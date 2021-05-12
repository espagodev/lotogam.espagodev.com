$(document).ready(function() {

        if ($('#spr_date_filter').length == 1) {
        $('#spr_date_filter').daterangepicker(dateRangeSettings, function(start, end) {
            $('#spr_date_filter span').val(
                start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
            );
            reporteModalidades();
        });
        $('#spr_date_filter').on('cancel.daterangepicker', function(ev, picker) {

             $('#spr_date_filter').html(
                '<i class="fa fa-calendar"></i> ' + LANG.filter_by_date
            );
        });
         reporteModalidades();
        }

        $('#bancas_id, #loterias_id, #users_id, #estado, #promocion').change(function() {
            reporteModalidades();
        });

        $('.detalle-modalidades').click(function() {
             var modalidades_id = $(this).attr("data-modalidad"); 

            reporteModalidadesDetalle(modalidades_id);
        });
});

    //Reporte Modalidades
  function reporteModalidades() {

    var bancas_id = $('#bancas_id').val();
    var loterias_id = $('#loterias_id').val();
    var users_id = $('select#users_id').val();
    var estado = $('select#estado').val();
    var promocion = $('select#promocion').val();
    var start = $('#spr_date_filter')
        .data('daterangepicker')
        .startDate.format('YYYY-MM-DD');
    var end = $('#spr_date_filter')
        .data('daterangepicker')
        .endDate.format('YYYY-MM-DD');

    var data = { start_date: start, end_date: end, bancas_id: bancas_id, loterias_id: loterias_id, users_id: users_id, promocion: promocion, estado: estado };

    var loader = __fa_awesome();

        $('.quinielas_vendidas').html(loader);
        $('.total_quinielas').html(loader);
        $('.pale_vendido').html(loader);
        $('.total_pales').html(loader);
        $('.tripletas_vendidas').html(loader);
        $('.total_tripletas').html(loader);
        $('.superpale_vendido').html(loader);
        $('.total_superpales').html(loader);

            $.ajax({
                method: 'GET',
                url: '/reportes/reporte-modalidades',
                dataType: 'json',
                data: data,
                success: function(data) {

                    $('.quinielas_vendidas').html(__number_uf(data.quinielas_vendidas));
                    $('.total_quinielas').html(__currency_trans_from_en(data.total_quinielas, true));
                    $('.pale_vendido').html(__number_uf(data.pale_vendido));
                    $('.total_pales').html(__currency_trans_from_en(data.total_pales, true));
                    $('.tripletas_vendidas').html(__number_uf(data.tripletas_vendidas));
                    $('.total_tripletas').html(__currency_trans_from_en(data.total_tripletas, true));
                    $('.superpale_vendido').html(__number_uf(data.superpale_vendido));
                    $('.total_superpales').html(__currency_trans_from_en(data.total_superpales, true));
                },
            });
    }

       //Reporte Detalle
  function reporteModalidadesDetalle(modalidades_id) {

    var bancas_id = $('#bancas_id').val();
    var loterias_id = $('#loterias_id').val();
    var start = $('#spr_date_filter')
        .data('daterangepicker')
        .startDate.format('YYYY-MM-DD');
    var end = $('#spr_date_filter')
        .data('daterangepicker')
        .endDate.format('YYYY-MM-DD');

    var data = { start_date: start, end_date: end, modalidades_id: modalidades_id, bancas_id: bancas_id, loterias_id: loterias_id };

    var loader = __fa_awesome();

        $('.detalle').html(loader);

            $.ajax({
                method: 'GET',
                url: '/reportes/reporte-modalidades-detalle',
                dataType: 'html',
                data: data,
                success: function(data) {
                    $('.detalle').html(data);

                    __currency_convert_recursively($('.detalle'));
                },

            });

    }

