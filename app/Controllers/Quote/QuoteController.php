<?php
require '../vendor/autoload.php';
use Models\Quote\QuoteModel;
use Models\Articles\ArticlesModel;
use Models\Pdf\PdfModel;
use Models\Category\CategoryModel;
use Models\Prices\PricesModel;
use Models\Colors\ColorsModel;
use Models\Company\CompanyModel;
use Models\Groups\GroupsModel;
use Models\Customer_discounts\Customer_discountsModel;
use Models\Customer_payment_method\Customer_payment_methodModel;
use Models\MethodsPay\MethodsPayModel;
use Models\Sellers\SellersModel;
use Models\User\UserModel;

use function Helpers\dd;
use function Helpers\generateUrl;
use function Helpers\redirect;

class QuoteController{
    public function ViewCreateQuote(){
        $objUser= new UserModel();
        //users clients
        $usersClients=$objUser->consultUsersWithRolAndStatus('4','1');         
        $objCompany= new CompanyModel();
        foreach ($usersClients as $u) {
            //companies clients
            $companies=$objCompany->ConsultCompany($u['c_id']);
        }
    
        include_once "../app/Views/quote/quoteCreate.php";
    }

    public function attrsByAjax(){

        $companyId = $_POST['c_id'];

        // METHODS PAY --------------------------------------------------
        $objCustomerPaymentMethods = new Customer_payment_methodModel();
        $payment_methods = $objCustomerPaymentMethods->getPaymentMethodsByCustomerId($companyId);
        $objMethods = new MethodsPayModel();
        $response = array(); // Crear un array para la respuesta    
        if (!empty($payment_methods)) {
            $methods = array();
            foreach ($payment_methods as $p) {
                $methods[] = $objMethods->consultMethodsById($p['payment_method_id']);
            }
            
            $options = array(); // Inicializar un array para almacenar las opciones
        
            foreach ($methods as $method) {
                $payment_method_id = $method[0]['payment_method_id'];
                $name = $method[0]['name'];
                $options[] = array('value' => $payment_method_id, 'name' => $name);
            }
        
            $response['methods'] = $options; // Agregar las opciones al array de respuesta
        } else {
            $response['methods'] = array(array('value' => '', 'name' => 'No tiene metodos de pago asignados todavia'));
        }
         // ADDRESS SHIPPING OF COMPANY-----------------------------------------------------
         $objCompany = new CompanyModel();
         $shipping_address = $objCompany->ConsultCompany($_SESSION['IdCompany']);
         $quoteAddressParts = array(); // Array para almacenar las partes de la dirección
         // Verificar si al menos un campo está lleno en la dirección de envío
         foreach ($shipping_address as $key) {
             if (!empty($key['c_shippingStreet']) AND !empty($key['c_shippingApartament']) AND !empty($key['c_shippingCountry']) AND !empty($key['c_shippingCity']) AND !empty($key['c_shippingState']) AND !empty($key['c_shippingPostalcode'])) {
                 $quoteAddressParts[] = $key['c_shippingStreet'] . ', ' . $key['c_shippingApartament'] . ', ' . $key['c_shippingCountry'] . ', ' . $key['c_shippingCity'] . ', ' . $key['c_shippingState'] . ', ' . $key['c_shippingPostalcode'];
             }
         }
         
         if (!empty($quoteAddressParts)) {
             // Agregar la dirección de envío al array de respuesta
             $response['quoteAddress'] = implode(' ', $quoteAddressParts);
         } else {
             // Agregar un mensaje indicando que no hay dirección de envío
             $response['quoteAddress'] = 'No hay dirección de envío registrada - Ingresa una direccion en este campo';
         }
        //REPRESENTANT OF COMPANY
        $objUser= new UserModel();
        $user=$objUser->getUsersByRoleCompanyAndStatus('4',$companyId,'1');
        $response['representant']= $user;

         
        // Enviar la respuesta como JSON
        echo json_encode($response);
    }
    
    




