function ywc_datetimepickers($sel) {
    if(typeof $sel === "undefined") var $widget = $('div.ywc_datetimepicker_widget input');
    else var $widget = $sel.find('div.ywc_datetimepicker_widget input');
    $widget.datetimepicker({
	changeYear: true,
	changeMonth: true
    });
}
