<?php

use function Helpers\generateUrl;
?>
<div class="container d-flex">
    <div class="col-md-6">

        <button data-url="<?= generateUrl("Api","Api","consultGridArticles",['order'=>'3'],"ajax")?>"
            class="btn-grid btn btn-light">
            <img src="img/piezas.png" alt="" srcset="">
        </button>
        <button data-url="<?= generateUrl("Api","Api","consultGridArticles",['order'=>'4'],"ajax")?>"
            class="btn-grid btn btn-light">
            <img src="img/grid-alt.png" alt="" srcset="">
        </button>
        <button data-url="<?= generateUrl("Api","Api","consultGridArticles",['order'=>'6'],"ajax")?>"
            class="btn-grid btn btn-light">
            <img src="img/secciones.png" alt="" srcset="">
        </button>
        <button data-url="<?= generateUrl("Api","Api","consultGridArticles",['order'=>'table'],"ajax")?>"
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
        <img  data-url="<?= Helpers\generateUrl("Api", "Api", "viewArticleDesc", [], "ajax") ?>"
                        data-value="<?= $art->id?>" value="<?= $art->id?>" src="<?= $art->images[0]->src ?>" class="card-img-top img-fluid viewArticle" style="height: 200px; object-fit: cover;" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?= $art->name ?></h5>
            <p class="card-text"><b>Codigo: </b><?= $art->sku ?></p>
            <p class="card-text"><b>Precio: </b><?= $art->price_html ?></p>
            <p class="card-text"><b>Descripción: </b><?= $art->short_description ?></p>
            <p class="card-text"><b>Cantidad en stock: </b><?= $art->purchasable ?></p>
            <!-- Otros elementos de la tarjeta -->
        </div>
    </div>
</div>


    <?php 
    $count++; // Incrementar el contador 
    if ($count % 2 == 0) { // Se cierra cuando llega a 2
        echo '</div>';
    }
} 

// Si el número de artículos no es par, cerrar la última fila
if ($count % 2 != 0) { 
    echo '</div>';
}
?>

</div>