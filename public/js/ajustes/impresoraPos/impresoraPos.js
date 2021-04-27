$(document).ready(function() {

     $(document).on('change', 'select#imp_conexion', function() {
         var ctype = $(this).val();
            printer_connection_type_field(ctype);
     });

    //  $('select#imp_conexion').on('change',function() {
    //         var ctype = $(this).val();
    //         printer_connection_type_field(ctype);
    //  });



        $(document).on('click', '.modificar-impresora', function(e) {
        e.preventDefault();
        var container = $('.modificar_modal');

        $.ajax({
            url: $(this).data('href'),
            dataType: 'html',
            success: function(result) {
                container.html(result).modal('show');
                console.log($('select#imp_conexion').val());
                printer_connection_type_field($('select#imp_conexion').val());

            },
        });
    });

});

function printer_connection_type_field(ctype) {
    if (ctype == 'network') {
        $('div#path_div').addClass('hide');
        $('div#ip_address_div, div#port_div').removeClass('hide');
    } else if (ctype == 'windows' || ctype == 'linux') {
        $('div#path_div').removeClass('hide');
        $('div#ip_address_div, div#port_div').addClass('hide');
    }
}
