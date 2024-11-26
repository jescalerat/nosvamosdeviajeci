<?php

    class Municipios extends CI_Controller {

        function __construct() {
            parent::__construct();
            
            $idiom = $this->session->userdata('language');

            $this->lang->load('mensajes', $idiom);

            $this->load->helper('funciones');
        }

        public function index(){
           
            $paises = $this->lang->line('municipios_paises');
            $datos['municipiosPaises']=$paises;
            $comunidades = $this->lang->line('municipios_comunidades');
            $datos['municipiosComunidades']=$comunidades;
            $provincias = $this->lang->line('municipios_provincias');
            $datos['municipiosProvincias']=$provincias;
            $municipios = $this->lang->line('municipios_municipios');
            $datos['municipiosMunicipios']=$municipios;

            $this->load->model('MunicipiosModel','MM',true);

            $listaMunicipios = null;
            $datos['listaMunicipios']=$listaMunicipios;

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
                'Pagina'  => 6,
                'Observaciones'  => ''
            );

            $this->load->model('PaginasVistasModel','PVM',true);
            $this->PVM->guardar($data);
            
            $this->load->view('templates/cabecera');
            $this->load->view('templates/menu', $datosMenu);
            $this->load->view('paginas/municipios.php', $datos);
            $this->load->view('templates/pie', $datosPie);
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

            $this->load->model('MunicipiosModel','MM',true);
            $listaMunicipios = $this->MM->getMunicipiosParams($idPais,$idComunidad,$idProvincia,$idMunicipio);
            $datos['listaMunicipios']=$listaMunicipios;

            $this->load->view('paginas/municipios_recarga.php', $datos);
         }
    }