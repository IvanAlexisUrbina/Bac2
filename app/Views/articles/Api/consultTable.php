<div class="container table-responsive">
    <table id="myTable" class="DataTable text-center table align-middle slide-in-top table-hover table-responsive">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Cantidad en stock</th>
            </tr>
        </thead>
        <tbody>
            <?php

use function Helpers\dd;

foreach ($articles as $art) { ?>
            <tr>
                <td><img class='viewArticle' value="<?= $art->id?>" src="<?= $art->images[0]->src?>" alt="..."
                        height="100"
                        data-url="<?= Helpers\generateUrl("Api", "Api", "viewArticleDesc", [], "ajax") ?>"
                        data-value="<?= $art->id?>"></td>
                <td><?= $art->sku ?></td>
                <td><?= $art->name?></td>
                <td><?= $art->short_description?></td>
                <td><?= $art->purchasable?></td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
</div>