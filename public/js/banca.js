$(document).ready(function() {

    $(document).on('click', '.duplicar-banca', function(e) {
        e.preventDefault();
        var container = $('.nuevo_modal');

        $.ajax({
            url: $(this).data('href'),
            dataType: 'html',
            success: function(result) {
                container.html(result).modal('show');

            },
        });
    });

   

});

// $(document).on('click', 'a.duplicar-banca', function(){
//     console.log($(this).data('href'));
//     swal({
//         title: "Estás seguro de Duplicar la Banca esto puede tomar tiempo?",
//         icon: 'warning',
//         buttons: true,
//         dangerMode: true,
//     }).then(willDelete => {
//         if (willDelete) {
//             $.ajax({
                
//                 url: $(this).data('href'),
//                 dataType: 'json',
//                 success: function(result) {
//                     if (result.success == "estado") {
//                         // Lobibox.notify("success", {
//                         //     position: "top right",
//                         //     title:false,
//                         //     icon:false,
//                         //     size: "mini",
//                         //     rounded: true,
//                         //     msg: result.msg,
//                         //     });

//                     }
//                     else {
//                         // Lobibox.notify("error", {                                      
//                         //     position: "top right",
//                         //     title:false,
//                         //     icon:false,
//                         //     size: "mini",
//                         //     rounded: true,
//                         //     msg: result.msg,
//                         //             });
                 
//                     }

//                 },
//             });
//         }
//     });
// });
