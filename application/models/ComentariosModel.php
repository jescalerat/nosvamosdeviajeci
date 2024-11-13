<?php

class ComentariosModel extends CI_Model
{
    public function getComentario($idVisitado){
        $this->db->where('IdVisitado', $idVisitado);
        $result = $this->db->get('comentarios');
        $comentario = $result->result_array();
        
        return $comentario;
    }
}