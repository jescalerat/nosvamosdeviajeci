<?php

class PaginasVistasModel extends CI_Model
{
    public $ip;
    public $hora;
    public $fecha;
    public $pagina;
    public $observaciones;

    public function getAll(){
        $this->db->order_by('Fecha', 'DESC');
        $this->db->order_by('Hora', 'DESC');
        $this->db->order_by('IP', 'DESC');
        $this->db->limit(500);

        $query = $this->db->get('paginasvistas');

        $visitas = $query->result_array();
        return $visitas;
    }

    public function getByParametros($fecha, $ip){
        $this->db->select('*');
        $this->db->from('paginasvistas');
        $this->db->order_by('Fecha', 'DESC');
        $this->db->order_by('Hora', 'DESC');
        $this->db->order_by('IP', 'DESC');
        $this->db->limit(500);

        if ($fecha != null){
            $this->db->where('Fecha', $fecha);
        }
        if ($ip != null){
            $this->db->where('IP', $ip);
        }

        $query = $this->db->get();

        $paginasvistas = $query->result_array();
        return $paginasvistas;
    }

    public function eliminar($idPaginaVistas){
        $this->db->where('IdPaginasVistas', $idPaginaVistas);
        $this->db->delete('paginasvistas');
    }

    public function guardar($nuevoDato){
        $this->db->insert('paginasvistas', $nuevoDato);
    }
}