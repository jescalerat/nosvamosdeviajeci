<?php

class ContadorModel extends CI_Model
{
    public function getAll(){
        $result = $this->db->get('contador');
        $contador = $result->result_array();
        return $contador;
    }

    public function guardar($nuevoDato){
        $this->db->set('Contador', $nuevoDato);
        $this->db->where('IdContador', 1);
        $this->db->update('contador');
    }
}