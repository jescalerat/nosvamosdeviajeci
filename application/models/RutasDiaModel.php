<?php

class RutasDiaModel extends CI_Model
{
    public function getRutaDia($idRutaDia){
        $this->db->select('*');
        $this->db->from('rutas as r');
        $this->db->join('rutas_dias as rd', 'rd.IdRuta = r.IdRuta', 'left');
        $this->db->join('rutas_municipios as rm', 'rm.IdRutaDia = rd.IdRutaDia', 'left');
        $this->db->join('visitados as v', 'v.IdVisitado = rm.IdVisitado', 'left');
        $this->db->join('municipios as m', 'm.IdMunicipio = v.IdMunicipio', 'left');
        $this->db->join('provincias as p', 'p.IdProvincia = m.IdProvincia', 'left');
        $this->db->where('rd.IdRutaDia', $idRutaDia);
        $this->db->order_by('rd.Fecha', 'ASC');
        $this->db->order_by('rm.Orden', 'ASC');
        $query = $this->db->get();

        $listaRutasDia = $query->result_array();
        return $listaRutasDia;
    }

    
}