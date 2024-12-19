<?php

    class VisitasAdmin extends CI_Controller {

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

            $listaMunicipios = null;
            $datos['listaMunicipios']=$listaMunicipios;
            
            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/visitasAdmin', $datos);
        }

        public function recarga(){
           
            $idPais = null;
            $idComunidad = null;
            $idProvincia = null;
            $idMunicipio = null;
            
            if (!is_null($this->input->post('paiselegido')) && $this->input->post('paiselegido') != 0){
                $idPais = $this->input->post('paiselegido');
            }

            if (!is_null($this->input->post('comunidadelegida')) && $this->input->post('comunidadelegida') != 0){
                $idComunidad = $this->input->post('comunidadelegida');
            }

            if (!is_null($this->input->post('provinciaelegida')) && $this->input->post('provinciaelegida') != 0){
                $idProvincia = $this->input->post('provinciaelegida');
            }

            if (!is_null($this->input->post('municipioelegido')) && $this->input->post('municipioelegido') != 0){
                $idMunicipio = $this->input->post('municipioelegido');
            }

            $listaMunicipios = array();
            if ($idComunidad != null){
                $this->load->model('MunicipiosModel','MM',true);
                $listaMunicipios = $this->MM->getMunicipiosAdminParams($idPais,$idComunidad,$idProvincia,$idMunicipio);
            }
            $datos['listaMunicipios']=$listaMunicipios;

            $this->load->view('paginas/admin/municipios_recarga', $datos);
         }

        public function municipiosVisitados($idComunidad,$idProvincia,$idMunicipio){
            $this->load->model('MunicipiosModel','MM',true);

            $listaMunicipios = $this->MM->getMunicipiosParams(null,$idComunidad,$idProvincia,$idMunicipio);
            return $listaMunicipios;
        }

        public function municipiosNoVisitados($idComunidad,$idProvincia,$idMunicipio){
            $this->load->model('MunicipiosModel','MM',true);

            $listaMunicipios = $this->MM->getMunicipiosAdminParams(null,$idComunidad,$idProvincia,$idMunicipio);
            return $listaMunicipios;
        }

        public function visitado($idVisitado){
            
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];

            $this->load->model('VisitadosModel','VM',true);
            $visitado = $this->VM->getVisitado($idVisitado);
            $datos['fecha']=$visitado[0]['Fecha'];
            $datos['titulo']=$visitado[0]['Titulo'];
            $datos['facebook']=$visitado[0]['Facebook'];
            

            $this->load->model('MunicipiosModel','MM',true);
            $todomunicipio = $this->MM->getMunicipio($visitado[0]['IdMunicipio']);
            $datos['coordenadaX']=$todomunicipio[0]['CoordenadaX'];
            $datos['coordenadaY']=$todomunicipio[0]['CoordenadaY'];

            $this->load->helper('funciones');
            $municipio = obtenerMunicipio($visitado[0]['IdMunicipio'], false);
            $datos['municipio']=$municipio;

            $datos['idMunicipioVisitado']=$visitado[0]['IdMunicipio'];
            $datos['idVisitado']=$idVisitado;

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/visitado', $datos);
        }

        public function municipioVisitado($idMunicipio){
            
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];

            $this->load->helper('funciones');
            $municipio = obtenerMunicipio($idMunicipio, false);
            $datos['municipio']=$municipio;

            $datos['fecha']="";
            $datos['titulo']="";
            $datos['facebook']="";
            $datos['coordenadaX']="";
            $datos['coordenadaY']="";

            $datos['idMunicipioVisitado']=$idMunicipio;
            $datos['idVisitado']="";

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/visitado', $datos);
        }

        public function guardar(){
            
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];

            $fecha = null;
            if (!is_null($this->input->post('fecha'))){
                $fecha = $this->input->post('fecha');
                $fechaArray = explode('-', $fecha);
                $dia = $fechaArray[2];
                $mes = $fechaArray[1];
                $anyo = $fechaArray[0];
                $fechaBBDD = $anyo."-".$mes."-".$dia;
            }
            $titulo = null;
            if (!is_null($this->input->post('titulo'))){
                $titulo = $this->input->post('titulo');
            }
            $facebook = null;
            if (!is_null($this->input->post('facebook'))){
                $facebook = $this->input->post('facebook');
            }
            $coordenadax = null;
            if (!is_null($this->input->post('coordenadax'))){
                $coordenadax = $this->input->post('coordenadax');
            }
            $coordenaday = null;
            if (!is_null($this->input->post('coordenaday'))){
                $coordenaday = $this->input->post('coordenaday');
            }
            $idMunVisitado = null;
            if (!is_null($this->input->post('idMunVisitado'))){
                $idMunVisitado = $this->input->post('idMunVisitado');
            }
            $idVisitado = null;
            if (!is_null($this->input->post('idVisitado'))){
                $idVisitado = $this->input->post('idVisitado');
            }

            $this->load->model('VisitadosModel','VM',true);
            if ($idVisitado == null){
                
                $identificador = $this->VM->autoIncremento();

                $data = array(
                    'IdVisitado' => $identificador,
                    'IdMunicipio'  => $idMunVisitado,
                    'Fecha'  => $fechaBBDD,
                    'Titulo' => $titulo,
                    'Facebook' => $facebook
                );
                
                $this->VM->guardar($data);
            } else {
                $data = array(
                    'IdVisitado' => $idVisitado,
                    'IdMunicipio'  => $idMunVisitado,
                    'Fecha'  => $fechaBBDD,
                    'Titulo' => $titulo,
                    'Facebook' => $facebook
                );
                
                $this->VM->modificar($data);
            }
            
            $this->load->model('MunicipiosModel','MM',true);
            $data = array(
                'IdMunicipio' => $idMunVisitado,
                'CoordenadaX'  => $coordenadax,
                'CoordenadaY'  => $coordenaday
            );
            $this->MM->modificar($data);

            $queries = $this->db->queries;

            $output = null;
            foreach ($queries as $key => $query) {

                $output .= $query . "<br>";
            
            }
            print ("Querys: ".$output);

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/visitasAdmin', $datos);
        }

        public function borrarVisitado($idVisitado){
            
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];

            $this->load->model('VisitadosModel','VM',true);
            $this->VM->borrar($idVisitado);
            
            $queries = $this->db->queries;

            $output = null;
            foreach ($queries as $key => $query) {

                $output .= $query . "<br>";
            
            }
            print ("Querys: ".$output);

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/visitasAdmin', $datos);
        }

    }