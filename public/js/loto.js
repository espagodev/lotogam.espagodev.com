$(document).ready(function() {

      $('.single-select').select2();



//option-div


        //Business Location Receipt setting
    if ($('form#opciones_impresora_pos').length == 1) {
        if ($('select#ban_tipo_impresora').val() == 'printer') {
            $('div#location_printer_div').removeClass('hide');
        } else {
            $('div#location_printer_div').addClass('hide');
        }

        $('select#ban_tipo_impresora').change(function() {
            var printer_type = $(this).val();
            if (printer_type == 'printer') {
                $('div#location_printer_div').removeClass('hide');
            } else {
                $('div#location_printer_div').addClass('hide');
            }
        });

        $('form#opciones_impresora_pos').validate();
    }

});







function pad_zero(str, max) {
    str = str.toString();
    return str.length < max ? pad_zero('0' + str, max) : str;
}


    $('button#full_screen').click(function(e) {
        element = document.documentElement;
        if (screenfull.isEnabled) {
            screenfull.toggle(element);
        }
    });


