<?php

class VisitasModel extends CI_Model
{
    public function getAll(){
        $this->db->order_by('Fecha', 'DESC');
        $this->db->order_by('Hora', 'DESC');
        $this->db->order_by('IP', 'DESC');
        $this->db->limit(500);

        $query = $this->db->get('visitas');

        $visitas = $query->result_array();
        return $visitas;
    }

    public function getFechaActual(){
        $this->db->order_by('Fecha', 'DESC');
        $this->db->order_by('Hora', 'DESC');
        $this->db->order_by('IP', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get('visitas');

        $visitas = $query->result_array();
        return $visitas;
    }

    public function getVisitasDia($fechaactual){
        $this->db->select('*');
        $this->db->from('visitas');

        $this->db->where('Fecha', $fechaactual);

        $result = $this->db->count_all_results();

        return $result;
    }

    public function getVisitasDiaDistintas($fechaactual){
        $this->db->distinct();
        $this->db->select('IP');
        $this->db->from('visitas');

        $this->db->where('Fecha', $fechaactual);

        $result = $this->db->count_all_results();

        return $result;
    }

    public function eliminar($idVisita){
        $this->db->where('IdVisita', $idVisita);
        $this->db->delete('visitas');
    }
}