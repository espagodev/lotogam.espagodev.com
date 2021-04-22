let $impuesto;

$impuesto = $("#impuestos");
var loteria = (function($) {
    const taxes = $impuesto.val();
    ("use strict");
    return {
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////// SUBSCRIPTION ///////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        applyDiscount: function() {
            function getDiscountAmount() {
                var fac_valor_facturado = parseInt(
                    $("#fac_valor_facturado").val()
                ); // Get Selected plan amount
                var admission_amount = $("#admission_amount").length
                    ? parseInt($("#admission_amount").val())
                    : 0; // Get selected admission amount
                var total_amount = fac_valor_facturado + admission_amount;
                var tax = Math.round((total_amount * taxes) / 100); // Calculate taxes
                var total = fac_valor_facturado + tax; // Calculate total and prefill in dep_valor_pagado box

                var fac_valor_descuento = parseInt($("#fac_descuento").val());
                var fac_valor_descuento = isNaN(fac_valor_descuento)
                    ? $("#fac_valor_descuento").val()
                    : Math.round((total * fac_valor_descuento) / 100);
                $("#fac_valor_descuento").val(fac_valor_descuento);
            }

            function getCustomDiscountAmount() {
                var fac_valor_facturado = parseInt(
                    $("#fac_valor_facturado").val()
                ); // Get Selected plan amount
                var admission_amount = $("#admission_amount").length
                    ? parseInt($("#admission_amount").val())
                    : 0; // Get selected admission amount
                var total_amount = fac_valor_facturado + admission_amount;
                var tax = Math.round((total_amount * taxes) / 100); // Calculate taxes
                var total = total_amount + tax; // Calculate total and prefill in dep_valor_pagado box

                var fac_valor_descuento = $("#fac_valor_descuento").val();
                var fac_valor_descuento = isNaN(fac_valor_descuento)
                    ? ""
                    : fac_valor_descuento;
            }

            $("#fac_descuento").bind("change keyup input", function(e) {
                getDiscountAmount();
                if ($("#fac_descuento").val() != "custom") {
                    $("#fac_valor_descuento").attr("readonly", true);
                } else {
                    $("#fac_valor_descuento").attr("readonly", false);
                }
            });

            // On amount Change
            $("#fac_valor_descuento").bind("change keyup input", function() {
                if ($("#fac_descuento").val() == "custom") {
                    getCustomDiscountAmount();
                }
            });
        },

        applyDiscount: function() {
            function getDiscountAmount() {
                var fac_valor_facturado = parseInt(
                    $("#fac_valor_facturado").val()
                ); // Get Selected plan amount
                var admission_amount = $("#admission_amount").length
                    ? parseInt($("#admission_amount").val())
                    : 0; // Get selected admission amount
                var total_amount = fac_valor_facturado + admission_amount;
                var tax = Math.round((total_amount * taxes) / 100); // Calculate taxes
                var total = total_amount + tax; // Calculate total and prefill in dep_valor_pagado box

                var fac_valor_descuento = parseInt($("#fac_descuento").val());
                var fac_valor_descuento = isNaN(fac_valor_descuento)
                    ? $("#fac_valor_descuento").val()
                    : Math.round((total * fac_valor_descuento) / 100);
                $("#fac_valor_descuento").val(fac_valor_descuento);
            }

            function getCustomDiscountAmount() {
                var fac_valor_facturado = parseInt(
                    $("#fac_valor_facturado").val()
                ); // Get Selected plan amount
                var admission_amount = $("#admission_amount").length
                    ? parseInt($("#admission_amount").val())
                    : 0; // Get selected admission amount
                var total_amount = fac_valor_facturado + admission_amount;
                var tax = Math.round((total_amount * taxes) / 100); // Calculate taxes
                var total = total_amount + tax; // Calculate total and prefill in dep_valor_pagado box

                var fac_valor_descuento = $("#fac_valor_descuento").val();
                var fac_valor_descuento = isNaN(fac_valor_descuento)
                    ? ""
                    : fac_valor_descuento;
            }

            $("#fac_descuento").bind("change keyup input", function(e) {
                getDiscountAmount();
                if ($("#fac_descuento").val() != "custom") {
                    $("#fac_valor_descuento").attr("readonly", true);
                } else {
                    $("#fac_valor_descuento").attr("readonly", false);
                }
            });

            // On amount Change
            $("#fac_valor_descuento").bind("change keyup input", function() {
                if ($("#fac_descuento").val() == "custom") {
                    getCustomDiscountAmount();
                }
            });
        },

        subscription: function() {
            function getEndDate() {
                var plan_days = $(
                    ".plan-id select#planes_id option:selected"
                ).data("days");
                var subscription_start_date = $(
                    ".sus_fecha_inicio input#sus_fecha_inicio"
                ).val();
                var subscription_end_date = moment(
                    subscription_start_date,
                    "YYYY-MM-DD"
                )
                    .add(plan_days, "months")
                    .format("YYYY-MM-DD");

                $(".sus_fecha_fin input#sus_fecha_fin").val(
                    subscription_end_date
                );
            }

            function getPlanAmount() {
                var sum = 0;
                $(".plan-id select option:selected").each(function() {
                    sum += +$(this).data("precio");
                    $(".price input#price").val($(this).data("precio"));
                });
                $("#fac_valor_facturado")
                    .val(sum)
                    .trigger("change");
            }

            function getTaxAmount() {
                var fac_valor_facturado = parseInt(
                    $("#fac_valor_facturado").val()
                ); // Get Selected plan amount
                var admission_amount = $("#admission_amount").length
                    ? parseInt($("#admission_amount").val())
                    : 0; // Get selected admission amount
                var total_amount = fac_valor_facturado + admission_amount;
                var tax = Math.round((total_amount * taxes) / 100); // Calculate taxes

                $("#fac_valor_impuesto").val(tax);
            }

            function getDiscountAmount() {
                var fac_valor_facturado = parseInt(
                    $("#fac_valor_facturado").val()
                ); // Get Selected plan amount
                var admission_amount = $("#admission_amount").length
                    ? parseInt($("#admission_amount").val())
                    : 0; // Get selected admission amount
                var total_amount = fac_valor_facturado;
                var tax = Math.round((total_amount * taxes) / 100); // Calculate taxes
                var total = total_amount + tax; // Calculate total and prefill in dep_valor_pagado box

                var fac_valor_descuento = parseInt($("#fac_descuento").val());
                var fac_valor_descuento = isNaN(fac_valor_descuento)
                    ? $("#fac_valor_descuento").val()
                    : Math.round((total * fac_valor_descuento) / 100);
                $("#fac_valor_descuento").val(fac_valor_descuento);

                var dep_valor_pagado = total - fac_valor_descuento; // Calculate total and prefill in dep_valor_pagado box

                $("#dep_valor_pagado").val(Math.round(dep_valor_pagado));
                $("#dep_valor_pagado").data(
                    "amounttotal",
                    $("#dep_valor_pagado").val()
                );
            }

            function getCustomDiscountAmount() {
                var fac_valor_facturado = $("#fac_valor_facturado").length
                ? parseInt(
                    $("#fac_valor_facturado").val()
                ): 0; // Get Selected plan amount
                var admission_amount = $("#admission_amount").length
                    ? parseInt($("#admission_amount").val())
                    : 0; // Get selected admission amount
                var total_amount = fac_valor_facturado ;
                var tax = Math.round((total_amount * taxes) / 100); // Calculate taxes
                var total = total_amount + tax; // Calculate total and prefill in dep_valor_pagado box

                var fac_valor_descuento = $("#fac_valor_descuento").val();
                var fac_valor_descuento = isNaN(fac_valor_descuento)
                    ? ""
                    : fac_valor_descuento;
                var dep_valor_pagado = total - fac_valor_descuento; // Calculate total and prefill in dep_valor_pagado box

                $("#dep_valor_pagado").val(Math.round(dep_valor_pagado));
                $("#dep_valor_pagado").data(
                    "amounttotal",
                    $("#dep_valor_pagado").val()
                );
            }

            $(document).ready(function() {
                getEndDate(0);
                getPlanAmount();
                $("#fac_valor_pendiente").val(0);
                $("#fac_valor_facturado").val(0);
                $("#fac_valor_impuesto").val(0);
                $("#dep_valor_pagado").val(0);
                $("#fac_valor_descuento").val(0);
            });

            //On dropdown change set end date and plan amount
            $(document).on("change", ".plan-id select", function() {
                getEndDate($(this).data());
                getPlanAmount();
            });

            // On start date Change update end datepicker
            $(document).on(
                "change keyup input",
                ".sus_fecha_inicio input",
                function() {
                    getEndDate($(this).data());
                }
            );

            // On subscription amount Change tax & discount amount
            $("#fac_valor_facturado").bind("change keyup input", function(e) {
                getTaxAmount();
                getDiscountAmount();
            });

            // On Admission Change
            $("#admission_amount").bind("change keyup input", function() {
                getTaxAmount();
                getDiscountAmount();
            });

            //OnDiscount Percent dropdown change
            $("#fac_descuento").bind("change keyup input", function(e) {
                getDiscountAmount();
                if ($("#fac_descuento").val() != "custom") {
                    $("#fac_valor_descuento").attr("readonly", true);
                } else {
                    $("#fac_valor_descuento").attr("readonly", false);
                }
            });

            // On amount Change
            $("#fac_valor_descuento").bind("change keyup input", function() {
                if ($("#fac_descuento").val() == "custom") {
                    getCustomDiscountAmount();
                }
            });

            // On payment received amount Change
            $("#dep_valor_pagado").bind("change keyup input", function() {
                var payment_total = $("#dep_valor_pagado").data("amounttotal");
                if ($("#previous_payment").length) {
                    var pending =
                        payment_total -
                        parseInt($("#previous_payment").val()) -
                        parseInt($("#dep_valor_pagado").val());
                } else {
                    var pending =
                        payment_total - parseInt($("#dep_valor_pagado").val());
                }
                $("#fac_valor_pendiente").val(isNaN(pending) ? 0 : pending);
            });
        },

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////

        subscriptionChange: function() {
            function getAmountToPay() {
                var totalAmount = parseInt($("#dep_valor_pagado").val());
                var alreadyPaid = parseInt($("#previous_payment").val());
                var newTotal = totalAmount - alreadyPaid;
                $("#dep_valor_pagado").val(newTotal);
            }

            $(document).ready(function() {
                getAmountToPay();
            });

            // On plans dropdown change
            $(document).on("change", ".plan-id select", function() {
                getAmountToPay();
            });

            // On discount dropdown change
            $("#fac_valor_descuento").bind("change keyup input", function() {
                getAmountToPay();
            });
        }
    };
})(jQuery);
