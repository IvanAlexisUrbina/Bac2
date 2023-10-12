<?php
require '../vendor/autoload.php';

use Models\Company\CompanyModel;
use Models\CRM\CRMModel;
use Models\Mail\MailModel;
use Models\MasterModel;
use Models\Meet\MeetModel;
use Models\Priority_states\Priority_statesModel;
use Models\Status\StatusModel;
use Models\Template\TemplateModel;
use Models\User\UserModel;

use function Helpers\dd;
use function Helpers\generateUrl;
use function Helpers\redirect;

class CRMController {
 

    public function insertActivityCRM(){
        // Recuperar los datos del formulario
        $activityType = $_POST['activity-type'];
        $activityArea = $_POST['activity-area'];
        $activityDateInit = $_POST['activity-date-init'];
        $activityDateEnd = $_POST['activity-date-end'];
        $crmDesc = $_POST['crm_desc'];
        $id_prst=$_POST['id_prst'];
        $activityReminderTime = !empty($_POST['activity-reminder-time']) ? $_POST['activity-reminder-time'] : null;
        
        $objCRM = new CRMModel();
        $crmId = $objCRM->insertCRMActivity($activityType, $activityArea, $activityDateInit, $activityDateEnd, $crmDesc, $activityReminderTime,'1',$_SESSION['idUser'],$id_prst);
  
        $companies = !empty($_POST['companies']) ? $_POST['companies'] : [];
        $attendees = !empty($_POST['attendees']) ? $_POST['attendees'] : [];
        $meetingType = !empty($_POST['meetingType']) ? $_POST['meetingType'] : null;
        $meetingLink = !empty($_POST['meetingLink']) ? $_POST['meetingLink'] : null;
        $comments = !empty($_POST['comments']) ? $_POST['comments'] : null;

        // Determinar la longitud del array más largo
        $maxLength = max(count($companies), count($attendees));

        // Iterar hasta la longitud del array más largo
        for ($i = 0; $i < $maxLength; $i++) {
            $companyId = isset($companies[$i]) ? $companies[$i] : null;
            $attendeeId = isset($attendees[$i]) ? $attendees[$i] : null;

            // Llamar a InsertmeetCRMactivity para cada combinación de IDs
            $objCRM->InsertmeetCRMactivity($crmId, $meetingType, $meetingLink, $comments, $attendeeId, $companyId);
        }
        
        redirect(generateUrl("CRM","CRM","consultViewDate"));
    }
    

    public function consultViewDate(){
        // ITEM1
        $objCompanies= new CompanyModel();
        $users= new UserModel();
        $objPriority= new Priority_statesModel();
        $companies=$objCompanies->ConsultCompaniesClients();        
        $usersCompany=$users->consultUsersWithRol();
        $priority_States=$objPriority->consultPriorityStates();
        include_once '../app/Views/crm/createCRMview.php';
    }

    public function UpdateDetaillsActivity(){
        $act_id=$_POST['act_id'];
        $objCRM= new CRMModel();
        $objUser= new UserModel();
        $objCompany= new CompanyModel();
        $activity=$objCRM->consultCRMActivityById($act_id);  
        $companies=$objCompany->ConsultCompaniesClients();  
        $usersCompany=$objUser->consultUsersWithRol(3); 
        foreach ($activity as &$acti) {
            $acti['assignor'] = $objUser->getUserInfoById($acti['assignor_id']);
          
            // Obtener los IDs de los asistentes
            $attendeeIDs = $objCRM->consultAttendees($acti['crm_id']);            
            // Inicializar un arreglo para almacenar la información de los asistentes
            $attendeesInfo = [];
            // Obtener la información de cada asistente
            
            foreach ($attendeeIDs as $attendeeID) {
                $attendeesInfo[] = $objUser->getUserInfoById($attendeeID['u_id']);
            }
            // Almacenar la información de los asistentes en el array de actividad
            $acti['attendees'] = $attendeesInfo;

            
            $ClientsIDs = $objCRM->consultClientsActivity($acti['crm_id']);
            $clientsInfo=[];
            foreach ($ClientsIDs as $clientID) {
                $clientsInfo[] =  $objCompany->ConsultCompany($clientID['c_id']);
            }
            // Almacenar la información de los asistentes en el array de actividad
            $acti['clients'] = $clientsInfo;
            $acti['meetingDetaills']=$objCRM->consultCRM_MEETINGbyId($act_id);
        }

        
        include_once '../app/Views/crm/viewUpdateActivity.php';        
    }


