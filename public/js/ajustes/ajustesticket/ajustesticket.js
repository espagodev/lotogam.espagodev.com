$(document).ready(function() {

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

    $(document).on('change', 'input[type=radio][name=eqt_tipo]', function() {
        $('#invoice_format_settings').removeClass('hide');
        var scheme_type = $(this).val();

        if (scheme_type == 'blank') {
            $('#eqt_prefijo')
                .val('')
                .attr('placeholder', 'XXXX')
                .prop('disabled', false);
        } else if (scheme_type == 'year') {
            var d = new Date();
            var this_year = d.getFullYear();

            $('#eqt_prefijo')
                .val(this_year + '-')
                .attr('placeholder', '')
                .prop('disabled', true);
        }
        show_invoice_preview();
    });
        $(document).on('change', '#eqt_prefijo', function() {
        show_invoice_preview();
    });
    $(document).on('keyup', '#eqt_prefijo', function() {
        show_invoice_preview();
    });
    $(document).on('keyup', '#eqt_ticket_inicial', function() {
        show_invoice_preview();
    });
    $(document).on('change', '#eqt_ticket_digitos', function() {
        show_invoice_preview();
    });

      $(document).on('click', '.modificar-esquema', function(e) {
        e.preventDefault();
        var container = $('.modificar_modal');

        $.ajax({
            url: $(this).data('href'),
            dataType: 'html',
            success: function(result) {
                container.html(result).modal('show');


            },
        });
    });
});

function show_invoice_preview() {
    var prefix = $('#eqt_prefijo').val();
    var start_number = $('#eqt_ticket_inicial').val();
    var total_digits = $('#eqt_ticket_digitos').val();
    var preview = prefix + pad_zero(start_number, total_digits);
    $('#preview_format').text('# ' + preview);
}
