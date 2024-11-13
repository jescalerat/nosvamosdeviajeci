<?php

class ComunidadesModel extends CI_Model
{
    public function getAll(){
        $this->db->order_by('comunidad', 'ASC');
        $result = $this->db->get('comunidades');
        $listaComunidades = $result->result_array();
        return $listaComunidades;
    }

    public function getComunidadesPais($idPais){
        $this->db->where('IdPais', $idPais);
        $this->db->order_by('comunidad', 'ASC');
        $result = $this->db->get('comunidades');
        $listaComunidades = $result->result_array();
        
        return $listaComunidades;
    }
}