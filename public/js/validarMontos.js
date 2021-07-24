$(document).ready(function() {
    $(document).on('click', '.validar_monto', function(){

        var bancas_id = $("input#bancas_id").val();
        var users_id = $("input#users_id").val();

        var loterias_id = $(this).attr("data-loterias_id");
        var lot_nombre = $(this).attr("data-loteria");
        var lot_superpale = $(this).attr("data-superpale");

        __validarMontos(bancas_id, users_id, loterias_id, lot_nombre, lot_superpale );

    });
});


function __validarMontos(bancas_id, users_id, loterias_id, lot_nombre, lot_superpale) {


        // var data = {  bancas_id: bancas_id, users_id: users_id, lot_nombre: lot_nombre, loterias_id:loterias_id, lot_superpale:lot_superpale };
        $.when(
            $.ajax({

                type: "get",
                url: '/validar',
                dataType: 'json',
                data: {
                    bancas_id: bancas_id,
                    users_id: users_id,
                    lot_nombre: lot_nombre,
                    loterias_id: loterias_id,
                    lot_superpale: lot_superpale
                },
            })
        ).then(function (result) {
            var SOUND = 'public/audio/';

            if (result.status == 1) {
                swal(
                    'el siguientes Numeros:  ' + result.numero + ' ',
                    'No pueden ser Jugados en la Loteria   ' + result.loteria + ' ',
                )
            }
            if (result.status == 2) {
                swal(
                    'Los siguientes Numeros:',
                    '  ' + result.numero + '  en la Loteria   ' + result.loteria + ' ',
                )
            }
            if (result.status == 3) {
                Lobibox.notify("info", {
                    pauseDelayOnHover: true,
                    size: "mini",
                    rounded: true,
                    delayIndicator: false,
                    continueDelayOnInactiveTab: false,
                    position: "top center",
                    msg: result.numero + '  en la Loteria   ' + result.loteria + ' ',
                });
            }

            if (result.status == 4) {
                Lobibox.alert("error", {
                    title: 'Error de Montos',
                    msg: result.numero,
                });
            }

        });

}


