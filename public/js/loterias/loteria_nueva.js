$(document).ready(function () {
    $('.sorteols').timepicker({
       timeFormat: 'HH:mm',
        zindex:  999999,
        interval: 5,
        minTime: '7',
        maxTime: '10:00pm',
        defaultTime: '7',
        startTime: '07:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
     $('.sorteod').timepicker({
        timeFormat: 'HH:mm ',
        zindex:  999999,
        interval: 5,
        minTime: '11',
        maxTime: '10:00pm',
        defaultTime: '11',
        startTime: '11:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
});
