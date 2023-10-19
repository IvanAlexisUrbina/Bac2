<?php
require '../vendor/autoload.php';

use Models\Clients\ClientsModel;
use Models\Types_industry\Types_industryModel;
use Models\User\UserModel;
use Models\Company\CompanyModel;
use Models\CreditLimit\CreditLimitModel;
use Models\Mail\MailModel;
use Models\Messages\MessagesModel;
use Models\MethodsPay\MethodsPayModel;
use Models\Sellers\SellersModel;
use Models\Subscription\SubscriptionModel;
use Models\Template\TemplateModel;
use Models\Customer_payment_method\Customer_payment_methodModel;
use function Helpers\dd;
use function Helpers\generateUrl;
use function Helpers\redirect;
use function Helpers\showAlert;

class ClientsController
{   


    public function CreateMethodsPayCompanies(){
        $c_id=$_POST['id'];
        $objPayMethods= new MethodsPayModel();
        $objCompany= new CompanyModel();
        $objCustomerPaymentMethods= new Customer_payment_methodModel();
        // methods of pay
        $methodsPay=$objPayMethods->consultMethods();
        
        $company=$objCompany->ConsultCompany($c_id);
        foreach ($company as &$c) {
            $c['payment_methods'] = $objCustomerPaymentMethods->getPaymentMethodsByCustomerId($c['c_id']);
        }
       
        include_once "../app/Views/clients/methodspayAndCompanies.php";
        
    }

    public function paymentMethodsCompany()
    {
        $objCustomerPaymentMethods= new Customer_payment_methodModel();

        if (isset($_POST['method_pay']) && is_array($_POST['method_pay']) && count($_POST['method_pay']) > 0) {
            $c_id=$_POST['c_id'];
            $objCustomerPaymentMethods->deletePaymentMethodByCustomerId($c_id);
            $methods = $_POST['method_pay'];
            foreach ($methods as $m) {        
                $objCustomerPaymentMethods->insertMethodPayAndCompany($c_id,$m);
            }
        } else {
            echo "<script>alert('Debe seleccionar al menos un método de pago');</script>";
        }
        redirect(generateUrl("Company","Company","consultCompanies"));
    }
    
    public function ModalDocumentsCompany(){
        // dd($_POST);
        $c_id=$_POST['c_id'];
        $objCompany=new CompanyModel();
        $company=$objCompany->ConsultCompany($c_id);
        // dd($company);
        include_once '../app/Views/clients/ModalDocumentsCompany.php';
    }


    public function updateStatusCompanyAndUser(){
        $c_id=$_POST['id'];
    
        include_once '../app/Views/clients/ModalupdateStatusCompanyAndUser.php';

    }
    public function UpdateStatusOfClient(){
        $status_company=$_POST['status_company'];
        $c_id=$_POST['c_id'];
        $objCompany= new CompanyModel();
        $objCompany->updateStatusCompany($status_company,$c_id);
        redirect(generateUrl("Company","Company","consultCompanies"));
    }

    public function ViewClientPortal(){
        $objUser= new UserModel();
        $users=$objUser->consultUsersWithRol('4');
        $objCompany= new CompanyModel();
        $objSuscription= new SubscriptionModel();
        // dd($users);
        foreach ($users as &$user) {
            $company=$objCompany->ConsultCompany($user['c_id']);
            $subscription=$objSuscription->consultPlanSubscription($user['c_id']);
            $user['company'] = $company;
            $user['subscription']=$subscription; // Agregar información de la empresa al usuario
        }

        // dd($users);
        include '../app/Views/clients/viewClientPortal.php';
    }
    
    public function UpdatePlansCompany(){
        $c_id = $_POST['c_id'];
        $u_id = $_POST['u_id'];
        $objPlan = new SubscriptionModel();
        $objCompany = new CompanyModel();
        $plan = $objPlan->consultPlanSubscription($c_id);
        
        $company = $objCompany->ConsultCompany($c_id);
    
        // Agregar $company al arreglo $plan
        foreach ($plan as $key => $p) {
            $plan[$key]['company'] = $company;
        }
        // dd($plan);
        $user= new UserModel();
        $data=$user->getUserInfoById($u_id);
        include '../app/Views/clients/updateSubscriptionPlans.php';
    }

