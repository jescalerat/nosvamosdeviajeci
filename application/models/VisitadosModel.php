<?php

class VisitadosModel extends CI_Model
{
    public function getVisitado($idVisitado){
        $this->db->where('IdVisitado', $idVisitado);
        $result = $this->db->get('visitados');
        $visitado = $result->result_array();
        
        return $visitado;
    }

    public function getVisitadosDia($fecha){
        $this->db->select('v.IdVisitado, m.IdMunicipio, m.Municipio, v.Fecha');
        $this->db->from('visitados v');
        $this->db->join('municipios m', 'v.IdMunicipio = m.idMunicipio', 'left');
        $this->db->where('v.Fecha', $fecha);
        $query = $this->db->get();

        $listaVisitadosDia = $query->result_array();
        return $listaVisitadosDia;
    }

    public function autoIncremento(){
        $query = $this->db->query("select Auto_increment from information_schema.tables WHERE table_name='visitados'");
        $rowAutoIncremento = $query->result_array();
        return $rowAutoIncremento[0]['Auto_increment'];
    }

    public function guardar($nuevoDato){
        $this->db->insert('visitados', $nuevoDato);
    }

    public function modificar($nuevoDato){
        $this->db->where('IdVisitado', $nuevoDato['IdVisitado']);
        $this->db->update('visitados', $nuevoDato);
    }

    public function borrar($idVisitado){
        $this->db->where('IdVisitado', $idVisitado);
        $this->db->delete('visitados');
    }
}