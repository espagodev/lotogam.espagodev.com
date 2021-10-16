$(document).ready(function() {

    $('.view_register').on('shown.bs.modal', function() {
        __currency_convert_recursively($(this));

        horaInicio();

        $('.updateTime').on( 'keyup keypress change load', function(){
            if($(this).val() < 0) {
                // Notify( 'Tiempo de cierre incorrecto!', 'El tiempo de cierre debe de estár antes que el sorteo!', 'error' );
                $(this).val(0)
            }
    
            updateClosingTime($(this))
        })

        $('.hlo_hora_fin').on('change load', function(){      

            var horaInicio = moment($(`#Horariols_L`).val(), 'HH:mm');
            var horaFin = moment($(this).val(), 'HH:mm');

            // console.log(horaInicio.isBefore(horaFin)); // deberá aparecer true 

            if(horaInicio.isBefore(horaFin)) {

                Lobibox.notify("error", {
                    pauseDelayOnHover: true,
                    size: "mini",
                    rounded: true,
                    delayIndicator: false,
                    continueDelayOnInactiveTab: false,
                    position: "top right",
                    msg: "Horario De Cierre No puede Ser mayor o Igual Al Horario de Cierre de la Loteria",
                });
            }

        })

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
});


    function horaInicio() {
        // $('.hlo_hora_inicio').timepicker({
        //     timeFormat: 'hh:mm',
        //     interval: 60,
        //     minTime: '07',
        //     maxTime: '6:00pm',
        //     defaultTime: '07',
        //     startTime: '07',
        //     dynamic: false,
        //     dropdown: true,
        //     scrollbar: true
        // });

        $('.hlo_hora_fin').timepicker({
            timeFormat: 'hh:mm',
            zindex:  999999,
            interval: 5,
            // minTime: '07',
            maxTime: '00:00',
            // defaultTime: '07',
            // startTime: '07',
            dynamic: false,
            dropdown: false,
            scrollbar: false
        });

            $('.hlo_hora_inicio').timepicker({
                timeFormat: 'hh:mm',
                zindex:  999999,
                interval: 5,
                // minTime: '07',
                maxTime: '00:00',
                defaultTime: '07',
                // startTime: '07',
                dynamic: false,
                dropdown: false,
                scrollbar: false
        });
    }

function updateClosingTime(element) { 
    var id = element.attr('rel')
    var raffle_time  = moment.utc( $(`#Horariols_L`).val(), 'HH:mm' )
    $(`#hlo_hora_fin_L_${id}`).val(
        raffle_time.subtract(element.val(), "minutes").format('HH:mm')
    )
}