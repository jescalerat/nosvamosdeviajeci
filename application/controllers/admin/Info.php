<?php

    class Info extends CI_Controller {

        public function index(){
           
            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/info');
        }

    }