<?php

    class Salir extends CI_Controller {

        public function index(){
            
            $this->session->set_userdata('registrado',null);
            //redirect('inicioAdmin', 'refresh');
            $datos['error']="";
            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/login.php', $datos);
        }

    }
