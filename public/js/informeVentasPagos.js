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

    $('#bancas_id').change(function() {
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

    var data = { start_date: start, end_date: end, bancas_id: bancas_id };

    var loader = __fa_awesome();
    $('.venta_total').html(loader);
    $('.venta_promocion').html(loader);
    $('.venta_futuro').html(loader);
    $('.pago_total').html(loader);
    $('.pago_pendiente').html(loader);


    $.ajax({
        method: 'GET',
        url: '/reportes/informe-ventas-pagos',
        dataType: 'json',
        data: data,
        success: function(data) {
            $('.venta_total').html(__currency_trans_from_en(data.ventas.venta_total, true));
            $('.venta_promocion').html(__currency_trans_from_en(data.ventas.venta_promocion, true));
            $('.venta_futuro').html(__currency_trans_from_en(data.ventas.venta_futuro, true));
            $('.pago_total').html(__currency_trans_from_en(data.ventas.pago_total, true));
            $('.pago_pendiente').html(__currency_trans_from_en(data.ventas.pago_pendiente, true));


            // $('.pago_total').html(__currency_trans_from_en(data.sell.pago_total, true));
            // $('.pago_propio').html(__currency_trans_from_en(data.sell.pago_propio, true));
            // $('.pago_otras').html(__currency_trans_from_en(data.sell.pago_otras, true));


        },
    });
}
