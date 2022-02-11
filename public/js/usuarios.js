$(document).ready(function() {
    $(document).on("click", ".nuevo-modal", function(e) {
        e.preventDefault();
        var container = $(".nuevo_modal");

        $.ajax({
            url: $(this).data("href"),
            dataType: "html",
            success: function(result) {
                container
                    .html(result)
                    .modal("show")
                    .modal("show")
                    .find(".select2")
                    .each(function() {
                        $(this).select2();
                    });
            }
        });
    });

    $(function() {
        // obtener campos ocultar div
        var checkbox = $(".use_permite_limite");
        var hidden = $(".numeroVendido");
        //var populate = $("#populate");

        hidden.hide();
        checkbox.change(function() {
            if (checkbox.is(":checked")) {
                //hidden.show();
                $(".numeroVendido").fadeIn("200");
            } else {
                //hidden.hide();
                $(".numeroVendido").fadeOut("200");
                // $("#use_limite_numeros").val(""); // limpia los valores de lols input al ser ocultado
                //    $('input[type=checkbox]').prop('checked',false);// limpia los valores de checkbox al ser ocultado
            }
        });
    });
});


