document
    .getElementById("tid_valor")
    .addEventListener("keydown", inputCharacters);

function inputCharacters(event) {
    if (event.keyCode == 13) {
        document.getElementById("tid_apuesta").focus();
    }
}

$(document).ready(function() {
    if ($("#spr_date_filter").length == 1) {
        $("#spr_date_filter").daterangepicker(dateRangeSettings, function(
            start,
            end
        ) {
            $("#spr_date_filter span").val(
                start.format(moment_date_format) +
                    " ~ " +
                    end.format(moment_date_format)
            );
            reporte_tickets.ajax.reload();
        });
        $("#spr_date_filter").on("cancel.daterangepicker", function(
            _ev,
            _picker
        ) {
            $("#spr_date_filter").val("");
            reporte_tickets.ajax.reload();
        });
    }

    $(".close_register_modal, .register_details_modal").on(
        "shown.bs.modal",
        function() {
            __currency_convert_recursively($(this));
        }
    );

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
    if ($("input#product_row_count").length > 0) {
        initialize_printer();
    }

    horarioLoteriasDia();
    horarioSuperPale();
    progressBar();


    //VALIDA EL MONTO Y NUMERO PARA SER INGRESADOS

    $("#tid_apuesta").keydown(function(event) {
        if ($("input[name='lot_id[]']:checked").length >= 1) {
            var bancas_id = $("input#bancas_id").val();
            var users_id = $("input#users_id").val();
            var loterias_id = $("input[name='lot_id[]']:checked")
                .map(function() {
                    return this.value;
                })
                .get();
            var numero = $("input[name=tid_apuesta]").val();
            var valor = $("input[name=tid_valor]").val();

            __validarLoteriaSelecconada(
                bancas_id,
                users_id,
                loterias_id,
                numero,
                valor
            );
        }
    });

    $("#tid_valor, #tid_apuesta").keydown(function(event) {
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
                        tid_valor: valor
                    }
                })
            ).then(function(resp) {
                if (resp.status == "NumeroCaliente") {
                    $("input[name=tid_apuesta]").focus();
                    Lobibox.notify("warning", {
                        pauseDelayOnHover: true,
                        size: "mini",
                        rounded: true,
                        delayIndicator: false,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        msg: resp.mensaje
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
                        msg: resp.mensaje
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
                        msg: resp.mensaje
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
                        msg: resp.mensaje
                    });
                }
                if (resp.status == "LimiteGlobal") {
                    $("input[name=tid_valor]").focus();
                    Lobibox.notify("info", {
                        pauseDelayOnHover: true,
                        size: "mini",
                        rounded: true,
                        delayIndicator: false,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        msg: resp.mensaje
                    });
                }
                if (resp.status == "success") {
                    $("input[name=tid_apuesta]").val("");
                    $("input[name=tid_valor]")
                        .focus()
                        .val("");
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

    $("button.pos-express-finalize").click(function() {
        //Compruebe si hay almenos una apuesta.
        if ($("table#pos_table tbody").find(".product_row").length <= 0) {
            Lobibox.notify("warning", {
                pauseDelayOnHover: true,
                size: "mini",
                rounded: true,
                delayIndicator: false,
                continueDelayOnInactiveTab: false,
                position: "top right",
                msg: "No se Agregaron Jugadas, Agregue Algunas Jugadas Primero."
            });

            return false;
        }
    });

    //Cancelar la apuesta --> SI
    $("button#pos-cancel").click(function() {
        reset_pos_form();
        Lobibox.notify("danger", {
            pauseDelayOnHover: true,
            size: "mini",
            rounded: true,
            delayIndicator: false,
            continueDelayOnInactiveTab: false,
            position: "top right",
            msg: "Borrar Apuestas."
        });
    });

    //Finalize without showing payment options
    $("button.pos-express-finalize").click(function() {
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
        submitHandler: function(form) {
            // var total_payble = __read_number($('input#final_total_input'));
            // var total_paying = __read_number($('input#total_paying_input'));
            var cnf = true;

            if (cnf) {
                disable_pos_form_actions();

                var loterias = $("input[name='lot_id[]']:checked")
                    .map(function() {
                        return this.value;
                    })
                    .get();
                var product_row = $("input#product_row_count").val();
                var promocion = $("input[name='tic_promocion']:checked").val();
                var agrupado = $("input[name='tic_agrupado']:checked").val();
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
                        tic_agrupado: agrupado
                    },
                    dataType: "json",
                    success: function(result) {
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
                                msg: result.mensaje
                            });

                            reset_pos_form();
                            horarioLoteriasDia();
                            horarioSuperPale();
                            progressBar();

                            // if (result.receipt.is_enabled) {
                            // __pos_print(result.receipt);
                            console.log(receipt);
                            receipt.forEach(function(elemento, index, arr) {
                                if (arr[index].is_enabled) {
                                    // console.log(arr[index] = elemento)
                                    __pos_print((arr[index] = elemento));
                                }
                            });
                            // }
                        } else {
                            Lobibox.notify("error", {
                                pauseDelayOnHover: true,
                                size: "mini",
                                rounded: true,
                                delayIndicator: false,
                                continueDelayOnInactiveTab: false,
                                position: "top right",
                                msg: result.mensaje
                            });
                            horarioLoteriasDia();
                            horarioSuperPale();
                        }

                        $("div.pos-processing").hide();
                        $("#pos-save").removeAttr("disabled");
                        $("span#total_payable").text(
                            __currency_trans_from_en(0, true)
                        );
                        $("span#total_loterias").text(0);
                        $("input[name='tic_promocion']").each(function() {
                            this.checked = false;
                        });
                        $("input[name='tic_agrupado']").prop("disabled", true);
                        $("input[name='tic_agrupado']").each(function() {
                            this.checked = false;
                        });
                        enable_pos_form_actions();
                    }
                });
            }

            $("input[name=tid_valor]").focus();
            return false;
        }
    });

    //Cancel the invoice
    $("button#pos-cancel").click(function() {
        reset_pos_form();
    });

    // generarTicket()
    MostrarJugadas();

    reporte_tickets = $("#reporte_tickets").DataTable({
        processing: true,
        serverSide: true,
        aaSorting: false,
        ajax: {
            url: "/reportes/reporte-tickets",
            dataType: "json",
            data: function(d) {
                d.loterias_id = $("select#loterias_id").val();
                d.bancas_id = $("select#bancas_id").val();
                d.users_id = $("select#users_id").val();
                d.estado = $("select#estado").val();
                d.promocion = $("select#promocion").val();
                var start = "";
                var end = "";
                if ($("input#spr_date_filter").val()) {
                    start = $("input#spr_date_filter")
                        .data("daterangepicker")
                        .startDate.format("YYYY-MM-DD");
                    end = $("input#spr_date_filter")
                        .data("daterangepicker")
                        .endDate.format("YYYY-MM-DD");
                }
                d.start_date = start;
                d.end_date = end;
            }
        },
        columns: [
            {
                data: "tic_fecha_sorteo",
                name: "tic_fecha_sorteo",
                orderable: false,
                searchable: false
            },
            {
                data: "tic_ticket",
                name: "tic_ticket",
                orderable: false,
                searchable: true
            },
            {
                data: "lot_nombre",
                name: "loteria",
                orderable: false,
                searchable: false
            },
            {
                data: "tic_numeros",
                name: "tic_numeros",
                orderable: false,
                searchable: false
            },
            {
                data: "tic_apostado",
                name: "tic_apostado",
                orderable: false,
                searchable: false
            },
            {
                data: "tic_estado",
                name: "estado",
                orderable: false,
                searchable: false
            },
            { data: "action", name: "action" }
        ],
        fnDrawCallback: function(_oSettings) {
            __currency_convert_recursively($("#reporte_tickets"));
        }
    });
});

