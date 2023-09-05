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

    public function consultRequest(){
        $sql = "SELECT * FROM purchase_requests";
        $params=[];
        $result=$this->select($sql,$params);
        return $result;
    }

    public function insertRequest($pr_reason, $pr_quantity, $pr_date_request, $pr_status_request, $u_id){
        $sql = "INSERT INTO purchase_requests 
                (pr_reason, pr_quantity, pr_date_request, pr_status_request, u_id) 
                VALUES (:pr_reason, :pr_quantity, :pr_date_request, :pr_status_request, :u_id)";
        $params = [':pr_reason'=>$pr_reason, 
                    ':pr_quantity'=>$pr_quantity,
                    ':pr_date_request'=>$pr_date_request, 
                    ':pr_status_request'=>$pr_status_request,
                    ':u_id'=>$u_id];
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