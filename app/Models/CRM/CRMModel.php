<?php

namespace Models\CRM;

use Models\MasterModel;

Class CRMModel extends MasterModel
{

   
    public function ConsultCreditLimitByIdCompany(int $c_id){
        $sql="SELECT *  FROM dateCrm";
        $params=[':c_id'=>$c_id];
        $result=$this->select($sql,$params);
        return $result;
    }
    
    

}

?>