    public function consultActivities(){
        $objCRM= new CRMModel(); 
        $objUser= new UserModel();
        $objCompany= new CompanyModel();
        $objPriority= new Priority_statesModel();
        $objStatus= new StatusModel();
        $activities=$objCRM->consultCRMactivities($_SESSION['RolUser'],$_SESSION['idUser']);
        foreach ($activities as &$activity) {
            $activity['assignor'] = $objUser->getUserInfoById($activity['assignor_id']);
            $activity['priority']=$objPriority->consultPriorityById($activity['id_prst']);
            $activity['status']=$objStatus->consultStatusById($activity['crm_status']);
            // Obtener los IDs de los asistentes
            $attendeeIDs = $objCRM->consultAttendees($activity['crm_id']);            
            // Inicializar un arreglo para almacenar la información de los asistentes
            $attendeesInfo = [];
            // Obtener la información de cada asistente
            
            foreach ($attendeeIDs as $attendeeID) {
                $attendeesInfo[] = $objUser->getUserInfoById($attendeeID['u_id']);
            }
            
            // Almacenar la información de los asistentes en el array de actividad
            $activity['attendees'] = $attendeesInfo;

            
            $ClientsIDs = $objCRM->consultClientsActivity($activity['crm_id']);
            $clientsInfo=[];
            foreach ($ClientsIDs as $clientID) {
                $clientsInfo[] =  $objCompany->ConsultCompany($clientID['c_id']);
            }
            // Almacenar la información de los asistentes en el array de actividad
            $activity['clients'] = $clientsInfo;
            //  dd($activities);
        }
        
        include_once '../app/Views/crm/viewCRMtable.php';
    }

  
    

    public function consutlDetaillsActivity(){
        $act_id=$_POST['act_id'];
        $objCRM= new CRMModel();
        $objUser= new UserModel();
        $objCompany= new CompanyModel();
        $activity=$objCRM->consultCRMActivityById($act_id);
        
        foreach ($activity as &$acti) {
       

            $acti['assignor'] = $objUser->getUserInfoById($acti['assignor_id']);
          
            // Obtener los IDs de los asistentes
            $attendeeIDs = $objCRM->consultAttendees($acti['crm_id']);            
            // Inicializar un arreglo para almacenar la información de los asistentes
            $attendeesInfo = [];
            // Obtener la información de cada asistente
            
            foreach ($attendeeIDs as $attendeeID) {
                $attendeesInfo[] = $objUser->getUserInfoById($attendeeID['u_id']);
            }
            // Almacenar la información de los asistentes en el array de actividad
            $acti['attendees'] = $attendeesInfo;

            
            $ClientsIDs = $objCRM->consultClientsActivity($acti['crm_id']);
            $clientsInfo=[];
            foreach ($ClientsIDs as $clientID) {
                $clientsInfo[] =  $objCompany->ConsultCompany($clientID['c_id']);
            }
            // Almacenar la información de los asistentes en el array de actividad
            $acti['clients'] = $clientsInfo;


            $acti['meetingDetaills']=$objCRM->consultCRM_MEETINGbyId($act_id);
            //  dd($activities);
        }
        // dd($activity[0]['meetingDetaills']);
        include_once '../app/Views/crm/viewDetaillsActivity.php';
        
    }

    public function sendNotificationEmail(){
       $companies=$_POST['companies'];
       $attendees=$_POST['attendees'];
       $meetingDate=$_POST['meetingDate'];
       $meetingTime=$_POST['meetingTime'];
       $meetingLink=$_POST['meetingLink'];
       $meetingType=$_POST['meetingType'];
       $comments=$_POST['comments'];
       $users=new UserModel();
       $mail= new MailModel();
       $CRM= new CRMModel();
       $meet= new MeetModel();
       $meet->insertMeeting($meetingDate,$meetingTime,$meetingType,$meetingLink,$comments);  
       $lastIdMeet=$CRM->getLastId('meeting','meeting_id');   
       foreach ($companies as $c) { 
        $meet->insertMeetingAttendee($lastIdMeet,null,$c);
            $Company_users=$users->consultEmailsAndNameOfTheCompany($c);
            foreach ($Company_users as $c_u) {        
                $template=TemplateModel::TemplateMeetingScheduledNotification($c_u['u_name'],$meetingDate,$meetingTime,$meetingLink,$comments);
                $mail->DataEmail($template,$c_u['u_email'],$meetingType);
                
            }
       }
       foreach ($attendees as $att) {
            $user=$users->getUserInfoById($att);
            $meet->insertMeetingAttendee($lastIdMeet,$user['u_id'],null);
            $template=TemplateModel::TemplateMeetingScheduledNotification($user['u_name'],$meetingDate,$meetingTime,$meetingLink,$comments);
            $mail->DataEmail($template,$user['u_email'],$meetingType);         
       }
    }

    public function ConsutlDiaryView(){

        include_once '../app/Views/crm/consultDiaryView.php';
    }
    
   
    
}

?>