<?php

class RutasComentariosModel extends CI_Model
{
    public function getComentarioRutaDia($idRutaDia){
        $this->db->where('IdRutaDia', $idRutaDia);
        $result = $this->db->get('rutas_comentarios');
        $ruta = $result->result_array();
        return $ruta;
    }

    public function getComentarioRuta($idRutaComentario){
        $this->db->where('IdRutaComentario', $idRutaComentario);
        $result = $this->db->get('rutas_comentarios');
        $ruta = $result->result_array();
        return $ruta;
    }

    public function maxComentariosRuta(){
        $query = $this->db->query("select max(IdRutaComentario) as IdRutaComentario from rutas_comentarios");
        $rowMax = $query->result_array();
        return $rowMax[0]['IdRutaComentario'];
    }

    public function guardar($nuevoDato){
        $this->db->insert('rutas_comentarios', $nuevoDato);
    }

    public function eliminar($idRutaComentario){
        $this->db->where('IdRutaComentario', $idRutaComentario);
        $this->db->delete('rutas_comentarios');
    }

    public function modificar($nuevoDato){
        $this->db->where('IdRutaComentario', $nuevoDato['IdRutaComentario']);
        $this->db->update('rutas_comentarios', $nuevoDato);
    }
    
}