
$(document).ready(function(){
            $('.hlo_hora_inicio').timepicker({
            timeFormat: 'HH:mm',
            interval: 5,
            minTime: '7',
            maxTime: '10:00pm',
            defaultTime: '7',
            startTime: '07:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
        //   $('.hlo_hora_fin').timepicker({
        //         timeFormat: 'HH:mm ',
        //         interval: 5,
        //         minTime: '11',
        //         maxTime: '10:00pm',
        //         defaultTime: '11',
        //         startTime: '11:00',
        //         dynamic: false,
        //         dropdown: true,
        //         scrollbar: true
        // });


	$('.updateTime').on( 'keyup keypress change load', function(){
		if($(this).val() < 0) {
			// Notify( 'Tiempo de cierre incorrecto!', 'El tiempo de cierre debe de estár antes que el sorteo!', 'error' );
			$(this).val(0)
		}

		updateClosingTime($(this))
	})

	$('#update_all_at_once_input').on( 'keyup keypress change', function(){
		if($(this).val() < 0) {
			// Notify( 'Tiempo de cierre incorrecto!', 'El tiempo de cierre debe de estár antes que el sorteo!', 'error' );
			$(this).val(0)
			return
		}

		if($(this).val().length == '') return

		$('.updateTime').each(function(){
			$(this).val($('#update_all_at_once_input').val())
			updateClosingTime($(this))
		})
	})

	// $('.update_closing_times').click(function(){
	// 	var data = {}

		// $('.updateTime').each(function(){
		// 	var key = $(this).attr('name')
		// 	data[key] = $(this).val()
		// })

	// 	$.ajax( {
	// 		type: 'POST',
	// 		url: aURL( 'configurations/closing_time' ),
	// 		data: data,
	// 	} ).done( function( data, textStatus, jqXHR ) {
	// 		if( data._META )
	// 			displayMessages(data._META.messages)
	// 		else
	// 			displayMessages( data.messages )
	// 	} );
	// })

	function updateClosingTime(element) {
        var id = element.attr('rel')

        var raffle_time  = moment.utc( $(`#Horariols_L`).val(), 'HH:mm' )
		$(`#hlo_hora_fin_L_${id}`).val(
			raffle_time.subtract(element.val(), "minutes").format('HH:mm')
		)
	}
})
