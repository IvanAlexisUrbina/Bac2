<?php

namespace Models\MethodsPay;

use Models\MasterModel;

Class MethodsPayModel extends MasterModel
{


    public function consultMethods()
    {
        $sql = "SELECT * FROM payment_methods";
        $params = [];
        $methods = $this->select($sql, $params);
        return $methods;
    }
    
    public function consultMethodsById(int $payment_method_id)
    {
        $sql = "SELECT * FROM payment_methods
                WHERE payment_method_id=:pay_id";
        $params = [':pay_id'=>$payment_method_id];
        $method= $this->select($sql, $params);
        return $method;
    }




}

?>