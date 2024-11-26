<?php

    class InicioAdmin extends CI_Controller {

        function __construct() {
            parent::__construct();
            
            $registrado = $this->session->userdata('registrado');

            if ($registrado == null) {
                redirect('admin/login', 'refresh');
            }
        }

        public function index(){
            
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];
            
            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/inicio', $datos);
        }
    }