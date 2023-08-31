<?php

namespace Models\Sellers_customers;

require '../vendor/autoload.php';

use Models\MasterModel;


class Sellers_customersModel extends MasterModel
{

    public function ConsultSellerByIdOfCustomer(int $c_id){
        $sql="SELECT * FROM sellers_customers WHERE c_id=:c_id";
        $params=[':c_id'=>$c_id];
        $seller=$this->select($sql,$params);
        return $seller[0];
    }

    public function InsertSellerWithCustomer(int $u_id,int $c_id){
        $sql="INSERT INTO sellers_customers (u_id,c_id)
              VALUES (:u_id,:c_id)";
        $params=[':u_id'=>$u_id,
                 ':c_id'=>$c_id];
        $this->insert($sql,$params);
    }
    
    public function DeleteSellerWithCustomer(int $c_id){
        $sql = "DELETE FROM sellers_customers
                WHERE c_id = :c_id";
        $params = [':c_id' => $c_id];
        $this->delete($sql, $params);
    }
    
    
    

}

?>