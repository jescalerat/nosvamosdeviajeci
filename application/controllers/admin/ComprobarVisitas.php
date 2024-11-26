<?php

    class ComprobarVisitas extends CI_Controller {

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


            $this->load->model('VisitasModel','VM',true);
            $visitas = $this->VM->getAll();
            $datos['visitas']=$visitas;

            $rowfechaactual = $this->VM->getFechaActual();
            $fechaactual=$rowfechaactual[0]['Fecha'];
            $datos['fecha_actual']=$fechaactual;

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/comprobarVisitas', $datos);
        }

        public function visitasDia($fechaactual){
            $this->load->model('VisitasModel','VM',true);
            $totalVisitasDia = $this->VM->getVisitasDia($fechaactual);
            return $totalVisitasDia;
        }

        public function visitasDiaDistintas($fechaactual){
            $this->load->model('VisitasModel','VM',true);
            $totalVisitasDiaDistintas = $this->VM->getVisitasDiaDistintas($fechaactual);
            return $totalVisitasDiaDistintas;
        }

        public function eliminar($idVisita){
           
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];


            $this->load->model('VisitasModel','VM',true);

            $this->VM->eliminar($idVisita);

            $visitas = $this->VM->getAll();
            $datos['visitas']=$visitas;

            $rowfechaactual = $this->VM->getFechaActual();
            $fechaactual=$rowfechaactual[0]['Fecha'];
            $datos['fecha_actual']=$fechaactual;

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/comprobarVisitas', $datos);
        }

    }