<div class="container table-responsive">
  <table id="myTable"  class="DataTable text-center table align-middle slide-in-top table-hover table-responsive">
    <thead class="table-secondary table-dark">
      <tr>
        <th class="text-white">Descripcion</th>
        <th class="text-white">Tipo</th>
        <th class="text-white">Monto</th>
        <th class="text-white">Fecha</th>
        <th class="text-white">Estado</th>
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
