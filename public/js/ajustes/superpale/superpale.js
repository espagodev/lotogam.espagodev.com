$(document).ready(function() {

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

    $(document).on('click', '.modificar-superpale', function(e) {
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



     $(document).on('click', 'button.activar-inactivar-loteria', function(){
        swal({
            title: "Estás seguro ?",
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                $.ajax({
                    url: $(this).data('href'),
                    dataType: 'json',
                    success: function(result) {
                        if (result.success == "estado") {
                            Lobibox.notify("success", {
                                position: "top right",
                                title:false,
                                icon:false,
                                size: "mini",
                                rounded: true,
                                msg: result.msg,
                                });
                            loteriasSuper.ajax.reload();
                        }
                        else {
                            Lobibox.notify("error", {                                      
                                position: "top right",
                                title:false,
                                icon:false,
                                size: "mini",
                                rounded: true,
                                msg: result.msg,
                                        });
                     
                        }

                    },
                });
            }
        });
    });

   