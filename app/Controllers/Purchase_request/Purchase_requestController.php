<?php

use Models\Purchase_request\Purchase_requestModel;

use function Helpers\dd;

require '../vendor/autoload.php';

class Purchase_requestController
{
    public function ConsultRequestPurchaseView(){
        $Objpurchase= new Purchase_requestModel();
        $request=$Objpurchase->consultRequest();
        include_once "../app/Views/purchase_request/purchaseTableRequest.php";
    }

    public function consultPurchaseView(){
        $Objpurchase= new Purchase_requestModel();
        $types=$Objpurchase->consultPurchaseRequestTypes();
        include_once "../app/Views/purchase_request/purchaseView.php";
    }

    public function generateRequestPurchase(){
        $pr_desc=$_POST['desc'];
        $pr_quantity=$_POST['pr_quantity'];
        $Objpurchase= new Purchase_requestModel();

        if ($_POST['type']=='otros') {
            $newTypeShop=$_POST['newTypeShop'];
            $type_id=$Objpurchase->insertPurchaseRequestType($newTypeShop);
        }else {
            $type_id=$_POST['type'];
        }
        $Objpurchase->insertPurchaseRequest($pr_desc,$pr_quantity,$_SESSION['idUser'],'1',$type_id); 
    }

}

?>