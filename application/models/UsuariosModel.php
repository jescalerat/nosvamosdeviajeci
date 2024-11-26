<?php

class UsuariosModel extends CI_Model
{
    public function getUsuarioParams($usuario, $password){
        $this->db->select('*');
        $this->db->from('usuarios');

        $this->db->where('Usuario', $usuario);
        $this->db->where('Password', $password);

        $result = $this->db->count_all_results();

        return $result;
    }

    public function getUsuario($usuario){
        $this->db->select('*');
        $this->db->from('usuarios');

        $this->db->where('Usuario', $usuario);

        $query = $this->db->get();

        $usuario = $query->result_array();

        return $usuario;
    }

    public function actualizar($nuevoDato){
        $this->db->update('usuarios', $nuevoDato);
    }
}