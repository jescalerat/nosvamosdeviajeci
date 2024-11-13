<?php

class VisitasModel extends CI_Model
{
    public function getAll(){
        $result = $this->db->get('visitas');
        $visitas = $result->result_array();
        return $visitas;
    }
}