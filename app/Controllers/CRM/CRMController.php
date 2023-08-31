<?php
require '../vendor/autoload.php';

use Models\Company\CompanyModel;
use Models\CRM\CRMModel;
use Models\Mail\MailModel;
use Models\MasterModel;
use Models\Meet\MeetModel;
use Models\Template\TemplateModel;
use Models\User\UserModel;

use function Helpers\dd;
use function Helpers\generateUrl;
use function Helpers\redirect;

class CRMController {
 

    public function consultViewDate(){
        // ITEM1
        $objCompanies= new CompanyModel();
        $users= new UserModel();
        $companies=$objCompanies->consultCompanies();        
        $usersCompany=$users->consultUsersWithRol(2);  
        // ITEM2
        // $meet= new MeetModel();
        // $meeting=$meet->getMeeting();
        // foreach ($meeting as $m) {
        //     $attendees=$meet->getMeetingAttendees($m['meeting_id']);
        // }
        // $users= new UserModel();
        // foreach ($attendees as $att) {
           
        // }
        include_once '../app/Views/crm/createCRMview.php';
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