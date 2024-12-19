<?php

class RutasDiaModel extends CI_Model
{
    public function getRutaDia($idRutaDia){
        $this->db->select('r.*, rd.Fecha, rd.IdRutaDia, v.IdVisitado, m.Municipio, p.Provincia');
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

    public function getDiasRuta($idRuta){
        $this->db->where('IdRuta', $idRuta);
        $result = $this->db->get('rutas_dias');
        $listaRutaDias = $result->result_array();

        return $listaRutaDias;
    }

    public function maxRutaDia(){
        $query = $this->db->query("select max(IdRutaDia) as IdRutaDia from rutas_dias");
        $rowMax = $query->result_array();
        return $rowMax[0]['IdRutaDia'];
    }

    public function guardar($nuevoDato){
        $this->db->insert('rutas_dias', $nuevoDato);
    }

    public function modificar($nuevoDato){
        $this->db->where('IdRutaDia', $nuevoDato['IdRutaDia']);
        $this->db->update('rutas_dias', $nuevoDato);
    }

    public function eliminar($idRutaDia){
        $this->db->where('IdRutaDia', $idRutaDia);
        $this->db->delete('rutas_dias');
    }
    
}