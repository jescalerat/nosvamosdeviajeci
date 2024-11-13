<?php

    class Inicio extends CI_Controller {

        public function index(){
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $cuenta = $contador[0]['Contador'] + 1;
            $this->CM->guardar($cuenta);
            $datosPie['Contador']=$cuenta;

            $this->detalle($datosPie);
        }

        public function indexAdmin(){
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datosPie['Contador']=$contador[0]['Contador'];

            $this->detalle($datosPie);
        }

        private function detalle($datosPie){
            $this->load->model('MunicipiosModel','MM',true);
            $listaMunicipios = $this->MM->getMapaInicio();

            $marcas = "";
            foreach ($listaMunicipios as $row){
                $municipioText = str_replace("'", "\'", $row['Municipio']);
                $marcas .= "L.marker([".$row['CoordenadaX'].", ".$row['CoordenadaY']."]).bindPopup('".$municipioText."').addTo(cities),";
            }
            $marcas = substr($marcas, 0, strlen($marcas) - 1);
            $marcas .= ";";
            $datos['Marcas']=$marcas;

            $this->load->library('session');

            $idiom = $this->session->userdata('cambioIdioma');

            if ($idiom == null) {
            
                $idiomas = explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE']);            
                if (substr($idiomas[0], 0, 2) == "es"){$idioma = 'spanish';}
                else if (substr($idiomas[0], 0, 2) == "en"){$idioma = 'english';}
                else if (substr($idiomas[0], 0, 2) == "ca"){$idioma = 'catalan';}
                else {$idioma = 'spanish';}

                $this->session->set_userdata('language',$idioma);
                $idiom = $this->session->userdata('language');
            } else {
                $this->session->set_userdata('language',$idiom);
            }

            $this->lang->load('mensajes', $idiom);
            $titulo = $this->lang->line('titulo');

            $datosMenu = array ('inicio' => $this->lang->line('menu_inicio'),
                                'rutas' => $this->lang->line('menu_rutas'),
                                'municipios' => $this->lang->line('menu_municipios'),
                                'contacta' => $this->lang->line('menu_contacta'));
            
           
            $this->load->view('templates/cabecera');
            $this->load->view('templates/menu', $datosMenu);
            $this->load->view('paginas/inicio.php', $datos);
            $this->load->view('templates/pie', $datosPie);
        }

    }