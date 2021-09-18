$(document).ready(function () {

    // por comodidad puedes asignar los selects a una variable, ya que los vas a usar mas de una vez
    var bancaSelect = $('#bancas_id');
    var userSelect = $('#users_id');
    // var equipoSelect = $('#equipo_id');
    // primero obtienes las plantas y llenas el select
    // function listaBancaSelect() {
    //     $.ajax({
    //         url: "/select/getbancas",
    //         type: 'GET',
    //         dataType: 'json',
    //         success: function (response) {

    //             $.each(response, function (key, value) {
    //                 bancaSelect.append("<option value='" + value.id + "'>" + value.ban_nombre + "</option>");
    //             });
    //         },
    //         error: function () {
    //             alert('Hubo un error obteniendo las Bancas!');
    //         }
    //     });
    // }
    // listaBancaSelect();
    // luego indicas que cuando se seleccione una planta, se obtengan las areas correspondientes y se llene el select de areas
    bancaSelect.change(function () {
        var bancas_id = $(this).val();
        userSelect.empty();

        if (bancas_id) {
            $.ajax({
                url: "/select/getusuarios",
                type: 'GET',
                data: { bancas_id: bancas_id },
                dataType: 'json',
                success: function (response) {
                    userSelect.append('<option value="">Seleccione un Usuario</option>')
                    $.each(response, function (key, value) {
                        userSelect.append("<option value='" + value.id + "'>" + value.name + "</option>");
                    });
                },
                error: function () {
                    alert('Hubo un error obteniendo los Usuarios!');
                }
            });
        }
    });



    // finalmente, indicas que cuando se seleccione un area, se obtengan los equipos correspondientes y se llene el select de equipos
    // userSelect.change(function () {
    //     var areaId = $(this).val();
    //     equipoSelect.empty();

    //     if (areaId) {
    //         $.ajax({
    //             url: "{{ route('getequipos') }}",
    //             type: 'GET',
    //             data: { area_id: areaId },
    //             dataType: 'json',
    //             success: function (response) {
    //                 equipoSelect.append('<option value="">--Elije un equipo</option>')
    //                 $.each(response.data, function (key, value) {
    //                     equipoSelect.append("<option value='" + value.id + "'>" + value.name + "</option>");
    //                 });
    //             },
    //             error: function () {
    //                 alert('Hubo un error obteniendo los equipos!');
    //             }
    //         });
    //     }
    // });
});

