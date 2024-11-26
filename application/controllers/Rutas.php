<?php

    class Rutas extends CI_Controller {

        function __construct() {
            parent::__construct();
            
            $idiom = $this->session->userdata('language');

            $this->lang->load('mensajes', $idiom);
        }

        public function index(){
           
            $titulo = $this->lang->line('rutas_titulo');
            $datos['rutaTitulo']=$titulo;

            $this->load->model('RutasModel','RM',true);
            $listaRutas = $this->RM->getAll();
            $datos['listaRutas']=$listaRutas;

            $datosMenu = array ('inicio' => $this->lang->line('menu_inicio'),
                                'rutas' => $this->lang->line('menu_rutas'),
                                'municipios' => $this->lang->line('menu_municipios'),
                                'contacta' => $this->lang->line('menu_contacta'));
            
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datosPie['Contador']=$contador[0]['Contador'];

            $this->load->helper('funciones');
            $IP = getRealIP();
            $data = array(
                'IP' => $IP,
                'Hora'  => date("H:i:s"),
                'Fecha'  => date("Y-m-d"),
                'Pagina'  => 2,
                'Observaciones'  => ''
            );

            $this->load->model('PaginasVistasModel','PVM',true);
            $this->PVM->guardar($data);
            
            $this->load->view('templates/cabecera');
            $this->load->view('templates/menu', $datosMenu);
            $this->load->view('paginas/rutas.php', $datos);
            $this->load->view('templates/pie', $datosPie);
        }

        public function ruta($idRuta){
            $idiom = $this->session->userdata('language');

            $datos = array ('rutaDia' => $this->lang->line('ruta_dia_dia'),
                            'rutaMunicipios' => $this->lang->line('ruta_dia_municipios'),
                            'rutaVolver' => $this->lang->line('ruta_dia_volver'));

            $this->load->model('RutasModel','RM',true);
            $ruta = $this->RM->getRuta($idRuta);
            $datos['ruta']=$ruta;
            if ("spanish" == $idiom){
				$titulo=$ruta[0]['FechaES'];
			} else if ("english" == $idiom){
				$titulo=$ruta[0]['FechaEN'];
			} else if ("catalan" == $idiom){
				$titulo=$ruta[0]['FechaCA'];
			} else {
				$titulo=$ruta[0]['FechaES'];
			}
            $datos['rutaTitulo']=$titulo;

            $listRutaDia = $this->RM->getRutaDia($idRuta);
            $datos['listRutaDia']=$listRutaDia;
            $listRutaDiaAgrupa = $this->RM->getRutaDiaAgrupa($idRuta);
            $datos['listRutaDiaAgrupa']=$listRutaDiaAgrupa;

            $datosMenu = array ('inicio' => $this->lang->line('menu_inicio'),
                                'rutas' => $this->lang->line('menu_rutas'),
                                'municipios' => $this->lang->line('menu_municipios'),
                                'contacta' => $this->lang->line('menu_contacta'));
            
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datosPie['Contador']=$contador[0]['Contador'];

            $this->load->helper('funciones');
            $IP = getRealIP();
            $data = array(
                'IP' => $IP,
                'Hora'  => date("H:i:s"),
                'Fecha'  => date("Y-m-d"),
                'Pagina'  => 3,
                'Observaciones'  => $titulo
            );

            $this->load->model('PaginasVistasModel','PVM',true);
            $this->PVM->guardar($data);

            $this->load->view('templates/cabecera');
            $this->load->view('templates/menu', $datosMenu);
            $this->load->view('paginas/ruta.php', $datos);
            $this->load->view('templates/pie', $datosPie);
        }

        public function ruta_dia($idRuta){
            $idiom = $this->session->userdata('language');
            
            $datos = array ('rutaDia' => $this->lang->line('ruta_dia_dia'),
                            'rutaMunicipios' => $this->lang->line('ruta_dia_municipios'),
                            'rutaVolver' => $this->lang->line('ruta_dia_volver'));
            
            $this->load->model('RutasDiaModel','RDM',true);
            $rutaDia = $this->RDM->getRutaDia($idRuta);
            $datos['rutaDia']=$rutaDia;
            $datos['rutaDiaTitulo']=$rutaDia[0]['Fecha'];

            $this->load->model('RutasComentariosModel','RCM',true);
            $rutaComentario = $this->RCM->getComentarioRutaDia($idRuta);
            $comentarios = "";
            if ($rutaComentario != null) {
                if ("spanish" == $idiom){
                    $comentarios=$rutaComentario[0]['ComentarioES'];
                } else if ("english" == $idiom){
                    $comentarios=$rutaComentario[0]['ComentarioEN'];
                } else if ("catalan" == $idiom){
                    $comentarios=$rutaComentario[0]['ComentarioCA'];
                } else {
                    $comentarios=$rutaComentario[0]['ComentarioES'];
                }
            }
            $datos['rutaComentario']=$comentarios;
            
            $datosMenu = array ('inicio' => $this->lang->line('menu_inicio'),
                                'rutas' => $this->lang->line('menu_rutas'),
                                'municipios' => $this->lang->line('menu_municipios'),
                                'contacta' => $this->lang->line('menu_contacta'));
            
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datosPie['Contador']=$contador[0]['Contador'];

            $this->load->helper('funciones');
            $IP = getRealIP();
            $data = array(
                'IP' => $IP,
                'Hora'  => date("H:i:s"),
                'Fecha'  => date("Y-m-d"),
                'Pagina'  => 4,
                'Observaciones'  => $rutaDia[0]['Fecha']
            );

            $this->load->model('PaginasVistasModel','PVM',true);
            $this->PVM->guardar($data);

            $this->load->view('templates/cabecera');
            $this->load->view('templates/menu', $datosMenu);
            $this->load->view('paginas/ruta_dia.php', $datos);
            $this->load->view('templates/pie', $datosPie);
        }
    }