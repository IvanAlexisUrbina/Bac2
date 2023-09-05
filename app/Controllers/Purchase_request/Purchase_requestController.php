<?php

use function Helpers\dd;

require '../vendor/autoload.php';

class Purchase_requestController
{
    public function ConsultRequestPurchaseView(){

        include_once "../app/Views/purchase_request/purchaseTableRequest.php";
    }

    public function consultPurchaseView(){
        include_once "../app/Views/purchase_request/purchaseView.php";

    }

    public function generateRequestPurchase(){
        dd($_POST);
    }

}

?>