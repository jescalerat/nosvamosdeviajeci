<?php

class MunicipiosModel extends CI_Model
{
    public function getAll(){
        $this->db->order_by('municipio', 'ASC');
        $result = $this->db->get('municipios');
        $listaMunicipios = $result->result_array();
        return $listaMunicipios;
    }

    public function getMapaInicio(){
        $this->db->select('*');
        $this->db->from('municipios as muni');
        $this->db->join('visitados as vis', 'muni.IdMunicipio = vis.IdMunicipio');
        $this->db->where('muni.CoordenadaX is not null');
        $query = $this->db->get();

        $listaMunicipios = $query->result_array();
        return $listaMunicipios;
    }

    public function getMunicipio($idMunicipio){
        $this->db->select('*');
        $this->db->from('municipios as m');
        $this->db->join('provincias as p', 'm.IdProvincia = p.IdProvincia');
        $this->db->where('IdMunicipio', $idMunicipio);
        $query = $this->db->get();

        $municipio = $query->result_array();
        return $municipio;
    }

    public function getMunicipiosParams($idPais, $idComunidad, $idProvincia, $idMunicipio){
        $this->db->select('c.IdComunidad, c.Comunidad, p.IdProvincia, p.Provincia, m.IdMunicipio, m.Municipio, v.Fecha, v.IdVisitado');
        $this->db->from('municipios as m');
        $this->db->join('provincias as p', 'm.IdProvincia = p.IdProvincia', 'left');
        $this->db->join('comunidades as c', 'p.IdComunidad=c.IdComunidad', 'left');
        $this->db->join('paises as pa', 'c.IdPais=pa.IdPais', 'left');
        $this->db->join('visitados as v', 'v.IdMunicipio=m.IdMunicipio', 'left');
        $this->db->where('v.IdVisitado is not null');
        if ($idPais != null) {
            $this->db->where('pa.idPais', $idPais);
        }
        if ($idComunidad != null) {
            $this->db->where('c.IdComunidad', $idComunidad);
        }
        if ($idProvincia != null) {
            $this->db->where('p.IdProvincia', $idProvincia);
        }
        if ($idMunicipio != null) {
            $this->db->where('m.IdMunicipio', $idMunicipio);
        }
        $this->db->order_by('c.IdComunidad', 'ASC');
        $this->db->order_by('p.IdProvincia', 'ASC');
        $this->db->order_by('m.Municipio', 'ASC');
        $query = $this->db->get();

        $listaMunicipios = $query->result_array();
        return $listaMunicipios;
    }

    public function getMunicipioProvincias($idProvincia){
        $this->db->where('IdProvincia', $idProvincia);
        $this->db->order_by('municipio', 'ASC');
        $result = $this->db->get('municipios');
        $listaMunicipios = $result->result_array();
 
        return $listaMunicipios;
    }

    public function getMunicipiosAdminParams($idPais, $idComunidad, $idProvincia, $idMunicipio){
        $this->db->select('c.IdComunidad, c.Comunidad, p.IdProvincia, p.Provincia, m.IdMunicipio, m.Municipio, v.Fecha, v.IdVisitado');
        $this->db->from('municipios as m');
        $this->db->join('provincias as p', 'm.IdProvincia = p.IdProvincia', 'left');
        $this->db->join('comunidades as c', 'p.IdComunidad=c.IdComunidad', 'left');
        $this->db->join('paises as pa', 'c.IdPais=pa.IdPais', 'left');
        $this->db->join('visitados as v', 'v.IdMunicipio=m.IdMunicipio', 'left');
        $this->db->where('1=1');
        if ($idPais != null) {
            $this->db->where('pa.idPais', $idPais);
        }
        if ($idComunidad != null) {
            $this->db->where('c.IdComunidad', $idComunidad);
        }
        if ($idProvincia != null) {
            $this->db->where('p.IdProvincia', $idProvincia);
        }
        if ($idMunicipio != null) {
            $this->db->where('m.IdMunicipio', $idMunicipio);
        }
        $this->db->order_by('c.IdComunidad', 'ASC');
        $this->db->order_by('p.IdProvincia', 'ASC');
        $this->db->order_by('m.Municipio', 'ASC');
        $query = $this->db->get();

        $listaMunicipios = $query->result_array();
        return $listaMunicipios;
    }

}