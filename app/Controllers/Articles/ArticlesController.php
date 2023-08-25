<?php
require '../vendor/autoload.php';
use Models\Articles\ArticlesModel;
use Models\Colors\ColorsModel;
use Models\Permission\PermissionModel;
use Models\Prices\PricesModel;
use Models\Stock\StockModel;
use Models\Measurement\MeasurementModel;
use function Helpers\dd;

// ID on the table modules of la bd
// 1: Dashboard
// 2: Quotes
// 3: Order
// 4: List prices
// 5: warehouse
// 6: stock
// 7: reports

class ArticlesController{


    public function consult() {
        // $obj = new PermissionModel();
        // if (!$obj->checkPermission(self::MODULE_ID)) {
        //     die('Acceso denegado');
        // } else {
            $obj = new ArticlesModel();
            $objColor = new ColorsModel();
            $objStock= new StockModel();
            $objPrice= new PricesModel();
            $objMeauserement= new MeasurementModel();

            
            $articles = $obj->consultArticles();
            foreach ($articles as &$arti) {
                $color = $objColor->consultColorByID($arti['color_id']);
                $stock=$objStock->consultStockArticleById($arti['ar_id']);
                $price=$objPrice->consultPriceById($arti['ar_id']);
                $meauserement=$objMeauserement->consultMeasurementById($arti['mt_id']);
                $arti['meauserement'] = $meauserement;
                $arti['price'] = $price;
                $arti['stock'] = $stock;
                $arti['color'] = $color;
            }
            include_once '../app/Views/articles/consult.php';
        // }
    }
    

    public function consultGridArticles(){
        $obj= new ArticlesModel();
        $objColor= new ColorsModel();  
        $objStock= new StockModel();
        $objPrice= new PricesModel();
        $objMeauserement= new MeasurementModel();
        
        $articles=$obj->consultArticles();


        foreach ($articles as &$arti) {
           $color=$objColor->consultColorByID($arti['color_id']);
           $stock=$objStock->consultStockArticleById($arti['ar_id']);
           $price=$objPrice->consultPriceById($arti['ar_id']);
           $meauserement=$objMeauserement->consultMeasurementById($arti['mt_id']);
        
           $arti['price'] = $price;
           $arti['color'] = $color;
           $arti['stock'] = $stock;
           $arti['meauserement'] = $meauserement;

        }

        // dd($articles);

        $articlesForRows=$_GET['order'];
        $count=0;
        if ($articlesForRows=='table') {
            include_once '../app/Views/articles/consultTable.php';
        }else {
            foreach ($articles as $art) {
                if ($count % $articlesForRows == 0) {
                    echo '<div class="row mt-3">';
                }
                ?>
<div class="col-md-<?php echo 12 / $articlesForRows ?> roll-in-blurred-left cardsDiv">
    <div class="card">
        <img src="<?= $art['ar_img_url'] ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?= $art['ar_name'] ?></h5>
            <p class="card-text"><b>Descripción: </b><?= $art['ar_desc'] ?></p>
            <p class="card-text"><b>Unidad de medida: </b><?= $art['ar_measurement_value'] ?>
                <?php foreach ($art['meauserement'] as $m) {
                        echo $m['mt_meas'];
                   ?>
                <?php  } ?></p>
            <?php foreach ($art['color'] as $color): ?>
            <p class="card-text"><b>Color: </b><?= $color['color_name'] ?></p>
            <?php endforeach; ?>
            <?php foreach ($art['price'] as $price): ?>
            <p class="card-text"><b>Precio: </b><?= $price['p_value'] ?></p>
            <?php endforeach; ?>
            <?php if (!empty($art['stock'])): ?>
            <?php foreach ($art['stock'] as $stock): ?>
            <p class="card-text"><b>Cantidad en stock: </b><?= $stock['stock_Quantity'] ?></p>
            <?php endforeach; ?>
            <?php else: ?>
            <p class="card-text"><b>Cantidad en stock: </b>Sin existencias</p>
            <?php endif; ?>
            <button id="pdf-btn" data-pdf-url="<?= $art['ar_data_url']?>" class="btn btn-outline-primary">Ficha
                tecnica</button>
        </div>
    </div>
</div>
<?php
                        $count++;
                        if ($count % $articlesForRows == 0) {
                            echo '</div>';
                        }
                    }
                    
                    if ($count % $articlesForRows!= 0) {
                        echo '</div>';
                    }
                }     
    }

}
?>