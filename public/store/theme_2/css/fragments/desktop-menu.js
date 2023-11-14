const desktopMenu = (function() {

	const state = {};
	const template = document.querySelector(".desktop-menu-wrapper");

	function stopHideCountdown() {
		window.clearTimeout(state.timeoutHandle);
	}

	function startHideCountdown() {

		// Handle menu mouseout events (by restarting the hiding
		// countdown timer).

		stopHideCountdown();

		const timeoutHandle = window.setTimeout(() => {
			template.classList.remove("show");
		}, 250);

		state.timeoutHandle = timeoutHandle;
	}

	function show(anchorElement) {

		// Show sub-menu panel, conditionally.

		// This function shows the sub-menu panel for a top-level
		// desktop menu item, on the condition that the item has
		// children.

		// First, check if item has children ...

		const index = anchorElement.getAttribute("index");
		const hasChildren = menu_v2[index].children.length > 0;

		if (!hasChildren)
			return;  // nothing to do

		// Menu item has children so show sub-menu ...

		app.index = index;
		Popper.createPopper(anchorElement, template);
		template.classList.add("show");

		// and clear any existing hiding countdown timer ...

		stopHideCountdown();

		// Finally, calculate sub-menu depth (used for rendering panels at suitable sizes)

		app.depth = calculateDepth(menu_v2[index]);

	}

	function subMenu() {
		return menu_v2[this.index].children;
	}

	function navigateItem(item) {

		if (!item.url)
			return;  // nothing to do

		if (item.new_tab)
			window.open(item.url, '_blank');
		else
			window.location.href = item.url;

	}

	function calculateDepth(root) {

		const max = (items) => Math.max(...items);

		function _calculateDepth(root) {
			const hasChildren = root.children.length > 0;
			return hasChildren ? max(root.children.map(_calculateDepth)) + 1: 0;
		}

		return _calculateDepth(root);

	}

	function isExpanded() {
		return this.depth > 1;
	}

	function expandedStyle() {

		// Return computed style to display (expanded) sub-menu panel with a
		// width proportional to number of children.

		if (!this.isExpanded)
			return {
				"min-width": 0
			};

		const children_count = menu_v2[this.index].children.length;
		const width = 150 * children_count;

		return {
			"min-width": `${width}px`,
		}
	}

	const app = new Vue({
		el: '#desktop-menu-app',
		data: {
			index: 0,
			depth: null,
		},
		methods: {
			 navigateItem,
		},
		computed: {
			subMenu,
			isExpanded,
			expandedStyle,
		},
		delimiters: ['{', '}'],
	});

	return {
		show,
		stopHideCountdown,
		startHideCountdown,
	};

})();