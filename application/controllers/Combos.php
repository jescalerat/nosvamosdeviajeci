<?php

    class Combos extends CI_Controller {

        function __construct() {
            parent::__construct();
            
            $idiom = $this->session->userdata('language');

            $this->lang->load('mensajes', $idiom);
        }

        public function index(){
       
        }

        public function paises(){
            
            $this->load->model('PaisesModel','PM',true);
            $paises = $this->PM->getAll();
            
            $items = array();
            $seleccionar = $this->lang->line('municipios_seleccionar');
            echo '<option value="0">'.$seleccionar.'</option>';
            foreach ($paises as $row)
            {
                echo '<option value="'.$row["IdPais"].'">'.$row["Pais"].'</option>';
            }
        }

        public function comunidades(){
            
            $idPais = null;
            if (!is_null($this->input->post('paiselegido'))){
                $idPais = $this->input->post('paiselegido');
            }
            $this->load->model('ComunidadesModel','CM',true);
            $comunidades = $this->CM->getComunidadesPais($idPais);
            
            $items = array();
            $seleccionar = $this->lang->line('municipios_seleccionar');
            echo '<option value="0">'.$seleccionar.'</option>';
            foreach ($comunidades as $row)
            {
                echo '<option value="'.$row["IdComunidad"].'">'.$row["Comunidad"].'</option>';
            }
        }


        public function provincias(){
            
            $idComunidad = null;
            if (!is_null($this->input->post('comunidadelegida'))){
                $idComunidad = $this->input->post('comunidadelegida');
            }
            $this->load->model('ProvinciasModel','PM',true);
            $provincias = $this->PM->getProvinciaComunidades($idComunidad);
            
            $items = array();
            $seleccionar = $this->lang->line('municipios_seleccionar');
            echo '<option value="0">'.$seleccionar.'</option>';
            foreach ($provincias as $row)
            {
                echo '<option value="'.$row["IdProvincia"].'">'.$row["Provincia"].'</option>';
            }
        }

        public function municipios(){
            
            $idProvincia = null;
            if (!is_null($this->input->post('provinciaelegida'))){
                $idProvincia = $this->input->post('provinciaelegida');
            }
            $this->load->model('MunicipiosModel','MM',true);
            $municipios = $this->MM->getMunicipioProvincias($idProvincia);
            
            $items = array();
            $seleccionar = $this->lang->line('municipios_seleccionar');
            echo '<option value="0">'.$seleccionar.'</option>';
            foreach ($municipios as $row)
            {
                echo '<option value="'.$row["IdMunicipio"].'">'.$row["Municipio"].'</option>';
            }
        }

    }
