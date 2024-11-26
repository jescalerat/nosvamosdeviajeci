<?php

    class VisitasAdmin extends CI_Controller {

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
            $datos['visitado']=$visitado;

            $this->load->model('MunicipiosModel','MM',true);
            $todomunicipio = $this->MM->getMunicipio($visitado[0]['IdMunicipio']);
            $datos['todomunicipio']=$todomunicipio;

            $this->load->helper('funciones');
            $municipio = obtenerMunicipio($visitado[0]['IdMunicipio'], false);
            $datos['municipio']=$municipio;

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/visitado', $datos);
        }

    }