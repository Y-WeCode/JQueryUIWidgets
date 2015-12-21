function ywc_init_all($sel) {
    ywc_autocompletes($sel);
    ywc_select2s($sel);
    ywc_datepickers($sel);
    ywc_datetimepickers($sel);
}

$(document).ready(function() {
    ywc_init_all();
});
