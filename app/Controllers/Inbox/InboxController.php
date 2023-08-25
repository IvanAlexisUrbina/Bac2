<?php
require '../vendor/autoload.php';

use Models\Company\CompanyModel;
use Models\Inbox\InboxModel;
use Models\Mail\MailModel;
use Models\Template\TemplateModel;
use Models\Types_industry\Types_industryModel;
use Models\User\UserModel;
use PhpOffice\PhpSpreadsheet\Calculation\Information\Value;

use function Helpers\dd;
use function Helpers\generateUrl;
use function Helpers\redirect;

class InboxController
{
 
    public function viewInbox() {
        $objUser = new UserModel();
        $objCompany = new CompanyModel();
        // status inactive  
        $companies = $objCompany->selectById('company', 'status_id', 2);        
        // status inactive  
        foreach ($companies as $c => $value) {
            $users = $objUser->getUsersByRoleCompanyAndStatus('3', $value['c_id'], '2');
            $companies[$c]['representant'] = $users; // Almacenar los usuarios en la posición correspondiente de la compañía
        } 

        //status pending
        $companiesPendig = $objCompany->selectById('company', 'status_id', 3);  
        //status pending
        foreach ($companiesPendig as $key => $value) {
            $users = $objUser->getUsersByRoleCompanyAndStatus('3', $value['c_id'], '3');
            $companiesPendig[$key]['representant'] = $users; // Almacenar los usuarios en la posición correspondiente de la compañía
        }  

        include_once '../app/Views/inbox/viewInboxClients.php';
    }
    
    public function viewRequestRegister(){
        $id_company=$_POST['id'];
        $objCompany= new CompanyModel();
        $objUser = new UserModel();
        $objIndustry= new Types_industryModel();
       
        $company=$objCompany->consultCompany($id_company);
        foreach ($company as $c => $value) {
            $user = $objUser->getUsersByRoleCompanyAndStatus('3', $value['c_id'], '2');
            $company[$c]['representant'] = $user; // Almacenar los usuarios en la posición correspondiente de la compañía
            $company[$c]['Industry']=$objIndustry->consultTypes_industryById($value['tpi_id']);
        }  
        // dd($company);  
        include_once '../app/Views/inbox/modalViewRequest.php';
    }

    public function processRegistrationRequest(){
        $c_id=$_POST['c_id'];
        $u_id=$_POST['u_id'];
        $rejectOrAccept=$_POST['rejectOrAccept'];
        // dd($_POST);
        if ($rejectOrAccept == 'accept') {
            $objCompany= new CompanyModel();
            $objCompany->updateStatusCompany('1',$c_id);
            $objUser=new UserModel();
            $objUser->updateStatusUser('1',$u_id);
            $mail= new MailModel();
            $user=$objUser->getUserInfoById($u_id);
            $template=TemplateModel::TemplateRegister($user['u_name'].' '.$user['u_lastname'],$user['u_email'],'Utilizada en el registro');   
            $mail->DataEmail($template,$user['u_email'],'Notificacion de registro');   
        }elseif ($rejectOrAccept == 'reject') {
            $objUser=new UserModel();
            $user=$objUser->getUserInfoById($u_id);
            $template=TemplateModel::TemplateRejectRegistration($user['u_name'].' '.$user['u_lastname'],'Lo sentimos, pero no hemos podido procesar su solicitud de registro debido a que Los documentos proporcionados no están completos o contienen información errónea.');   
            $objUser->deleteUser($u_id);
            $objCompany= new CompanyModel();
            $objCompany->deleteCompany($c_id);
            $mail= new MailModel();
            $mail->DataEmail($template,$user['u_email'],'Notificacion de registro');
        }
        redirect(generateUrl("Inbox","Inbox","viewInbox"));
    }

}






?>