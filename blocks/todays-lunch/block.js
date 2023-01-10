(function (blocks, element) {
	var el = element.createElement;

	blocks.registerBlockType('lunch-list/todays-lunch', {
		edit: function () {
			return el('p', {}, 'Shows todays lunch');
		},
		save: function () {
			return el('p', {}, 'Shows todays lunch');
		},
	});
})(window.wp.blocks, window.wp.element);