<div class="container table-responsive">
<h1>Solicitudes de compra</h1>
 
    <table class="DataTable text-center truncate  table align-middle slide-in-top table-hover">
        <thead>
            <tr>
                <th>Descripcion</th>
                <th>Tipo</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php

use function Helpers\dd;

foreach ($request as $req) { ?>
            <tr>
                <td><?= $req['pr_desc']?></td>
                <td><?= $req['type_name']?></td>
                <td><?= $req['pr_quantity']?></td>
                <td><?=$req['pr_date_request']?></td>
                <td><?= $req['state_name']?></td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
</div>