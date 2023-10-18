$(document).ready(function() {
  // Función para agregar un producto
  $(document).on("click", "#agregar_producto", function() {
    let url = $(this).attr("data-url");
    console.log(url);
    $.ajax({
      url: url,
      type: "POST",
      success: function(datos) {
        $(".modal-body").html(datos);
        $("#exampleModalFullscreen").modal("show");
      }
    });
  });

  // Función para añadir artículos a la orden
  let cont = 0;
  $(document).on("click", "#addArticles", function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top',
      showConfirmButton: false,
      timer: 3000, // Cambiar la duración a 3000 ms o el tiempo deseado
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer);
        toast.addEventListener('mouseleave', Swal.resumeTimer);
      },
    });
    
    Toast.fire({
      icon: 'success', // Cambiar el icono a 'success' para indicar éxito
      title: 'Artículo agregado', // Cambiar el mensaje a 'Artículo agregado'
    });
    

    cont++;
    let shopcar = $(".cart-counter").text(cont);
    let id_article = $(this).val();
    let url = $(this).attr("data-url");
    let quantity_articles = $(this).siblings("input").val();
    let c_id =$('#SelectOrder').val();
    $.ajax({
      type: "POST",
      url: url,
      data: { id_article: id_article, quantity_articles: quantity_articles,companyId:c_id },
      success: function(response) {
        let totalSubtotal = 0;
        let iva = 0;

        $(".DataTable").DataTable().destroy();
        $("#contArticlesOrder").append(response);
        $(".DataTable").DataTable();

        $("#contArticlesOrder .subtotal").each(function() {
          let subtotalValue = parseFloat($(this).text().replace("$", ""));
          totalSubtotal += subtotalValue;
        });
        
        iva = totalSubtotal * 0.19;
        total = iva + totalSubtotal;
        $("#subtotalOrder").text("$" + totalSubtotal.toFixed(2));
        $("#subtotalOrderInput").val(totalSubtotal.toFixed(2));
        $("#taxesOrder").text("$" + iva.toFixed(2));
        $("#taxesOrderInput").val(iva.toFixed(2));
        $("#totalOrder").text("$" + total.toFixed(2));
        $("#totalOrderInput").val(total.toFixed(2));
      }
    });
  });

  // Función para cambiar la cantidad de artículos
  $(document).on("change", ".quantityArt", function() {
    let totalSubtotal = 0;
    let changeInput = $(this).val();
    let priceUnit = +$(this)
      .closest("tr")
      .find(".discount")
      .text();
    let newsubtotal = priceUnit * changeInput;
    let subtotal = +$(this)
      .closest("tr")
      .find(".subtotal")
      .text("$" + parseInt(newsubtotal, 10));
    let iva = 0;

    $("#contArticlesOrder .subtotal").each(function() {
      let subtotalValue = parseFloat($(this).text().replace("$", ""));
      totalSubtotal += subtotalValue;
    });

    iva = totalSubtotal * 0.19;
    total = iva + totalSubtotal;
    $("#subtotalOrder").text("$" + totalSubtotal.toFixed(2));
    $("#subtotalOrderInput").val(totalSubtotal.toFixed(2));
    $("#taxesOrder").text("$" + iva.toFixed(2));
    $("#taxesOrderInput").val(iva.toFixed(2));
    $("#totalOrder").text("$" + total.toFixed(2));
    $("#totalOrderInput").val(total.toFixed(2));
  });

