<div class="container mt-5">
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Solicitud de Compra</h5>
        </div>
        <div class="card-body">
            <form action="<?=Helpers\generateUrl("Purchase_request","Purchase_request","generateRequestPurchase",[],"ajax")?>"
                method="POST">
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="monto">Monto:</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="ammount" name="pr_quantity"
                            placeholder="Ingrese el monto">
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="desc">Descripción:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="desc" name="desc" rows="4"
                            placeholder="Ingrese una descripción detallada"></textarea>
                    </div>
                </div>
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
                <div class="row justify-content-end">
                    <div class="col-sm-9">
                        <button type="button" id="submit-button-request" class="btn btn-primary">Enviar Solicitud</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>