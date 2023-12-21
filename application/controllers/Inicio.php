<?php

    class Inicio extends CI_Controller {

        public function index(){
            $this->load->model('VisitasModel','VM',true);
            $datos['Visitas']=$this->VM->getAll();

            //$idiom = $this->session->get_userdata('language');
            //$idiom = "spanish";
            $idiom = "english";
            $this->lang->load('mensajes', $idiom);
            //$this->lang->load('mensajes');
            $titulo = $this->lang->line('titulo');
            $datosCabecera['Titulo']=$titulo;

            $datosMenu = array ('inicio' => $this->lang->line('menu_inicio'),
                                'rutas' => $this->lang->line('menu_rutas'),
                                'municipios' => $this->lang->line('menu_municipios'),
                                'contacta' => $this->lang->line('menu_contacta'));
            
            $this->load->helper('url');
            $this->load->view('templates/cabecera', $datosCabecera);
            $this->load->view('templates/menu', $datosMenu);
            $this->load->view('paginas/inicio.php', $datos);
            $this->load->view('templates/pie');
        }

    }