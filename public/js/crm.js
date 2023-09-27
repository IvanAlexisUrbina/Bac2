$(document).ready(function() {
    $('.js-example-basic-multiple').select2();


    // alerta envio de email
    $('#meetingFormButton').click(function() {  
        var url = $(this).attr('data-url');
        var formData = $('#meetingForm').serialize();
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            beforeSend: function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    },
                })       
                Toast.fire({
                    icon: 'info',
                    title: 'Enviando confirmación de reunión...'
                })
            },
            success: function(data) {
                swal.close();
                showAlert("Reunión agendada exitosamente.", "success");
                // Redirigir a la misma página
                window.location.href = window.location.href;
            },
            error: function(xhr, status, error) {
                swal.close();
                showAlert("Error al enviar confirmación de reunión.", "error");
                // Redirigir a la misma página
                window.location.href = window.location.href;
            }
        });
    });
    
    
    // Función para mostrar la alerta
    function showAlert(message, type) {
        Swal.fire({
            icon: type,
            title: type === "success" ? "Éxito" : "Error",
            text: message,
            confirmButtonText: 'Aceptar'
        });
    }




  
        // Escuchar el evento de cambio en el select
        $(document).on('change','#activity-type',function () {
            // alert(a);
            var selectedOption = $(this).val();
            // Si se selecciona "Reunión", mostrar el div y borrar datos
            if (selectedOption === "reunion") {
                $('#DivMeet').show();
                // Borra los datos de los campos en el div
                $('#clientSelect').val([]).trigger('change');
                $('#attendees').val([]).trigger('change');
                $('#meetingType').val('');
                $('#meetingLink').val('');
                $('#comments').val('');
                // Inicializar select2 para los selects múltiples
                $('.js-example-basic-multiple').select2();
            } else {
                // Si se selecciona otra cosa, ocultar el div y borrar datos
                $('#DivMeet').hide();
                $('#clientSelect').val([]).trigger('change');
                $('#attendees').val([]).trigger('change');
                $('#meetingType').val('');
                $('#meetingLink').val('');
                $('#comments').val('');
            }
        });


        $(document).on('change','#activity-reminder',function () {
            var reminderDetails = $('#reminder-details');
            var reminderTimeInput = $('#activity-reminder-time');
            
            if ($(this).is(':checked')) {
                reminderDetails.show();
            } else {
                reminderDetails.hide();
                reminderTimeInput.val(''); // Borrar el valor si el checkbox se desmarca
            }
        });
   
        $(document).on("click",".detaillsActivity",function () {
            let url=$(this).attr("data-url");
            let id=$(this).attr("data-id");
            $.ajax({
                url: url,
                data:{act_id:id},
                type: "POST",
                success: function(datos) {
                    $("#ModalContent").html(datos); 
                    $("#ModalLarge").modal("show");  
                }
            });
       });
        $(document).on("click",".updateActivity",function () {
            let url=$(this).attr("data-url");
            let id=$(this).attr("data-id");
            $.ajax({
                url: url,
                data:{act_id:id},
                type: "POST",
                success: function(datos) {
                    $("#ModalContent").html(datos); 
                    $("#ModalLarge").modal("show"); 
                    $('.js-example-basic-multiple').select2(); 
                }
            });
       });




       $(document).on("click", "#submit-button-activity", function () {
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
                    $("#submit-button-activity").prop("disabled", false);
        
                    // Muestra una alerta de éxito con SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: 'La actividad se ha guardado correctamente.'
                    }).then(function () {
                         // Borra todos los campos del formulario
                        $("form")[0].reset();

                        // Recarga la página
                        location.reload();
                    });
                },
                error: function (error) {
                    // Habilita el botón nuevamente en caso de error
                    $("#submit-button-activity").prop("disabled", false);
        
                    // Muestra una alerta de error con SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ha ocurrido un error al guardar la actividad.'
                    });
                }
            });
        });
    
    

    
   
    
    
});


  
