const cart = (function() {

	'use strict';

	const key = "cart";
	const version = "7";  // string (must match version in localStorage)
	const observers = [];  // list of callbacks

	function getCartItemKey(item) {

		// Calculate string key for identifying unique cart items.

		// Two cart items are identical iff they have the same product
		// (identified by its primary key) and set of custom field values.

		const sortIfArray = item => Array.isArray(item) ? item.sort() : item;

		const pk = item.pk;
		const fieldValues = item.custom_fields
			.map(item => item.value)
			.map(sortIfArray);
		return JSON.stringify([pk, fieldValues]);
	}

	function setItems(items) {

		// Write cart items to localStorage.

		const cart = {items, version};
		localStorage.setItem(key, JSON.stringify(cart));
		notifyObservers();
	}

	function get() {

		// Load cart from localStorage.

		const cart_s = localStorage.getItem('cart') || "{}";
		const cart = JSON.parse(cart_s);
		const valid = cart.version === version;

		cart.items = valid ? cart.items : [];  // empty items if invalid

		const items = cart.items
			.filter(item => item.quantity > 0)
			.map(annotateCustomFields)
			.map(addAttributeTexts)
			.map(addTotals);

		const total = _.chain(items)
			.map(item => item.total)
			.sum()
			.value();

		const count = _.chain(items)
			.map(item => item.quantity)
			.sum()
			.value();

		return {items, total, count};

	}

	function getCustomFieldCharge(field) {

		// Return the total charge of a custom field.

		const {value, options, type} = field;

		const hasValue = value.length > 0;

		if (!hasValue)
			return 0;

		if (type === "multi-select") {

			// Value is a list (of option IDs)

			return _.chain(options)
				.filter(item => value.includes(item.id))
				.map(item => item.computed_price)
				.map(Number)
				.sum()
				.value();

		} else if (type === "single-select") {

			// Value is an option ID

			const option = options.find(item => item.id === value);
			return Number(option.computed_price);

		} else {

			return Number(field.price || "0");
		}
	}

	function getCustomFieldValueTexts(field) {

		// Return field value(s) as a (blingual) string.

		const hasValue = field.value.length > 0;

		if (!hasValue)
			return {
				"valueText_en": "",
				"valueText_ar": ""
			};

		if (field.type === "multi-select") {

			// Value is a list (of option IDs)

			const selected = field.options
				.filter(item => field.value.includes(item.id));

			return {
				"valueText_en": selected.map(item => item.name_en).join(", "),
				"valueText_ar": selected.map(item => item.name_ar).join(", "),
			}

		} else if (field.type === "single-select") {

			// Value is an option ID

			const option = field.options
				.find(item => item.id === field.value);

			return {
				"valueText_en": option.name_en,
				"valueText_ar": option.name_ar,
			}

		} else {

			return {
				"valueText_en": field.value,
				"valueText_ar": field.value,
			};

		}
	}

	function annotateCustomField(field) {

		// Add "hasValue" and "charge" properties to a custom field
		// object.
		//
		// - hasValue (Boolean) indicates whether the field has been
		//   filled-in by the user.
		//
		// - charge is field fee (zero if hasValue is false).

		const hasValue = field.value.length > 0;
		const charge = getCustomFieldCharge(field);
		const valueTexts = getCustomFieldValueTexts(field);
		return {...field, hasValue, charge, ...valueTexts};
	}

	function annotateCustomFields(product) {

		// Annotate a product's custom fields (see annotateCustomField),
		// as well as add "charges" and "item_total" properties to the
		// product.

		const custom_fields = product.custom_fields
			.map(annotateCustomField);

		const charges = _.chain(custom_fields)
			.map(item => item.charge)
			.sum()
			.value();

		const item_total = Number(product.price) + charges;

		return {
			...product,
			charges,
			item_total,
			custom_fields,
		};
	}

	function checkItemTotals(product) {

		return [product]
			.map(annotateCustomFields)
			.map(addTotals)[0];
	}

	function addTotals(product) {

		// Annotate a product object with a "total" field.

		const total = product.item_total * product.quantity;
		return {...product, total};
	}

	function addAttributeTexts(product) {

		const {attributes} = product;

		const pairs = Object.entries(attributes)
			.map( ([key, val]) => `${key} = ${val}`);

		const text = pairs.join(", ");

		return {
			...product,
			attributeText_en: text,
			attributeText_ar: text,
		};

	}

	function add(product, options={}) {

		// Add an item to cart.

		const {
			quantity = 1,
		} = options;

		const {items} = get();
		const productKey = getCartItemKey(product);
		const existing = items.find(item => getCartItemKey(item) == productKey);

		if (existing) {

			existing.quantity += quantity;
			setItems(items);

		} else {

			const newItem = {...product, quantity};
			setItems([...items, newItem]);
		}
	}

	function validateIndex(index) {

		const {items} = get();
		const valid = index >= 0 && index < items.length;

		if (!valid) {
			throw "invalid cart item index";
		}

	}

	function setQuantity(index, newQuantity) {

		// Change quantity of cart item.

		validateIndex(index);
		const {items} = get();
		items[index].quantity = Math.max(newQuantity, 0);
		setItems(items);
	}

	function addQuantity(index, delta=1) {

		// Increment quantity of a cart item.

		validateIndex(index);
		const {items} = get();
		items[index].quantity += delta;
		setItems(items);
	}

	function remove(index) {

		// Remove cart item.

		validateIndex(index);
		const {items} = get();
		items.splice(index, 1);
		setItems(items);
	}

	function filter(predicate) {

		// Filter cart items with a predicate.

		const {items} = get();

		const updatedItems = items.filter(predicate);

		setItems(updatedItems);
	}

	function clear() {

		// Clear cart content.

		setItems([]);
	}

	function limitQuantity(pk, count) {

		// Limit the total number of cart item units with given pk to count.
		//
		// Notes:
		//
		//   1. Used to update cart items based on stock availability.
		//
		//   2. May modify multiple cart items, since the same product can be
		//      listed more than once (with different custom field values).
		//
		//   3. Functional implementation dropped in favor of imperative
		//      alternative for readability.

		let remaining = count;

		function limitQuantity(item) {
			item.quantity = Math.min(item.quantity, remaining);
			remaining = remaining - item.quantity;
		}

		const { items } = get();
		items.filter(item => item.pk == pk).map(limitQuantity);
		setItems(items);

	}

	function observe(callback) {

		// Register cart change callback.

		callback(get()); // make first callback during registration
		observers.push(callback);
	}

	function notifyObservers() {

		// Notify observers of a change in cart content.

		const cart = get();
		for (const cb of observers)
			cb(cart);
	}

	function print() {

		// Print cart content.

		console.log(JSON.stringify(get(), null, 4));
	}

	return {
		get,
		add,
		clear,
		print,
		remove,
		filter,
		observe,
		setQuantity,
		addQuantity,
		limitQuantity,
		checkItemTotals,
	};

})();
