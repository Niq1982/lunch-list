(function (blocks, element) {
	var el = element.createElement;

	blocks.registerBlockType('lunch-list/this-weeks-lunch', {
		edit: function () {
			return el('p', {}, 'Shows this weeks lunch');
		},
		save: function () {
			return el('p', {}, 'Shows this weeks lunch');
		},
	});
})(window.wp.blocks, window.wp.element);