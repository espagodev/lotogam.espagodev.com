$(document).ready(function() {

    if ($('#spr_date_filter').length == 1) {
        $('#spr_date_filter').daterangepicker(dateRangeSettings, function(start, end) {
            $('#spr_date_filter span').val(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );
            reporte_registro.ajax.reload();
        });
        $('#spr_date_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#spr_date_filter').val('');
            reporte_registro.ajax.reload();
        });
    }

    $('.view_register').on('shown.bs.modal', function () {
        __currency_convert_recursively($(this));
    });

      $(document).on('click', '.btn-modal', function(e) {
        e.preventDefault();
        var container = $(this).data('container');

        $.ajax({
            url: $(this).data('href'),
            dataType: 'html',
            success: function(result) {

                $(container)
                    .html(result)
                    .modal('show');
            },
        });
    });

    $('#reporte_registro, #bancas_id,  #estado,  #users_id').change(
        function() {
            reporte_registro.ajax.reload();
        }
    );

    //Reporte de tickets
     reporte_registro =  $('#reporte_registro').DataTable({
        processing: true,
        serverSide: true,
         aaSorting: false,
        ajax: {
            url: '/reportes/reporte-registros',
                dataType: "json",
              data: function(d) {

                d.bancas_id = $('select#bancas_id').val();
                d.estado = $('select#estado').val();
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

                { data: 'created_at', name: 'created_at', orderable: false, searchable: false  },
                { data: 'caj_hora_cierre', name: 'caj_hora_cierre', orderable: false, searchable: true  },
                { data: 'bancas_id', name: 'bancas_id', orderable: false, searchable: false  },
                { data: 'users_id', name: 'users_id', orderable: false, searchable: false  },
                { data: 'caj_monto_cierre', name: 'caj_monto_cierre', orderable: false, searchable: false },
                { data: 'caj_estado', name: 'caj_estado', orderable: false, searchable: false  },
                 { data: 'action', name: 'action' },
         ],
          fnDrawCallback: function(oSettings) {
              __currency_convert_recursively($('#reporte_registro'));
        },
    });



});

