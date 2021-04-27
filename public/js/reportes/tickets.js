$(document).ready(function() {

    if ($('#spr_date_filter').length == 1) {
        $('#spr_date_filter').daterangepicker(dateRangeSettings, function(start, end) {
            $('#spr_date_filter span').val(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );
            reporte_tickets.ajax.reload();
        });
        $('#spr_date_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#spr_date_filter').val('');
            reporte_tickets.ajax.reload();
        });
    }

    $('#reporte_tickets, #bancas_id, #loterias_id, #estado, #promocion, #users_id').change(
        function() {
            reporte_tickets.ajax.reload();
        }
    );

    //Reporte de tickets
     reporte_tickets =  $('#reporte_tickets').DataTable({
        processing: true,
        serverSide: true,
         aaSorting: false,
        ajax: {
                url: '/reportes/reporte-tickets',
                dataType: "json",
              data: function(d) {

                d.loterias_id = $('select#loterias_id').val();
                d.bancas_id = $('select#bancas_id').val();
                d.estado = $('select#estado').val();
                d.promocion = $('select#promocion').val();
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
                { data: 'tic_fecha_sorteo', name: 'tic_fecha_sorteo', orderable: false, searchable: false  },
                { data: 'tic_ticket', name: 'tic_ticket', orderable: false, searchable: true  },
                { data: 'lot_nombre', name: 'loteria', orderable: false, searchable: false  },
                { data: 'tic_numeros', name: 'tic_numeros', orderable: false, searchable: false  },
                { data: 'tic_apostado', name: 'tic_apostado', orderable: false, searchable: false  },
                { data: 'tic_estado', name: 'estado', orderable: false, searchable: false  },
                { data: 'action', name: 'action' },
         ],
          fnDrawCallback: function(oSettings) {
            __currency_convert_recursively($('#reporte_tickets'));
        },
    });

    // $('.view_register').on('shown.bs.modal', function() {
    //     __currency_convert_recursively($(this));
    //   });

});
