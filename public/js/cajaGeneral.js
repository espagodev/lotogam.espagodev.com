$(document).ready(function() {
    if ($("#spr_date_filter").length == 1) {
        $("#spr_date_filter").daterangepicker(dateRangeSettings, function(start,end) {
            $("#spr_date_filter span").val(start.format(moment_date_format) + " ~ " +  end.format(moment_date_format));
            
            balance_diario_datatable.ajax.reload();
            caja_general_datatable.ajax.reload();

            $(".nav-tabs li.active").find('a[data-toggle="tab"]').trigger("shown.bs.tab");

            getCajaGeneral();
        });

        $("#spr_date_filter").on("cancel.daterangepicker", function(ev,picker) {
            $("#spr_date_filter").val("");            
            balance_diario_datatable.ajax.reload();
            caja_general_datatable.ajax.reload();
            $(".nav-tabs li.active").find('a[data-toggle="tab"]').trigger("shown.bs.tab");
            getCajaGeneral();
        });
        getCajaGeneral();
    }

    $("#balance_diario_table, #caja_general_table, #bancas_id, #users_id, #movimiento").change(function() {
        balance_diario_datatable.ajax.reload();
        caja_general_datatable.ajax.reload();
        
        $(".nav-tabs li.active")
            .find('a[data-toggle="tab"]')
            .trigger("shown.bs.tab");
        getCajaGeneral();
    });



    balance_diario_datatable = $("table#balance_diario_table").DataTable(
        {
            processing: true,
            serverSide: true,
            scrollY:        "500px",
            scrollX:        true,
            scrollCollapse: true,
            paging:         false,
            fixedColumns:   true,
            
            ajax: {
                url: "/balance/getBalance",
                dataType: "json",
                data: function(d) {
                    d.bancas_id = $("select#bancas_id").val();
                    d.users_id = $("select#users_id").val();
                    d.movimiento = $("select#movimiento").val();

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
                    data: "users_id",
                    name: "users_id",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "cgc_balance_inicial",
                    name: "cgc_balance_inicial",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "cgc_total_entradas",
                    name: "cgc_total_entradas",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "cgc_total_salidas",
                    name: "cgc_total_salidas",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "cgc_total_venta",
                    name: "cgc_total_venta",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "cgc_total_venta_neta",
                    name: "cgc_total_venta_neta",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "cgc_total_comisiones",
                    name: "cgc_total_comisiones",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "cgc_total_premios",
                    name: "cgc_total_premios",
                    orderable: false,
                    searchable: false
                },
                
                {
                    data: "cgc_balance_final",
                    name: "cgc_balance_final",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "disponible",
                    name: "disponible",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "cgc_fecha_movimiento",
                    name: "cgc_fecha_movimiento",
                    orderable: false,
                    searchable: false
                }
            ],
            fnDrawCallback: function(oSettings) {
                __currency_convert_recursively(
                    $("#balance_diario_table")
                );
            },
            createdRow: function (row, data, dataIndex) {
                $('td:eq(9)', row).css('background-color', '#9EF395');                
            }
            
        }
       
    );

    caja_general_datatable = $("table#caja_general_table").DataTable({
        processing: true,
        serverSide: true,
        aaSorting: false,
        scrollY:        "500px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
       

        ajax: {
            url: "/caja_general/getCajaGeneral",
            dataType: "json",
            data: function(d) {
                d.bancas_id = $("select#bancas_id").val();
                d.users_id = $("select#users_id").val();
                d.movimiento = $("select#movimiento").val();

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
                data: "cag_movimiento",
                name: "cag_movimiento",
                orderable: false,
                searchable: false
            },
            {
                data: "cag_fecha_movimiento",
                name: "cag_fecha_movimiento",
                orderable: false,
                searchable: false
            },
            {
                data: "bancas_id",
                name: "bancas_id",
                orderable: false,
                searchable: false
            },
            {
                data: "users_id",
                name: "users_id",
                orderable: false,
                searchable: false
            },
            {
                data: "cag_monto",
                name: "cag_monto",
                orderable: false,
                searchable: false
            },
            {
                data: "cag_nota_movimiento",
                name: "cag_nota_movimiento",
                orderable: false,
                searchable: false
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false
            }
        ],
        fnDrawCallback: function(oSettings) {
            __currency_convert_recursively($("#caja_general"));
        }
    });
   
    // $('a[data-toggle="tab"]').on("shown.bs.tab", function(e) {
    //     var target = $(e.target).attr("href");
    //     if (target == "#caja_general") {
    //         if (typeof caja_general_datatable == "undefined") {

    //             caja_general_datatable = $("#caja_general_table").DataTable({
    //                 processing: true,
    //                 serverSide: true,
    //                 aaSorting: false,
    //                 ajax: {
    //                     url: "/caja_general/getCajaGeneral",
    //                     dataType: "json",
    //                     data: function(d) {
    //                         d.bancas_id = $("select#bancas_id").val();
    //                         d.users_id = $("select#users_id").val();
    //                         d.movimiento = $("select#movimiento").val();
            
    //                         var start = "";
    //                         var end = "";
    //                         if ($("input#spr_date_filter").val()) {
    //                             start = $("input#spr_date_filter")
    //                                 .data("daterangepicker")
    //                                 .startDate.format("YYYY-MM-DD");
    //                             end = $("input#spr_date_filter")
    //                                 .data("daterangepicker")
    //                                 .endDate.format("YYYY-MM-DD");
    //                         }
    //                         d.start_date = start;
    //                         d.end_date = end;
    //                     }
    //                 },
    //                 columns: [
    //                     {
    //                         data: "cag_movimiento",
    //                         name: "cag_movimiento",
    //                         orderable: false,
    //                         searchable: false
    //                     },
    //                     {
    //                         data: "cag_fecha_movimiento",
    //                         name: "cag_fecha_movimiento",
    //                         orderable: false,
    //                         searchable: false
    //                     },
    //                     {
    //                         data: "bancas_id",
    //                         name: "bancas_id",
    //                         orderable: false,
    //                         searchable: false
    //                     },
    //                     {
    //                         data: "users_id",
    //                         name: "users_id",
    //                         orderable: false,
    //                         searchable: false
    //                     },
    //                     {
    //                         data: "cag_monto",
    //                         name: "cag_monto",
    //                         orderable: false,
    //                         searchable: false
    //                     },
    //                     {
    //                         data: "cag_nota_movimiento",
    //                         name: "cag_nota_movimiento",
    //                         orderable: false,
    //                         searchable: false
    //                     },
    //                     {
    //                         data: "action",
    //                         name: "action",
    //                         orderable: false,
    //                         searchable: false
    //                     }
    //                 ],
    //                 fnDrawCallback: function(oSettings) {
    //                     __currency_convert_recursively($("#caja_general"));
    //                 }
    //             });
    //         } else {
                
    //             caja_general_datatable.ajax.reload();
    //         }
    //     } else if (target == "#balance_diario") {
    //         balance_diario_datatable.ajax.reload();
    //     }
    // });

    $(document).on("click", ".nuevo-registro", function(e) {
        e.preventDefault();
        var container = $(".nuevo_modal");

        $.ajax({
            url: $(this).data("href"),
            dataType: "html",
            success: function(result) {
                container.html(result).modal("show");
            }
        });
    });

    $(document).on("click", "button.delete_cajaGeneral_button", function() {
        swal({
            title: "Estás seguro ?",
            icon: "warning",
            buttons: true,
            dangerMode: true
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).data("href");
                var data = $(this).serialize();

                $.ajax({
                    method: "GET",
                    url: href,
                    dataType: "json",
                    data: data,
                    success: function(result) {
                        if (result.success === true) {
                            Lobibox.notify("success", {
                                pauseDelayOnHover: true,
                                size: "mini",
                                rounded: true,
                                delayIndicator: false,
                                continueDelayOnInactiveTab: false,
                                position: "top right",
                                msg: result.msg
                            });
                            caja_general.ajax.reload();
                        } else {
                            Lobibox.notify("error", {
                                pauseDelayOnHover: true,
                                size: "mini",
                                rounded: true,
                                delayIndicator: false,
                                continueDelayOnInactiveTab: false,
                                position: "top right",
                                msg: result.msg
                            });
                        }
                    }
                });
            }
        });
    });
});

