<div class="container table-responsive">
    <table id="myTable" class="DataTable text-center table align-middle slide-in-top table-hover table-responsive">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Unidad de medida</th>
                <th>Color</th>
                <th>Cantidad en stock</th>
                <th>Ficha tecnica</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php

use function Helpers\dd;

foreach ($articles as $art) { ?>
            <tr>
                <td><img class='viewArticle' value="<?= $art['ar_id']?>" src="<?= $art['ar_img_url']?>" alt="..."
                        height="100"
                        data-url="<?= Helpers\generateUrl("Stock", "Stock", "viewArticleDesc", [], "ajax") ?>"
                        data-value="<?= $art['ar_id'] ?>"></td>
                <td><?= $art['ar_name']?></td>
                <td><?= $art['ar_desc']?></td>
                <td><?= $art['ar_measurement_value']?>
                    <?php foreach ($art['meauserement'] as $m) {
                        echo $m['mt_meas'];
                   ?>
                    <?php  } ?>
                </td>
                <?php foreach ($art['color'] as $color): ?>
                <td><?= $color['color_name']?></td>
                <?php endforeach; ?>
                <?php if (!empty($art['stock'])): ?>
                <?php foreach ($art['stock'] as $stock): ?>
                <td><?= $stock['stock_Quantity']?></td>
                <?php endforeach; ?>
                <?php else: ?>
                <td>Sin existencias</td>
                <?php endif; ?>
                <td><button id="pdf-btn" data-pdf-url="<?= $art['ar_data_url']?>" class="btn btn-outline-light"
                        style="border:1px solid #ff0000;"><i class="fa-regular fa-file-pdf fa-beat"
                            style="color: #ff0000;"></i></button></td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
</div>