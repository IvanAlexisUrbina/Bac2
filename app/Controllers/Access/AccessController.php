<?php

require '../vendor/autoload.php';

use Models\Access\AccessModel;
use Models\Mail\MailModel;
use Models\Template\TemplateModel;
use Models\Types_industry\Types_industryModel;
use Models\User\UserModel;
use Models\Company\CompanyModel;
use Models\Sellers_customers\Sellers_customersModel;
use Models\Town\TownModel;

use function Helpers\dd;
use function Helpers\generateUrl;
use function Helpers\redirect;

class AccessController
{

    public function EmailCode() {
        $obj = new AccessModel();
        $sendEmail = new MailModel();
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $userExistence = $obj->userExistence($email, $pass);  

        if ($userExistence['success']==true) {
            $template = TemplateModel::TemplateCode($userExistence['data']['code'], $userExistence['data']['name'] . " " . $userExistence['data']['lastname']);
            $sendEmail->DataEmail($template, $email, 'Código de verificación');
            echo $userExistence['success'];
        } else {
            // Aquí puedes mostrar una alerta o realizar otra acción en caso de que success sea false
            echo $message = $userExistence['message'];
            // redirect('index.php');
        }
    }
    

    public function UserAccess(){
        $obj = new AccessModel();
        $u_email = $_POST['u_email'];
        $u_pass = $_POST['u_pass'];
        $u_code = $_POST['u_code'];
        $execute = $obj->ValidationUser($u_email, $u_pass, $u_code);  
        if (!$execute) {
            echo "<script>alert('contraseña, correo electronico y/o codigo de verificación erroneo');</script>";
            redirect('login.php');
        } else {
            $_SESSION['StatusUser'] = $execute['StatusUser'];
            $_SESSION['StatusCompany'] = $execute['StatusCompany'];
            if ($_SESSION['StatusUser'] == 1 || $_SESSION['StatusCompany'] == 1) {
                $_SESSION['nameUser'] = $execute['nameUser'];      
                $_SESSION['LastNameUser'] = $execute['LastNameUser'];
                $_SESSION['CompanyName'] = $execute['CompanyName'];
                $_SESSION['UserNumDocument'] = $execute['UserNumDocument'];
                $_SESSION['IdCompany'] = $execute['IdCompany'];
                $_SESSION['EmailUser'] = $execute['EmailUser'];
                $_SESSION['PhoneUser'] = $execute['PhoneUser'];
                $_SESSION['CountryUser'] = $execute['CountryUser'];
                $_SESSION['CityUser'] = $execute['CityUser'];
                $_SESSION['RolUser'] = $execute['RolUser'];
                $_SESSION['RolName'] = $execute['RolName'];
                $_SESSION['idUser'] = $execute['idUser'];
                $_SESSION['auth'] = true;
                $_SESSION['welcome'] = false;
        
                $folderPath = "uploads/UserImg/".$_SESSION['idUser']."/";
                $defaultImage = "img/default.png";
                $destination = $folderPath . "default.png";
        
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0755, true);
                    copy($defaultImage, $destination);
                    // Establecer permisos de lectura y escritura para la imagen
                    chmod($destination, 0644);
                }
            }else {
                echo "<script>alert('No tienes acceso a la aplicación.');</script>";
                session_destroy();
            }
            redirect('index.php');
        }
    }
    

    public function CompanyRequestRegister(){
      //  dd($_POST);
      // validation
      $objUser= new UserModel();
      $email=$_POST['email'];
      if (!$objUser->checkEmailExists($email)) {
            $company_name=$_POST['company_name'];
            $company_desc=$_POST['c_desc'];
            $nit=$_POST['NIT'];
            $industry=$_POST['industry'];
            $department=$_POST['department'];
            $country=$_POST['country'];
            $city=$_POST['city'];
            $objCompany=new CompanyModel();
            $objCompany->RegisterCompaniesClients($company_name,$company_desc,$nit,$industry,'2',$country,$department,$city);

            $c_id=$objCompany->getLastId('company','c_id'); //id company updloads
            if (isset($_FILES['rut'], $_FILES['chamber_of_commerce'], $_FILES['representative_cedula'],$_FILES['form_inscription'],$_FILES['certificate_bank'])) {
                $uploadDir = 'uploads/companies/company_' . $c_id . '/';
                
                // Create main directory if it doesn't exist
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                $filesToUpload = [
                    'rut' => $_FILES['rut'],
                    'chamber_of_commerce' => $_FILES['chamber_of_commerce'],
                    'representative_cedula' => $_FILES['representative_cedula'],
                    'form_inscription' => $_FILES['form_inscription'],
                    'certificate_bank' => $_FILES['certificate_bank']
                ];
                
                $filePaths = []; // Array to store the file paths
                
                foreach ($filesToUpload as $fileKey => $fileData) {
                    // Create corresponding folder inside the main directory
                    $folderPath = $uploadDir . $fileKey . '/';
                    if (!is_dir($folderPath)) {
                        mkdir($folderPath, 0755, true);
                    }
                    
                    $filePath = $folderPath . $fileData['name'];
                    
                    if (move_uploaded_file($fileData['tmp_name'], $filePath)) {
                        // echo 'File "' . $fileKey . '" uploaded and saved successfully.<br>';
                        
                        $filePaths[$fileKey] = $filePath; // Store the file path
                    }
                }   
            
                
                // Update the fields in the database
                $objCompany->updateCompanyFields($c_id, $filePaths['rut'], $filePaths['chamber_of_commerce'], $filePaths['representative_cedula'], $filePaths['form_inscription'], $filePaths['certificate_bank']);
            }
            
            
                $name=$_POST['representative_name'];
                $lastname=$_POST['representative_lastname'];
                $document=$_POST['representative_document'];
                $type_document=$_POST['representative_document_type'];
            
                $phone=$_POST['phone'];

                $objUser->insertUser($email,null,null,$c_id,4,2,$name,$lastname,$phone,$document,$type_document,$country,$city);

                // INSERT SELLER WITH COMPANY
                $ObjSeller_customer= new Sellers_customersModel();
                $ObjSeller_customer->InsertSellerWithCustomer($_SESSION['idUser'],$c_id);


                //   SEND EMAILS OF NOTIFICATION
                //TEMPLATES EMAILS
                $templateUserCompany=TemplateModel::TemplateRegisterCompany($name.' '.$lastname);
                $templateNotificacionPortal=TemplateModel::TemplateNotification($name.' '.$lastname, $company_name );
                //SEND EMAILS
                //SEND EMAIL USER
                $mail= new MailModel();
                $mail->DataEmail($templateUserCompany,$email,'Notificación petición registro');
                //SEND EMAIL COMPANY PORTAL
                //FIND ROL COMPANY = PORTAL ADMIN USER EMAIL
                $email=$objUser->emailRolCompany();
                $mail->DataEmail($templateNotificacionPortal,$email[0]['u_email'],'Notificación petición registro');
        }else {
            echo "<script>alert('Este correo ya esta registrado en la base de datos, porfavor utiliza otro.')</script>";
        }
        redirect(generateUrl("Access","Access","RegisterView"));
    }

    //views
    public function RegisterView(){
        $obj= new Types_industryModel();
        $objTown= new TownModel();
        $deptos=$objTown->consultDeptos();
        $industries=$obj->consultTypes_industry(); 
        include_once '../app/Views/Register/Register.php';
    }

    public function TownsWithDepto(){
        $objTown= new TownModel();
        $depto=$_POST['depto'];
        $town=$objTown->consultTowns($depto);
        $html='<label>Ciudad:</label>
        <div class="form-group">
                     <select class="form-select form-control" name="city">';
        foreach ($town as $t) {
            $html.="<option value='".$t['NOMBRE_MPIO']."'>".$t['NOMBRE_MPIO']."</option>";
        }
        $html.="</select>
        </div>";
        echo $html;
    }
    

    public function HomeView(){
        include_once '../app/Views/partials/home.php';
    }
    
    public function UserDestroy()
    {
        session_unset();
        session_destroy();
        redirect('login.php');
    }
    public function error404(){
        include_once '../app/Views/partials/page404.php';

    }
}






?>