    public function sendEmailClientsOfClients(){
         $Objmessages= new MessagesModel();
        $Messages=$Objmessages->consultMessages();
        include_once '../app/Views/clients/ContMessage.php';

    }



    // public function sendEmails(){

    //     $subject =$_POST['subject'];
    //     $messages=$_POST['message'];
    //     $addressee =$_POST['addressee'];
    //     $addresseeArray = explode(", ", $addressee);
    //     $mail = new MailModel();
    //     foreach ($addresseeArray as $a) {
    //         $template= TemplateModel::TemplateRegistrationLink($a,$messages);
    //         $mail->DataEmail($template,$a,$subject);
    //     }
    //     $Objmessages= new MessagesModel();
    //     $Objmessages->insertMessage($addressee,date('Y-m-d H:i:s'),$subject,$messages);
    //     redirect(generateUrl("Clients","Clients","sendEmailClientsOfClients"));
    // }


    public function UpdateStatusCompanyActive(){
        $c_id=$_POST['c_id'];
        $u_id=$_POST['u_id'];
        // dd($_POST);
        $objCompany=new CompanyModel();
        $company=$objCompany->ConsultCompany($c_id);
        // dd($company);
        $status_id=$_POST['c_id'];
        include_once '../app/Views/infoCompany/ModalCompanyStatusUser.php';
    }

    public function SellerUpdate(){
        $u_id=$_POST['u_id'];
        $u_name=$_POST['u_name'];
        $u_email=$_POST['u_email'];
        $u_phone=$_POST['u_phone'];
        $u_codeSeller=$_POST['u_codeSeller'];
        $objSeller= new SellersModel();
        $objSeller->updateSeller($u_id,$u_name,$u_email,$u_phone,$u_codeSeller);
        redirect(generateUrl("Clients","Clients","CreateSellers"));
    }

    public function SellerUpdateModal(){
        $s_id=$_POST['id'];
        $objSeller= new SellersModel();
        $seller=$objSeller->ConsultSellerById($s_id);
        include_once '../app/Views/clients/modalSellerUpdate.php';

    }

    public function updatePlan(){
        // dd($_POST);
        $date_init=$_POST['date_init'];
        $date_end=$_POST['date_end'];
        $u_email=$_POST['u_email'];
        $template=TemplateModel::SubscriptionUpdatedTemplate($date_end,'Señor/a Usuario');
        $id_subs=$_POST['id_subs'];
        $obj=new SubscriptionModel(); 
        $obj->updateSubscription($id_subs,$date_init,$date_end);
        $mail= new MailModel();
        $mail->DataEmail($template,$u_email,'Actualizacion de suscripcion');
        redirect(generateUrl("Clients","Clients","viewClientPortal"));
    }
    public function CreateSellers(){
        $objS= new SellersModel();
        $sellers=$objS->ConsultSellers();     
        include_once '../app/Views/clients/consultSellersview.php';  
    }
    public function CreateSeller(){

        include_once '../app/Views/clients/modalSellersview.php';  
    }
    public function insertSeller(){
        $objS= new SellersModel();
        $u_name=$_POST['u_name'];
        $u_email=$_POST['u_email'];
        $u_phone=$_POST['u_phone'];
        $u_codeSeller=$_POST['u_codeSeller'];


        // password seller
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = substr(str_shuffle($characters), 0, 12);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        //template user and password
        $template=TemplateModel::TemplateRegister($u_name,$u_email,$password);
        //MAIL
        $mail= new MailModel();
        $mail->DataEmail($template,$u_email,'Credenciales de inicio de sesion');

        
        $objS->insertSeller($u_name,$u_email,$u_phone,$hashedPassword,'3',$_SESSION['IdCompany'],'1',$u_codeSeller);
        redirect(generateUrl("Clients","Clients","CreateSellers"));

    }
    // public function SellerAndCompanyModal(){
    //     $s_id=$_POST['id'];
    //     $objS= new SellersModel();
    //     $companies=$objS->consultCompaniesOfSellerById($s_id);
    //     $objCompany= new CompanyModel();
    //        // Obtener el rol y la empresa del usuario
    //     foreach ($companies as &$company) {
    //         $rol_id ='3';
    //         $c_id = $company['c_id'];
    //         $rolAndCompany = $objCompany->RolAndCompany($c_id, $rol_id);
    //         $company['rol'] = $rolAndCompany; // Asumiendo que el campo de rol se llama 'rol'
    //     }
        
