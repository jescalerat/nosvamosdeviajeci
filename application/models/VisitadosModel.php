<?php

class VisitadosModel extends CI_Model
{
    public function getVisitado($idVisitado){
        $this->db->where('IdVisitado', $idVisitado);
        $result = $this->db->get('visitados');
        $visitado = $result->result_array();
        
        return $visitado;
    }
}