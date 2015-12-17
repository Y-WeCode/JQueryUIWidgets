function ywc_init_all($sel) {
    ywc_autocompletes($sel);
    ywc_datepickers($sel);
}

$(document).ready(function() {
    ywc_init_all();
});
