$(document).ready(function () {
  $(document).on("click","#agregar_producto",function() {
    let url=$(this).attr("data-url");
        console.log(url);
        $.ajax({
            url: url,
            type: "POST",
            success: function(datos) {     
                    $(".modal-body").html(datos); 
                    $("#exampleModalFullscreen").modal("show");              
            }
        });
  })

  // add articles table quote
  cont = 0;

  $(document).on('click', '#addArticles', function() {
    Swal.fire({
      icon: 'success',
      title: 'Articulo agregado correctamente',
      timer: 1000,
      showConfirmButton: false,
      position: 'top',
      width: '15rem',
      padding: '0.5rem',
      background: '#fff',
      iconColor: '#1abc9c',
      toast: true,
    });
  
    cont++;
    let shopcar = $('.cart-counter').text(cont);
    let id_article = $(this).val();
    let url = $(this).attr('data-url');
    let quantity_articles = $(this).siblings('input').val();
  
    $.ajax({
      type: 'POST',
      url: url,
      data: { id_article: id_article, quantity_articles: quantity_articles },
      success: function(response) {
        let totalSubtotal = 0;
        let iva = 0;
  
        $('.DataTable').DataTable().destroy();
        $('#contArticlesQuote').append(response);
        $('.DataTable').DataTable();
  
        $('#contArticlesQuote .subtotal').each(function() {
          let subtotalValue = parseFloat($(this).text().replace('$', ''));
          totalSubtotal += subtotalValue;
        });
  
        iva = totalSubtotal * 0.19;
        total = iva + totalSubtotal;  
        $('#subtotalQuote').text('$' + totalSubtotal.toFixed(2));
        $('#subtotalQuoteInput').val(totalSubtotal.toFixed(2));
        $('#taxesQuote').text('$' + iva.toFixed(2));
        $('#taxesQuoteInput').val(iva.toFixed(2));
        $('#totalQuote').text('$' + total.toFixed(2));
        $('#totalQuoteInput').val(total.toFixed(2));
        
      }
    });
  });
  
  $(document).on('change', '.quantityArt', function () {
    let  totalSubtotal=0;
    let changeInput = $(this).val();
    let priceUnit = +$(this).closest('tr').find('.discount').text(); 
    let newsubtotal=priceUnit*changeInput;
    let subtotal = +$(this).closest('tr').find('.subtotal').text('$'+parseInt(newsubtotal, 10));
    let iva=0;
    $('#contArticlesQuote .subtotal').each(function() {
      let subtotalValue = parseFloat($(this).text().replace('$', ''));
      totalSubtotal += subtotalValue;   
    });
    iva = totalSubtotal * 0.19;
    total = iva + totalSubtotal;  
    $('#subtotalQuote').text('$' + totalSubtotal.toFixed(2));
    $('#subtotalQuoteInput').val(totalSubtotal.toFixed(2));
    $('#taxesQuote').text('$' + iva.toFixed(2));
    $('#taxesQuoteInput').val(iva.toFixed(2));
    $('#totalQuote').text('$' + total.toFixed(2));
    $('#totalQuoteInput').val(total.toFixed(2));

  });


  $(document).on('click', '.delete-row', function() {
    cont--;
    let shopcar = $('.cart-counter').text(cont + " productos");
    
    let deletedSubtotal = parseFloat($(this).closest('tr').find('.subtotal').text().replace('$', ''));
    let totalSubtotal = parseFloat($('#subtotalQuote').text().replace('$', ''));
    
    let iva = 0;
    let total = 0;
    
    totalSubtotal -= deletedSubtotal;
    iva = totalSubtotal * 0.19;
    total = iva + totalSubtotal;
    
    $('#subtotalQuote').text('$' + totalSubtotal.toFixed(2));
    $('#subtotalQuoteInput').val(totalSubtotal.toFixed(2));
    $('#taxesQuote').text('$' + iva.toFixed(2));
    $('#taxesQuoteInput').val(iva.toFixed(2));
    $('#totalQuote').text('$' + total.toFixed(2));
    $('#totalQuoteInput').val(total.toFixed(2));
    
    $('.DataTable').DataTable().destroy();
    $(this).closest('tr').remove();
    $('.DataTable').DataTable();
  });
  
  
// Modal for add more fields
  $(document).on('click','#addFieldsForm', function () {
    let url=$(this).attr('data-url');
    $.ajax({
      type: "POST",
      url: url,
      success: function (response) {
        $('#ModalContent').html(response);
        $('#ModalLarge').modal('show');
      }
    });
  })

  $(document).on('click','#Addinputs', function () {
    let url=$(this).attr('data-url');
    let type=$('#typeInput').val();
    let quantity=$('#quantityInput').val();
    $.ajax({
      type: "POST",
      url: url,
      data:{ 'quantity':quantity,'typeInput':type},
      success: function (response) {
        Swal.fire({
          icon: 'success',
          title: 'Campo agregado correctamente.',
          timer: 1000,
          showConfirmButton: false,
          position: 'top',
          width: '15rem',
          padding: '0.5rem',
          background: '#fff',
          iconColor: '#1abc9c',
          toast: true,
        });
        $('#FormFields').append(response);
      }
    });
  })
  // delete input
  $(document).on('click', '.delete-btn', function() {
    $(this).closest('.col-md-6').remove();
  });


  // // quote to order
  // $(document).on('click','.GenerateOrderSinceQuote',function () {
  //   let url= $(this).data('url');
  //   let id = $(this).data('id');
  //     $.ajax({
  //       type: "POST",
  //       url: url,
  //       data:{id:id},
  //       success: function (response) {

  //           $("#ModalContent").html(response); 
  //           $("#ModalLarge").modal("show");      
  //       }
  //     });
  // });

// Función para validar los campos
function validarCampos() {
  let allFieldsFilled = true;
  let emptyFields = [];

  $('.form-field').each(function() {
      const fieldValue = $(this).val();
      if (!fieldValue || fieldValue.trim() === '') {
          allFieldsFilled = false;
          emptyFields.push($(this).attr('name'));
      }
  });

  // Habilitar o deshabilitar el botón de submit según si están todos los campos llenos o no
  if (allFieldsFilled) {
      $('button[type="submit"]').prop('disabled', false);
  } else {
      $('button[type="submit"]').prop('disabled', true);
      mostrarAlerta(emptyFields);
  }
}

// Mostrar alerta con los campos faltantes usando SweetAlert
function mostrarAlerta(camposFaltantes) {
  const mensaje = 'Los siguientes campos están vacíos o faltan por completar:\n' +
                  camposFaltantes.join('\n');
  
  // Utilizar SweetAlert en lugar de alert
  Swal.fire({
    icon: 'warning',
    title: 'Campos Faltantes',
    text: mensaje,
  });
}

$(document).ready(function() {
  // Llamar a la función de validación al cargar la página para inicializar el estado del botón de submit
  validarCampos();

  // Agregar eventos keyup y blur a los campos con clase "form-field"
  $('.form-field').on('keyup blur', validarCampos);
});

  

})