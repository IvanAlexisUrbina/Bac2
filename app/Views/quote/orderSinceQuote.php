<?php
foreach ($quote as $quot) {

?>
<form id="formOrderSinceQuote" action="<?=Helpers\generateUrl("Order","Order","pdfOrder",[],"ajax");?>" method="POST"
    enctype="multipart/form-data">
    <div class="container">
        <h1 class="tracking-in-expand">Pedido <i class="fa-solid fa-pen-to-square"></i></h1>
        <hr>
        <div class="row d-flex">

            <div class="col-md-6 ">
                <h3 class="tracking-in-expand">Información del cliente <i class="fa-solid fa-user"></i></h3>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <label for=""
                        class="form form-control"><?=  $_SESSION['nameUser']." ".$_SESSION['LastNameUser']?></label>
                    <input type="hidden" value="<?= $_SESSION['nameUser']." ".$_SESSION['LastNameUser']?>" id="name"
                        name="name">
                </div>
                <label for="">Empresa:</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-building"></i></span>
                    <label for="" class="form form-control"><?=  $_SESSION['CompanyName']?></label>

                    <input type="hidden" value="<?= $_SESSION['CompanyName']?>" aria-label="Username" name="company"
                        aria-describedby="basic-addon1">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <div class="input-group mb-3">
                        <label for="" class="form form-control"><?= $_SESSION['EmailUser']?></label>
                        <input type="hidden" value="<?= $_SESSION['EmailUser']?>" name="email"
                            aria-describedby="basic-addon2">
                    </div>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-phone"></i></span>
                        <label for="" class="form form-control"><?= $_SESSION['PhoneUser']?></label>
                        <input type="hidden" value="<?= $_SESSION['PhoneUser']?>" class="form-control" name="phone"
                            aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h3 class="tracking-in-expand">Información de pago <i class="fa-solid fa-money-bill"></i></h3>
                <div class="form-group">
                    <label for="metodo_pago">Método de pago:</label>
                    <select class="form-select form-field" id="payment_method" name="payment_method">
                        <option selected disabled> Seleccione una opcion</option>
                        <?php
                        foreach ($methods as $method) {
                            $payment_method_id = $method[0]['payment_method_id'];
                            $name = $method[0]['name'];

                            // Verificar si el valor coincide con $quot['quo_payment_method']
                            $selected = ($payment_method_id == $quot['quo_payment_method']) ? 'selected' : '';

                            echo "<option value='$payment_method_id' $selected>$name</option>";
                        }
                        ?>
                    </select>

                </div>
                <div class="form-group">
                    <label for="direccion"></label>

                    <div class="input-group">
                        <span class="input-group-text">Dirección de envío:</span>
                        <textarea class="form-control form-field" aria-label="With textarea"
                            name="address_shipping"><?= $orderAddress?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="comentarios">Comentarios:</label>
                    <textarea class="form-control" id="comentarios" name="comments" rows="3">
                        <?php echo !empty($quot['quo_comments']) ? htmlspecialchars($quot['quo_comments']) : ''; ?>
                    </textarea>
                </div>


            </div>
            <div id="FormFields" class="col-md-12 row d-flex">

            </div>
        </div>
        <hr>




        <h3 class="tracking-in-expand">Articulos <i class="fa-solid fa-cart-shopping"></i></h3>
        <div class="text-right p-4">
            <button type="button" data-url="<?=Helpers\generateUrl("Order","Order","CreateOrder",[],"ajax");?>"
                class="btn btn-outline-primary" id="agregar_producto">Agregar productos</button>
        </div>
        <div class="table-responsive">

            <table class="table DataTable table-sm slide-in-top table-hover  table-striped">
                <thead>
                    <tr>
                        <th>Articulo</th>
                        <th>Categoria</th>
                        <th>Cantidad</th>
                        <th>Precio unit</th>
                        <th>Descuento</th>
                        <th>Precio tras el descuento</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="contArticlesOrder" >
                    <!-- ADD ARTICLES FOR AJAX  -->
                    <?php
                    echo $articlesHmtl;
                    
                    ?>
                </tbody>
            </table>
        </div>

        <hr>


        <h3 class="tracking-in-expand">Resumen<i class="fa-solid fa-pen-to-square"></i></h3>
        <div class="container ">
            <div class="col-md-12 p-2 d-flex">
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="metodo_pago">Codigo de vendedor:</label>
                        <?php if (!empty($seller)) { ?>
                        <label class="form form-control" for=""><?=$seller[0]['s_code'];?></label>
                        <?php } else { ?>
                        <label class="form form-control">No se ha asignado un vendedor</label>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label for="metodo_pago">Nombre vendedor:</label>
                        <?php if (!empty($seller)) { ?>
                        <label for="" class="form form-control"><?=$seller[0]['s_name'];?></label>
                        <?php } else { ?>
                        <label class="form form-control">No se ha asignado un vendedor</label>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-6 p-2">
                    <label for="">Subtotal:</label>
                    <label for="" class="form form-control" id="subtotalOrder">NAN</label>
                    <input type="hidden" name="subtotalOrderInput" id="subtotalOrderInput">
                    <label for="">Impuestos:</label>
                    <label for="" class="form form-control" id="taxesOrder">NAN</label>
                    <input type="hidden" name="taxesOrderInput" id="taxesOrderInput">
                    <label for="">Total:</label>
                    <label for="" class="form form-control" id="totalOrder">NAN</label>
                    <input type="hidden" name="totalOrderInput" id="totalOrderInput">

                </div>

            </div>



        </div>
        <div class="text-right">


            <button type="submit" class="btn btn-outline-success">Generar pedido</button>

        </div>
</form>
<?php
}
?>