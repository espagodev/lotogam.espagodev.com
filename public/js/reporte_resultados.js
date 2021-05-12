$(document).ready(function() {

    if ($('#spr_date_filter').length == 1) {
        $('#spr_date_filter').daterangepicker(dateRangeSettings, function(start, end) {
            $('#spr_date_filter span').val(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );
            reporte_resultados.ajax.reload();
        });
        $('#spr_date_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#spr_date_filter').val('');
            reporte_resultados.ajax.reload();
        });
    }

    $('#reporte_resultados, #loterias_id').change(
        function() {
            reporte_resultados.ajax.reload();
        }
    );

    //Reporte de resultados
     reporte_resultados =  $('#reporte_resultados').DataTable({
        processing: true,
        serverSide: true,
         aaSorting: false,
        ajax: {
                url: '/reportes/reporte-resultados',
                dataType: "json",
              data: function(d) {

                d.loterias_id = $('select#loterias_id').val();
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
                { data: 'loteria', name: 'loteria', orderable: false, searchable: false  },
                { data: 'res_fecha', name: 'res_fecha', orderable: false, searchable: false  },
                { data: 'res_premio1', name: 'res_premio1', orderable: false, searchable: false  },
                { data: 'res_premio2', name: 'res_premio2', orderable: false, searchable: false  },
                { data: 'res_premio3', name: 'res_premio3', orderable: false, searchable: false  },

         ],
          fnDrawCallback: function(oSettings) {
            __currency_convert_recursively($('#reporte_resultados'));
        },
    });

     //Reporte de resultados detalle
     $(document).on('click', '.detalle-resultados', function() {
            var loterias_id = $(this).attr("data-loteria");

            reporteResultadosDetalle(loterias_id);
        });

});

   //Reporte Detalle
  function reporteResultadosDetalle(loterias_id) {

    var start = $('#spr_date_filter')
        .data('daterangepicker')
        .startDate.format('YYYY-MM-DD');
    var end = $('#spr_date_filter')
        .data('daterangepicker')
        .endDate.format('YYYY-MM-DD');


    var data = { start_date: start, end_date: end, loterias_id: loterias_id };

    var loader = __fa_awesome();

        $('.detalle_resultados').html(loader);

            $.ajax({
                method: 'GET',
                url: '/reportes/reporte-resultados-detalle',
                dataType: 'html',
                data: data,
                success: function(data) {
                    $('.detalle_resultados').html(data);
                    __currency_convert_recursively($('.detalle_resultados'));
                },

            });

    }
