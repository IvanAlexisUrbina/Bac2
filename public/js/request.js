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



































});