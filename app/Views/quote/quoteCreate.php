<form action="<?=Helpers\generateUrl("Quote","Quote","pdfQuote",[],"ajax");?>" method="POST"
    enctype="multipart/form-data">
    <div class="container">
        <h1 class="tracking-in-expand">Cotización <i class="fa-solid fa-pen-to-square"></i></h1>
        <hr>
        <div class="row d-flex">

            <div class="col-md-6 ">
                <h3 class="tracking-in-expand">Información del cliente <i class="fa-solid fa-user"></i></h3>
                <label for="">Empresa:</label>
                <div class="input-group mb-3">
                    <select data-url="<?= Helpers\generateUrl("Quote","Quote","attrsByAjax",[],"ajax")?>"
                        id="SelectQuote" name="company" class="form-control js-example-basic-single">
                        <option value="" disabled selected>Seleccione una opcion</option>
                        <?php foreach ($companies as $c) {?>
                        <option value="<?=$c['c_id']?>"><?=$c['c_name']?></option>
                        <?php } ?>
                    </select>

                </div>
                <div class="form-group">
                    <label for="nombre">Cliente:</label>
                    <input type="text" id="clientQuote" disabled class="form-control" name="name">

                </div>
                <div class="form-group">
                    <label for="nombre">Cedula:</label>
                    <input type="number" id="ccQuote" disabled class="form-control" name="cc">

                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <div class="input-group mb-3">
                        <input type="text" id="emailQuote" disabled class="form-control" name="email">

                    </div>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-phone"></i></span>

                        <input type="text" disabled class="form-control" id="phoneQuote" name="phone">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label for="telefono">Fecha válida de la cotización:</label>
                <div class="input-group mb-3">
                    <input type="date" class="form-control" name="quoteValidateDate" id="quoteValidateDate">
                </div>


                <h3 class="tracking-in-expand">Información de pago <i class="fa-solid fa-money-bill"></i></h3>
                <div class="form-group">
                    <label for="metodo_pago">Método de pago:</label>
                    <select class="form-select form-field" id="payment_method" name="payment_method">
                        <option selected disabled> Seleccione una opcion</option>
                        <?php
                        foreach ($methods as $method) {
                            $payment_method_id = $method[0]['payment_method_id'];
                            $name = $method[0]['name'];
                            echo "<option value='$payment_method_id'>$name</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="direccion"></label>

                    <div class="input-group">
                        <span class="input-group-text">Dirección de envío:</span>
                        <textarea class="form-control form-field" aria-label="With textarea" id="address_shipping"
                            name="address_shipping"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="comentarios">Comentarios:</label>
                    <textarea class="form-control" id="comentarios" name="comments" rows="3"></textarea>
                </div>

            </div>
            <div id="FormFields" class="col-md-12 row d-flex">

            </div>
        </div>
        <hr>




        <h3 class="tracking-in-expand">Articulos <i class="fa-solid fa-cart-shopping"></i></h3>
        <div class="text-right p-4">
            <button type="button" data-url="<?=Helpers\generateUrl("Quote","Quote","CreateQuote",[],"ajax");?>"
                class="btn btn-outline-primary" id="agregar_producto">Agregar productos</button>
        </div>
        <div class="table-responsive">

            <table class="DataTable  text-center truncate table align-middle slide-in-top table-hover">
                <thead>
                    <tr>
                        <th>#Cod</th>
                        <th>Articulo</th>
                        <th>Categoria</th>
                        <th>Cantidad</th>
                        <th>Precio unit</th>
                        <th>Descuento</th>
                        <th>Precio tras el descuento</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="contArticlesQuote">
                    <!-- ADD ARTICLES FOR AJAX  -->
                </tbody>
            </table>
        </div>

        <hr>


        <h3 class="tracking-in-expand">Resumen <i class="fa-solid fa-pen-to-square"></i></h3>
        <div class="container d-flex">
            <div class="col-md-6 p-2 ">
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
                <label for="" class="form form-control" id="subtotalQuote">NAN</label>
                <input type="hidden" name="subtotalQuoteInput" id="subtotalQuoteInput">
                <label for="">Impuestos:</label>
                <label for="" class="form form-control" id="taxesQuote">NAN</label>
                <input type="hidden" name="taxesQuoteInput" id="taxesQuoteInput">
                <label for="">Total:</label>
                <label for="" class="form form-control" id="totalQuote">NAN</label>
                <input type="hidden" name="totalQuoteInput" id="totalQuoteInput">

            </div>

        </div>


        <div class="text-right">


            <button type="submit" class="btn btn-outline-success">Generar cotización</button>

        </div>

    </div>
</form>