// funcion para activar los taxes de ordersincequote 
if ($("#formOrderSinceQuote").length > 0) {
  // Este bloque de código se ejecutará solo si el formulario existe

  // Puedes realizar las operaciones que necesitas aquí, por ejemplo, actualizar los totales

  // Ejemplo de cómo actualizar los totales
  let totalSubtotal = 0;

  $("#contArticlesOrder .subtotal").each(function() {
      let subtotalValue = parseFloat($(this).text().replace("$", ""));
      totalSubtotal += subtotalValue;
  });

  let iva = totalSubtotal * 0.19;
  let total = iva + totalSubtotal;

  $("#subtotalOrder").text("$" + totalSubtotal.toFixed(2));
  $("#subtotalOrderInput").val(totalSubtotal.toFixed(2));
  $("#taxesOrder").text("$" + iva.toFixed(2));
  $("#taxesOrderInput").val(iva.toFixed(2));
  $("#totalOrder").text("$" + total.toFixed(2));
  $("#totalOrderInput").val(total.toFixed(2));
}


  // Función para eliminar una fila de la tabla
  $(document).on("click", ".delete-row", function() {
    cont--;
    let shopcar = $(".cart-counter").text(cont + " productos");

    let deletedSubtotal = parseFloat(
      $(this)
        .closest("tr")
        .find(".subtotal")
        .text()
        .replace("$", "")
    );
    let totalSubtotal = parseFloat(
      $("#subtotalOrder")
        .text()
        .replace("$", "")
    );

    let iva = 0;
    let total = 0;

    totalSubtotal -= deletedSubtotal;
    iva = totalSubtotal * 0.19;
    total = iva + totalSubtotal;

    $("#subtotalOrder").text("$" + totalSubtotal.toFixed(2));
    $("#subtotalOrderInput").val(totalSubtotal.toFixed(2));
    $("#taxesOrder").text("$" + iva.toFixed(2));
    $("#taxesOrderInput").val(iva.toFixed(2));
    $("#totalOrder").text("$" + total.toFixed(2));
    $("#totalOrderInput").val(total.toFixed(2));

    $(".DataTable").DataTable().destroy();
    $(this)
      .closest("tr")
      .remove();
    $(".DataTable").DataTable();
  });

  // Función para agregar un nuevo campo de entrada
  $(document).on("click", "#AddinputsOrder", function() {
    let url = $(this).attr("data-url");
    let type = $("#typeInput").val();
    let quantity = $("#quantityInput").val();
    $.ajax({
      type: "POST",
      url: url,
      data: { quantity: quantity, typeInput: type },
      success: function(response) {
        Swal.fire({
          icon: "success",
          title: "Campo agregado correctamente.",
          timer: 1000,
          showConfirmButton: false,
          position: "top",
          width: "15rem",
          padding: "0.5rem",
          background: "#fff",
          iconColor: "#1abc9c",
          toast: true
        });
        $("#FormFields").append(response);
      }
    });
  });

  // Función para eliminar un campo de entrada
  $(document).on("click", ".delete-btn", function() {
    $(this)
      .closest(".col-md-6")
      .remove();
  });

  // Función para abrir un PDF en un modal
  $(document).on("click", ".pdfModalLink", function() {
    let pdfUrl = $(this).data("url");
    let modalContent =
      '<iframe src="' + pdfUrl + '" width="100%" height="700px"></iframe>';

    // Actualiza el contenido de tu modal con el PDF
    $("#ModalContent").html(modalContent);

    // Abre la modal
    $("#ModalLarge").modal("show");
  });

  // Función para mostrar un modal de confirmación del documento de la orden
  $(document).on("click", ".ModalAcceptDocumentOrder", function() {
    let url = $(this).data("url");
    let order_id = $(this).data("id");
    let c_id = $(this).data("company");
    $.ajax({
      type: "POST",
      url: url,
      data: { order_id: order_id, c_id: c_id },
      success: function(response) {
        // Actualiza el contenido de tu modal con el PDF
        $("#ModalContent").html(response);

        // Abre la modal
        $("#ModalLarge").modal("show");
      }
    });
  });


// change select order
  $(document).on('change', '#SelectOrder', function () {

    let url = $(this).attr('data-url');
    let id = $(this).val();

    $.ajax({
        type: "POST",
        url: url,
        data: { c_id: id },
        dataType: "json", // Indica que esperas una respuesta JSON
        success: function (response) {
            console.log(response); // Mostrar la respuesta completa
            // name
            let representantName=response.representant[0].u_name+" "+response.representant[0].u_lastname;
            // phone
            let representantPhone=response.representant[0].u_phone;
            // email
            let representantEmail=response.representant[0].u_email;
            //
            let address_shipping=response.orderAddress;
            //
            let representantDocument=response.representant[0].u_document;

            $('#clientOrder').prop('disabled', false).val(representantName);            
            $('#phoneOrder').prop('disabled', false).val(representantPhone);            
            $('#ccOrder').prop('disabled', false).val(representantDocument);            
            $('#emailOrder').prop('disabled', false).val(representantEmail);            
            $('#address_shipping').val(address_shipping);
            
           // Crear un elemento <select> con las opciones de métodos de pago
           let optionsMethods = $("<select class='form-select' name='payment_method' id='methodspayOrder'></select>");
           optionsMethods.append("<option value='' selected disabled>Selecciona una opcion</option>");
           
           // Agregar opciones de métodos de pago al <select>
           response.methods.forEach(method => {
               optionsMethods.append(`<option value='${method.value}'>${method.name}</option>`);
           });
           
           // Insertar el <select> en el contenedor deseado
           $('#methodspayOrder').replaceWith(optionsMethods);
           
        }
    });
});

  $(document).on('change', '#SelectOrder', function () {
  // alert('hola');
    let url = $(this).attr('data-url');
    let id = $(this).val();

    $.ajax({
        type: "POST",
        url: url,
        data: { c_id: id },
        dataType: "json", // Indica que esperas una respuesta JSON
        success: function (response) {
            console.log(response); // Mostrar la respuesta completa
            // name
            let representantName=response.representant[0].u_name+" "+response.representant[0].u_lastname;
            // phone
            let representantPhone=response.representant[0].u_phone;
            // phone
            let representantDocument=response.representant[0].u_document;
            // email
            let representantEmail=response.representant[0].u_email;
            //
            let address_shipping=response.orderAddress;
                    
            $('#clientOrder').prop('disabled', false).val(representantName);            
            $('#phoneOrder').prop('disabled', false).val(representantPhone);            
            $('#ccOrder').prop('disabled', false).val(representantDocument);            
            $('#emailOrder').prop('disabled', false).val(representantEmail);            
            $('#address_shipping').val(address_shipping);
            
          // Crear un elemento <select> con las opciones de métodos de pago
          let optionsMethods = $("<select class='form-select' name='payment_method' id='methodspayQuote'></select>");
          optionsMethods.append("<option value='' selected disabled>Selecciona una opcion</option>");
          
          // Agregar opciones de métodos de pago al <select>
          response.methods.forEach(method => {
              optionsMethods.append(`<option value='${method.value}'>${method.name}</option>`);
          });
          
          // Insertar el <select> en el contenedor deseado
          $('#methodspayQuote').replaceWith(optionsMethods);
          
        }
    });
  });

  // Resto del código...
});
