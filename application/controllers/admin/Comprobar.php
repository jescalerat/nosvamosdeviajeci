<?php

    class Comprobar extends CI_Controller {

        public function index(){
            
            $usuario = null;
            if (!is_null($this->input->post('usuario'))){
                $usuario = $this->input->post('usuario');
            }
            $password = null;
            if (!is_null($this->input->post('password'))){
                $password = $this->input->post('password');
            }

            $this->load->model('UsuariosModel','UM',true);
            $existeUsuario = $this->UM->getUsuarioParams($usuario, $password);

            if ($existeUsuario > 0){
                $this->session->set_userdata('registrado',1);
                $this->session->set_userdata('usuario',$usuario);
                redirect('admin/inicioAdmin', 'refresh');
            } else {
                $datos['error']="Usuario no existente";
                $this->load->view('templates/cabecera');
                $this->load->view('paginas/admin/login.php', $datos);
            }
        }
    }
