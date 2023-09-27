<?php
namespace Models\CRM;
use Models\MasterModel;
use PDOException;

Class CRMModel extends MasterModel
{

    public function consultCRMActivities(int $userRole, int $userID) {
        try {
            $sql = "SELECT * FROM crm";
            $params = [];
    
            if ($userRole == 3) {
                $sql .= " WHERE u_id = :u_id";
                $params = [':u_id' => $userID];
            }
    
            // Ejecutar la consulta aquí y obtener los resultados
            $results = $this->select($sql, $params);
    
            // Devolver los resultados (puedes manejarlos según tus necesidades)
            return $results;
        } catch (PDOException $e) {
            // Manejo de errores: Puedes personalizar el manejo de errores aquí
            echo "Error al consultar las actividades CRM: " . $e->getMessage();
            return false;
        }
    }

    public function consultCRM_MEETINGbyId(int $crm_id){

        try {
            $sql = "SELECT meeting_type, meeting_link, comments 
                    FROM crm_meeting WHERE crm_id = :crm_id";
            $params = [':crm_id' => $crm_id];
            
    
            // Ejecutar la consulta aquí y obtener los resultados
            $results = $this->select($sql, $params);
    
            // Devolver los resultados (puedes manejarlos según tus necesidades)
            return $results;
        } catch (PDOException $e) {
            // Manejo de errores: Puedes personalizar el manejo de errores aquí
            echo "Error al consultar la actividad CRM: " . $e->getMessage();
            return false;
        }

    }


    public function consultCRMActivityById(int $activityID) {
        try {
            $sql = "SELECT * FROM crm WHERE crm_id = :activity_id";
            $params = [':activity_id' => $activityID];
    
            // Ejecutar la consulta aquí y obtener los resultados
            $results = $this->select($sql, $params);
    
            // Devolver los resultados (puedes manejarlos según tus necesidades)
            return $results;
        } catch (PDOException $e) {
            // Manejo de errores: Puedes personalizar el manejo de errores aquí
            echo "Error al consultar la actividad CRM: " . $e->getMessage();
            return false;
        }
    }
    
    public function consultAttendees(int $crm_id){
        try {
            $sql = "SELECT crm_meeting.u_id
                    FROM crm_meeting
                    WHERE crm_id=:crm_id";
            $params = [':crm_id'=>$crm_id];
            // Ejecutar la consulta aquí y obtener los resultados
            $results = $this->select($sql, $params);
    
            // Devolver los resultados (puedes manejarlos según tus necesidades)
            return $results;
        } catch (PDOException $e) {
            // Manejo de errores: Puedes personalizar el manejo de errores aquí
            echo "Error al consultar las actividades CRM: " . $e->getMessage();
            return false;
        }
    }
    
    public function consultClientsActivity(int $crm_id){
        try {
            $sql = "SELECT crm_meeting.c_id
                    FROM crm_meeting
                    WHERE crm_id=:crm_id";
            $params = [':crm_id'=>$crm_id];
            // Ejecutar la consulta aquí y obtener los resultados
            $results = $this->select($sql, $params);
            // Devolver los resultados (puedes manejarlos según tus necesidades)
            return $results;
        } catch (PDOException $e) {
            // Manejo de errores: Puedes personalizar el manejo de errores aquí
            echo "Error al consultar las actividades CRM: " . $e->getMessage();
            return false;
        }
    }


    public function insertCRMActivity($activity, $area, $dateTimeInit, $dateTimeEnd, $desc, $reminder,$crm_status,$assignor_id,$id_prst) {
        try {
            // Preparar la consulta SQL
            $sql = "INSERT INTO crm (crm_activity, crm_area, crm_date_time_init, crm_date_time_end, crm_desc, crm_reminder,crm_status,assignor_id,id_prst) 
                    VALUES (:activity, :area, :dateTimeInit, :dateTimeEnd, :desc, :reminder,:crm_status,:assignor_id,:id_prst)";

            $params = [

            // Asignar valores a los parámetros
            ':activity'=> $activity,
            ':area'=> $area,
            ':dateTimeInit'=> $dateTimeInit,
            ':dateTimeEnd'=> $dateTimeEnd,
            ':desc'=> $desc,
            ':reminder'=> $reminder,
            ':crm_status'=> $crm_status,
            ':assignor_id'=> $assignor_id,
            ':id_prst'=> $id_prst
            ];
            // Ejecutar la consulta
            $this->insert($sql, $params);
            return $this->getLastId('crm','crm_id');
            
        } catch (PDOException $e) {
            // Manejo de errores: Puedes personalizar el manejo de errores aquí
            echo "Error al insertar en la tabla CRM: " . $e->getMessage();
            return false;
        }
    }

    public function consultStatusActitvity(int $act_id){

        try {
            // Preparar la consulta SQL
            $sql = "SELECT * FROM activity_status WHERE act_status_id=:act_id";
            $params = [
            // Asignar valores a los parámetros
            ':act_id'=> $act_id
            ];
            // Ejecutar la consulta
            $result=$this->select($sql, $params);
            return $result;
        } catch (PDOException $e) {
            // Manejo de errores: Puedes personalizar el manejo de errores aquí
            echo "Error al insertar en la tabla CRM: " . $e->getMessage();
            return false;
        }
    }


    public function InsertmeetCRMactivity($crmId, $meetingType, $meetingLink, $comments, $uId, $cId){
        try {
            // Preparar la consulta SQL
            $sql = "INSERT INTO crm_meeting (crm_id,  meeting_type, meeting_link, comments, u_id, c_id) 
            VALUES (:crmId,  :meetingType, :meetingLink, :comments, :uId, :cId)";

            $params = [
            // Asignar valores a los parámetros
            ':crmId'=> $crmId,
            ':meetingType'=> $meetingType,
            ':meetingLink'=> $meetingLink,
            ':comments'=> $comments,
            ':uId'=> $uId,
            ':cId'=> $cId
            ];
            // Ejecutar la consulta
            $this->insert($sql, $params);

        } catch (PDOException $e) {
            // Manejo de errores: Puedes personalizar el manejo de errores aquí
            echo "Error al insertar en la tabla CRM: " . $e->getMessage();
            return false;
        }
    }

}

?>