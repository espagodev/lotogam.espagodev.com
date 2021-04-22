$(document).ready(function() {
    var start = $('input[name="date-filter"]:checked').data('start');
    var end = $('input[name="date-filter"]:checked').data('end');

    update_statistics(start, end);

    $(document).on('change', 'input[name="date-filter"], #dashboard_location', function() {
        var start = $('input[name="date-filter"]:checked').data('start');
        var end = $('input[name="date-filter"]:checked').data('end');
        update_statistics(start, end);
        if ($('#quotation_table').length && $('#dashboard_location').length) {
            quotation_datatable.ajax.reload();
        }

    });
});
function update_statistics(start, end) {

    var bancas_id = '';
    if ($('#dashboard_location').length > 0) {
        bancas_id = $('#dashboard_location').val();
    }
    var data = { start: start, end: end, bancas_id: bancas_id };
    //get purchase details

    var loader = '<i class="fa-spin fa fa-refresh fa-fw margin-bottom"></i>';
    $('.total_tickets').html(loader);
    $('.purchase_due').html(loader);
    $('.total_sell').html(loader);
    $('.invoice_due').html(loader);

    $.ajax({
        method: 'get',
        url: '/home/get-totals',
        dataType: 'json',
        data: data,
        success: function(data) {

            $('.total_tickets').html(__number_uf(data.total_tickets));
            $('.purchase_due').html(__currency_trans_from_en(data.purchase_due, true));

            //sell details
            $('.total_sell').html(__currency_trans_from_en(data.total_sell, true));
            $('.invoice_due').html(__currency_trans_from_en(data.invoice_due, true));

        },
    });
}


