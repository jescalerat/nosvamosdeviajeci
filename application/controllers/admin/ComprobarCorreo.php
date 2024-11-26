<?php

    class ComprobarCorreo extends CI_Controller {

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


            $this->load->model('CorreoModel','MM',true);
            $correos = $this->MM->getAll();
            $datos['correos']=$correos;

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/comprobarCorreo', $datos);
        }
        
        public function eliminar($idCorreo){

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];


            $this->load->model('CorreoModel','MM',true);
            $this->MM->eliminar($idCorreo);
            $correos = $this->MM->getAll();
            $datos['correos']=$correos;

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/comprobarCorreo', $datos);
        }

    }