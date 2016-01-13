function ywc_autocompletes($sel) {
    if(typeof $sel === "undefined") var $widget = $('div.ywc_autocomplete_widget input[type="text"]');
    else var $widget = $sel.find('div.ywc_autocomplete_widget input[type="text"]');
    $widget.each(function(i, el) {
	var $el = $(el);
	$el.autocomplete({
	    source: function(request, response) {
		var type = $el.parent().attr('data-type');
		$.post(ywc_glob['api_base_url']+'autocomplete/'+type, {
		    q: $el.val()
		}, function(data) {
		    data = data[type+'s'];
		    response(data.map(function(item) {						
			return {label:item['value'], value:item['id']};
		    }));
		});
	    },
	    select: function(e, u) {
		$el.val(u.item.label);
		$el.next().val(u.item.value+':'+u.item.label);
		$el.change();
		return false;
	    },
	});
	$el.val($el.next().val().split(':').splice(1, 100).join(':'));
	$el.keydown(function() {
	    $el.next().val('');
	});
    });
}
