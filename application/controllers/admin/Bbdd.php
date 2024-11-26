<?php

    class Bbdd extends CI_Controller {

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

            $datos['mensajeError']="";

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/bbdd', $datos);
        }
        
        public function mensaje(){
            
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];

            $mensaje = null;
            if (!is_null($this->input->post('mensaje'))){
                $mensaje = $this->input->post('mensaje');
            }
         
            $this->load->model('BbddModel','BM',true);
            $error = $this->BM->lanzar($mensaje);

            $mensajeError = "";
            if ($error){
                $mensajeError = "Error";
            } else {
                $mensajeError = "Correcto";
            }
            $datos['mensajeError']=$mensajeError;

            
            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/bbdd', $datos);
        }

    }