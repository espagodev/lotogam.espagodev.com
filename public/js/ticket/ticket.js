$(document).ready(function() {

    $('.view_register').on('shown.bs.modal', function() {
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

      $(document).on('click', '.pagar_premio', function(e) {
        e.preventDefault();
        var container = $('.pagar_premio_modal');

        $.ajax({
            url: $(this).data('href'),
            dataType: 'html',
            success: function(result) {
                container.html(result).modal('show');
                __currency_convert_recursively(container);

                container.find('form#transaction_payment_add_form').validate();
            },
        });
    });

    $(document).on('click', '.view_ticket_modal', function(e) {
            e.preventDefault();
            var container = $('.ticket_modal');

            $.ajax({
                url: $(this).attr('href'),
                dataType: 'html',
                success: function(result) {
                    $(container)
                        .html(result)
                        .modal('show');
                    __currency_convert_recursively(container);
                },
            });
    });

    $(document).on('click', '.anular_ticket_modal', function(e) {
            e.preventDefault();
            var container = $('.anular_modal');

            $.ajax({
                url: $(this).attr('href'),
                dataType: 'html',
                success: function(result) {
                    $(container)
                        .html(result)
                        .modal('show');
                    __currency_convert_recursively(container);
                },
            });
    });

    $(document).on('click', '.pagarPremio', function(e) {

        var tickets_id = $('#tickets_id').val();
        var pin = $('#tic_pin').val();
        var premio = $('#tic_ganado').val();

        var data = { tickets_id: tickets_id, pin: pin, premio: premio };

            $.ajax({
                method: 'GET',
                url: $(this).data('href'),

                dataType: 'json',
                data: data,
                success: function(result) {
                     if (result.success === true) {

                            $('div.ticket_modal').modal('hide');
                            $('div.pagar_premio_modal').modal('hide');
                            getTicketsPremiados();
                            // toastr.success(result.msg);
                            Lobibox.notify("success", {
                                pauseDelayOnHover: true,
                                size: "mini",
                                rounded: true,
                                delayIndicator: false,
                                continueDelayOnInactiveTab: false,
                                position: "top right",
                                msg: result.msg,
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
                                msg: result.msg,
                            });
                        }
                }
            });
    });

     $(document).on('click', '.anularTicket', function(e) {

        var tickets_id = $('#tickets_id').val();
        var loterias_id = $('#loterias_id').val();
        var pin = $('#tic_pin').val();
        var detalle = $('#tia_detalle').val();



        var data = { tickets_id: tickets_id, loterias_id: loterias_id, pin: pin, detalle: detalle };


            $.ajax({
                method: 'GET',
                url: $(this).data('href'),

                dataType: 'json',
                data: data,
                success: function(result) {
                     if (result.success == true) {

                            $('div.anular_modal').modal('hide');


                            Lobibox.notify("success", {
                                pauseDelayOnHover: true,
                                size: "mini",
                                rounded: true,
                                delayIndicator: false,
                                continueDelayOnInactiveTab: false,
                                position: "top right",
                                msg: result.msg,
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
                                msg: result.msg,
                            });
                        }
                }
            });
    });

    $(document).on('click', '.duplicarTicket', function(e) {

        var tickets_id = $('#tickets_id').val();

        var data = { tickets_id: tickets_id};

            $.ajax({
                method: 'GET',
                url: $(this).data('href'),

                dataType: 'json',
                data: data,
                success: function(result) {
                     if (result.success === true) {

                            $('div.ticket_modal').modal('hide');
                            $('div.pagar_premio_modal').modal('hide');
                            getTicketsPremiados();
                            // toastr.success(result.msg);
                            Lobibox.notify("success", {
                                pauseDelayOnHover: true,
                                size: "mini",
                                rounded: true,
                                delayIndicator: false,
                                continueDelayOnInactiveTab: false,
                                position: "top right",
                                msg: result.msg,
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
                                msg: result.msg,
                            });
                        }
                }
            });
    });

    $(document).on('click', '.print-invoice-link', function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href') + "?check_location=true",
            dataType: 'json',
            success: function (result) {


                if (result.success == 1) {
                    pos_print(result.receipt);

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


    //Se utiliza para el ticket
    $(document).on('click', 'a.print-invoice', function (e) {
        e.preventDefault();
        var href = $(this).data('href') + "?ticket_copia=true";

        $.ajax({
            method: 'GET',
            url: href,
            dataType: 'json',
            success: function (result) {

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




function pos_print(receipt) {


    //Si es tipo de impresora, conéctese con websocket
    if (receipt.print_type == 'printer') {
        var content = receipt;
        content.type = 'print-receipt';

        //Compruebe si está listo o no, luego imprima.
        if (socket != null && socket.readyState == 1) {
            socket.send(JSON.stringify(content));
        } else {
            initializeSocket();
            setTimeout(function () {
                socket.send(JSON.stringify(content));
            }, 700);
        }

    } else if (receipt.html_content != '') {
        //Si la impresora escribe un navegador, imprima el contenido

        $('#receipt_section').html(receipt.html_content);
        __currency_convert_recursively($('#receipt_section'));
        __print_receipt('receipt_section');
    }
}
