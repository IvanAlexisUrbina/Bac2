<?php

namespace Models\Priority_states;

use Models\MasterModel;

Class Priority_statesModel extends MasterModel
{

    public function consultPriorityById($id_prst)
    {   
        $result = $this->selectById('priority_states', 'id_prst ', $id_prst );
        return $result;
    }

    public function consultPriorityStates(){

        // Consulta para obtener los usuarios de una compañía específica
        $sql = "SELECT * FROM priority_states ";
        $params = [];
        $states = $this->select($sql, $params);
        return $states;
    }





}

?>