function ywc_datepickers($sel) {
    if(typeof $sel === "undefined") var $widget = $('div.ywc_datepicker_widget input');
    else var $widget = $sel.find('div.ywc_datepicker_widget input');
    $widget.datepicker({
	changeYear: true,
	changeMonth: true,
    });
}
