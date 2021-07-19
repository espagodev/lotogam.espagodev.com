$(document).ready(function () {

    // por comodidad puedes asignar los selects a una variable, ya que los vas a usar mas de una vez
    var plantSelect = $('#bancas_id');
    var areaSelect = $('#users_id');
    var equipoSelect = $('#equipo_id');
    // primero obtienes las plantas y llenas el select
    function populatePlantSelect() {
        $.ajax({
            url: "/select/getbancas",
            type: 'GET',
            dataType: 'json',
            success: function (response) {

                $.each(response, function (key, value) {
                    plantSelect.append("<option value='" + value.id + "'>" + value.ban_nombre + "</option>");
                });
            },
            error: function () {
                alert('Hubo un error obteniendo las Bancas!');
            }
        });
    }
    populatePlantSelect();
    // luego indicas que cuando se seleccione una planta, se obtengan las areas correspondientes y se llene el select de areas
    plantSelect.change(function () {
        var bancas_id = $(this).val();
        areaSelect.empty();

        if (bancas_id) {
            $.ajax({
                url: "/select/getusuarios",
                type: 'GET',
                data: { bancas_id: bancas_id },
                dataType: 'json',
                success: function (response) {
                    areaSelect.append('<option value="">Seleccione un Usuario</option>')
                    $.each(response, function (key, value) {
                        areaSelect.append("<option value='" + value.id + "'>" + value.name + "</option>");
                    });
                },
                error: function () {
                    alert('Hubo un error obteniendo los Usuarios!');
                }
            });
        }
    });



    // finalmente, indicas que cuando se seleccione un area, se obtengan los equipos correspondientes y se llene el select de equipos
    // areaSelect.change(function () {
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

