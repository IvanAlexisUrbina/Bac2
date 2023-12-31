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
    public function consultArticlesOfTheRequest($pr_id){
        $sql = "SELECT * FROM purchase_request_articles
                WHERE pr_id = :id";
        $params = [':id' => $pr_id];
        $articles = $this->select($sql, $params);
        return $articles;
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

    public function insertPurchaseRequest($pr_desc, $pr_quantity,$pr_url_document, $u_id,$status_id,$type_id,$c_id=null){
        $sql = "INSERT INTO purchase_requests (pr_desc, pr_quantity,pr_url_document, u_id, state_id,type_id,c_id) 
                VALUES (:pr_desc, :pr_quantity,:pr_url_document, :u_id, :state_id,:type_id,:c_id)";
        $params = [
            ':pr_desc' => $pr_desc,
            ':pr_quantity' => $pr_quantity,
            ':pr_url_document' => $pr_url_document,
            ':u_id' => $u_id,
            ':state_id' => $status_id,
            ':type_id'=>$type_id,
            ':c_id'=>$c_id
        ];
        $this->insert($sql, $params);
    }
    
    public function insertPurchaseArticle($pr_id, $ar_id, $quantity, $priceNormal, $discountPercentajeOrPrice, $discountPrice)
    {
        $sql = "INSERT INTO purchase_request_articles (pr_id, ar_id, reqart_quantity, reqart_pricenormal, reqart_discountPercentajeOrPrice, reqart_discountPrice)
                VALUES (:pr_id, :ar_id, :quantity, :priceNormal, :discountPercentajeOrPrice, :discountPrice)";
        $params = [
            ':pr_id' => $pr_id,
            ':ar_id' => $ar_id,
            ':quantity' => $quantity,
            ':priceNormal' => $priceNormal,
            ':discountPercentajeOrPrice' => $discountPercentajeOrPrice,
            ':discountPrice' => $discountPrice,
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