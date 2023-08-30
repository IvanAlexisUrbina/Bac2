<?php

namespace Models\Sellers;

require '../vendor/autoload.php';

use Models\MasterModel;


class SellersModel extends MasterModel
{

    public function ConsultSellerById(int $u_id){
        $sql="SELECT * FROM users WHERE u_id=:u_id";
        $params=[':u_id'=>$u_id];
        $seller=$this->select($sql,$params);
        return $seller;
    }
    public function ConsultSellerByIdOfCompany(int $company_id){
        $sql="SELECT users.*,company.* 
        FROM users
        INNER JOIN company
        ON users.u_id=company.u_id
        WHERE company.c_id=:c_id";
        $params=[':c_id'=>$company_id];
        $seller=$this->select($sql,$params);
        return $seller;
    }
    public function ConsultSellers(){
        $sql="SELECT * FROM users WHERE rol_id='3'";
        $params=[];
        $sellers=$this->select($sql,$params);
        return $sellers;
    }
    
    public function insertSeller($u_name, $u_email, $u_phone,$hashedPassword,$rol_id,$c_id,$status_id,$u_codeSeller,) {
        $sql = "INSERT INTO users (u_name, u_email, u_phone,u_pass,rol_id,c_id,status_id,u_codeSeller)
                VALUES (:u_name, :u_email, :u_phone,:u_pass,:rol_id,:c_id,:status_id,:u_codeSeller)";
        $params = array(
            ':u_name' => $u_name,
            ':u_email' => $u_email,
            ':u_phone' => $u_phone,
            ':u_pass' => $hashedPassword,
            ':rol_id' => $rol_id,
            ':c_id' => $c_id,
            ':status_id' => $status_id,
            ':u_codeSeller' => $u_codeSeller
        );

        $this->insert($sql, $params);
    }

    public function updateSeller($u_id, $u_name, $u_email, $u_phone, $u_codeSeller) {
        $sql = "UPDATE users SET
                u_name = :u_name,
                u_email = :u_email,
                u_phone = :u_phone,
                u_codeSeller = :u_codeSeller
                WHERE u_id = :u_id";
        $params =[
            ':u_id' => $u_id,
            ':u_name' => $u_name,
            ':u_email' => $u_email,
            ':u_phone' => $u_phone,
            ':u_codeSeller' => $u_codeSeller
        ];
        $this->update($sql, $params);
    }
    
    public function consultCompaniesOfSellerById(int $u_id){
        $sql="SELECT company.*,sellers.*,users.*
              FROM sellers
              INNER JOIN company
              ON company.s_id=sellers.s_id
              INNER JOIN users
              ON company.c_id=users.c_id
              WHERE company.s_id=:s_id
              AND users.rol_id='3'";
        $params=[':s_id'=>$u_id];
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