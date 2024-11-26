<?php

    class ComprobarPaginasVistas extends CI_Controller {

        function __construct() {
            parent::__construct();
            
            $registrado = $this->session->userdata('registrado');

            if ($registrado == null) {
                redirect('admin/login', 'refresh');
            }

            $this->load->helper('funciones');
        }

        public function index(){
           
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];


            $this->load->model('PaginasVistasModel','PVM',true);
            $paginasvistas = $this->PVM->getAll();
            $datos['paginasvistas']=$paginasvistas;
            $datos['titulo']="";

            $datos['params']="0/0";

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/comprobarPaginasVistas', $datos);
        }

        public function fecha($fecha){
           
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];


            $this->load->model('PaginasVistasModel','PVM',true);
            $paginasvistas = $this->PVM->getByParametros($fecha, null);
            $datos['paginasvistas']=$paginasvistas;
            $titulo = "Fecha: ".devolverFechaBBDD($fecha);
            $datos['titulo']=$titulo;

            $datos['params']=$fecha."/0";

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/comprobarPaginasVistas', $datos);
        }

        public function fechaIP($fecha, $IP){
           
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];


            $this->load->model('PaginasVistasModel','PVM',true);
            $paginasvistas = $this->PVM->getByParametros($fecha, $IP);
            $datos['paginasvistas']=$paginasvistas;

            $titulo = "Fecha: ".devolverFechaBBDD($fecha)." IP: ".$IP;
            $datos['titulo']=$titulo;

            $datos['params']=$fecha."/".$IP;


            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/comprobarPaginasVistas', $datos);
        }

        public function titulopagina($idPagina){
            if ($idPagina==1)
            {
                $pagina_vista="Inicio";
            }
            else if ($idPagina==2)
            {
                $pagina_vista="Rutas";
            }
            else if ($idPagina==3)
            {
                $pagina_vista="Ruta";
            }
            else if ($idPagina==4)
            {
                $pagina_vista="Dia ruta";
            }
            else if ($idPagina==5)
            {
                $pagina_vista="Municipio visitado";
            }
            else if ($idPagina==6)
            {
                $pagina_vista="Municipios";
            }
            else if ($idPagina==7)
            {
                $pagina_vista="Contactar";
            }
            else if ($idPagina==72)
            {
                $pagina_vista="Contactar enviado";
            }
            return $pagina_vista;
        }

        public function estilo($idPagina){
            $estilo = "";
            if ($idPagina==7)
            {
                $estilo = "bgcolor=\"red\"";
            }
            else if ($idPagina==72)
            {
                $estilo = "bgcolor=\"red\"";
            }
            return $estilo;
        }

        public function eliminar($idPaginaVista, $fecha, $IP){

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];


            $this->load->model('PaginasVistasModel','PVM',true);
            $this->PVM->eliminar($idPaginaVista);
            if ($IP == 0 && $fecha == 0){
                $paginasvistas = $this->PVM->getAll();
                $datos['params']="0/0";
            } else {
                if ($IP == 0){
                    $paginasvistas = $this->PVM->getByParametros($fecha, null);
                } else {
                    $paginasvistas = $this->PVM->getByParametros($fecha, $IP);
                }
                
                $datos['params']=$fecha."/".$IP;
            }
            $datos['paginasvistas']=$paginasvistas;

            $titulo = "";
            if ($IP != 0){
                $titulo = "Fecha: ".devolverFechaBBDD($fecha)." IP: ".$IP;
            } else if ($fecha != 0) { 
                $titulo = "Fecha: ".devolverFechaBBDD($fecha);
            }
            $datos['titulo']=$titulo;


            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/comprobarPaginasVistas', $datos);
        }

    }