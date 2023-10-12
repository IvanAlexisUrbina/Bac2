<div class="container table-responsive">
    <h1>Inventario</h1>
    <div class="p-2">
        <button class="btn btn-outline-primary" type="button" id="StockArticle"
            data-url="<?= Helpers\generateUrl("Stock","Stock","ViewModalCreateArticle",[],"ajax")?>">Crear
            articulo</button>
    </div>
    <div class="table-responsive">

        <table class="table DataTable text-center slide-in-top align-middle table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Codigo</th>
                    <th>Descripción</th>
                    <th>Lote</th>
                    <th>Cantidad</th>
                    <th>Comprometido</th>
                    <th>Total</th>
                    <th>Precio unit</th>
                    <th>Entrada</th>
                    <th>Vencimiento</th>
                    <th>Bodega</th>
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
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
    foreach ($articles as $arti) { 
        ?>
                <tr>
                    <td><?= $arti['ar_id']?></td>
                    <td><img class="viewArticle"
                            data-url="<?= Helpers\generateUrl("Stock","Stock","viewArticleDesc",[],"ajax")?>"
                            data-value="<?= $arti['ar_id']?>" src="<?= $arti['ar_img_url']?>" alt="..." height="100">
                    </td>
                    <td><?= $arti['ar_name']?></td>
                    <td><?= $arti['ar_code']?></td>
                    <td><?= $arti['ar_desc']?></td>
                    <td><?= $arti['stock_lote']?></td>
                    <td><?= $arti['stock_quantity']?></td>
                    <td><?= $arti['quantityImplicated']?></td>
                    <td style="color: <?= ($arti['quantityImplicated'] >= 0) ? 'green' : 'red' ?>">
                        <?= ($arti['quantityImplicated'] >= 0) ? ($arti['stock_quantity'] - $arti['quantityImplicated']) : $arti['stock_quantity'] ?>
                    </td>
                    <td><?= $arti['p_value']?></td>
                    <td><?= $arti['stock_date_entry']?></td>
                    <td>
                        <?= !empty($arti['stock_expiration_date']) ? $arti['stock_expiration_date'] : "<em>No tiene fecha de expiración</em>" ?>
                    </td>
                    <td><?= $arti['wh_name']?></td>
                    <td><button id="editArticleOfStock" data-id="<?=$arti['ar_id']?>"
                            data-url="<?=Helpers\generateUrl("Stock","Stock","UpdateArticleOfStockModal",[],"ajax")?>"
                            title="Editar inventario" class="btn btn-outline-warning"><img src="img/editar.png" alt=""
                                srcset=""></button></td>
                </tr>
                <?php
    }
    ?>
            </tbody>

        </table>
    </div>

</div>