<?php

class ProvinciasModel extends CI_Model
{
    public function getAll(){
        $this->db->order_by('provincia', 'ASC');
        $result = $this->db->get('provincias');
        $listaProvincias = $result->result_array();
        return $listaProvincias;
    }

    public function getProvinciaComunidades($idComunidad){
        $this->db->where('IdComunidad', $idComunidad);
        $this->db->order_by('provincia', 'ASC');
        $result = $this->db->get('provincias');
        $listaProvincias = $result->result_array();
        
        return $listaProvincias;
    }
}