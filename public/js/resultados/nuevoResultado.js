    function __validar_loteria() {
        $("#loterias_id").bind("change", function() {

            var loterias_id = $('#loterias_id').val();
            
            var fecha = $('#res_fecha').val();
            var HoraCierre = $(".loterias-id select#loterias_id option:selected").data("hora");
            var horaDetalle = HoraCierre.split(" ");
            var horaCierre = horaDetalle[0];
            var token = '{{ csrf_token() }}';
            $.when(
                $.ajax({
                    async: false,
                    url: "/validaHoraCierre",
                    method: "get",
                    dataType: "json",
                    data: {
                        loterias_id: loterias_id,
                        fecha: fecha,
                        horaCierre: horaCierre,
                        _token: token,
                    },
                })
            ).then(function (resp) {

                if (resp.status == "resultados") {
                    $("input[name=res_fecha]").focus();
                    Lobibox.notify("warning", {
                        title: '',
                        position: "top right",
                        size: "mini",
                        rounded: true,
                        delayIndicator: false,
                        continueDelayOnInactiveTab: false,
                        sound: false,
                        msg: resp.mensaje,
                    });
                }else if (resp.status == "cierre") {
                    $(".numerosPremiados").hide();
                    $(".GuardarResultados").hide();
                    Lobibox.notify("warning", {
                        pauseDelayOnHover: true,
                        size: "mini",
                        rounded: true,
                        delayIndicator: false,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        sound: false,
                        msg: resp.mensaje,
                    });
                }else if (resp.status == "fecha") {
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
                }else if (resp.status == "ok") {
                    $(".numerosPremiados").show();
                    $(".GuardarResultados").show();

                }
            });
        });
    }
