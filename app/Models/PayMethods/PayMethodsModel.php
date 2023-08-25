<?php

namespace Models\PayMethods;

use Models\MasterModel;

Class PayMethodsModel extends MasterModel
{

    public function consultPayMethods()
    {
            $sql = "SELECT * FROM payment_methods";
            $params = [];
            $methods = $this->select($sql, $params);

        return $methods;
    }

    public function insertPayMethods(string $name){
        $sql= "INSERT INTO payment_methods (name)
               VALUES(:name)";
        $params=[':name'=>$name];
        $this->insert($sql, $params);
    }
    
    

} 


?>