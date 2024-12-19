<?php

class RutasMunicipiosModel extends CI_Model
{
    public function getMunicipiosRutaDia($idRutaDia){
        $this->db->select('rm.IdRutaMunicipio, rm.IdRutaDia, m.IdMunicipio, m.Municipio');
        $this->db->from('rutas_municipios rm');
        $this->db->join('visitados v', 'rm.IdVisitado = v.IdVisitado', 'left');
        $this->db->join('municipios m', 'v.IdMunicipio = m.IdMunicipio', 'left');
        $this->db->where('rm.IdRutaDia', $idRutaDia);
        $query = $this->db->get();

        $listaMunicipiosRuta = $query->result_array();
        return $listaMunicipiosRuta;
    }

    public function maxMunicipioRuta(){
        $query = $this->db->query("select max(IdRutaMunicipio) as IdRutaMunicipio from rutas_municipios");
        $rowMax = $query->result_array();
        return $rowMax[0]['IdRutaMunicipio'];
    }

    public function maxMunicipioRutaOrden($idRutaDia){
        $this->db->select("max(Orden) as Orden");
        $this->db->from('rutas_municipios rm');
        $this->db->where('IdRutaDia', $idRutaDia);

        $query = $this->db->get();
        $rowMax = $query->result_array();
        return $rowMax[0]['Orden'];
    }
    
    public function guardar($nuevoDato){
        $this->db->insert('rutas_municipios', $nuevoDato);
    }

    public function eliminar($idRutaMunicipio){
        $this->db->where('IdRutaMunicipio', $idRutaMunicipio);
        $this->db->delete('rutas_municipios');
    }
}