$(document).ready(function() {

    if ($('#spr_date_filter').length == 1) {
        $('#spr_date_filter').daterangepicker(dateRangeSettings, function(start, end) {
            $('#spr_date_filter span').val(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );
            caja_general.ajax.reload();
            getCajaGeneral();
        });
        $('#spr_date_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#spr_date_filter').val('');
            caja_general.ajax.reload();
            getCajaGeneral();
        });
        getCajaGeneral();
    }

    $('#caja_general, #bancas_id, #users_id, #movimiento').change(
        function() {
            caja_general.ajax.reload();
            getCajaGeneral();
        }
    );

    // Reporte de caja general
     caja_general =  $('#caja_general').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: false,
        ajax: {
                url: '/caja_general/getCajaGeneral',
                dataType: "json",
              data: function(d) {

                d.bancas_id = $('select#bancas_id').val();
                d.users_id = $('select#users_id').val();
                d.movimiento = $('select#movimiento').val();

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
             { data: 'cag_movimiento', name: 'cag_movimiento', orderable: false, searchable: false },
             { data: 'cag_fecha_movimiento', name: 'cag_fecha_movimiento', orderable: false, searchable: false },
             { data: 'bancas_id', name: 'bancas_id', orderable: false, searchable: false },
             { data: 'users_id', name: 'users_id', orderable: false, searchable: false },
             { data: 'cag_monto', name: 'cag_monto', orderable: false, searchable: false },
             { data: 'cag_nota_movimiento', name: 'cag_nota_movimiento', orderable: false, searchable: false },
             { data: 'action', name: 'action', orderable: false, searchable: false },

         ],
         fnDrawCallback: function (oSettings) {
             __currency_convert_recursively($('#caja_general'));
         },
    });

    $(document).on('click', '.nuevo-registro', function (e) {
        e.preventDefault();
        var container = $('.nuevo_modal');

        $.ajax({
            url: $(this).data('href'),
            dataType: 'html',
            success: function (result) {
                container.html(result).modal('show');
            },
        });
    });

    $(document).on('click', 'button.delete_cajaGeneral_button', function() {
        swal({
            title: "Estás seguro ?",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).data('href');
                var data = $(this).serialize();

                $.ajax({
                    method: 'GET',
                    url: href,
                    dataType: 'json',
                    data: data,
                    success: function(result) {

                        if (result.success === true) {
                            Lobibox.notify("success", {
                                pauseDelayOnHover: true,
                                size: "mini",
                                rounded: true,
                                delayIndicator: false,
                                continueDelayOnInactiveTab: false,
                                position: "top right",
                                msg: result.msg,
                            });
                            caja_general.ajax.reload();
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
            }
        });
    });


});


function getCajaGeneral() {

    var start = $('#spr_date_filter')
        .data('daterangepicker')
        .startDate.format('YYYY-MM-DD');
    var end = $('#spr_date_filter')
        .data('daterangepicker')
        .endDate.format('YYYY-MM-DD');
    var bancas_id = $('#bancas_id').val();

    var data = { start_date: start, end_date: end, bancas_id: bancas_id };

    var loader = __fa_awesome();

    $('.balance_inicial').html(loader);
    $('.total_entradas').html(loader);
    $('.total_salidas').html(loader);
    $('.total_cupo').html(loader);
    $('.total_neto').html(loader);



    $.ajax({
        method: 'GET',
        url: '/caja_general/getCajaGeneralDetalle',
        dataType: 'json',
        data: data,
        success: function (data) {
            $('.balance_inicial').html(__currency_trans_from_en(data.balance_inicial, true));
            $('.total_entradas').html(__currency_trans_from_en(data.total_entradas, true));
            $('.total_salidas').html(__currency_trans_from_en(data.total_salidas, true));
            $('.total_cupo').html(__currency_trans_from_en(data.total_cupo, true));
            $('.total_neto').html(__currency_trans_from_en(data.total_neto, true));

        },
    });
}
