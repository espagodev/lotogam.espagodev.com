$(document).ready(function() {

      $('.single-select').select2();

     $('select#imp_conexion').change(function() {
            var ctype = $(this).val();
            printer_connection_type_field(ctype);
     });

//option-div
    $(document).on('click', '.option-div-group .option-div', function() {
        $(this)
            .closest('.option-div-group')
            .find('.option-div')
            .each(function() {
                $(this).removeClass('active');
            });
        $(this).addClass('active');
        $(this)
            .find('input:radio')
            .prop('checked', true)
            .change();
    });

    $(document).on('change', 'input[type=radio][name=scheme_type]', function() {
        $('#invoice_format_settings').removeClass('hide');
        var scheme_type = $(this).val();
        if (scheme_type == 'blank') {
            $('#prefix')
                .val('')
                .attr('placeholder', 'XXXX')
                .prop('disabled', false);
        } else if (scheme_type == 'year') {
            var d = new Date();
            var this_year = d.getFullYear();
            $('#prefix')
                .val(this_year + '-')
                .attr('placeholder', '')
                .prop('disabled', true);
        }
        show_invoice_preview();
    });
        $(document).on('change', '#prefix', function() {
        show_invoice_preview();
    });
    $(document).on('keyup', '#prefix', function() {
        show_invoice_preview();
    });
    $(document).on('keyup', '#start_number', function() {
        show_invoice_preview();
    });
    $(document).on('change', '#total_digits', function() {
        show_invoice_preview();
    });

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

    // //usa para imprimir ticket desde modal.
    // $(document).on('click', 'a.print-ticket', function(e) {
    //     e.preventDefault();
    //     var href = $(this).data('href');

    //     $.ajax({
    //         method: 'GET',
    //         url: href,
    //         dataType: 'json',
    //         success: function(result) {
    //             if (result.success == 1 && result.receipt.html_content != '') {
    //                 $('#receipt_section').html(result.receipt.html_content);
    //                 __currency_convert_recursively($('#receipt_section'));
    //                 __print_receipt('receipt_section');
    //             } else {
    //                 // toastr.error(result.msg);
    //             }
    //         },
    //     });
    // });

    //  $(document).on('click', '.btn-modal', function(e) {
    //     e.preventDefault();
    //     var container = $(this).data('container');

    //     $.ajax({
    //         url: $(this).data('href'),
    //         dataType: 'html',
    //         success: function(result) {

    //             $(container)
    //                 .html(result)
    //                 .modal('show');
    //         },
    //     });
    // });
});



function printer_connection_type_field(ctype) {
    if (ctype == 'network') {
        $('div#path_div').addClass('hide');
        $('div#ip_address_div, div#port_div').removeClass('hide');
    } else if (ctype == 'windows' || ctype == 'linux') {
        $('div#path_div').removeClass('hide');
        $('div#ip_address_div, div#port_div').addClass('hide');
    }
}

function show_invoice_preview() {
    var prefix = $('#prefix').val();
    var start_number = $('#start_number').val();
    var total_digits = $('#total_digits').val();
    var preview = prefix + pad_zero(start_number, total_digits);
    $('#preview_format').text('# ' + preview);
}

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


//  $(document).on('click', '.print-invoice-link', function(e) {
//         e.preventDefault();
//         $.ajax({
//             url: $(this).attr('href') + "?check_location=true",
//             dataType: 'json',
//             success: function(result) {
//                 if (result.success == 1) {

//                     //Check if enabled or not
//                     if (result.receipt.is_enabled) {

//                         __pos_print(result.receipt);
//                     }
//                 } else {
//                     // toastr.error(result.msg);
//                 }

//             },
//         });
//     });
