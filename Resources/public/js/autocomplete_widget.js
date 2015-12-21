function ywc_autocompletes($sel) {
    if(typeof $sel === "undefined") var $widget = $('div.ywc_autocomplete_widget input[type="text"]');
    else var $widget = $sel.find('div.ywc_autocomplete_widget input[type="text"]');
    $widget.each(function(i, el) {
	var $el = $(el);
	$el.bind("keydown", function(event) {
	    if(event.keyCode === $.ui.keyCode.TAB && $(this).autocomplete("instance").menu.active) event.preventDefault();
	});
	if($el.parent().attr('data-multiple') === 'false') {
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
		    $el.next().val(u.item.value);
		    $el.change();
		    return false;
		},
	    });
	}
	else {
	    $el.autocomplete({
		source: function(request, response) {
		    var type = $el.parent().attr('data-type');
		    $.post(ywc_glob['api_base_url']+'autocomplete/'+type, {
			q: $el.val().split(/,\s*/).pop()
		    }, function(data) {
			data = data[type+'s'];
			response(data.map(function(item) {						
			    return {label:item['value'], value:item['id']};
			}));
		    });
		},
		select: function(e, u) {
		    var labels = $el.val().split(/,\s*/);
		    labels.pop();
		    labels.push(u.item.label);
		    labels.push('');
		    $el.val($labels.join(', '));
		    var values = $el.next().val().split(/,\s*/);
		    values.push(u.item.value);
		    $el.next().val($values.join(','));
		    return false;
		}
	    });
	}
    });
}
