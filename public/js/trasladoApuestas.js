$(document).ready(function() {

    if ($('#spr_date_filter').length == 1) {
        $('#spr_date_filter').daterangepicker(dateRangeSettings, function(start, end) {
            $('#spr_date_filter span').val(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );
            control_apuestas.ajax.reload();
        });
        $('#spr_date_filter').on('cancel.daterangepicker', function(ev, picker) {
            $('#spr_date_filter').val('');
            control_apuestas.ajax.reload();
        });
    }

    $('#control_apuestas, #bancas_id, #loterias_id, #modalidades_id').change(
        function() {
            control_apuestas.ajax.reload();
        }
    );

    //TRASLADO DE NUMEROS
     control_apuestas =  $('#control_apuestas').DataTable({
        processing: true,
        serverSide: true,
         paging:    false,
         responsive: false,
        ajax: {
                url: '/traslado-numeros',
                dataType: "json",
                data: function(d) {

                    d.loterias_id = $('select#loterias_id').val();
                    d.bancas_id = $('select#bancas_id').val();
                    d.modalidades_id = $('select#modalidades_id').val();
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
                },
            },
        columns: [                
                { data: 'lot_nombre', name: 'loteria', orderable: false, searchable: false  },
                { data: 'mod_nombre', name: 'mod_nombre', orderable: false, searchable: false  },
                { data: 'tln_numero', name: 'tln_numero', orderable: false, searchable: false  },
                { data: 'tln_contador', name: 'tln_contador', orderable: false, searchable: false  },  
                { data: 'contador', name: 'contador', orderable: false, searchable: false  },
                { data: 'tln_fecha', name: 'tln_fecha', orderable: false, searchable: false  },
                // { data: 'tln_contador_traslado', name: 'tln_contador_traslado', orderable: false, searchable: false  },
         ],
          fnDrawCallback: function(oSettings) {
           
            __currency_convert_recursively($('#control_apuestas'));
        }
        ,
        createdRow: function( row, data, dataIndex){
            
            if((data["tln_contador_traslado"] != "0") && (data["tln_contador_updated"] == "0"))
            {             
                $('td:eq(4)', row).css('background-color', '#9EF395');    

            } else if((data["tln_contador_traslado"] != "0") && (data["tln_contador_updated"] == "1"))
            {
                $('td:eq(4)', row).css('background-color', '#F3959E');      
            }   
           
        },
        footerCallback: function (row, data, start, end, display) {

            var total_control = 0;
            var total_traslado = 0;


            for (var r in data){               
                total_control +=  parseFloat(data[r].tln_contador) ? parseFloat(data[r].tln_contador) : 0;
                total_traslado += parseFloat(data[r].tln_contador_traslado) ? parseFloat(data[r].tln_contador_traslado) : 0;                
            }
            
            $('.total_control').html(__currency_trans_from_en(total_control));
            $('.total_traslado').html(__currency_trans_from_en(total_traslado));


        }
    });
    
    //imprimir reporte de numeros a pasar
    $(document).on("click", "a.numeros-traslado", function(e) {
        e.preventDefault();
        // var href = $(this).data("href") + "?ticket_copia=true";
        var href = $(this).data("href");
        var start = $('#spr_date_filter')
        .data('daterangepicker')
        .startDate.format('YYYY-MM-DD');
        var end = $('#spr_date_filter')
            .data('daterangepicker')
            .endDate.format('YYYY-MM-DD');
            var start = $('#spr_date_filter')
            .data('daterangepicker')
            .startDate.format('YYYY-MM-DD');
        var end = $('#spr_date_filter')
            .data('daterangepicker')
            .endDate.format('YYYY-MM-DD');
        var bancas_id = $('#bancas_id').val();
        var users_id = $('#users_id').val();
        var modalidades_id = $('select#modalidades_id').val();
        var loterias_id = $('select#loterias_id').val();

        var data = { start_date: start, end_date: end, bancas_id: bancas_id, users_id: users_id, modalidades_id:modalidades_id, loterias_id:loterias_id };

        $.ajax({
            method: "GET",
            url: href,
            dataType: "json",
            data: data,
            success: function(result) {
                if (result.success == 1 && result.receipt.html_content != "") {
                    $("#receipt_section").html(result.receipt.html_content);

                    __currency_convert_recursively($("#receipt_section"));
                    __print_receipt("receipt_section");
                } else {
                    Lobibox.notify("error", {
                        pauseDelayOnHover: true,
                        size: "mini",
                        rounded: true,
                        delayIndicator: false,
                        continueDelayOnInactiveTab: false,
                        position: "top right",
                        msg: result.msg
                    });
                }
            }
        });
    });

    $(document).on('click', '#deactivate-selected', function(e){
        e.preventDefault();
        var selected_rows = [];
        var i = 0;
        $('.row-select:checked').each(function () {
            selected_rows[i++] = $(this).val();
        }); 
        
        if(selected_rows.length > 0){
            $('input#selected_discounts').val(selected_rows);
            swal({
                title: LANG.sure,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $('form#mass_deactivate_form').submit();
                }
            });
        } else{
            $('input#selected_discounts').val('');
            swal('@lang("lang_v1.no_row_selected")');
        }    
    });
});

$(document).on('change', 'input.tln_contador_traslado', function() {

    var id = $(this).data('id');
    var traslado = $(`#tln_contador_traslado_${id}`).val();
    
    $.ajax({
        method: "get",
        url: "/trasladar/" + id,
        dataType: 'json',
        data: {           
            tln_contador_traslado: traslado,
        },

        success: function(result) {
            if (result.success == "actualizado") {

                Lobibox.notify("success", {
                    position: "top right",
                    title:false,
                    icon:false,
                    size: "mini",
                    rounded: true,
                    msg: result.msg,
                    });

                control_apuestas.ajax.reload();
            } 
            if(result.success == "error") {
                Lobibox.notify("info", {
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
});

