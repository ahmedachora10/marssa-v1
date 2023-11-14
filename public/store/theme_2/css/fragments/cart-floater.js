const cart_floater = new Vue({
	el: '#cart-floater',
	delimiters: ['{', '}'],
	data: {
		some_key: 0,  // used for add-to-cart animation
		count: 0,  // number of items in cart
	},
	methods: {
		animate_addition() {
			this.some_key += 1;
		}
	},
	mounted() {
		cart.observe((cart) => {this.count = cart.count});
	}
});
