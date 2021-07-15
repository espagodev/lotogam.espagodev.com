$(document).ready(function() {

    // por comodidad puedes asignar los selects a una variable, ya que los vas a usar mas de una vez
    var bancas_id = $('#bancas_id');
    var users_id = $('#users_id');

    // primero obtienes las plantas y llenas el select
    function bancaSelect() {
        $.ajax({
            url: "/select/getbancas",
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $.each(response, function (key, value) {
                    bancaIdSelect.append("<option value='" + value.id + "'>" + value.ban_nombre + "</option>");
                });
            },
            error: function () {
                alert('Hubo un error obteniendo las Bancas!');
            }
        });
    }
    bancaSelect();
    // luego indicas que cuando se seleccione una planta, se obtengan las areas correspondientes y se llene el select de areas
    bancaIdSelect.change(function () {
        var bancas_id = $(this).val();
        usuarioIdSelect.empty();

        if (bancas_id) {
            $.ajax({
                url: "/select/getusuarios",
                type: 'GET',
                data: { bancas_id: bancas_id },
                dataType: 'json',
                success: function (response) {
                    usuarioIdSelect.append('<option value="">Seleccione un Usuario</option>')
                    $.each(response, function (key, value) {
                        usuarioIdSelect.append("<option value='" + value.id + "'>" + value.name + "</option>");
                    });
                },
                error: function () {
                    alert('Hubo un error obteniendo los Usuarios!');
                }
            });
        }
    });

});


