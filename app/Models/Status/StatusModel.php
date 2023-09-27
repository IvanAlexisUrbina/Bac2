<?php

namespace Models\Status;

require '../vendor/autoload.php';

use Models\MasterModel;


class StatusModel extends MasterModel
{

    public function consultStatus(){
        $sql = "SELECT * FROM `status`";
        $params = [];
        $result = $this->select($sql, $params); 
        return $result;
    }

    public function consultStatusById(int $status_id){    
        $result = $this->selectById('`status`', 'status_id', $status_id);
        return $result;
    }

    
}

?>