<?php

class RutasComentariosModel extends CI_Model
{
    public function getComentarioRutaDia($idRutaDia){
        $this->db->where('IdRutaDia', $idRutaDia);
        $result = $this->db->get('rutas_comentarios');
        $ruta = $result->result_array();
        return $ruta;
    }

    
}