<?php

use function Helpers\dd;
use Models\Company\CompanyModel;
use Models\Articles\ArticlesModel;
use Models\Prices\PricesModel;
use Models\Customer_discounts\Customer_discountsModel;
use Models\Purchase_request\Purchase_requestModel;
use Models\Groups\GroupsModel;
use Models\Pdf\PdfModel;
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
        // dd($_POST);
        $pr_desc=$_POST['comments'];
        $type_id=$_POST['type'];
        if ($type_id=='2') {   
            // Applicant
           $nameApplicant=$_POST['nameApplicant'];
           $ccApplicant=$_POST['ccApplicant'];
           $emailApplicant=$_POST['emailApplicant'];
           $phoneApplicant=$_POST['phoneApplicant']; 
           // client company]
           
           $company=$_POST['company'];
           $name=$_POST['name'];
           $cc=$_POST['cc'];
           $email=$_POST['email'];
           $phone=$_POST['phone'];
           $subtotalOrderInput = $_POST['subtotalOrderInput'];
           $taxesOrderInput = $_POST['taxesOrderInput'];
           $totalOrderInput = $_POST['totalOrderInput'];
           $quantity_article = $_POST['quantity_article'];
           $PriceNormal=$_POST['PriceNormal'];
           $art_id = $_POST['art_id'];
           $cc = $_POST['cc'];
           $PercentajeOrPrice = $_POST['discountPercentajeOrPrice'];
           $discountPrice = $_POST['discountPrice'];
           //$totalOrderInput products 
           // Insert the basic data into the "purchase request" table
           $Objpurchase->insertPurchaseRequest($pr_desc,$totalOrderInput,null,$_SESSION['idUser'],'1',$type_id);
            //get last id
           $pr_id=$Objpurchase->getLastId('purchase_requests','pr_id');

           foreach ($art_id as $key => $article_id) {
                $quantity = $quantity_article[$key];
                $discountType = $PercentajeOrPrice[$key];
                $discountedPrice = $discountPrice[$key];
                // Insert the basic data into the "Order and articles" table
                $Objpurchase->insertPurchaseArticle($pr_id, $article_id, $quantity, $PriceNormal[$key], $discountType, $discountedPrice);
            }

            $articles=$_POST['art_id'];//ARRAY DE ID ARTICLES
            $quantity=$_POST['quantity_article'];//ARRAY QUANTITY OF ARTICLES


                //DATA OF  ARTICLE
            $objArticle=new ArticlesModel();
            //PRICE OF ARTICLE
            $objPrice=new PricesModel();
            $articleArray = array();   
            //CONSULT DISCOUNT ARTICLE
            //CHECK IF THE COMPANY EXISTS IN THE DISCOUNT GROUPS
            $objDiscount= new Customer_discountsModel();
            $discountCompany=$objDiscount->consultDiscountsByColumn('c_id',$company);
            $priceDiscount=null;
            $discountPercentage=null;
            $arrayArticles = array();
            $arrayCategories = array();
            $arraySubcategories = array();
            $discountPercentajeOrPrice='No aplica';

            if (!empty($discountCompany)) {
                //CONSULT CATEGORIES,SUBCATEGORIES,ARTICLES AND DISCOUNT GROUP OF DISCOUNT
                $objGroups= new GroupsModel();
                $group=$objGroups->consultGroupById($discountCompany[0]['gp_id']);
    
                foreach ($discountCompany as $key) {
                    $arrayArticles[]=$key['ar_id'];
                    $arrayCategories[]=$key['cat_id'];
                    $arraySubcategories[]=$key['sbcat_id'];
                }
                    // save discount o price discount
                    $priceDiscount=$discountCompany[0]['price_discount'];
                    $discountPercentage=$group[0]['gp_discount_percentage'];
              
    
                  // Here it checks if the discount is based on price or percentage, and assigns it to the variable $discountPercentajeOrPrice.
                    if (!empty($discountPercentage)) {
                        $discountPercentajeOrPrice = $discountPercentage.'%';
                    }
                    if (!empty($priceDiscount)) {
                        $discountPercentajeOrPrice = $priceDiscount.'$';
                    }
    
            }

            foreach ($articles as $key => $ar_id) {
           
                $article = $objArticle->consultArticleById($ar_id);
                $article['price']=$price['p_value']=$objPrice->consultPriceById($ar_id);
                
    
                $discountedPrice = $this->verifyDiscount($article[0]['ar_id'], $article[0]['cat_id'], $article[0]['sbcat_id'], $arrayArticles, $arrayCategories, $arraySubcategories, $priceDiscount, $discountPercentage, $article['price'][0]['p_value']);
                $article['pricePre']= $article['price'][0]['p_value'];
                $article['price']=$discountedPrice;
                $article['discountPercentajeOrPrice']= $discountPercentajeOrPrice;
                $article['quantity'] = $quantity[$key];  
                $articleArray[] = $article;
            }

             // DATOS DEL TEMPLATE DE PURCHASE REQUEST
            $objCompany= new CompanyModel();
            $companyinfo=$objCompany->ConsultCompany($company);

            $template = PdfModel::templatePurchaseRequestPdf($articleArray,null,null,$companyinfo[0]['c_name'],$name,'Direccion prueba',$phone,$email);
            $pdfModel = new PdfModel();
            $pr_id = $Objpurchase->getLastId('purchase_requests','pr_id');
            $filePath=$pdfModel->generatePdf($template,$pr_id,'requestdocs'); 
            $Objpurchase->updateField('purchase_requests','pr_id ',$pr_id,'pr_url_document',$filePath);
            // dd($_FILES['fieldValue']);

        }else if($type_id=='otros'){
            $newTypeShop=$_POST['newTypeShop'];
            $type_id=$Objpurchase->insertPurchaseRequestType($newTypeShop);

        }else {
            // quantity normal
            $pr_quantity=$_POST['pr_quantity']; 
            $Objpurchase->insertPurchaseRequest($pr_desc,$pr_quantity,null,$_SESSION['idUser'],'1',$type_id); 
        }
    }

    // verify discount of article include in the purchase request
    public function verifyDiscount($idArt, $cat_id_Art, $sbcat_id, $arryArticles, $arrayCategories, $arraySubcategories, $priceDiscount, $discountPercentage, $price)
    {
        if (in_array($idArt, $arryArticles) || in_array($cat_id_Art, $arrayCategories) || in_array($sbcat_id, $arraySubcategories)) {
            // The ID has a discount
            if (!empty($discountPercentage)) {
                // Apply discount based on $discountPercentage
                
                $discountedPrice = $price - ($price * $discountPercentage / 100);
                return $discountedPrice;
            }
    
            if (!empty($priceDiscount)) {
                // Apply discount based on $priceDiscount
                $discountedPrice = $price - $priceDiscount;
                return $discountedPrice;
            }         
        } else {
            // The ID does not have a discount, return the original price
            return $price;
        }
    }


}

?>