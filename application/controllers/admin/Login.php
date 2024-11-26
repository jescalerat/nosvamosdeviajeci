<?php

    class Login extends CI_Controller {

        public function index(){
            
            $datos['error']="";
            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/login.php', $datos);
        }

    }
