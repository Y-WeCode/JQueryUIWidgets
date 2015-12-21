function ywc_select2s($sel) {
    if(typeof $sel === "undefined") var $widget = $('div.ywc_select2_widget select');
    else var $widget = $sel.find('div.ywc_select2_widget select');
    $widget.each(function(i, el) {
	var $el = $(el);
	var type = $el.parent().attr('data-type');
	$el.select2({
	    ajax: {
		url: ywc_glob['api_base_url']+'autocomplete/'+type,
		dataType: 'json',
		delay: 250,
		method: 'POST',
		data: function (params) {
		    return {
			q: params.term, // search term
		    };
		},
		processResults: function (data, params) {    
		    return {
			results: data.items
		    };
		},
		cache: true
	    },
	    escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
	    minimumInputLength: 1
	    //templateResult: formatRepo, // omitted for brevity, see the source of this page
	    //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
	});
    });
}
