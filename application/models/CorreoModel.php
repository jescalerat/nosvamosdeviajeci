<?php

class CorreoModel extends CI_Model
{
    public function getAll(){
        $this->db->order_by('IdCorreo', 'DESC');
        $result = $this->db->get('correo');
        $correos = $result->result_array();
        return $correos;
    }

    public function guardar($nuevoDato){
        $this->db->insert('correo', $nuevoDato);
    }

    public function eliminar($idCorreo){
        $this->db->where('IdCorreo', $idCorreo);
        $this->db->delete('correo');
    }
}