    //     include_once '../app/Views/clients/modalSellerAndCompany.php';  
    // }

    public function DeleteSellerOfCompany(){
        $objSeller= new SellersModel();
        $s_id=$_GET['s_id'];
        $c_id=$_GET['c_id'];
        $objSeller->DeleteSellerOfCompany($s_id,$c_id);
        
    }

    public function addCompanyToSeller(){
        $objCompany= new CompanyModel();
        $s_id=$_POST['id'];
        $companies=$objCompany->ConsultCompaniesUnselected();
        include_once '../app/Views/clients/modalSelectCompanies.php';  
    }
    public function MethodsPayClients(){
        $objMethods= new MethodsPayModel();
        $methods=$objMethods->consultMethods();
        include_once '../app/Views/clients/modalmethodsPay.php';  

    }
    public function LimitCredit(){
        $obj= new CompanyModel();
        $objUser= new UserModel();
        $objCredit= new CreditLimitModel();
            //status
            //1 active
            //2 inactive
        $users=$objUser->consultUsersWithRolAndStatus('3','1');
        foreach ($users as $u => $value) {
            $companies = $obj->consultCompany($value['c_id']);
            $credit= $objCredit->ConsultCreditLimitByIdCompany($value['c_id']);
            $users[$u]['user'] = $companies;
            $users[$u]['credit']=$credit;
        }
        
        include_once '../app/Views/clients/companiesconsultcredit.php';  

    }
    public function UpdateLimitCredit(){
        $c_id=$_POST['c_id'];
        $credit_limit_new=$_POST['credit_limit_new'];
        $objCredit= new CreditLimitModel();
        
        $creditLimit = $objCredit->ConsultCreditLimitByIdCompany($c_id);

        if (empty($creditLimit)) {
            // No hay límite de crédito existente, realizar inserción
            $objCredit->InsertCreditLimitByIdCompany($c_id, $credit_limit_new);
        } else {
            // Hay límite de crédito existente, realizar actualización
            $objCredit->UpdateCreditLimitByIdCompany($c_id, $credit_limit_new);
        }
        
        redirect(generateUrl("Clients","Clients","limitCredit"));
    }

    public function updateCreditLimitModal(){
        $c_id=$_POST['id'];
        $objCompany= new CompanyModel();
        $company=$objCompany->ConsultCompany($c_id);
        $objCredit= new CreditLimitModel();
        foreach ($company as &$c) {
            $c['LimitCredit']=$objCredit->ConsultCreditLimitByIdCompany($c_id);
        }
        include "../app/Views/clients/consultAndUpdateCreditLimit.php";
    }

    public function RegisterCompaniesOnSeller() {
        $selectedCompanyIds = $_POST['selectedCompanyIds'];
        $s_id = $_POST['s_id'];
        $objCompany = new CompanyModel();
        $objS = new SellersModel();
    
        // Convertir la cadena en un array
        $companies = explode(',', $selectedCompanyIds);
        // Recorrer el array de empresas seleccionadas
        foreach ($companies as $c) {
            $objCompany->updateSellerCompany($s_id, $c);
        }
    
        // Obtener las empresas actualizadas del vendedor
        $updatedCompanies = $objS->consultCompaniesOfSellerById($s_id);
        $rows = "";
        // Imprimir las empresas actualizadas
        foreach ($updatedCompanies as $c) {
            $rows .=  '<tr>
            <td>' . $c['c_name'] . '</td>
            <td>' . $c['u_email'] . '</td>
            <td>' . $c['u_phone'] . '</td>
            <td class="text-center">
            <button class="btn btn-outline-success"><i class="fa-solid fa-eye"></i></button>
            </td>
            </tr>';
        }
        // Devolver las filas HTML como respuesta
        echo $rows;
    }
    
    
}






?>