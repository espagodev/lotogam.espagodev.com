
        $(document).on('click', '.toggle-class', function(e) {


        var loe_estado = $(this).prop('checked') == true ? 1 : 0;
        var loterias_id = $(this).data('id');


        var data = { loterias_id: loterias_id, loe_estado: loe_estado, hlo_hora_fin: hlo_hora_fin, hlo_minutos: hlo_minutos };


            $.ajax({
                method: 'GET',
                url: $(this).data('href'),

                dataType: 'json',
                data: data,
                success: function(result) {
                     if (result.success == true) {


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



