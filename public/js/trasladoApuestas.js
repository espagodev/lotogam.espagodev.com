$(document).ready(function() {

    if ($('#spr_date_filter').length == 1) {
        $('#spr_date_filter').daterangepicker(dateRangeSettings, function(start, end) {
            $('#spr_date_filter span').val(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );
            control_apuestas.ajax.reload();
        });
        $('#spr_date_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#spr_date_filter').val('');
            control_apuestas.ajax.reload();
        });
    }

    $('#control_apuestas, #bancas_id, #loterias_id, #modalidades_id').change(
        function() {
            control_apuestas.ajax.reload();
        }
    );

    //Reporte de tickets
     control_apuestas =  $('#control_apuestas').DataTable({
        processing: true,
        serverSide: true,
         aaSorting: false,
        ajax: {
                url: '/traslado-numeros',
                dataType: "json",
              data: function(d) {

                d.loterias_id = $('select#loterias_id').val();
                d.bancas_id = $('select#bancas_id').val();
                d.modalidades_id = $('select#modalidades_id').val();
                var start = '';
                var end = '';
                if ($('input#spr_date_filter').val()) {
                    start = $('input#spr_date_filter')
                        .data('daterangepicker')
                        .startDate.format('YYYY-MM-DD');
                    end = $('input#spr_date_filter')
                        .data('daterangepicker')
                        .endDate.format('YYYY-MM-DD');
                }
                d.start_date = start;
                d.end_date = end;
            },
        },
        columns: [
                { data: 'lot_nombre', name: 'loteria', orderable: false, searchable: false  },
                { data: 'ban_nombre', name: 'ban_nombre', orderable: false, searchable: false  },
                { data: 'mod_nombre', name: 'mod_nombre', orderable: false, searchable: true  },
                { data: 'cnj_numero', name: 'cnj_numero', orderable: false, searchable: false  },
                { data: 'cnj_contador', name: 'cnj_contador', orderable: false, searchable: false  },
                { data: 'cnj_fecha', name: 'cnj_fecha', orderable: false, searchable: false  },
         ],
          fnDrawCallback: function(oSettings) {
            __currency_convert_recursively($('#control_apuestas'));
        },
    });

    //imprimir reporte de numeros a pasar
    $(document).on("click", "a.numeros-traslado", function(e) {
        e.preventDefault();
        // var href = $(this).data("href") + "?ticket_copia=true";
        var href = $(this).data("href");
        var start = $('#spr_date_filter')
        .data('daterangepicker')
        .startDate.format('YYYY-MM-DD');
        var end = $('#spr_date_filter')
            .data('daterangepicker')
            .endDate.format('YYYY-MM-DD');
            var start = $('#spr_date_filter')
            .data('daterangepicker')
            .startDate.format('YYYY-MM-DD');
        var end = $('#spr_date_filter')
            .data('daterangepicker')
            .endDate.format('YYYY-MM-DD');
        var bancas_id = $('#bancas_id').val();
        var users_id = $('#users_id').val();
        var modalidades_id = $('select#modalidades_id').val();
        var loterias_id = $('select#loterias_id').val();

        var data = { start_date: start, end_date: end, bancas_id: bancas_id, users_id: users_id, modalidades_id:modalidades_id, loterias_id:loterias_id };

        $.ajax({
            method: "GET",
            url: href,
            dataType: "json",
            data: data,
            success: function(result) {
                if (result.success == 1 && result.receipt.html_content != "") {
                    $("#receipt_section").html(result.receipt.html_content);

                    __currency_convert_recursively($("#receipt_section"));
                    __print_receipt("receipt_section");
                } else {
                    Lobibox.notify("error", {
                        pauseDelayOnHover: true,
                        size: "mini",
                        rounded: true,
                        delayIndicator: false,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        msg: result.msg
                    });
                }
            }
        });
    });
});
