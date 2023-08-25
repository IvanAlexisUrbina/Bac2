<?php

namespace Models\Sellers;

require '../vendor/autoload.php';

use Models\MasterModel;


class SellersModel extends MasterModel
{

    public function ConsultSellerById(int $s_id){
        $sql="SELECT * FROM sellers WHERE s_id=:s_id";
        $params=[':s_id'=>$s_id];
        $seller=$this->select($sql,$params);
        return $seller;
    }
    public function ConsultSellerByIdOfCompany(int $company_id){
        $sql="SELECT sellers.*,company.* 
        FROM sellers
        INNER JOIN company
        ON sellers.s_id=company.s_id
        WHERE company.c_id=:c_id";
        $params=[':c_id'=>$company_id];
        $seller=$this->select($sql,$params);
        return $seller;
    }
    public function ConsultSellers(){
        $sql="SELECT * FROM sellers";
        $params=[];
        $sellers=$this->select($sql,$params);
        return $sellers;
    }
    public function insertSeller($s_name, $s_email, $s_phone, $s_code) {
        $sql = "INSERT INTO sellers (s_name, s_email, s_phone, s_code)
                VALUES (:s_name, :s_email, :s_phone, :s_code)";
        $params = array(
            ':s_name' => $s_name,
            ':s_email' => $s_email,
            ':s_phone' => $s_phone,
            ':s_code' => $s_code
        );
        $this->insert($sql, $params);
    }
    public function updateSeller($s_id, $s_name, $s_email, $s_phone, $s_code) {
        $sql = "UPDATE sellers SET
                s_name = :s_name,
                s_email = :s_email,
                s_phone = :s_phone,
                s_code = :s_code
                WHERE s_id = :s_id";
        $params =[
            ':s_id' => $s_id,
            ':s_name' => $s_name,
            ':s_email' => $s_email,
            ':s_phone' => $s_phone,
            ':s_code' => $s_code
        ];
        $this->update($sql, $params);
    }
    
    public function consultCompaniesOfSellerById(int $s_id){
        $sql="SELECT company.*,sellers.*,users.*
              FROM sellers
              INNER JOIN company
              ON company.s_id=sellers.s_id
              INNER JOIN users
              ON company.c_id=users.c_id
              WHERE company.s_id=:s_id
              AND users.rol_id='3'";
        $params=[':s_id'=>$s_id];
        $companies=$this->select($sql,$params);
        return $companies;
    }

    public function DeleteSellerOfCompany($s_id,$c_id){
        $sql = "UPDATE company SET s_id = NULL WHERE c_id = :c_id";
        $params = [
            ':c_id' => $c_id
        ];
        $this->update($sql, $params);
    }

}

?>