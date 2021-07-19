$(document).ready(function() {
    //Purchase & Sell report
    //Date range as a button
    if ($('#spr_date_filter').length == 1) {
        $('#spr_date_filter').daterangepicker(dateRangeSettings, function(start, end) {
            $('#spr_date_filter span').html(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );
            updatePurchaseSell();
        });
        $('#spr_date_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#spr_date_filter').html(
                '<i class="fa fa-calendar"></i> ' + LANG.filter_by_date
            );
        });
        updatePurchaseSell();
    }

    $('#bancas_id, #users_id').change(function() {
        updatePurchaseSell();
    });
});


function updatePurchaseSell() {
    var start = $('#spr_date_filter')
        .data('daterangepicker')
        .startDate.format('YYYY-MM-DD');
    var end = $('#spr_date_filter')
        .data('daterangepicker')
        .endDate.format('YYYY-MM-DD');
    var bancas_id = $('#bancas_id').val();
    var users_id = $('#users_id').val();

    var data = { start_date: start, end_date: end, bancas_id: bancas_id, users_id: users_id };

    var loader = __fa_awesome();
    $('.venta_total').html(loader);
    $('.venta_promocion').html(loader);
    $('.venta_futuro').html(loader);
    $('.venta_comison').html(loader);
    $('.total_premios').html(loader);
    $('.total_pagado').html(loader);
    $('.total_premios_promo').html(loader);
    $('.total_pendiente_pago').html(loader);
    $('.neto_total').html(loader);
    $('.total_entrada').html(loader);
    $('.total_salida').html(loader);
    $('.total_cupo').html(loader);
    $('.neto_faltante').html(loader);
    $('.gastos_banca').html(loader);
    $('.balance_inicial').html(loader);

    $.ajax({
        method: 'GET',
        url: '/reportes/informe-ventas-pagos',
        dataType: 'json',
        data: data,
        success: function(data) {

            $('.venta_total').html(__currency_trans_from_en(data.total_venta, true));
            $('.venta_promocion').html(__currency_trans_from_en(data.total_venta_promo, true));
            $('.venta_futuro').html(__currency_trans_from_en(data.total_venta_futuro, true));
            $('.venta_comison').html(__currency_trans_from_en(data.total_comision, true));

            $('.total_premios').html(__currency_trans_from_en(data.total_premios, true));
            $('.total_premios_promo').html(__currency_trans_from_en(data.total_premios_promo, true));
            $('.total_pagado').html(__currency_trans_from_en(data.total_pagado, true));
            $('.total_pendiente_pago').html(__currency_trans_from_en(data.total_pendiente_pago, true));

            $('.neto_total').html(__currency_trans_from_en(data.neto_total, true));

            $('.total_entrada').html(__currency_trans_from_en(data.total_entrada, true));
            $('.total_salida').html(__currency_trans_from_en(data.total_salida, true));
            $('.total_cupo').html(__currency_trans_from_en(data.total_cupo, true));

            $('.neto_faltante').html(__currency_trans_from_en(data.neto_faltante, true));
            $('.balance_inicial').html(__currency_trans_from_en(data.balance_inicial, true));
        },
    });
}