    public function quotesCompanies(){
        $obj= new QuoteModel();
        $quotes=$obj->consultQuotesClients();
        include_once '../app/Views/quote/quotesConsultCompanies.php';
    }

    public function ViewQuotes(){
         $obj=new QuoteModel();
         $quotes=$obj->consultQuotes($_SESSION['IdCompany']);
         include_once "../app/Views/quote/quoteConsult.php";
    }

    public function CreateQuote(){
        $objArticles=new ArticlesModel();
        $objColor= new ColorsModel();
        $articles=$objArticles->consultArticles();
        foreach ($articles as &$arti) {
            $color=$objColor->consultColorByID($arti['color_id']);
            $arti['color'] = $color;
         }
        include_once "../app/Views/quote/quoteModal.php";
    }  


    public function pdfQuote(){ 
        // dd($_POST);
      

        $objQuote=new QuoteModel();
        $name = $_POST['name'];
        $company = $_POST['company'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $payment_method = $_POST['payment_method'];
        $address_shipping = $_POST['address_shipping'];
        $comments = $_POST['comments'];
        $cc = $_POST['cc'];
        $subtotalQuoteInput = $_POST['subtotalQuoteInput'];
        $taxesQuoteInput = $_POST['taxesQuoteInput'];
        $totalQuoteInput = $_POST['totalQuoteInput'];
        $quantity_article = $_POST['quantity_article'];
        $PriceNormal=$_POST['PriceNormal'];
        $art_id = $_POST['art_id'];
        $PercentajeOrPrice = $_POST['discountPercentajeOrPrice'];
        $discountPrice = $_POST['discountPrice'];
        
       // Insert the basic data into the "quotations" table
        $objQuote->insertQuote($name,'a',$payment_method,$company,$address_shipping,$email,$phone,$comments,$cc,$subtotalQuoteInput,$taxesQuoteInput,$totalQuoteInput,null,$_SESSION['idUser'],'1');
      
        //get last id
        $quo_id=$objQuote->getLastId('quotes','quo_id');
        
        foreach ($art_id as $key => $article_id) {
            $quantity = $quantity_article[$key];
            $discountType = $PercentajeOrPrice[$key];
            $discountedPrice = $discountPrice[$key];
        // Insert the basic data into the "quote and articles" table
            $objQuote->insertQuoteArticle($quo_id, $article_id, $quantity, $PriceNormal[$key], $discountType, $discountedPrice);
        }

        $articles=$_POST['art_id'];//ARRAY DE ID ARTICLES
        $quantity=$_POST['quantity_article'];//ARRAY QUANTITY OF ARTICLES
        if (isset($_POST['fieldName']) && isset($_POST['fieldValue'])) {
            $fieldName = $_POST['fieldName']; //ARRAY OF FIELDS NAME
            $fieldValue = $_POST['fieldValue']; //ARRAY OF FIELDS VALUE
        }else{
            $fieldName = NULL; //ARRAY OF FIELDS NAME
            $fieldValue = NULL; //ARRAY OF FIELDS VALUE
        }
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
        // DATOS DEL TEMPLATE DE QUOTE
        $objCompany= new CompanyModel();
        $companyinfo=$objCompany->ConsultCompany($company);

        $template = PdfModel::templateQuotePdf($articleArray,$fieldName,$fieldValue,$companyinfo[0]['c_name'],$name,$address_shipping,$phone,$email);


        $pdfModel = new PdfModel();
        $idQuote = $objQuote->getLastId('quotes','quo_id');
        $filePath=$pdfModel->generatePdf($template,$idQuote,'quotes'); 
        // dd($_FILES['fieldValue']);
        $objQuote->updateField('quotes','quo_id',$idQuote,'quo_url_document',$filePath);

        if (isset($_POST['fieldName'])) {
            $fieldNames = $_POST['fieldName'];
            $fieldValues = $_POST['fieldValue'];
            for ($i=0; $i <  count($fieldNames ); $i++) { 
                $objQuote->insertExtraAttributeQuote($fieldNames[$i], $fieldValues[$i], $quo_id);     

            }
        
        }
        if (isset($_FILES['fieldValue'])) {
            $fileCount = count($_FILES['fieldValue']['name']);
        
            for ($i = 0; $i < $fileCount; $i++) {
                $fileName = $_FILES['fieldValue']['name'][$i];
                $fileTmpName = $_FILES['fieldValue']['tmp_name'][$i];
        
                // Definir la ubicación de destino para el archivo
                $destination = 'uploads/quotes/' . $quo_id . '/';
        
                // Verificar si la carpeta de destino existe
                if (!is_dir($destination)) {
                    // La carpeta de destino no existe, intenta crearla
                    if (!mkdir($destination, 0755, true)) {
                        // No se pudo crear la carpeta, muestra un mensaje de error y detén el proceso

                        return;
                    }
                }
        
                // Construir la ruta completa del archivo
                $filePath = $destination . $fileName;
        
                // Mover el archivo a la ubicación de destino
                if (move_uploaded_file($fileTmpName, $filePath)) {
                    // echo "El archivo $fileName se ha subido correctamente.";
                    // echo "Ruta completa del archivo: $filePath";
                    $objQuote->insertExtraAttributeQuote($fileName, $filePath, $quo_id);
                } else {
                    echo "Ocurrió un error al mover el archivo $fileName.";
                }
            }
        }
        
        
        redirect(generateUrl("Quote","Quote","ViewQuotes"));
    }

    public function AddArticlesAjax(){
        $idArticle=$_POST['id_article'];
        $quantity=$_POST['quantity_articles'];
        $c_id=$_POST['companyId'];

        // GET INFO ARTICLE
        $objArticle=new ArticlesModel(); 
        $article= $objArticle->consultArticleById($idArticle);
        $idCategory = $article[0]['cat_id'];       
        //GET INFO CATEGORY
        //CONSULT DISCOUNT CATEGORY
        $objCategory=new CategoryModel();
        $category=$objCategory->consultCategoryById($idCategory);
        $nameCategory = $category[0]['cat_name']; 
        //GET INFO PRICE ARTICLE
        $objPrice= new PricesModel(); 
        $price=$objPrice->consultPriceById($idArticle);
        //CONSULT DISCOUNT ARTICLE
        //CHECK IF THE COMPANY EXISTS IN THE DISCOUNT GROUPS
        $objDiscount= new Customer_discountsModel();
        $discountCompany=$objDiscount->consultDiscountsByColumn('c_id',$c_id);
        
        $priceDiscount=null;
        $discountPercentage=null;
        $arryArticles = array();
        $arrayCategories = array();
        $arraySubcategories = array();
        $discountPercentajeOrPrice='No aplica';
        if (!empty($discountCompany)) {
            //CONSULT CATEGORIES,SUBCATEGORIES,ARTICLES AND DISCOUNT GROUP OF DISCOUNT
            $objGroups= new GroupsModel();
            $group=$objGroups->consultGroupById($discountCompany[0]['gp_id']);

          

            foreach ($discountCompany as $key) {
                $arryArticles[]=$key['ar_id'];
                $arrayCategories[]=$key['cat_id'];
                $arraySubcategories[]=$key['sbcat_id'];
            }

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

        $PriceWithDiscount=0;
        foreach ($article as $ar) {
            $discountedPrice = $this->verifyDiscount($ar['ar_id'], $ar['cat_id'], $ar['sbcat_id'], $arryArticles, $arrayCategories, $arraySubcategories, $priceDiscount, $discountPercentage, $price[0]['p_value']);
            $subtotal = $discountedPrice * $quantity;
        
            echo '<tr>
                    <td>'.$ar['ar_id'].'</td>
                    <td> <img src='.$ar['ar_img_url'].' class="card-img-top viewArticle" alt="..." data-url="'.Helpers\generateUrl("Stock","Stock","viewArticleDesc",[],"ajax").'" data-value="'. $ar['ar_id'].'">'.$ar['ar_name'].'</td>
                    <td>'.$nameCategory.'</td>
                    <td>
                        <input type="number" class="form-control quantityArt" name="quantity_article[]" min="1" value="'.$quantity.'">
                        <input type="hidden"  name="art_id[]" value="'.$ar['ar_id'].'">
                    </td>
                    <td class="price">'.$price[0]['p_value'].'<input type="hidden" name="PriceNormal[]" value="'.$price[0]['p_value'].'"></td>
                    <td>'.$discountPercentajeOrPrice.'<input type="hidden" name="discountPercentajeOrPrice[]" value='.$discountPercentajeOrPrice.'></td>
                    <td class="discount">'.$discountedPrice.'<input type="hidden" name="discountPrice[]" value="'.$discountedPrice.'" ></td>
                    <td class="subtotal">$'.$subtotal.'</td>
                    <td><button class="btn btn-danger delete-row"><i class="fa-solid fa-square-xmark"></i></button></td>
                 </tr>';
        }
    }
        
    // verify discount of article include in the quote
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
    

    // MODAL DINAMICA QUE TRAE LOS VALORES DEPENDIENDO LOS FILTROS 
    public function consultGridArticles(){
        $obj= new ArticlesModel();
        $objColor= new ColorsModel();
        $articles=$obj->consultArticles();
        foreach ($articles as &$arti) {
            $color=$objColor->consultColorByID($arti['color_id']);
            $arti['color'] = $color;
        }
        $articlesForRows=$_GET['order'];
        $count=0;

        if ($articlesForRows=='table') {
            include_once '../app/Views/quote/quoteArticlesTable.php';
        }else {
            foreach ($articles as $art) {
                if ($count % $articlesForRows== 0) {
                    echo '<div class="row mt-3">';
                }
                ?>
<div class="col-md-<?php echo 12 / $articlesForRows?> roll-in-blurred-left cardsDiv">
    <div class="card">
        <img src="<?= $art['ar_img_url'] ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?= $art['ar_name'] ?></h5>
            <p class="card-text"><b>Descripción: </b><?= $art['ar_desc'] ?></p>
            <p class="card-text"><b>Peso: </b><?= $art['ar_measurement_value'] ?>kg</p>
            <?php foreach ($art['color'] as $color): ?>
            <p class="card-text"><b>Color: </b><?= $color['color_name'] ?></p>
            <?php endforeach; ?>
            <p><b>Cantidad:</b>
                <input type="number" class="mt-2 mb-2 quantityinput form form-control" name="quantity" min="1" id="">
                <button data-url="<?= Helpers\generateUrl("Quote","Quote","AddArticlesAjax",[],"ajax");?>"
                    value="<?= $art['ar_id']?>" id="addArticles" class="btn btn-outline-primary">Añadir
                    articulo</button>
            </p>
        </div>
    </div>
</div>
<?php
                                $count++;
                                if ($count % $articlesForRows== 0) {
                                    echo '</div>';
                                }
                            }
                            if ($count % $articlesForRows!= 0) {
                                echo '</div>';
                            }
                        }     
    }


    public function ViewModalAddFields(){
        include_once '../app/Views/quote/ModalAddFields.php';
    }


    public function addInputsFormAjax()
    {
        $quantityInput = $_POST['quantity'];
        $typeInput = $_POST['typeInput'];
    
        for ($i = 0; $i < $quantityInput; $i++) {
            echo "<div class='col-md-6' style='border:1px solid #ced4da;'>
                    <div class='form-group'>";
            
            if ($typeInput === "file") {
                echo "<label ><br></label>";
                echo "<label '>Adjunta el archivo:</label>";
                echo "<input type='file' name='fieldValue[]' class='form-control'>";
            } else {
                echo "Campo: <input class='form-control' placeholder='Escribe el nombre del campo' name='fieldName[]' type='text'>";
                echo "Valor: <input type='text' name='fieldValue[]' class='form-control'>";
            }
    
            echo "</div>
                  <button type='button' class='mt-2 mb-2 btn btn-danger btn-sm delete-btn'>Eliminar</button>
                </div>";
        }
    }
    

    

}
?>