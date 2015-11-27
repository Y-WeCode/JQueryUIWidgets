$(document).ready(function() {
    var $widget = $('div.ywc_slider_widget div.slider');
    $widget.each(function(i, el) {
	var $el = $(el);
	$el.slider({
	    max: parseInt($el.attr('data-max')),
	    min: parseInt($el.attr('data-min')),
	    value: parseInt($el.attr('data-value')),
	    slide: function(e, ui) {
		$el.next().html(ui.value);
	    },
	    change: function(e, ui) {
		$el.next().next().val(ui.value);
	    }
	});
    });
});
