function ywc_select2s($sel) {
    if(typeof $sel === "undefined") var $widget = $('div.ywc_select2_widget select');
    else var $widget = $sel.find('div.ywc_select2_widget select');
    $widget.each(function(i, el) {
	var $el = $(el);
	var type = $el.parent().parent().attr('data-type');	
	$el.select2({
	    ajax: {
		url: ywc_glob['api_base_url']+'autocomplete/'+type,
		dataType: 'json',
		delay: 250,
		method: 'POST',
		cache: true,
		data: function (params) {
		    return {
			q: params.term
		    };
		},
		processResults: function(data, params) {
		    return {results: data[type+'s']};
		}		
	    },
	    templateResult: function(item) {
		return item.value;
	    },
	    templateSelection: function(item) {
		return item.value;
	    }
	});
	reloadTags($el);
    });    
    $widget.change(function() {
	var $el = $(this);
	reloadTags($el);
	var propagate_label = $el.parent().parent().attr('data-propagate-label');
	console.log(propagate_label);
	if(typeof propagate_label !== typeof undefined && propagate_label !== false) {
	    var $labels = $el.parent().find('li.select2-selection__choice');
	    var $values = $el.val();
	    var out = [];
	    $.each($labels, function(i, v) {
		out.push($values[i]+'::'+$(v).clone().children().remove().end().text())
	    });
	    $(this).parents('div.ywc_select2_widget').children('input').val(out.join(',,'));
	}
	else $(this).parents('div.ywc_select2_widget').children('input').val($el.val().join());
    });
}

function reloadTags($el) {
    var $tags = $el.parent().find('li.select2-selection__choice');
    $tags.each(function(i, el) {
	var $tag = $(el);
	if($tag.clone().children().remove().end().text() == '') $tag.append($tag.attr('title'));
    });
}
