<div class="container table-responsive">
    <h1>Solicitudes de compra</h1>

    <table class="DataTable text-center truncate table align-middle slide-in-top table-hover">
        <thead>
            <tr>
                <th>Descripcion</th>
                <th>Tipo</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Estado</th>
                <?php if ($_SESSION['RolUser'] == '2') { ?>
                <th>Acciones</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <?php } else {?>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <?php }?>
        </thead>
        <tbody>
            <?php
            use function Helpers\dd;

            foreach ($request as $req) { ?>
            <tr>
                <td><?= $req['pr_desc'] ?></td>
                <td><?= $req['type_name'] ?></td>
                <td><?= $req['pr_quantity'] ?></td>
                <td><?= $req['pr_date_request'] ?></td>
                <td><?= $req['state_name'] ?></td>
                <?php if ($_SESSION['RolUser'] == '2') { ?>
                <td><button data-id="<?=$req['pr_id']?>"
                        data-url="<?=Helpers\generateUrl("Purchase_request","Purchase_request","RequestUpdateStatusViewModal",[],"ajax")?>"
                        class="btn btn-warning requestModalStatus"><i class="fa-solid fa-coins"></i></button>
                <?php } ?>
                <?php if ($req['type_id']=='2') {?>
                    <button data-url="<?=$req['pr_url_document']?>"  title="Visualizar Solicitud de compra" class="pdfModalLink btn btn-outline-info"><i class="fa-solid fa-eye"></i></button>
                <?php }?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>