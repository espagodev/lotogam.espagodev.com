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

     $(document).on('change', '#dashboard_location', function() {
        getVentasMes()
    });

    __reporteResultadosDetalle();
    getVentasMes()
    getTicketsPremiados()

    $(document).on('click', '.resultados_print', function(e) {

        var start = moment().subtract(1, 'days').format('YYYY-MM-DD');
        var end = moment().subtract(1, 'days').format('YYYY-MM-DD');

        var data = { start_date: start, end_date: end};

            $.ajax({
                method: 'GET',
                url: $(this).data('href'),

                dataType: 'json',
                data: data,
                success: function(result) {


                     if (result.success === 1) {
                        var receipt = result.receipt;
                            Lobibox.notify("success", {
                                pauseDelayOnHover: true,
                                size: "mini",
                                rounded: true,
                                delayIndicator: false,
                                continueDelayOnInactiveTab: false,
                                position: "top right",
                                msg: "Se Genero el Listado",
                            });
                            receipt.forEach(function(elemento, index, arr) {
                                //    console.log(arr[index] = elemento);
                                    if (arr[index].is_enabled){
                                        // console.log(arr[index].data)
                                        __pos_print(arr[index] = elemento);
                                    }
                            });
                        } else {
                            // toastr.error(result.msg);
                             Lobibox.notify("error", {
                                pauseDelayOnHover: true,
                                size: "mini",
                                rounded: true,
                                delayIndicator: false,
                                continueDelayOnInactiveTab: false,
                                position: "top right",
                                msg: "No hay Resultados paramostrar",
                            });
                        }
                }
            });
    });

     $(document).on('click', '.ventas_print', function(e) {

        var start = moment().startOf('month').format('YYYY-MM-DD');
        var end = moment().endOf('month').format('YYYY-MM-DD');

        var data = { start_date: start, end_date: end};

            $.ajax({
                method: 'GET',
                url: $(this).data('href'),

                dataType: 'json',
                data: data,
                success: function(result) {

                     if (result.success === 1) {
                        var receipt = result.receipt;
                            Lobibox.notify("success", {
                                pauseDelayOnHover: true,
                                size: "mini",
                                rounded: true,
                                delayIndicator: false,
                                continueDelayOnInactiveTab: false,
                                position: "top right",
                                msg: "Se Genero El Reporte de Ventas",
                            });
                            receipt.forEach(function(elemento, index, arr) {
                                //    console.log(arr[index] = elemento);
                                    if (arr[index].is_enabled){
                                        // console.log(arr[index].data)
                                        __pos_print(arr[index] = elemento);
                                    }
                            });
                        } else {
                            // toastr.error(result.msg);
                             Lobibox.notify("error", {
                                pauseDelayOnHover: true,
                                size: "mini",
                                rounded: true,
                                delayIndicator: false,
                                continueDelayOnInactiveTab: false,
                                position: "top right",
                                msg: "No hay Resultados paramostrar",
                            });
                        }
                }
            });
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

    function getVentasMes()
        {

            var start = moment().startOf('month').format('YYYY-MM-DD');
            var end   = moment().endOf('month').format('YYYY-MM-DD');

            var bancas_id = '';
            if ($('#dashboard_location').length > 0) {
                bancas_id = $('#dashboard_location').val();
            }

            var data = { start_date: start, end_date: end, bancas_id: bancas_id};

            var loader = __fa_awesome();

                $('.detalle-ventas').html(loader);

                    $.ajax({
                        method: 'GET',
                        url: '/dashboard/getVentasMes',
                        dataType: 'html',
                        data: data,
                        success: function(data) {
                            $('.detalle-ventas').html(data);
                            __currency_convert_recursively($('.detalle-ventas'));
                        },

                    });
    }

    function getTicketsPremiados() {

    var start = moment().subtract(1, 'days').format('YYYY-MM-DD');
    var end = moment().subtract(1, 'days').format('YYYY-MM-DD');

    var data = { start_date: start, end_date: end};

    var loader = __fa_awesome();

        $('.tickets-premiados').html(loader);

            $.ajax({
                method: 'GET',
                url: '/dashboard/getTickesPremiados',
                dataType: 'html',
                data: data,
                success: function(data) {
                    $('.tickets-premiados').html(data);
                     __currency_convert_recursively($('.tickets-premiados'));

                },

            });
    }




