<?php

class FotosModel extends CI_Model
{
    public function getRows($params = array()){
        $this->db->select('*');
        $this->db->from('fotos');
        $this->db->where('IdMunicipio',$params['IdMunicipio']);

        //set start and limit
        if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit'],$params['start']);
        }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
            $this->db->limit($params['limit']);
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            $query = $this->db->get();
            $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
        }

        //return fetched data
        return $result;
    }

    public function sinFotos(){
        $this->db->select('c.IdComunidad, c.Comunidad, p.IdProvincia, p.Provincia, m.IdMunicipio, m.Municipio, v.Fecha, v.IdVisitado');
        $this->db->from('municipios m');
        $this->db->join('provincias as p', 'm.IdProvincia=p.IdProvincia', 'left');
        $this->db->join('comunidades as c', 'p.IdComunidad=c.IdComunidad', 'left');
        $this->db->join('visitados as v', 'v.IdMunicipio=m.IdMunicipio', 'left');
        $this->db->join('fotos as f', 'f.IdMunicipio=v.IdMunicipio', 'left');
        $this->db->where('f.IdFoto is null and v.IdVisitado is not null');
        $this->db->order_by('c.IdComunidad', 'ASC');
        $this->db->order_by('p.IdProvincia', 'ASC');
        $this->db->order_by('m.Municipio', 'ASC');
        $query = $this->db->get();

        $listaFotos = $query->result_array();
        return $listaFotos;
    }

    public function conFotos(){
        $this->db->distinct();
        $this->db->select('c.IdComunidad, c.Comunidad, p.IdProvincia, p.Provincia, m.IdMunicipio, m.Municipio, v.Fecha, v.IdVisitado');
        $this->db->from('municipios m');
        $this->db->join('provincias as p', 'm.IdProvincia=p.IdProvincia', 'left');
        $this->db->join('comunidades as c', 'p.IdComunidad=c.IdComunidad', 'left');
        $this->db->join('visitados as v', 'v.IdMunicipio=m.IdMunicipio', 'left');
        $this->db->join('fotos as f', 'f.IdMunicipio=v.IdMunicipio', 'left');
        $this->db->where('f.IdFoto is not null and v.IdVisitado is not null');
        $this->db->order_by('c.IdComunidad', 'ASC');
        $this->db->order_by('p.IdProvincia', 'ASC');
        $this->db->order_by('m.Municipio', 'ASC');
        $query = $this->db->get();

        $listaFotos = $query->result_array();
        return $listaFotos;
    }

    public function buscarOrden($idMunicipio){
        $this->db->select('max(Orden) as Orden');
        $this->db->from('fotos f');
        $this->db->where('f.IdMunicipio', $idMunicipio);
        $query = $this->db->get();

        $orden = $query->result_array();
        return $orden[0]['Orden'];
    }

    public function guardar($nuevoDato){
        $this->db->insert('fotos', $nuevoDato);
    }

    public function eliminar($idMunicipio){
        $this->db->where('IdMunicipio', $idMunicipio);
        $this->db->delete('fotos');
    }

}