function getCajaGeneral() {
    var start = $("#spr_date_filter")
        .data("daterangepicker")
        .startDate.format("YYYY-MM-DD");
    var end = $("#spr_date_filter")
        .data("daterangepicker")
        .endDate.format("YYYY-MM-DD");
    var bancas_id = $("#bancas_id").val();

    var data = { start_date: start, end_date: end, bancas_id: bancas_id };

    var loader = __fa_awesome();

    $(".balance_inicial").html(loader);
    $(".total_entradas").html(loader);
    $(".total_salidas").html(loader);
    $(".total_cupo").html(loader);
    $(".total_venta").html(loader);
    $(".balance_final").html(loader);

    $.ajax({
        method: "GET",
        url: "/caja_general/getCajaGeneralDetalle",
        dataType: "json",
        data: data,
        success: function(data) { 
            $(".balance_inicial").html(
                __currency_trans_from_en(data.balance_inicial, true)
            );
            $(".total_entradas").html(
                __currency_trans_from_en(data.total_entradas, true)
            );
            $(".total_salidas").html(
                __currency_trans_from_en(data.total_salidas, true)
            );
            $(".total_cupo").html(
                __currency_trans_from_en(data.total_cupo, true)
            );
            $(".total_venta").html(
                __currency_trans_from_en(data.total_venta, true)
            );
            $(".balance_final").html(
                __currency_trans_from_en(data.balance_final, true)
            );
        }
    });
}
