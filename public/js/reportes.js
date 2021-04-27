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

    $('#reporte_ventas, #bancas_id, #loterias_id, #users_id').change(
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
                { data: 'comision', name: 'comision', orderable: false, searchable: false  },
                { data: 'ganado', name: 'ganado', orderable: false, searchable: false  },
                { data: 'ganancia', name: 'ganancia', orderable: false, searchable: false  },
         ],
          fnDrawCallback: function(oSettings) {
            var total_venta = sum_table_col($('#reporte_ventas'), 'venta');
            $('#footer_total_venta').text(total_venta);
             var total_comision = sum_table_col($('#reporte_ventas'), 'comision');
            $('#footer_total_comision').text(total_comision);
             var total_premios = sum_table_col($('#reporte_ventas'), 'premios');
            $('#footer_total_premios').text(total_premios);
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


