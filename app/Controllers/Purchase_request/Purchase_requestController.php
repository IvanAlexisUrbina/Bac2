<?php

use Models\Company\CompanyModel;
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
        $objCompany= new CompanyModel();
        $companies=$objCompany->ConsultCompaniesClients();
        include_once "../app/Views/purchase_request/purchaseView.php";
    }

    public function RequestUpdateStatusViewModal(){
        
        include_once "../app/Views/purchase_request/purchaseViewModalRequest.php";

    }

    public function generateRequestPurchase(){
        $Objpurchase= new Purchase_requestModel();
        dd($_POST);

        $pr_desc=$_POST['comments'];

        if ($_POST['type']=='2') {      
            // Applicant
           $nameApplicant=$_POST['nameApplicant'];
           $ccApplicant=$_POST['ccApplicant'];
           $emailApplicant=$_POST['emailApplicant'];
           $phoneApplicant=$_POST['phoneApplicant']; 
           // client company]
           $idCompany=$_POST['company'];
           $name=$_POST['name'];
           $cc=$_POST['cc'];
           $email=$_POST['email'];
           $phone=$_POST['phone'];
        
        }else if($_POST['type']=='otros'){
            $newTypeShop=$_POST['newTypeShop'];
            $type_id=$Objpurchase->insertPurchaseRequestType($newTypeShop);
        }else {
            $pr_quantity=$_POST['pr_quantity']; 
        }

        $type_id=$_POST['type'];

       
        $Objpurchase->insertPurchaseRequest($pr_desc,$pr_quantity,$_SESSION['idUser'],'1',$type_id); 
    }

}

?>