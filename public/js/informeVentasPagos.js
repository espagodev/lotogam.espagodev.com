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
    $('.pago_propio').html(loader);
    $('.pago_otras').html(loader);

    $.ajax({
        method: 'GET',
        url: '/reports/purchase-sell',
        dataType: 'json',
        data: data,
        success: function(data) {
            $('.venta_total').html(__currency_trans_from_en(data.purchase.total_purchase_exc_tax, true)
            );
            $('.venta_promocion').html(__currency_trans_from_en(data.purchase.total_purchase_inc_tax, true)
            );
            $('.venta_futuro').html(__currency_trans_from_en(data.purchase.purchase_due, true));

            $('.pago_total').html(__currency_trans_from_en(data.sell.total_sell_exc_tax, true));
            $('.pago_propio').html(__currency_trans_from_en(data.sell.total_sell_inc_tax, true));
            $('.pago_otras').html(__currency_trans_from_en(data.sell.invoice_due, true));
            $('.purchase_return_inc_tax').html(__currency_trans_from_en(data.total_purchase_return, true)
            );
            $('.total_sell_return').html(__currency_trans_from_en(data.total_sell_return, true));

            $('.sell_minus_purchase').html(__currency_trans_from_en(data.difference.total, true));
            __highlight(data.difference.total, $('.sell_minus_purchase'));

            $('.difference_due').html(__currency_trans_from_en(data.difference.due, true));
            __highlight(data.difference.due, $('.difference_due'));

            // $('.purchase_due').html( __currency_trans_from_en(data.purchase_due, true));
        },
    });
}
