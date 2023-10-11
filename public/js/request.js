$(document).ready(function() {
    $(document).on("change", "#type", function() {
        if ($(this).val() === "otros") {
            $("#newTypeShop").show();
        } else {
            $("#newTypeShop").hide();
            // Borra el valor del input cuando se oculta
            $("#newTypeShop input").val("");
        }
    });



    $(document).on("click", "#submit-button-request", function () {
        // Deshabilita el botón mientras se procesa la solicitud
            $(this).prop("disabled", true);
        
            // Obtiene la URL del formulario
            var url = $("form").attr("action");
            
            // Realiza la solicitud AJAX
            $.ajax({
                type: "POST",
                url: url, // Usa la URL del formulario como la URL de la solicitud
                data: $("form").serialize(), // Envía los datos del formulario
                success: function (response) {
                    console.log(response);
                    // Habilita el botón nuevamente
                    $("#submit-button-request").prop("disabled", false);
        
                    // Muestra una alerta de éxito con SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: 'La Solicitud de compra correctamente.'
                    }).then(function () {
                         // Borra todos los campos del formulario
                        $("form")[0].reset();

                        // Recarga la página
                        // location.reload();
                    });
                },
                error: function (error) {
                    console.log(error.responseText);
                    // Habilita el botón nuevamente en caso de error
                    $("#submit-button-request").prop("disabled", false);
        
                    // Muestra una alerta de error con SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ha ocurrido un error al guardar la solicitud de compra.'
                    });
                }
            });
        });


     $(document).on("click", ".requestModalStatus", function() {
        let url = $(this).attr("data-url");
        let id =$(this).data('id');
        console.log(url);
        $.ajax({
        url: url,
        data:{id:id},
        type: "POST",
        success: function(datos) {
            $("#ModalContent").html(datos);
            $("#ModalLarge").modal("show");
        }
        });
    });




// Agrega un evento change al select con id "type"
$(document).on("change", "#type", function() {
    // Verifica si la opción seleccionada tiene el valor "2"
    if ($(this).val() == "2") {
        // Si es "2", muestra el div con id "containerRequestArticles"
        $("#containerRequestArticles").show();
        $("#ammount").val("");
        $("#valContainer").hide(); 
    } else {
        // Si no es "2", oculta el div con id "containerRequestArticles"
        $("#containerRequestArticles").hide();
        $("#valContainer").show(); 
    }
});

// Asegúrate de que el estado inicial coincida con el valor seleccionado
if ($("#type").val() == "2") {
    $("#containerRequestArticles").show();
    $('.js-example-basic-single2').select2();
} else {
    $("#containerRequestArticles").hide();
}



























});