<?php

class PaisesModel extends CI_Model
{
    public function getAll(){
        $this->db->order_by('pais', 'ASC');
        $result = $this->db->get('paises');
        $listaPaises = $result->result_array();
        return $listaPaises;
    }
}