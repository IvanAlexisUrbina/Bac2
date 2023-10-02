<?php

use function Helpers\generateUrl;
?>
<div class="container d-flex">
    <div class="col-md-6">

        <button data-url="<?= generateUrl("Articles","Articles","consultGridArticles",['order'=>'3'],"ajax")?>"
            class="btn-grid btn btn-light">
            <img src="img/piezas.png" alt="" srcset="">
        </button>
        <button data-url="<?= generateUrl("Articles","Articles","consultGridArticles",['order'=>'4'],"ajax")?>"
            class="btn-grid btn btn-light">
            <img src="img/grid-alt.png" alt="" srcset="">
        </button>
        <button data-url="<?= generateUrl("Articles","Articles","consultGridArticles",['order'=>'6'],"ajax")?>"
            class="btn-grid btn btn-light">
            <img src="img/secciones.png" alt="" srcset="">
        </button>
        <button data-url="<?= generateUrl("Articles","Articles","consultGridArticles",['order'=>'table'],"ajax")?>"
            class="btn-grid btn btn-light">
            <img src="img/table.png" alt="" srcset="">
        </button>
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Buscar" aria-label="Buscar"
            aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button"><i
                    class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </div>

</div>

<div class="container" id="contArticles">
    
<?php 
$count = 0; 
foreach ($articles as $art) { 
    if ($count % 2 == 0) { 
        echo '<div class="row mt-3">'; // Crea una nueva fila
    }
?>
   <div class="col-md-6 cardsDiv">
        <div class="card">
            <img src="<?= $art['ar_img_url']?>" data-url="<?= Helpers\generateUrl("Stock", "Stock", "viewArticleDesc", [], "ajax") ?>" data-value="<?= $art['ar_id'] ?>" class="card-img-top img-fluid rounded viewArticle"  style="height: 400px ; object-fit: cover;" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $art['ar_name']?></h5>
                <!-- Aplica la función substr para truncar la descripción -->
                <p class="card-text"><b>Descripcióna: </b><?= substr($art['ar_desc'], 0, 100) . '...' ?></p>
                <p class="card-text"><b>Unidad de medida: </b><?= $art['ar_measurement_value']?> <?php foreach ($art['meauserement'] as $m) {
                    echo $m['mt_meas'];
                ?></p>
                <?php  } ?>
                <?php foreach ($art['color'] as $color): ?>
                <p class="card-text"><b>Color: </b><?= $color['color_name']?></p>
                <?php endforeach; ?>
                <?php foreach ($art['price'] as $price): ?>
                <p class="card-text"><b>Precio: </b><?= $price['p_value'] ?></p>
                <?php endforeach; ?>
                <?php if (!empty($art['stock'])): ?>
                <?php foreach ($art['stock'] as $stock): ?>
                <p class="card-text"><b>Cantidad en stock: </b><?= $stock['stock_Quantity']?></p>
                <?php endforeach; ?>
                <?php else: ?>
                <p class="card-text"><b>Cantidad en stock: </b>Sin existencias</p>
                <?php endif; ?>
                <button id="pdf-btn" data-pdf-url="<?= $art['ar_data_url']?>" class="btn btn-outline-primary">Ficha
                    técnica</button>
            </div>
        </div>
    </div>
    <?php 
    $count++;
    if ($count % 2 == 0) {
        echo '</div>';
    }
} ?>

</div>