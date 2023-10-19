$(document).ready(function() {
  $('.updateInfoCompany').click(function() {
    let url=$(this).attr("data-url");
    let id=$(this).attr("data-id");
        console.log(url);
        console.log(id);
        $.ajax({
            url: url,
            type: "POST",
            data:{id:id},
            success: function(datos) {     
                    $("#ModalContent").html(datos); 
                    $("#ModalLarge").modal("show");              
            }
        });
  });
  $('.updateStatusCompany').click(function() {
    let url=$(this).attr("data-url");
    let id=$(this).attr("data-id");
    let u_id=$(this).attr("data-user");
        console.log(url);
        console.log(id);
        $.ajax({
            url: url,
            type: "POST",
            data:{c_id:id,u_id:u_id},
            success: function(datos) {     
                    $("#ModalContent").html(datos); 
                    $("#ModalLarge").modal("show");              
            }
        });
  });

  $('.SubscriptionPlans').click(function() {
    let url=$(this).attr("data-url");
    let c_id=$(this).attr("data-id");
    let u_id=$(this).attr("data-user");
        console.log(url);
        console.log(c_id);
        $.ajax({
            url: url,
            type: "POST",
            data:{c_id:c_id,u_id:u_id},
            success: function(datos) {     
                    $("#ModalContent").html(datos); 
                    $("#ModalLarge").modal("show");              
            }
        });
  });
  
  $('.documentsCompany').click(function() {
    let url=$(this).attr("data-url");
    let c_id=$(this).attr("data-id");
        $.ajax({
            url: url,
            type: "POST",
            data:{c_id:c_id},
            success: function(datos) {     
                    $("#ModalContent").html(datos); 
                    $("#ModalLarge").modal("show");              
            }
        });
  });

  $(document).on('click','#createSeller',function () {
    let url=$(this).attr("data-url");
    $.ajax({
      type: "POST",
      url: url,
      success: function (response) {
        $("#ModalContent").html(response); 
        $("#ModalLarge").modal("show");       
      }
    });
  })
  

  $(document).on('click','#CompanyAndSeller',function () {
    let url=$(this).attr("data-url");
    let id=$(this).attr("data-id");
    $.ajax({
      type: "POST",
      url: url,
      data:{id:id},
      success: function (response) {
        $("#ModalContent").html(response); 
        $("#ModalLarge").modal("show");       
      }
    });
  })

  $(document).on('click','#UpdateSeller',function () {
    let url=$(this).attr("data-url");
    let id=$(this).attr("data-id");
    $.ajax({
      type: "POST",
      url: url,
      data:{id:id},
      success: function (response) {
        $("#ModalContent").html(response); 
        $("#ModalLarge").modal("show");       
      }
    });
  })


  
  $(document).on('click','#addCompanyToSeller',function () {
    let url=$(this).attr("data-url");
    let id=$(this).attr("data-id");
    $.ajax({
      type: "POST",
      url: url,
      data:{id:id},
      success: function (response) {
        $("#staticBody").html(response); 
        $("#staticBackdrop").modal("show");       
      }
    });
  })
  
  $(document).on('click','.updateCreditLimit',function () {
    let url=$(this).attr("data-url");
    let id=$(this).attr("data-id");
    $.ajax({
      type: "POST",
      url: url,
      data:{id:id},
      success: function (response) {
        $("#staticBody").html(response); 
        $("#staticBackdrop").modal("show");       
      }
    });
  })
  $(document).on('click','.updateMethodsPay',function () {
    let url=$(this).attr("data-url");
    let id=$(this).attr("data-id");
    $.ajax({
      type: "POST",
      url: url,
      data:{id:id},
      success: function (response) {
        $("#staticBody").html(response); 
        $("#staticBackdrop").modal("show");       
      }
    });
  })
  
  $(document).on('click','.createMethodsPay', function () {
    let url = $(this).data('url');
    let id =$(this).data('id');

    $.ajax({
      type: "POST",
      url: url,
      data:{id:id},
      success: function (response) {
        $("#ModalContent").html(response); 
        $("#ModalLarge").modal("show");   
      }
    });

  })
  $(document).on('click','.updateStatusClient', function () {
    let url = $(this).data('url');
    let id =$(this).data('id');

    $.ajax({
      type: "POST",
      url: url,
      data:{id:id},
      success: function (response) {
        $("#ModalContent").html(response); 
        $("#ModalLarge").modal("show");   
      }
    });

  })
  $(document).on('click', '#deleteSellerOfCompany', function () {
    let url = $(this).data('url');
    let $row = $(this).closest('tr');
  
    // Mostrar confirmación al usuario con SweetAlert2
    Swal.fire({
      title: '¿Estás seguro?',
      text: '¿Deseas borrar este vendedor asignado a la empresa?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Sí, borrar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        // El usuario confirmó la eliminación
        $.ajax({
          type: 'GET',
          url: url,
          success: function (response) {
            $row.remove();
  
            // Mostrar una alerta de éxito con SweetAlert2
            Swal.fire({
              icon: 'success',
              title: 'Vendedor eliminado',
              text: 'Este vendedor ya no está asignado a esta empresa.',
              showConfirmButton: false,
              timer: 2000 // La alerta se cerrará automáticamente después de 2 segundos
            });
          }
        });
      } else {
        // El usuario canceló la eliminación
        // No se realiza ninguna acción adicional
      }
    });
  });
  
  

  $('#emailForm').submit(function(event) {
    event.preventDefault(); // Detener el envío del formulario
    
    // Mostrar la alerta de envío con SweetAlert2
    Swal.fire({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        },
        icon: 'info',
        title: 'Enviando correo...'
    });

    // Enviar el formulario por AJAX
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: $(this).serialize(),
    }).then(function(response) {
        // Mostrar la alerta de correo enviado con SweetAlert2
        Swal.fire({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            },
            icon: 'success',
            title: 'El correo se ha enviado correctamente.'
        }).then(function() {
            // Redireccionar después de cerrar la alerta
            window.location.href = window.location.href;
        });
    }).catch(function() {
        // Mostrar la alerta de error con SweetAlert2
        Swal.fire({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 1000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            },
            icon: 'error',
            title: 'Error al enviar el correo.'
        }).then(function() {
            // Redireccionar después de cerrar la alerta
            window.location.href = window.location.href;
        });
    });
});


$(document).ready(function() {
  $('#plan').change(function() {
      updateDates($(this).val());
  });

  function updateDates(plan) {
      const fechaInicioInput = $('#fecha_inicio');
      const fechaFinInput = $('#fecha_fin');
      const today = new Date();
      const selectedPlan = parseInt(plan);
      let fechaFin = new Date();

      if (selectedPlan === 3) {
          fechaFin.setMonth(today.getMonth() + 3);
      } else if (selectedPlan === 6) {
          fechaFin.setMonth(today.getMonth() + 6);
      } else if (selectedPlan === 12) {
          fechaFin.setMonth(today.getMonth() + 12);
      }

      fechaInicioInput.val(formatDate(today));
      fechaFinInput.val(formatDate(fechaFin));
  }

  function formatDate(date) {
      const year = date.getFullYear();
      const month = (date.getMonth() + 1).toString().padStart(2, '0');
      const day = date.getDate().toString().padStart(2, '0');
      return `${year}-${month}-${day}`;
  }
});

});


