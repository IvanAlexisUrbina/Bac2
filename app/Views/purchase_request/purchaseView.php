<form class=""
    action="<?=Helpers\generateUrl("Purchase_request","Purchase_request","generateRequestPurchase",[],"ajax")?>"
    method="POST" enctype="multipart/form-data">
    <div class="container ">
        <h1 class="tracking-in-expand mt-2">Solicitud de compra<i class="fa-solid fa-pen-to-square"></i></h1>
        <hr>
        <div class="row d-flex">

            <div class="col-md-6 ">
                <h3 class="tracking-in-expand">Información del solicitante <i class="fa-solid fa-user"></i></h3>



                <div class="form-group">
                    <label for="nombre">Solicitante:</label>
                    <input type="text" readonly class="form-control"
                        value="<?=$_SESSION['nameUser']." ".$_SESSION['LastNameUser']?>" name="nameApplicant">
                </div>

                <div class="form-group">
                    <label for="nombre">Cedula:</label>
                    <input type="number" value="<?=$_SESSION['UserNumDocument']?>" readonly class="form-control"
                        name="ccApplicant">

                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <div class="input-group mb-3">
                        <input type="text" value="<?=$_SESSION['EmailUser']?>" readonly class="form-control" name="emailApplicant">
                    </div>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-phone"></i></span>
                        <input type="text" readonly class="form-control" value="<?=$_SESSION['PhoneUser']?>"
                            name="phoneApplicant">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <h3 class="tracking-in-expand">Información de compra <i class="fa-solid fa-money-bill"></i></h3>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="type">Tipo de Compra:</label>
                    <div class="col-sm-9">
                        <select class="form-select" id="type" name="type">
                            <?php foreach ($types as $tp) {?>
                            <option value="<?=$tp['type_id']?>"><?=$tp['type_name']?></option>
                            <?php }?>
                            <option value="otros">Otros</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3" id="newTypeShop" style="display: none;">
                    <label class="col-sm-3 col-form-label" for="Nuevo Tipo de Compra:">Nuevo Tipo de Compra:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="newTypeShop" name="newTypeShop"
                            placeholder="Ingrese un nuevo tipo de compra">
                    </div>
                </div>
                <div class="row mb-3" id="valContainer">
                    <label class="col-sm-3 col-form-label" for="monto">Monto:</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="ammount" name="pr_quantity"
                            placeholder="Ingrese el monto">
                    </div>
                </div>

                <div class="form-group">
                    <label for="comentarios">Comentarios:</label>
                    <textarea class="form-control" name="comments" rows="3"></textarea>
                </div>

            </div>
        </div>
        <hr>


        <div id="containerRequestArticles">


            <h3 class="tracking-in-expand">Información del cliente <i class="fa-solid fa-user"></i></h3>

            <div class="row">
                <div class="col-md-6">
                    <label for="">Empresa:</label>
                    <div class="">
                        <select data-url="<?= Helpers\generateUrl("Order","Order","attrsByAjax",[],"ajax")?>"
                            id="SelectOrder" name="company" class="form-select js-example-basic-single2">
                            <option value="" readonly selected>Seleccione una opcion</option>
                            <?php foreach ($companies as $c) {?>
                            <option value="<?=$c['c_id']?>"><?=$c['c_name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre">Cliente:</label>
                        <input type="text" id="clientOrder" readonly class="form-control" name="name">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre">Cedula:</label>
                        <input type="number" id="ccOrder" readonly class="form-control" name="cc">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <div class="input-group mb-3">
                            <input type="text" id="emailOrder" readonly class="form-control" name="email">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono">Teléfono:</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-phone"></i></span>
                            <input type="text" readonly class="form-control" id="phoneOrder" name="phone">
                        </div>
                    </div>
                </div>
            </div>





            <h3 class="tracking-in-expand">Articulos <i class="fa-solid fa-cart-shopping"></i></h3>
            <div class="text-right p-4">
                <button type="button" data-url="<?=Helpers\generateUrl("Order","Order","CreateOrder",[],"ajax");?>"
                    class="btn btn-outline-primary" id="agregar_producto">Agregar productos</button>
            </div>
            <div class="table-responsive">

                <table class="DataTable  text-center truncate table align-middle slide-in-top table-hover">
                    <thead>
                        <tr>
                            <th>Articulo</th>
                            <th>Categoria</th>
                            <th>Cantidad</th>
                            <th class="text-nowrap">Precio unit</th>
                            <th>Descuento</th>
                            <th class="text-nowrap">Precio tras el descuento</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="contArticlesOrder">
                        <!-- ADD ARTICLES FOR AJAX  -->
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
        </div>

        <div class="text-right mb-2">


            <button type="button" id="submit-button-request" class="btn btn-primary">Enviar Solicitud</button>

        </div>
</form>