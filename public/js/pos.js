document.getElementById('tid_valor').addEventListener('keydown', inputCharacters);

function inputCharacters(event) {
    if (event.keyCode == 13) {
        document.getElementById('tid_apuesta').focus();
    }
}

$(document).ready(function () {

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

    //Evitar la función de tecla enter excepto textarea
    // $('form').on('keyup keypress', function (e) {
    //     var keyCode = e.keyCode || e.which;
    //     if ((keyCode === 13 && e.target.tagName != 'tid_valor') || (keyCode === 13 && e.target.tagName != 'tid_apuesta')) {
    //         e.preventDefault();
    //         return false;
    //     }
    // });

    //For edit pos form
    // if ($("form#edit_pos_sell_form").length > 0) {
    //     pos_total_row();
    //     pos_form_obj = $("form#edit_pos_sell_form");
    // } else {
    pos_form_obj = $("form#add_pos_sell_form");
    // }
    if ($("input#product_row_count").length > 0 ) {
        initialize_printer();

    }

    horarioLoteriasDia();


    $("#tid_valor,#tid_apuesta").keydown(function (event) {
        var product_row = $("input#product_row_count").val();
        var numero = $("input[name=tid_apuesta]").val();
        var valor = $("input[name=tid_valor]").val();

        var token = $('meta[name="csrf-token"]').attr("content");

        if (event.keyCode == 13 && numero != "" && valor != "") {
            $.when(
                $.ajax({
                    async: false,
                    url: "/apuestaDetalleTemp",
                    method: "post",
                    dataType: "json",
                    data: {
                        product_row: product_row,
                        _token: token,

                        tid_apuesta: numero,
                        tid_valor: valor,
                    },
                })
            ).then(function (resp) {
                if (resp.status == "NumeroCaliente") {
                    $("input[name=tid_apuesta]").focus();
                    Lobibox.notify("warning", {
                        pauseDelayOnHover: true,
                        size: "mini",
                        rounded: true,
                        delayIndicator: false,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        msg: resp.mensaje,
                    });
                }
                if (resp.status == "LimiteSuperado") {
                    $("input[name=tid_valor]").focus();
                    Lobibox.notify("warning", {
                        pauseDelayOnHover: true,
                        size: "mini",
                        rounded: true,
                        delayIndicator: false,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        msg: resp.mensaje,
                    });
                }
                 if (resp.status == "Comision") {
                     $("input[name=tid_valor]").focus();
                     Lobibox.notify("warning", {
                         pauseDelayOnHover: true,
                         size: "mini",
                         rounded: true,
                         delayIndicator: false,
                         continueDelayOnInactiveTab: false,
                         position: "top right",
                         msg: resp.mensaje,
                     });
                 }
                if (resp.status == "MontoIndividual") {
                    $("input[name=tid_valor]").focus();
                    Lobibox.notify("warning", {
                        pauseDelayOnHover: true,
                        size: "mini",
                        rounded: true,
                        delayIndicator: false,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        msg: resp.mensaje,
                    });
                }
                if (resp.status == "success") {
                    $("input[name=tid_apuesta]").val("");
                    $("input[name=tid_valor]").focus().val("");
                    MostrarJugadas();
                }
            });
        } else if (event.keyCode == 13 && numero != "" && valor == "") {
            $("input[name=tid_valor]").focus();
        } else if (event.keyCode == 13 && numero == "" && valor == "") {
            $("input[name=tid_valor]").focus();
        }
    });

    function initialize_printer() {
        initializeSocket();
        // if ($('input#location_id').data('receipt_printer_type') == 'printer') {
        //     initializeSocket();
        // }
    }

    $("button.pos-express-finalize").click(function () {
        //Compruebe si hay almenos una apuesta.
        if ($("table#pos_table tbody").find(".product_row").length <= 0) {
            Lobibox.notify("warning", {
                pauseDelayOnHover: true,
                size: "mini",
                rounded: true,
                delayIndicator: false,
                continueDelayOnInactiveTab: false,
                position: "top right",
                msg:
                    "No se Agregaron Jugadas, Agregue Algunas Jugadas Primero.",
            });
            return false;
        }
    });

    //Cancelar la apuesta --> SI
    $("button#pos-cancel").click(function () {
        reset_pos_form();
        Lobibox.notify("danger", {
            pauseDelayOnHover: true,
            size: "mini",
            rounded: true,
            delayIndicator: false,
            continueDelayOnInactiveTab: false,
            position: "top right",
            msg: "Borrar Apuestas.",
        });
    });

    //Finalize without showing payment options
    $("button.pos-express-finalize").click(function () {
        //Check if product is present or not.
        // if ($('table#pos_table tbody').find('.product_row').length <= 0) {
        //     toastr.warning(LANG.no_products_added);
        //     return false;
        // }

        var pay_method = $(this).data("pay_method");

        //Change payment method.
        $("#payment_rows_div")
            .find(".payment_types_dropdown")
            .first()
            .val(pay_method);
        if (pay_method == "card") {
            $("div#card_details_modal").modal("show");
        } else if (pay_method == "suspend") {
            $("div#confirmSuspendModal").modal("show");
        } else {
            pos_form_obj.submit();
        }
    });

    pos_form_validator = pos_form_obj.validate({
        submitHandler: function (form) {
            // var total_payble = __read_number($('input#final_total_input'));
            // var total_paying = __read_number($('input#total_paying_input'));
            var cnf = true;

            if (cnf) {
                $("div.pos-processing").show();
                $("#pos-save").attr("disabled", "true");
                var loterias = $("input[name='lot_id[]']:checked").map(function () { return this.value; }).get();
                var product_row = $("input#product_row_count").val();
                var promocion = $("input[name='tic_promocion']:checked").val();
                var tic_fecha_sorteo = $("input#tic_fecha_sorteo").val();
                var token = $('meta[name="csrf-token"]').attr("content");

                var url = $(form).attr("action");

                $.ajax({
                    method: "POST",
                    url: url,
                    data: {
                        product_row: product_row,
                        _token: token,
                        loterias_id: loterias,
                        tic_promocion: promocion,
                        tic_fecha_sorteo: tic_fecha_sorteo,
                    },
                    dataType: "json",
                    success: function (result) {

                         var receipt = result.receipt;

                        if (result.success == 1) {
                            $("#modal_payment").modal("hide");
                            Lobibox.notify("success", {
                                pauseDelayOnHover: true,
                                size: "mini",
                                rounded: true,
                                delayIndicator: false,
                                continueDelayOnInactiveTab: false,
                                position: "top right",
                                msg: result.mensaje,
                            });

                            reset_pos_form();
                            horarioLoteriasDia();

                            receipt.forEach(function(elemento, index, arr) {
                                   console.log(arr[index] = elemento);
                                    if (arr[index].is_enabled){
                                        // console.log(arr[index].data)
                                        __pos_print(arr[index] = elemento);
                                    }

                            });

                        } else {
                            Lobibox.notify("error", {
                                pauseDelayOnHover: true,
                                size: "mini",
                                rounded: true,
                                delayIndicator: false,
                                continueDelayOnInactiveTab: false,
                                position: "top right",
                                msg: result.mensaje,
                            });
                        }

                        $("div.pos-processing").hide();
                        $("#pos-save").removeAttr("disabled");
                    },
                });
            }
            return false;
        },
    });

    //Cancel the invoice
    $("button#pos-cancel").click(function () {
        reset_pos_form();
    });

    // generarTicket()
    MostrarJugadas()


    reporte_tickets = $('#reporte_tickets').DataTable({
        processing: true,
        serverSide: true,
         aaSorting: false,
        ajax: {
                url: '/reportes/reporte-tickets',
                dataType: "json",
              data: function(d) {

                d.loterias_id = $('select#loterias_id').val();
                d.bancas_id = $('select#bancas_id').val();
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
                { data: 'tic_fecha_sorteo', name: 'tic_fecha_sorteo', orderable: false, searchable: false  },
                { data: 'tic_ticket', name: 'tic_ticket', orderable: false, searchable: true  },
                { data: 'lot_nombre', name: 'loteria', orderable: false, searchable: false  },
                { data: 'tic_numeros', name: 'tic_numeros', orderable: false, searchable: false  },
                { data: 'tic_apostado', name: 'tic_apostado', orderable: false, searchable: false  },
                { data: 'tic_estado', name: 'estado', orderable: false, searchable: false  },
                { data: 'action', name: 'action' },
         ],
          fnDrawCallback: function(oSettings) {
            __currency_convert_recursively($('#reporte_tickets'));
        },
    });

});

$(document).on('show.bs.modal', '#recent_transactions_modal', function () {
   reporte_tickets.ajax.reload();
});


 //BORRAR
    $(document).ready(function() {
        $(document).on('click', '.borrar', function(){

            var id = $(this).attr("data-record-id");

           $.when(
               $.ajax({
                   async: false,
                   url: "/eliminarApuesta/" + id,
                   method: "DELETE",

                   data: {
                       _token: token,
                       id: id,
                   },
               })
           ).then(function (resp) {
               if (resp.status == "success") {
                   $("input[name=tid_apuesta]").val("");
                   $("input[name=tid_valor]").focus().val("");
                   MostrarJugadas();
                   Lobibox.notify("success", {
                       pauseDelayOnHover: true,
                       size: "mini",
                       rounded: true,
                       delayIndicator: false,
                       continueDelayOnInactiveTab: false,
                       position: "top right",
                       msg: resp.msg,
                   });
               }
               if (resp.status == "error") {
                   Lobibox.notify("error", {
                       pauseDelayOnHover: true,
                       size: "mini",
                       rounded: true,
                       delayIndicator: false,
                       continueDelayOnInactiveTab: false,
                       position: "top right",
                       msg: resp.msg,
                   });
               }
           });
        });
    });

    function reset_pos_form() {

       var banca = $("input#bancas_id").val();
        var usuario = $("input#users_id").val();

        $.when(
            $.ajax({
                async: false,
                url: "/eliminar/"+ banca +"/jugadas/"+ usuario,
                method: "DELETE",

                data: {
                banca: banca,
                usuario: usuario,
                },
            })
        ).then(function (resp) {
            if (resp.status == "success") {
                $("input[name=tid_apuesta]").val("");
                $("input[name=tid_valor]").focus().val("");

                // Lobibox.notify("success", {
                //     pauseDelayOnHover: true,
                //     size: "mini",
                //     rounded: true,
                //     delayIndicator: false,
                //     continueDelayOnInactiveTab: false,
                //     position: "top right",
                //     msg: resp.msg,
                // });
            }
            if (resp.status == "error") {
                Lobibox.notify("error", {
                    pauseDelayOnHover: true,
                    size: "mini",
                    rounded: true,
                    delayIndicator: false,
                    continueDelayOnInactiveTab: false,
                    position: "top right",
                    msg: resp.msg,
                });
            }
            MostrarJugadas();
        });

    }

    function pos_total_row() {
        var total_quantity = 0;
        var price_total = 0;
        var contador = 0;
        var total_payable = 0;

        $('table#pos_table tbody tr').each(function () {

        price_total =  price_total + __read_number($(this).find("input.pos_line_total"));

        });

            $("span.price_total").text(
                __currency_trans_from_en(price_total, false)
            );


        $("input[name='lot_id[]']").on("click", function () {
        // $(".loteria").on("click", function () {
            if ($(this).is(":checked")) {
                contador++;
            } else {
                contador--;
            }

            if (contador == 0) {
                total_payable = price_total;
            } else {
                total_payable = price_total * contador;
            }

            $("span#total_payable").text(__currency_trans_from_en(total_payable, true));
            $("span#total_loterias").text(contador);
        });



    }

    function MostrarJugadas() {
        var banca = $("input#bancas_id").val();
        var usuario = $("input#users_id").val();

        $.ajax({
            url: "/apuestaDetalleTemp",
            method: "get",
            dataType: "json",
            data: {
                banca: banca,
                usuario: usuario,
            },
            success: function (result) {

                    $("table#pos_table tbody").html(result.ticketDetalles);

                    $("input#product_row_count").val(result.row_count);

                    $("span.total_quantity").each(function () {
                        $(this).html(__number_f(result.row_count));
                    });

                    var this_row = $("table#pos_table tbody").find("tr");

                    __currency_convert_recursively(this_row);
                    pos_total_row();
                // }
            },
        });
    }

    function generarTicket(){
        $.when(
            $.ajax({
                async: false,
                url: "/apuestaTemp",
                method: "get",
                dataType: "json",
                success: function (result) {
                    $("input#ticket").val(result);
                },
            })
            ).then(function (resp) {
                MostrarJugadas();
            });
        }

    //LOTERIAS
  function horarioLoteriasDia() {

    var bancas_id = $('#bancas_id').val();

    var data = {  bancas_id: bancas_id };

    var loader = __fa_awesome();

        $('.loterias').html(loader);

            $.ajax({
                method: 'GET',
                url: '/pos/getHorarioLoteriasDia',
                dataType: 'html',
                data: data,
                success: function(data) {
                    $('.loterias').html(data);

                },

            });

    }


    function __pos_print(receipt) {

        // console.log(receipt);
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
