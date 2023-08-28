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
    
});


  
