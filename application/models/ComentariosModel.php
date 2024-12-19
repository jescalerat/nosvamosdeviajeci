<?php

class ComentariosModel extends CI_Model
{
    public function getComentario($idVisitado){
        $this->db->where('IdVisitado', $idVisitado);
        $result = $this->db->get('comentarios');
        $comentario = $result->result_array();
        
        return $comentario;
    }

    public function sinComentarios(){
        $this->db->select('c.IdComunidad, c.Comunidad, p.IdProvincia, p.Provincia, m.IdMunicipio, m.Municipio, v.Fecha, v.IdVisitado');
        $this->db->from('municipios m');
        $this->db->join('provincias as p', 'm.IdProvincia=p.IdProvincia', 'left');
        $this->db->join('comunidades as c', 'p.IdComunidad=c.IdComunidad', 'left');
        $this->db->join('visitados as v', 'v.IdMunicipio=m.IdMunicipio', 'left');
        $this->db->join('comentarios co', 'co.IdVisitado=v.IdVisitado', 'left');
        $this->db->where('co.IdComentario is null and v.IdVisitado is not null');
        $this->db->order_by('c.IdComunidad', 'ASC');
        $this->db->order_by('p.IdProvincia', 'ASC');
        $this->db->order_by('m.Municipio', 'ASC');
        $query = $this->db->get();

        $listaComentarios = $query->result_array();
        return $listaComentarios;
    }

    public function conComentarios(){
        $this->db->distinct();
        $this->db->select('c.IdComunidad, c.Comunidad, p.IdProvincia, p.Provincia, m.IdMunicipio, m.Municipio, v.Fecha, v.IdVisitado, co.IdComentario');
        $this->db->from('municipios m');
        $this->db->join('provincias as p', 'm.IdProvincia=p.IdProvincia', 'left');
        $this->db->join('comunidades as c', 'p.IdComunidad=c.IdComunidad', 'left');
        $this->db->join('visitados as v', 'v.IdMunicipio=m.IdMunicipio', 'left');
        $this->db->join('comentarios co', 'co.IdVisitado=v.IdVisitado', 'left');
        $this->db->where('co.IdComentario is not null');
        $this->db->order_by('c.IdComunidad', 'ASC');
        $this->db->order_by('p.IdProvincia', 'ASC');
        $this->db->order_by('m.Municipio', 'ASC');
        $query = $this->db->get();

        $listaComentarios = $query->result_array();
        return $listaComentarios;
    }

    public function guardar($nuevoDato){
        $this->db->insert('comentarios', $nuevoDato);
    }

    public function eliminar($idComentario){
        $this->db->where('IdComentario', $idComentario);
        $this->db->delete('comentarios');
    }

    public function modificar($nuevoDato){
        $this->db->where('IdComentario', $nuevoDato['IdComentario']);
        $this->db->update('comentarios', $nuevoDato);
    }
}