<?php

class VisitasModel extends CI_Model
{
    public function getAll(){
        $result = $this->db->get('Visitas');
        $visitas = $result->result_array();
        return $visitas;
    }
}