$(document).on("show.bs.modal", "#recent_transactions_modal", function() {
    reporte_tickets.ajax.reload();
});

//BORRAR
$(document).ready(function() {
    $(document).on("click", ".borrar", function() {
        var id = $(this).attr("data-record-id");

        $.when(
            $.ajax({
                async: false,
                url: "/eliminarApuesta/" + id,
                method: "DELETE",

                data: {
                    _token: token,
                    id: id
                }
            })
        ).then(function(resp) {
            if (resp.status == "success") {
                $("input[name=tid_apuesta]").val("");
                $("input[name=tid_valor]")
                    .focus()
                    .val("");
                MostrarJugadas();
                Lobibox.notify("success", {
                    pauseDelayOnHover: true,
                    size: "mini",
                    rounded: true,
                    delayIndicator: false,
                    continueDelayOnInactiveTab: false,
                    position: "top right",
                    msg: resp.msg
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
                    msg: resp.msg
                });
            }
        });
    });
});

//agrupado
$(document).click(function() {
    var checked = $("input[name='lot_id[]']:checked").length;
    if (checked > 1) {
        $("input[name='tic_agrupado']").prop("disabled", false);
    } else {
        $("input[name='tic_agrupado']").prop("disabled", true);
        $("input[name='tic_agrupado']").each(function() {
            this.checked = false;
        });
    }
});

