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

                { data: 'lot_nombre', name: 'loteria', orderable: false, searchable: false  },
                { data: 'tic_ticket', name: 'tic_ticket', orderable: false, searchable: true  },
                { data: 'tic_fecha_sorteo', name: 'tic_fecha_sorteo', orderable: false, searchable: false  },
                { data: 'tic_apostado', name: 'tic_apostado', orderable: false, searchable: false  },
                { data: 'tic_ganado', name: 'tic_ganado', orderable: false, searchable: false  },
                // { data: 'tic_fecha_pago', name: 'tic_fecha_pago', orderable: false, searchable: false  },
                { data: 'tic_estado', name: 'tic_estado', orderable: false, searchable: false  },
                 { data: 'action', name: 'action' },
         ],
          fnDrawCallback: function(oSettings) {
            __currency_convert_recursively($('#reporte_tickets'));
        },
    });

     $(document).on('click', '.detalle-ticket', function() {
            var tickets_id = $(this).attr("data-ticket");

            reporteTicketDetalle(tickets_id);
        });

});


   //Reporte Detalle
  function reporteTicketDetalle(tickets_id) {

    var start = $('#spr_date_filter')
        .data('daterangepicker')
        .startDate.format('YYYY-MM-DD');
    var end = $('#spr_date_filter')
        .data('daterangepicker')
        .endDate.format('YYYY-MM-DD');


    var data = { start_date: start, end_date: end, tickets_id: tickets_id };

    var loader = __fa_awesome();

        $('.detalle').html(loader);

            $.ajax({
                method: 'GET',
                url: '/reportes/reporte-tickets-detalle',
                dataType: 'html',
                data: data,
                success: function(data) {
                    $('.detalle').html(data);
                    __currency_convert_recursively($('.detalle'));
                },

            });

    }
