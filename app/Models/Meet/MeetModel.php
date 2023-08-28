<?php

namespace Models\Meet;

use Models\MasterModel;

Class MeetModel extends MasterModel
{

    public function insertMeeting($meetingDate, $meetingTime, $meetingType, $meetingLink, $comments) {
        $sql = "INSERT INTO meeting (meeting_date, meeting_time, meeting_type, meeting_link, comments)
                VALUES (:meetingDate, :meetingTime, :meetingType, :meetingLink, :comments)";
        
        $params = array(
            ':meetingDate' => $meetingDate,
            ':meetingTime' => $meetingTime,
            ':meetingType' => $meetingType,
            ':meetingLink' => $meetingLink,
            ':comments' => $comments
        );
        
        $this->insert($sql, $params);
    }
    
    public function insertMeetingAttendee($meetingId, $userId, $companyId) {
        $sql = "INSERT INTO meeting_attendees (meeting_id, u_id, c_id)
                VALUES (:meetingId, :userId, :companyId)";
        
        $params = [
            ':meetingId' => $meetingId,
            ':userId' => $userId,
            ':companyId' => $companyId
        ];
        
        $this->insert($sql, $params);
    }
     
    public function getMeetingAttendees($meetingId) {
        $sql = "SELECT * FROM meeting_attendees 
                WHERE meeting_id = :meetingId";
        $params = [':meetingId' => $meetingId];
        // Aquí asumes que tienes una conexión a la base de datos llamada $pdo
        $result=$this->select($sql, $params);
        return $result;
    }
    
    public function getMeeting() {
        $sql = "SELECT * FROM meeting";
        $params = [];
        // Aquí asumes que tienes una conexión a la base de datos llamada $pdo
        $result=$this->select($sql, $params);
        return $result;
    }
    


}

?>