function __validarLoteriaSelecconada(
    bancas_id,
    users_id,
    loterias_id,
    numero,
    valor
) {
    $.when(
        $.ajax({
            type: "get",
            url: "/validarLoteriaSeleccionada",
            dataType: "json",
            data: {
                bancas_id: bancas_id,
                users_id: users_id,
                loterias_id: loterias_id,
                tid_apuesta: numero,
                tid_valor: valor
            }
        })
    ).then(function(result) {
        if (result.status == 1) {
            swal(
                "el siguientes Numeros:  " + result.numero + " ",
                "No pueden ser Jugados en la Loteria   " + result.loteria + " "
            );
        }
        if (result.status == 2) {
            swal(
                "Los siguientes Numeros:",
                "  " +
                    result.numero +
                    "  en la Loteria   " +
                    result.loteria +
                    " "
            );
        }
        if (result.status == 3) {
            Lobibox.notify("info", {
                pauseDelayOnHover: true,
                size: "mini",
                rounded: true,
                delayIndicator: false,
                continueDelayOnInactiveTab: false,
                position: "top center",
                msg: result.numero + "  en la Loteria   " + result.loteria + " "
            });
        }

        if (result.status == 4) {
            Lobibox.alert("error", {
                title: "Error de Montos",
                msg: result.numero
            });
        }
    });
}

