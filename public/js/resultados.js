$('#modificarPremio').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var fecha = button.data('fecha')
    var loteria = button.data('loteria')
    var numero_1 = button.data('numero_1')
    var numero_2 = button.data('numero_2')
    var numero_3 = button.data('numero_3')
    var id = button.data('id')
    var modificar = button.data('modificar')
    var modal = $(this)
    modal.find('.panel-body #pre_fecha').val(fecha)
    modal.find('.panel-body #lot_id').val(loteria)
    modal.find('.panel-body #pre_premio1').val(numero_1)
    modal.find('.panel-body #pre_premio2').val(numero_2)
    modal.find('.panel-body #pre_premio3').val(numero_3)
    modal.find('.panel-body #pre_id').val(id)
    modal.find('.panel-body #modificar').val(modificar)
})


// $('#nuevo').on('show.bs.modal', function (event) {


//         $("#loterias_id").hide();
// })

    $(document).ready(function() {

            if ($('#spr_date_filter').length == 1) {
                $('#spr_date_filter').daterangepicker(dateRangeSettings, function(start, end) {
                    $('#spr_date_filter span').val(
                        start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
                    );
                    reporte_resultados.ajax.reload();
                });
                $('#spr_date_filter').on('cancel.daterangepicker', function(ev, picker) {
                    $('#spr_date_filter').val('');
                    reporte_resultados.ajax.reload();
                });
            }

            $('#reporte_resultados, #loterias_id').change(
                function() {
                    reporte_resultados.ajax.reload();
                }
            );


        $(".loterias_id").hide();
        $(".numerosPremiados").hide();
        $(".GuardarResultados").hide();
        $(".enproceso").hide();
        $(".procesado").hide();

        $("input[name=res_fecha]").change(function(){

            $(".loterias_id").show();
            $(".numerosPremiados").hide();
            $(".GuardarResultados").hide();
        });


        $("#loterias_id ").bind("change", function() {

            var loterias_id = $('#loterias_id').val();
            var fecha = $('#res_fecha').val();
            var HoraCierre = $(".loterias-id select#loterias_id option:selected").data("hora");
            var horaDetalle = HoraCierre.split(" ");
            var horaCierre = horaDetalle[0];

            $.when(
                $.ajax({
                    async: false,
                    url: "/validaHoraCierre",
                    method: "get",
                    dataType: "json",
                    data: {
                        loterias_id: loterias_id,
                        fecha: fecha,
                        horaCierre: horaCierre,
                        _token: token,
                    },
                })
            ).then(function (resp) {

                if (resp.status == "resultados") {
                    $("input[name=res_fecha]").focus();
                    Lobibox.notify("warning", {
                        title: '',
                        position: "top right",
                        size: "mini",
                        rounded: true,
                        delayIndicator: false,
                        continueDelayOnInactiveTab: false,
                        sound: false,
                        msg: resp.mensaje,
                    });
                }else if (resp.status == "cierre") {
                        $(".numerosPremiados").hide();
                    $(".GuardarResultados").hide();
                    Lobibox.notify("warning", {
                        pauseDelayOnHover: true,
                        size: "mini",
                        rounded: true,
                        delayIndicator: false,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        sound: false,
                        msg: resp.mensaje,
                    });
                }else if (resp.status == "fecha") {
                    $("input[name=tid_apuesta]").focus();
                    Lobibox.notify("warning", {
                        pauseDelayOnHover: true,
                        size: "mini",
                        rounded: true,
                        delayIndicator: false,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        msg: resp.mensaje,
                    });
                }else if (resp.status == "ok") {
                    $(".numerosPremiados").show();
                        $(".GuardarResultados").show();

                }
            });
        });

          $(".GuardarResultados").click(function () {
            $(".resultados").hide();
            $(".enproceso").show();
            $(".GuardarResultados").hide();
            $(".cancelar").hide();

            var loterias_id = $('#loterias_id').val();
            var fecha = $('#res_fecha').val();
            var premio1 = $('#res_premio1').val();
            var premio2 = $('#res_premio2').val();
            var premio3 = $('#res_premio3').val();
            var delayInMilliseconds = 2000; //1 second
            setTimeout(function() {
             $.when(
                 $.ajax({
                 async: false,
                    url: "/guardarResultados",
                    method: "post",
                    dataType: "json",
                    data: {
                        loterias_id: loterias_id,
                        fecha: fecha,
                        'premio1': premio1,
                        'premio2': premio2,
                        'premio3': premio3,
                        _token: token,
                    }
                    })
                   ).then(function (resp) {
                       console.log(resp);
                    if (resp.status == "ok") {
                        $(".enproceso").hide();
                        $(".procesado").show();
                        $("input[name=res_fecha]").val('');
                        $('#loterias_id').val('');
                        $('#res_premio1').val('');
                        $('#res_premio2').val('');
                        $('#res_premio3').val('');
                        $(".numerosPremiados").hide();
                        $(".GuardarResultados").hide();
                        $(".loterias_id").hide();
                        $('.totalPremiados').text(resp.mensaje['contPremiados']);
                    }
                });
            }, delayInMilliseconds);

        });

            //Reporte de resultados
            reporte_resultados =  $('#reporte_resultados').DataTable({
                processing: true,
                serverSide: true,
                aaSorting: false,
                ajax: {
                        url: '/reportes/reporte-resultados',
                        dataType: "json",
                    data: function(d) {

                        d.loterias_id = $('select#loterias_id').val();
                        var mostrar = 1;
                        var start = '';
                        var end = '';
                        if ($('input#spr_date_filter').val()) {
                            start = $('input#spr_date_filter')
                                .data('daterangepicker')
                                .startDate.format('YYYY-MM-DD');
                            end = $('input#spr_date_filter')
                                .data('daterangepicker')
                                .endDate.format('YYYY-MM-DD');
                        }
                        d.start_date = start;
                        d.end_date = end;
                        d.mostrar = mostrar;
                    },
                },
                columns: [
                        { data: 'lot_nombre', name: 'lot_nombre', orderable: false, searchable: false  },
                        { data: 'res_fecha', name: 'res_fecha', orderable: false, searchable: false  },
                        { data: 'res_premio1', name: 'res_premio1', orderable: false, searchable: false  },
                        { data: 'res_premio2', name: 'res_premio2', orderable: false, searchable: false  },
                        { data: 'res_premio3', name: 'res_premio3', orderable: false, searchable: false  },

                ],
                fnDrawCallback: function(oSettings) {
                    __currency_convert_recursively($('#reporte_resultados'));
                },
            });

            __reporteResultadosDetalle();
    });

       //Reportes dia anterior


    // $(document).ready(function() {

    //     $(".ModificarPremiados").click(function (e) {

    //         var fecha = $('input#pre_fecha').val();
    //         var loteria = document.getElementById("lot_id").value//obtener valor del input
    //         var premio1 = $('#pre_premio1').val();
    //         var premio2 = $('#pre_premio2').val();
    //         var premio3 = $('#pre_premio3').val();
    //         var id = $('#id').val();
    //         var token = '{{ csrf_token() }}';

    //         $.ajax({
    //             type: "POST",
    //             url: '{{ url('/admin/modificarPremiados') }}',

    //             data:{
    //                     '_token': token,
    //                     'fecha': fecha,
    //                     'loteria': loteria,
    //                     'premio1': premio1,
    //                     'premio2': premio2,
    //                     'premio3': premio3,
    //                     'id': id,
    //                 },
    //                 success: function (data) {
    //                     $('#modificarPremio').modal('hide');
    //                     $("#divid").load(" #divid");

    //                 }
    //         });
    //     });
    // });

    // $(document).ready(function() {
    //     $(document).on('click', '.BorrarPremiados', function(){
    //     // $(".BorrarPremiados").click(function (e) {

    //         var id = $(this).attr("data-record-id");
    //         var fecha = $(this).attr("data-record-fecha");
    //         var loteria = $(this).attr("data-record-loteria");

    //         var token = '{{ csrf_token() }}';
    //         $.ajax({
    //             type: "POST",
    //             url: '{{ url('/admin/borrarPremiados') }}',

    //             data:{
    //                     '_token': token,
    //                     'id': id,
    //                     'fecha': fecha,
    //                     'loteria': loteria,

    //                 },
    //                 success: function (data) {

    //                     $("#divid").load(" #divid");

    //                 }
    //         });
    //     });
    // });


