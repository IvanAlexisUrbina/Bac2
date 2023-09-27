<?php

namespace Models\Purchase_request;

use Models\MasterModel;

Class Purchase_requestModel extends MasterModel
{

    public function consultRequestById($id)
    {   
        $result = $this->selectById('purchase_requests', 'pr_id', $id);
        return $result;
    }

    public function consultRequestByIdUser($u_id){
        $result = $this->selectById('purchase_requests', 'u_id', $u_id);
        return $result;
    }

    public function consultPurchaseRequestStatesById(int $state_id){
        $result = $this->selectById('purchase_request_states', 'state_id', $state_id);
        return $result;
    }
    public function consultPurchaseRequestTypesById(int $type_id){
        $result = $this->selectById('purchase_request_types', 'type_id', $type_id);
        return $result;
    }

    public function insertPurchaseRequestType($type_name){
        $sql = "INSERT INTO purchase_request_types (type_name) VALUES (:type_name)";
        $params = [':type_name' => $type_name];
        $this->insert($sql, $params);
        // Devuelve el ID del último registro insertado
        return $this->getLastId('purchase_request_types', 'type_id');
    }
    

    public function consultPurchaseRequestTypes(){
        $sql = "SELECT * FROM purchase_request_types";
        $params=[];
        $result=$this->select($sql,$params);
        return $result;
    }

    public function consultPurchaseRequestStates(){
        $sql = "SELECT * FROM purchase_request_states";
        $params=[];
        $result=$this->select($sql,$params);
        return $result;
    }
    public function insertPurchaseRequestState($state_name){
        $sql = "INSERT INTO purchase_request_states (state_name) VALUES (:state_name)";
        $params = [':state_name' => $state_name];
        $this->insert($sql, $params);
        // Devuelve el ID del último registro insertado
        return $this->getLastId('purchase_request_states','state_id ');
    }
    
   

    public function consultRequest(){
        $sql = "SELECT purchase_requests.*,purchase_request_states.state_name,purchase_request_types.type_name
                FROM purchase_requests
                INNER JOIN purchase_request_states
                ON purchase_request_states.state_id=purchase_requests.state_id
                INNER JOIN purchase_request_types
                ON purchase_request_types.type_id=purchase_requests.type_id";
        $params=[];
        $result=$this->select($sql,$params);
        return $result;
    }

    public function insertPurchaseRequest($pr_desc, $pr_quantity, $u_id,$status_id,$type_id){
        $sql = "INSERT INTO purchase_requests (pr_desc, pr_quantity, u_id, state_id,type_id) 
                VALUES (:pr_desc, :pr_quantity, :u_id, :state_id,:type_id)";
        $params = [
            ':pr_desc' => $pr_desc,
            ':pr_quantity' => $pr_quantity,
            ':u_id' => $u_id,
            ':state_id' => $status_id,
            ':type_id'=>$type_id
        ];
        $this->insert($sql, $params);
    }
    
    

    // public function updatePrice($ar_id, $wh_id, $p_value,$p_id)
    // {
    //     $sql = "UPDATE prices
    //             SET p_value = :p_value,wh_id=:wh_id
    //             WHERE ar_id = :ar_id AND p_id = :p_id";

    //     $params = [
    //         ':ar_id' => $ar_id,
    //         ':wh_id' => $wh_id,
    //         ':p_value' => $p_value,
    //         ':p_id'=>$p_id
    //     ];

    //     $this->update($sql, $params);
    // }



}

?>