function reset_pos_form() {
    var banca = $("input#bancas_id").val();
    var usuario = $("input#users_id").val();

    $.when(
        $.ajax({
            async: false,
            url: "/eliminar/" + banca + "/jugadas/" + usuario,
            method: "DELETE",

            data: {
                banca: banca,
                usuario: usuario
            }
        })
    ).then(function(resp) {
        if (resp.status == "success") {
            $("input[name=tid_apuesta]").val("");
            $("input[name=tid_valor]")
                .focus()
                .val("");

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
                msg: resp.msg
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

    $("table#pos_table tbody tr").each(function() {
        price_total =
            price_total + __read_number($(this).find("input.pos_line_total"));
    });

    $("span.price_total").text(__currency_trans_from_en(price_total, true));

    $("input[name='lot_id[]']").on("click", function() {
        var checked = $("input[name='lot_id[]']:checked").length;

        if (checked == 0) {
            total_payable = 0;
        } else {
            total_payable = price_total * checked;
        }

        $("span#total_payable").text(
            __currency_trans_from_en(total_payable, true)
        );
        $("span#total_loterias").text(checked);
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
            usuario: usuario
        },
        success: function(result) {
            $("table#pos_table tbody").html(result.ticketDetalles);

            $("input#product_row_count").val(result.row_count);

            $("span.total_quantity").each(function() {
                $(this).html(__number_f(result.row_count));
            });

            var this_row = $("table#pos_table tbody").find("tr");

            __currency_convert_recursively(this_row);
            pos_total_row();
            activarLoterias(result.row_count);
            // }
        }
    });
}

function generarTicket() {
    $.when(
        $.ajax({
            async: false,
            url: "/apuestaTemp",
            method: "get",
            dataType: "json",
            success: function(result) {
                $("input#ticket").val(result);
            }
        })
    ).then(function(_resp) {
        MostrarJugadas();
    });
}

//LOTERIAS
function horarioLoteriasDia() {
    var bancas_id = $("#bancas_id").val();

    // var data = { bancas_id: bancas_id };

    var loader = __fa_awesome();

    $(".loterias").html(loader);

    $.ajax({
        method: "GET",
        url: "/pos/getHorarioLoteriasDia",
        dataType: "html",
        // data: data,
        success: function(data) {
            $(".loterias").html(data);
        }
    });
}

function horarioSuperPale() {
    var bancas_id = $("#bancas_id").val();
    // var data = { bancas_id: bancas_id };

    var loader = __fa_awesome();
    $(".superPale").html(loader);

    $.ajax({
        method: "GET",
        url: "/pos/getLoteriasSuperPaleDia",
        dataType: "html",
        // data: data,
        success: function(data) {
            $(".superPale").html(data);
        }
    });
}

function __pos_print(receipt) {
    //Si es tipo de impresora, conéctese con websocket
    if (receipt.print_type == "printer") {
        var content = receipt;
        content.type = "print-receipt";

        //Compruebe si está listo o no, luego imprima.
        if (socket != null && socket.readyState == 1) {
            socket.send(JSON.stringify(content));
        } else {
            initializeSocket();
            setTimeout(function() {
                socket.send(JSON.stringify(content));
            }, 700);
        }
    } else if (receipt.html_content != "") {
        //Si la impresora escribe un navegador, imprima el contenido

        $("#receipt_section").html(receipt.html_content);

        __currency_convert_recursively($("#receipt_section"));

        __print_receipt("receipt_section");
    }
}

function disable_pos_form_actions() {
    // $('div.pos-processing').show();
    // $('#pos-save').attr('disabled', 'true');
    // $('div.pos-form-actions').find('button').attr('disabled', 'true');
}

function enable_pos_form_actions() {
    // $('div.pos-processing').hide();
    // $('#pos-save').removeAttr('disabled');
    // $('div.pos-form-actions').find('button').removeAttr('disabled');
}

//VALIDAR LOTERIAS ACTIVAS

function activarLoterias(jugadas) {
    // alert(jugadas);
    if (jugadas > 0 || jugadas != null) {
        $("input[name='lot_id[]']").prop("disabled", false);
        $("div.pos-form-actions")
            .find("button")
            .removeAttr("disabled");
    } else {
        $("input[name='lot_id[]']").prop("disabled", true);
        $("input[name='lot_id[]']").each(function() {
            this.checked = false;
        });
        $("div.pos-form-actions")
            .find("button")
            .attr("disabled", "true");
    }
}

function progressBar() {
    //reset progress bar
    $(".progress-bar").css("width", "0%");
    $(".progress-bar").text("0%");
    $(".progress-bar").attr("data-progress", "0");

    $.ajax({
        type: "POST",
        dataType: "json",
        url: "/caja-registradora/getprogressbar",
        success: function(response) {
            var percentage = response.percentage;
            var total = __currency_trans_from_en(response.total, true);
            var limite = __currency_trans_from_en(response.limite, true);
            var totalVenta = __currency_trans_from_en(response.venta, true);
            var estado = total + " / " + limite;

            $(".progress-bar").css("width", percentage + "%");
            $(".progress-bar").text(percentage + "%");
            $(".progress-bar").attr("data-progress", percentage);
            $(".totalVenta").text("Venta Total " + totalVenta);
            $(".progres-estado").text(estado);

            if (percentage >= 0 && percentage <= 50) {
                $(".progress-bar").addClass("bg-info");
            } else if (percentage >= 51 && percentage <= 80) {
                $(".progress-bar").addClass("bg-success");
            } else if (percentage >= 81 && percentage <= 99) {
                $(".progress-bar").addClass("bg-warning");
            } else if (percentage >= 100) {
                $(".progress-bar").addClass("bg-danger");

                Lobibox.alert("error", {
                    title: "Limite de Venta Superado",
                    msg: "Por Favor Comuniquese con el Administrador"
                });
                $("input[name='lot_id[]']").prop("disabled", true);
            }
        }
    });
}


