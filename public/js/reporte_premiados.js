$(document).ready(function() {

    if ($('#spr_date_filter').length == 1) {
        $('#spr_date_filter').daterangepicker(dateRangeSettings, function(start, end) {
            $('#spr_date_filter span').val(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );
            reporte_premiados.ajax.reload();
        });
        $('#spr_date_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#spr_date_filter').val('');
            reporte_premiados.ajax.reload();
        });
    }

    $('#reporte_premiados, #bancas_id, #loterias_id, #promocion').change(
        function() {
            reporte_premiados.ajax.reload();
        }
    );

    //Reporte de tickets
     reporte_premiados =  $('#reporte_premiados').DataTable({
        processing: true,
        serverSide: true,
         aaSorting: false,
        ajax: {
                url: '/reportes/reporte-premiados',
                dataType: "json",
              data: function(d) {

                 d.loterias_id = $('select#loterias_id').val();
                d.bancas_id = $('select#bancas_id').val();
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
                { data: 'tic_ticket', name: 'ticket', orderable: false, searchable: true  },
                { data: 'tic_fecha_sorteo', name: 'tic_fecha_sorteo', orderable: false, searchable: false  },
                { data: 'lot_nombre', name: 'loteria', orderable: false, searchable: false  },
                { data: 'tic_apostado', name: 'tic_apostado', orderable: false, searchable: false  },
                { data: 'tic_ganado', name: 'tic_ganado', orderable: false, searchable: false  },
                { data: 'tic_estado', name: 'tic_estado', orderable: false, searchable: false  },
                { data: 'action', name: 'action' , orderable: false, searchable: false  },
         ],
          fnDrawCallback: function(oSettings) {
            __currency_convert_recursively($('#reporte_premiados'));
        },
    });

});

