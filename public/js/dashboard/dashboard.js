$(document).ready(function() {
    var start = $('input[name="date-filter"]:checked').data('start');
    var end = $('input[name="date-filter"]:checked').data('end');

    update_statistics(start, end);

    $(document).on('change', 'input[name="date-filter"], #bancas_id', function() {
        var start = $('input[name="date-filter"]:checked').data('start');
        var end = $('input[name="date-filter"]:checked').data('end');
        update_statistics(start, end);
        if ($('#quotation_table').length && $('#bancas_id').length) {
            quotation_datatable.ajax.reload();
        }
    });

     $(document).on('change', '#bancas_id', function() {
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



    //Used for Purchase & Sell invoice.
    $(document).on('click', 'a.print-invoice', function(e) {
        e.preventDefault();
        var href = $(this).data('href');

        var bancas_id = '';
            if ($('#bancas_id').length > 0) {
                bancas_id = $('#bancas_id').val();
            }
        var data = { bancas_id: bancas_id};
        $.ajax({
            method: 'GET',
            url: href,
            data: data,
            dataType: 'json',
            success: function(result) {
                if (result.success == 1 && result.receipt.html_content != '') {
                    $('#receipt_section').html(result.receipt.html_content);
                    __currency_convert_recursively($('#receipt_section'));
                    __print_receipt('receipt_section');
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
    });

});
    function update_statistics(start, end) {

        var bancas_id = '';
        if ($('#bancas_id').length > 0) {
            bancas_id = $('#bancas_id').val();
        }
        var data = { start: start, end: end, bancas_id: bancas_id };
        //get purchase details

        var loader = '<i class="fa-spin fa fa-refresh fa-fw margin-bottom"></i>';
        $('.total_tickets').html(loader);
        $('.total_venta').html(loader);
        $('.total_comision').html(loader);
        $('.total_premios').html(loader);

        $.ajax({
            method: 'get',
            url: '/home/get-totals',
            dataType: 'json',
            data: data,
            success: function(data) {

                $('.total_tickets').html(__number_uf(data.total_tickets));
                $('.total_venta').html(__currency_trans_from_en(data.total_venta, true));

                //sell details
                $('.total_comision').html(__currency_trans_from_en(data.total_comision, true));
                $('.total_premios').html(__currency_trans_from_en(data.total_premios, true));

            },
        });
    }

    function getVentasMes()
        {

            var start = moment().startOf('month').format('YYYY-MM-DD');
            var end   = moment().endOf('month').format('YYYY-MM-DD');

            var bancas_id = '';
            if ($('#bancas_id').length > 0) {
                bancas_id = $('#bancas_id').val();
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

    var end= moment().format('YYYY-MM-DD');
    var start = moment().subtract(29, 'days').format('YYYY-MM-DD');

    // var start = moment().startOf('month').format('YYYY-MM-DD');
    // var end = moment().endOf('month').format('YYYY-MM-DD');

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




