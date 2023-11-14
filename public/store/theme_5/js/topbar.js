const fuseContainer = {
	"fuse": null
};

async function fetch_catalog(catalog_url) {
	const response = await fetch(catalog_url);
	const response_json = await response.json();
	const catalog = response_json.catalog;
	initInstanceSearch(catalog);
}

function initInstanceSearch(catalog) {
	const options = {
		shouldSort: true,
		includeScore: false,
		includeMatches: true,
		threshold: 0.2,
		location: 0,
		distance: 100,
		tokenize: true,
		maxPatternLength: 32,
		minMatchCharLength: 1,
		matchAllTokens: true,
		keys: [
			"name_en",
			"name_ar",
		]
	};
	fuseContainer["fuse"] = new Fuse(catalog, options);
}

function initializeTopBarApp() {

	function clickDrawerMenuItem(item) {

		const hasChildren = item.children.length > 0;

		if (hasChildren) {

			this.drawerMenuSelectionStack.push(this.drawerMenuRoot);
			this.drawerMenuRoot = item;

		} else if (item.url) {

			if (item.new_tab)
				window.open(item.url, '_blank');
			else
				window.location.href = item.url;

		}

	}

	function clickDrawerMenuBack() {
		this.drawerMenuRoot = this.drawerMenuSelectionStack.pop();
	}

	const virtualMenuRoot = {
		"children": menu_v2,
	};

	const app = new Vue({
		components: ['x-searchbar'],
		el: '#search-app',
		delimiters: ['{', '}'],
		data: {
			query: "",
			results: [],
			has_focus: false,
			drawerMenuRoot: virtualMenuRoot,
			drawerMenuSelectionStack: [],
		},
		methods: {
			clickDrawerMenuBack,
			clickDrawerMenuItem,
		}
	});

}

window.addEventListener('jsload', initializeTopBarApp);