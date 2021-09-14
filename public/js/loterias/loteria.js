$(document).ready(function () {



    $(document).on('click', '.nuevo-modal', function (e) {
        e.preventDefault();
        var container = $('.nuevo_modal');

        $.ajax({
            url: $(this).data('href'),
            dataType: 'html',
            success: function (result) {
                container.html(result).modal('show').modal('show').find('.select2').each( function(){
                    $(this).select2();
                });
            },
        });
    });

    $(document).on('click', '.modificar-modal', function (e) {
        e.preventDefault();
        var container = $('.modificar_modal');
        
        $.ajax({
            url: $(this).data('href'),
            dataType: 'html',
            success: function (result) {
                container.html(result).modal('show').find('.select2').each( function(){
                    $(this).select2();
                });

            },
        });
    });

});
