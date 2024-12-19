<?php

    class Fotos extends CI_Controller {

        function __construct() {
            parent::__construct();
            
            $registrado = $this->session->userdata('registrado');

            if ($registrado == null) {
                redirect('admin/login', 'refresh');
            }
        }

        public function index(){
            $this->load->helper('funciones');

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];

            $datos['municipio']=null;
            $datos['idMunicipio']=null;

            $this->load->model('FotosModel','FM',true);
            $listaSinFotos = $this->FM->sinFotos();
            $datos['listaSinFotos']=$listaSinFotos;

            $listaConFotos = $this->FM->conFotos();
            $datos['listaConFotos']=$listaConFotos;
            
            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/fotos', $datos);
        }

        public function ponerFotos($idMunicipio){
            $this->load->helper('funciones');

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];

            $municipio = obtenerMunicipio($idMunicipio, false);
            
            $datos['municipio']=$municipio;
            $datos['idMunicipio']=$idMunicipio;

            $this->load->model('FotosModel','FM',true);
            $listaSinFotos = null;
            $datos['listaSinFotos']=$listaSinFotos;

            $listaConFotos = null;
            $datos['listaConFotos']=$listaConFotos;
            
            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/fotos', $datos);
        }

        public function subirFotos(){
            $this->load->helper('funciones');

            $fotos = null;
            $idMunicipio = null;
            
            if (!is_null($this->input->post('fotos')) && $this->input->post('fotos') != 0){
                $fotos = $this->input->post('fotos');
            }

            if (!is_null($this->input->post('idMunicipio')) && $this->input->post('idMunicipio') != 0){
                $idMunicipio = $this->input->post('idMunicipio');
            }

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];

            $municipio = obtenerMunicipio($idMunicipio, false);
            
            $datos['municipio']=null;
            $datos['idMunicipio']=null;

            $this->load->model('FotosModel','FM',true);

            $roworden = $this->FM->buscarOrden($idMunicipio);
            $orden = $roworden + 1;
            $fotosArray = explode(';', $fotos);
			foreach ($fotosArray as $nuevaFoto) {
				if ($nuevaFoto != ""){
                    $data = array(
                        'IdMunicipio'  => $idMunicipio,
                        'Foto'  => trim($nuevaFoto),
                        'Orden' => $orden
                    );
                    $this->FM->guardar($data);
					$orden++;
				}
            }
            

            $listaSinFotos = $this->FM->sinFotos();
            $datos['listaSinFotos']=$listaSinFotos;

            $listaConFotos = null;
            $datos['listaConFotos']=$listaConFotos;
            
            $queries = $this->db->queries;

            $output = null;
            foreach ($queries as $key => $query) {

                $output .= $query . "<br>";
            
            }
            print ("Querys: ".$output);

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/fotos', $datos);
        }

        public function borrarFotos($idMunicipio){
            $this->load->helper('funciones');

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];
  
            $datos['municipio']=null;
            $datos['idMunicipio']=null;

            $this->load->model('FotosModel','FM',true);

            $this->FM->eliminar($idMunicipio);

            $listaSinFotos = $this->FM->sinFotos();
            $datos['listaSinFotos']=$listaSinFotos;

            $listaConFotos = $this->FM->conFotos();
            $datos['listaConFotos']=$listaConFotos;
            
            $queries = $this->db->queries;

            $output = null;
            foreach ($queries as $key => $query) {

                $output .= $query . "<br>";
            
            }
            print ("Querys: ".$output);

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/fotos', $datos);
        }

        
    }