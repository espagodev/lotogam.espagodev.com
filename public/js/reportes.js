$(document).ready(function() {

    if ($('#spr_date_filter').length == 1) {
        $('#spr_date_filter').daterangepicker(dateRangeSettings, function(start, end) {
            $('#spr_date_filter span').val(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );
            reporte_ventas.ajax.reload();
        });
        $('#spr_date_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#spr_date_filter').val('');
            reporte_ventas.ajax.reload();
        });
    }

    $('#reporte_ventas, #bancas_id, #loterias_id, #users_id, #estado, #promocion').change(
        function() {
            reporte_ventas.ajax.reload();
        }
    );

    //Reporte de Ventas
     reporte_ventas =  $('#reporte_ventas').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: false,
        ajax: {
                url: '/reportes/reporte-ventas',
                dataType: "json",
              data: function(d) {

                d.loterias_id = $('select#loterias_id').val();
                d.bancas_id = $('select#bancas_id').val();
                d.users_id = $('select#users_id').val();
                d.estado = $('select#estado').val();
                d.promocion = $('select#promocion').val();
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

                { data: 'lot_nombre', name: 'lot_nombre', orderable: false, searchable: false  },
                { data: 'venta', name: 'venta', orderable: false, searchable: false  },
                { data: 'venta_promo', name: 'venta_promo', orderable: false, searchable: false },
                { data: 'comision', name: 'comision', orderable: false, searchable: false  },
                { data: 'ganado', name: 'ganado', orderable: false, searchable: false  },
                { data: 'premios_promo', name: 'premios_promo', orderable: false, searchable: false },
                { data: 'ganancia', name: 'ganancia', orderable: false, searchable: false  },
         ],
          fnDrawCallback: function(oSettings) {
            var total_venta = sum_table_col($('#reporte_ventas'), 'venta');
            $('#footer_total_venta').text(total_venta);

              var total_venta_promo = sum_table_col($('#reporte_ventas'), 'venta_promo');
              $('#footer_total_venta_promo').text(total_venta_promo);

             var total_comision = sum_table_col($('#reporte_ventas'), 'comision');
            $('#footer_total_comision').text(total_comision);

             var total_premios = sum_table_col($('#reporte_ventas'), 'premios');
            $('#footer_total_premios').text(total_premios);

              var total_premios_promo = sum_table_col($('#reporte_ventas'), 'premios_promo');
              $('#footer_total_premios_promo').text(total_premios_promo);

             var total_ganancia = sum_table_col($('#reporte_ventas'), 'ganancia');
            $('#footer_total_ganancia').text(total_ganancia);

            __currency_convert_recursively($('#reporte_ventas'));
        },
    });

     $(document).on('click', '.detalle-ventas', function() {
            var loterias_id = $(this).attr("data-loteria");

            reporteVentasDetalle(loterias_id);
        });

});

      //Reporte Detalle
  function reporteVentasDetalle(loterias_id) {

    var bancas_id = $('#bancas_id').val();

    var start = $('#spr_date_filter')
        .data('daterangepicker')
        .startDate.format('YYYY-MM-DD');
    var end = $('#spr_date_filter')
        .data('daterangepicker')
        .endDate.format('YYYY-MM-DD');


    var data = { start_date: start, end_date: end, loterias_id: loterias_id, bancas_id: bancas_id };

    var loader = __fa_awesome();

        $('.detalle').html(loader);

            $.ajax({
                method: 'GET',
                url: '/reportes/reporte-ventas-detalle',
                dataType: 'html',
                data: data,
                success: function(data) {
                    $('.detalle').html(data);
                    __currency_convert_recursively($('.detalle'));
                },

            });

    }


//Used for Purchase & Sell invoice.
$(document).on('click', 'a.print-invoice', function(e) {
        e.preventDefault();
        var href = $(this).data('href');

        var loterias_id = $('select#loterias_id').val();
                var bancas_id = $('select#bancas_id').val();
                var users_id = $('select#users_id').val();
                var estado = $('select#estado').val();
                var promocion = $('select#promocion').val();
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
               var start_date = start;
               var end_date = end;


        var data = { start_date: start, end_date: end, loterias_id: loterias_id, bancas_id: bancas_id, users_id: users_id, promocion: promocion};
        $.ajax({
            method: 'GET',
            url: href,
            data: data,
            dataType: 'json',
            success: function(result) {
                if (result.success == 1 && result.receipt.html_content != '') {
                    $('#receipt_section').html(result.receipt.html_content);
                    __currency_convert_recursively($('#receipt_section'));
                    __print_receipt('receipt_section');
                } else {
                    Lobibox.notify("error", {
                        pauseDelayOnHover: true,
                        size: "mini",
                        rounded: true,
                        delayIndicator: false,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        msg: result.msg,
                    });
                }
            },
        });
    });
