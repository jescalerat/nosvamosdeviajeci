<?php

class CorreoModel extends CI_Model
{
    public function getAll(){
        $result = $this->db->get('correo');
        $contador = $result->result_array();
        return $contador;
    }

    public function guardar($nuevoDato){
        $this->db->insert('correo', $nuevoDato);
    }
}