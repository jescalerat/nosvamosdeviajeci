<?php

class RutasModel extends CI_Model
{
    public function getAll(){
        $this->db->order_by('Orden', 'DESC');
        $result = $this->db->get('rutas');
        $listaRutas = $result->result_array();
        return $listaRutas;
    }

    public function getRuta($idRuta){
        $this->db->where('IdRuta', $idRuta);
        $result = $this->db->get('rutas');
        $ruta = $result->result_array();
        return $ruta;
    }

    public function getRutaDia($idRuta){
        $this->db->select('*');
        $this->db->from('rutas as r');
        $this->db->join('rutas_dias as rd', 'rd.IdRuta = r.IdRuta', 'left');
        $this->db->join('rutas_municipios as rm', 'rm.IdRutaDia = rd.IdRutaDia', 'left');
        $this->db->join('visitados as v', 'v.IdVisitado = rm.IdVisitado', 'left');
        $this->db->join('municipios as m', 'm.IdMunicipio = v.IdMunicipio', 'left');
        $this->db->join('provincias as p', 'p.IdProvincia = m.IdProvincia', 'left');
        $this->db->where('rd.idRuta', $idRuta);
        $this->db->order_by('rd.Fecha', 'ASC');
        $this->db->order_by('rm.Orden', 'ASC');
        $query = $this->db->get();

        $listaRutasDia = $query->result_array();
        return $listaRutasDia;
    }

    public function getRutaDiaAgrupa($idRuta){
        $this->db->select('rd.Fecha, count(*) as contador');
        $this->db->from('rutas as r');
        $this->db->join('rutas_dias as rd', 'rd.IdRuta = r.IdRuta', 'left');
        $this->db->join('rutas_municipios as rm', 'rm.IdRutaDia = rd.IdRutaDia', 'left');
        $this->db->join('visitados as v', 'v.IdVisitado = rm.IdVisitado', 'left');
        $this->db->join('municipios as m', 'm.IdMunicipio = v.IdMunicipio', 'left');
        $this->db->join('provincias as p', 'p.IdProvincia = m.IdProvincia', 'left');
        $this->db->where('rd.idRuta', $idRuta);
        $this->db->order_by('rd.Fecha', 'ASC');
        $this->db->order_by('rm.Orden', 'ASC');
        $this->db->group_by('rd.Fecha');
        $query = $this->db->get();

        $listaRutasDia = $query->result_array();
        return $listaRutasDia;
    }

    public function guardar($nuevoDato){
        $this->db->insert('rutas', $nuevoDato);
    }

    public function eliminar($idRuta){
        $this->db->where('IdRuta', $idRuta);
        $this->db->delete('rutas');
    }

    public function modificar($nuevoDato){
        $this->db->where('IdRuta', $nuevoDato['IdRuta']);
        $this->db->update('rutas', $nuevoDato);
    }
}