<div class="container table-responsive">
  <table id="myTable"  class="DataTable text-center table align-middle slide-in-top table-hover table-responsive">
    <thead class="table-secondary">
      <tr>
        <th >Nombre</th>
        <th>Descripcion</th>
        <th>Motivo</th>
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
    <td><img class='viewArticle' value="<?= $req['ar_id']?>" src="<?= $req['ar_img_url']?>" alt="..." height="100" data-url="<?= Helpers\generateUrl("Stock", "Stock", "viewArticleDesc", [], "ajax") ?>" data-value="<?= $req['ar_id'] ?>"></td>
    <td><?= $req['ar_name']?></td>
    <td><?= $req['ar_desc']?></td>
    <td><?= $req['ar_measurement_value']?>
    <?php foreach ($req['meauserement'] as $m) {
                        echo $m['mt_meas'];
                   ?>
                <?php  } ?>  
  </td>
    <?php foreach ($req['color'] as $color): ?>
      <td><?= $color['color_name']?></td>
    <?php endforeach; ?>
    <?php if (!empty($req['stock'])): ?>
      <?php foreach ($req['stock'] as $stock): ?>
        <td><?= $stock['stock_Quantity']?></td>
      <?php endforeach; ?>
    <?php else: ?>
      <td>Sin existencias</td>
    <?php endif; ?>
    <td><button 
    id="pdf-btn" data-pdf-url="<?= $req['ar_data_url']?>"  class="btn btn-outline-light" style="border:1px solid #ff0000;"><i class="fa-regular fa-file-pdf fa-beat" style="color: #ff0000;"></i></button></td>
  </tr>
<?php } ?>

    </tbody>
  </table>
</div>
