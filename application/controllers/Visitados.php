<?php

    class Visitados extends CI_Controller {

        function __construct() {
            parent::__construct();
            
            $idiom = $this->session->userdata('language');

            $this->lang->load('mensajes', $idiom);

            //load pagination library
            $this->load->library('pagination');
            //per page limit
            $this->perPage = 12;
        }

       public function visita($idVisitado,$idRutaDia){
            $idiom = $this->session->userdata('language');

            $titulo = $this->lang->line('rutas_titulo');
            $datos['rutaTitulo']=$titulo;

            $this->load->model('ComentariosModel','COM',true);
            $comentario = $this->COM->getComentario($idVisitado);
            $comentarios = "";
            if ($comentario != null) {
                if ("spanish" == $idiom){
                    $comentarios=$comentario[0]['ComentarioES'];
                } else if ("english" == $idiom){
                    $comentarios=$comentario[0]['ComentarioEN'];
                } else if ("catalan" == $idiom){
                    $comentarios=$comentario[0]['ComentarioCA'];
                } else {
                    $comentarios=$comentario[0]['ComentarioES'];
                } 
            }
            $datos['comentario']=$comentarios;

            $this->load->model('VisitadosModel','VM',true);
            $visitados = $this->VM->getVisitado($idVisitado);
            
            $this->load->helper('funciones');
            $idMunicipio = $visitados[0]['IdMunicipio'];
            $municipio = obtenerMunicipio($idMunicipio, false);
            $datos['municipio']=$municipio;
            $datos['idRutaDia']=$idRutaDia;

            $this->load->model('FotosModel','FM',true);
            //get rows count
            $conditions['returnType'] = 'count';
            $conditions['IdMunicipio'] = $idMunicipio;
            $totalRec = $this->FM->getRows($conditions);
     
            //pagination config
            $config['base_url']    = site_url('').'/visitados/visita/'.$idVisitado.'/'.$idRutaDia;
            $config['uri_segment'] = 5;
            $config['total_rows']  = $totalRec;
            $config['per_page']    = $this->perPage;
            
            //styling
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="javascript:void(0);">';
            $config['cur_tag_close'] = '</a></li>';
            $config['next_link'] = $this->lang->line('pagination_siguiente');
            $config['prev_link'] = $this->lang->line('pagination_anterior');
            $config['next_tag_open'] = '<li class="pg-next">';
            $config['next_tag_close'] = '</li>';
            $config['prev_tag_open'] = '<li class="pg-prev">';
            $config['prev_tag_close'] = '</li>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['attributes'] = array('class' => 'page-link',);
             
            //initialize pagination library
            $this->pagination->initialize($config);
            
            //define offset
            $page = $this->uri->segment(5);
            $offset = !$page?0:$page;
            
            //get rows
            $conditions['returnType'] = '';
            $conditions['start'] = $offset;
            $conditions['limit'] = $this->perPage;
            $datos['fotos'] = $this->FM->getRows($conditions);
            // build paging links 
			$datos["links"] = $this->pagination->create_links();
            
            $datosMenu = array ('inicio' => $this->lang->line('menu_inicio'),
                                'rutas' => $this->lang->line('menu_rutas'),
                                'municipios' => $this->lang->line('menu_municipios'),
                                'contacta' => $this->lang->line('menu_contacta'),
                                'volver' => $this->lang->line('visitados_volver'),
                                'sin_fotos' => $this->lang->line('visitados_sin_fotos'));
            
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datosPie['Contador']=$contador[0]['Contador'];

            $IP = getRealIP();
            $data = array(
                'IP' => $IP,
                'Hora'  => date("H:i:s"),
                'Fecha'  => date("Y-m-d"),
                'Pagina'  => 5,
                'Observaciones'  => $municipio
            );

            $this->load->model('PaginasVistasModel','PVM',true);
            $this->PVM->guardar($data);

            $this->load->view('templates/cabecera');
            $this->load->view('templates/menu', $datosMenu);
            $this->load->view('paginas/visitados.php', $datos);
            $this->load->view('templates/pie', $datosPie);
        }

        public function ruta($idRuta){
            
            $datos = array ('rutaDia' => $this->lang->line('ruta_dia_dia'),
                            'rutaMunicipios' => $this->lang->line('ruta_dia_municipios'),
                            'rutaVolver' => $this->lang->line('ruta_dia_volver'));

            $this->load->model('RutasModel','RM',true);
            $ruta = $this->RM->getRuta($idRuta);
            $datos['ruta']=$ruta;
            $datos['rutaTitulo']=$ruta[0]['FechaES'];

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

            $this->load->view('templates/cabecera');
            $this->load->view('templates/menu', $datosMenu);
            $this->load->view('paginas/ruta.php', $datos);
            $this->load->view('templates/pie', $datosPie);
        }

        public function ruta_dia($idRuta){

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
                $comentarios=$rutaComentario[0]['ComentarioES'];    
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

            $this->load->view('templates/cabecera');
            $this->load->view('templates/menu', $datosMenu);
            $this->load->view('paginas/ruta_dia.php', $datos);
            $this->load->view('templates/pie', $datosPie);
        }
    }