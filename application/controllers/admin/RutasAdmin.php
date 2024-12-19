<?php

    class RutasAdmin extends CI_Controller {

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

            $datos['idRuta']=null;
            $datos['fechaES']=null;
            $datos['fechaCA']=null;
            $datos['fechaEN']=null;
            $datos['orden']=null;

            $this->load->model('RutasModel','RM',true);
            $listaRutas = $this->RM->getAll();
            $datos['listaRutas']=$listaRutas;

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/rutas', $datos);
        }

        public function ponerRuta($idRuta){
            
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];

            $datos['idRuta']=$idRuta;
            $datos['fechaES']=null;
            $datos['fechaCA']=null;
            $datos['fechaEN']=null;
            $datos['orden']=null;

            $this->load->model('RutasModel','RM',true);
            $ruta = $this->RM->getRuta($idRuta);
            if ($ruta != null) {
                $datos['fechaES']=$ruta[0]['FechaES'];
                $datos['fechaCA']=$ruta[0]['FechaCA'];
                $datos['fechaEN']=$ruta[0]['FechaEN'];
                $datos['orden']=$ruta[0]['Orden'];
            }

            $listaRutas = $this->RM->getAll();
            $datos['listaRutas']=$listaRutas;
            
            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/rutas', $datos);
        }

        public function subirRutas(){
            $fechaES = null;
            $fechaCA = null;
            $fechaEN = null;
            $orden = null;
            $idRuta = null;
            
            if (!is_null($this->input->post('fechaES')) && $this->input->post('fechaES') != 0){
                $fechaES = $this->input->post('fechaES');
                $fechaES = str_replace("'", "''", $fechaES);
            }

            if (!is_null($this->input->post('fechaCA')) && $this->input->post('fechaCA') != 0){
                $fechaCA = $this->input->post('fechaCA');
                $fechaCA = str_replace("'", "''", $fechaCA);
            }

            if (!is_null($this->input->post('fechaEN')) && $this->input->post('fechaEN') != 0){
                $fechaEN = $this->input->post('fechaEN');
                $fechaEN = str_replace("'", "''", $fechaEN);
            }

            if (!is_null($this->input->post('orden')) && $this->input->post('orden') != 0){
                $orden = $this->input->post('orden');
            }

            if (!is_null($this->input->post('idRuta')) && $this->input->post('idRuta') != 0){
                $idRuta = $this->input->post('idRuta');
            }

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];

            $datos['idRuta']=null;
            $datos['fechaES']=null;
            $datos['fechaCA']=null;
            $datos['fechaEN']=null;
            $datos['orden']=null;

            $this->load->model('RutasModel','RM',true);
            if ($idRuta == null){
                $data = array(
                    'FechaES'  => $fechaES,
                    'FechaCA'  => $fechaCA,
                    'FechaEN' => $fechaEN,
                    'Orden' => $orden
                );
                $this->RM->guardar($data);
            } else {
                $data = array(
                    'IdRuta'  => $idRuta,
                    'FechaES'  => $fechaES,
                    'FechaCA'  => $fechaCA,
                    'FechaEN' => $fechaEN,
                    'Orden' => $orden
                );
                $this->RM->modificar($data);
            }
            
            $this->load->model('RutasModel','RM',true);
            $listaRutas = $this->RM->getAll();
            $datos['listaRutas']=$listaRutas;
            
            $queries = $this->db->queries;

            $output = null;
            foreach ($queries as $key => $query) {

                $output .= $query . "<br>";
            
            }
            print ("Querys: ".$output);

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/rutas', $datos);
        }

        public function borrarRutas($idRuta){

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];
  
            $datos['idRuta']=null;
            $datos['fechaES']=null;
            $datos['fechaCA']=null;
            $datos['fechaEN']=null;
            $datos['orden']=null;

            $this->load->model('RutasModel','RM',true);
            $this->RM->eliminar($idRuta);

            $listaRutas = $this->RM->getAll();
            $datos['listaRutas']=$listaRutas;
            
            $queries = $this->db->queries;

            $output = null;
            foreach ($queries as $key => $query) {

                $output .= $query . "<br>";
            
            }
            print ("Querys: ".$output);

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/rutas', $datos);
        }

        public function ponerDias($idRuta){

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];
  
            $datos['idRuta']=$idRuta;
            $datos['idRutaDia']=null;
            $datos['fechaForm']=null;
            

            $this->load->model('RutasModel','RM',true);
            $ruta = $this->RM->getRuta($idRuta);
            $datos['titulo']=$ruta[0]['FechaES'];

            $this->load->model('RutasDiaModel','RDM',true);
            $listaDiasRuta = $this->RDM->getDiasRuta($idRuta);
            $datos['listaDiasRuta']=$listaDiasRuta;

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/ruta_dias', $datos);
        }

        public function subirDias(){
            $idRutaDia = null;
            $idRuta = null;
            $fecha = null;
            
            if (!is_null($this->input->post('idRutaDia')) && $this->input->post('idRutaDia') != 0){
                $idRutaDia = $this->input->post('idRutaDia');
            }

            if (!is_null($this->input->post('idRuta')) && $this->input->post('idRuta') != 0){
                $idRuta = $this->input->post('idRuta');
            }

            if (!is_null($this->input->post('fecha')) && $this->input->post('fecha') != 0){
                $fecha = $this->input->post('fecha');
            }

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];

            $datos['idRuta']=$idRuta;
            $datos['idRutaDia']=null;
            $datos['fechaForm']=null;

            $this->load->model('RutasDiaModel','RDM',true);
            if ($idRutaDia == null){
                
                $idRutaDia = $this->RDM->maxRutaDia($idRuta) + 1;
                $data = array(
                    'IdRutaDia'  => $idRutaDia,
                    'IdRuta'  => $idRuta,
                    'Fecha' => $fecha
                );
                $this->RDM->guardar($data);
            } else {
                $data = array(
                    'IdRutaDia'  => $idRutaDia,
                    'Fecha' => $fecha
                );
                $this->RDM->modificar($data);
            }
           
            $this->load->model('RutasModel','RM',true);
            $ruta = $this->RM->getRuta($idRuta);
            $datos['titulo']=$ruta[0]['FechaES'];

            $listaDiasRuta = $this->RDM->getDiasRuta($idRuta);
            $datos['listaDiasRuta']=$listaDiasRuta;

            $queries = $this->db->queries;

            $output = null;
            foreach ($queries as $key => $query) {

                $output .= $query . "<br>";
            
            }
            print ("Querys: ".$output);

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/ruta_dias', $datos);
        }

        public function ponerRutaDia($idRutaDia, $idRuta){

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];
  
            $datos['idRuta']=$idRuta;
            $datos['idRutaDia']=$idRutaDia;
            

            $this->load->model('RutasModel','RM',true);
            $ruta = $this->RM->getRuta($idRuta);
            $datos['titulo']=$ruta[0]['FechaES'];

            $this->load->model('RutasDiaModel','RDM',true);
            $rutaDia = $this->RDM->getRutaDia($idRutaDia);
            $datos['fechaForm']=$rutaDia[0]['Fecha'];

            $listaDiasRuta = $this->RDM->getDiasRuta($idRuta);
            $datos['listaDiasRuta']=$listaDiasRuta;

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/ruta_dias', $datos);
        }

        public function borrarRutaDia($idRutaDia, $idRuta){

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];
  
            $datos['idRuta']=$idRuta;
            $datos['idRutaDia']=null;
            $datos['fechaForm']=null;

            $this->load->model('RutasDiaModel','RDM',true);
            $this->RDM->eliminar($idRutaDia);

            $this->load->model('RutasModel','RM',true);
            $ruta = $this->RM->getRuta($idRuta);
            $datos['titulo']=$ruta[0]['FechaES'];

            $listaDiasRuta = $this->RDM->getDiasRuta($idRuta);
            $datos['listaDiasRuta']=$listaDiasRuta;

            $queries = $this->db->queries;

            $output = null;
            foreach ($queries as $key => $query) {

                $output .= $query . "<br>";
            
            }
            print ("Querys: ".$output);

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/ruta_dias', $datos);
        }

        public function ponerMunicipios($idRutaDia){

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];
  
            $datos['idRutaDia']=$idRutaDia;

            $this->load->model('RutasDiaModel','RDM',true);
            $rutaDia = $this->RDM->getRutaDia($idRutaDia);
            $datos['titulo']=$rutaDia[0]['Fecha'];
            $datos['idRuta']=$rutaDia[0]['IdRuta'];

            $this->load->model('VisitadosModel','VM',true);
            $listaMunicipiosDia = $this->VM->getVisitadosDia($rutaDia[0]['Fecha']);
            $datos['listaMunicipiosDia']=$listaMunicipiosDia;

            $this->load->model('RutasMunicipiosModel','RMM',true);
            $listaMunicipiosVisitados = $this->RMM->getMunicipiosRutaDia($idRutaDia);
            $datos['listaMunicipiosVisitados']=$listaMunicipiosVisitados;

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/municipios_dia', $datos);
        }

        public function subirMunicipioDia(){
            $idRutaDia = null;
            $idVisitado = null;
            
            if (!is_null($this->input->post('idRutaDia')) && $this->input->post('idRutaDia') != 0){
                $idRutaDia = $this->input->post('idRutaDia');
            }

            if (!is_null($this->input->post('idVisitado')) && $this->input->post('idVisitado') != 0){
                $idVisitado = $this->input->post('idVisitado');
            }

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];

            $datos['idRutaDia']=$idRutaDia;

            $this->load->model('RutasMunicipiosModel','RMM',true);
                
            $idRutaMunicipio = $this->RMM->maxMunicipioRuta() + 1;
            $orden = $this->RMM->maxMunicipioRutaOrden($idRutaDia) + 1;
            $data = array(
                'IdRutaMunicipio'  => $idRutaMunicipio,
                'IdRutaDia'  => $idRutaDia,
                'IdVisitado' => $idVisitado,
                'Orden' => $orden
            );
            $this->RMM->guardar($data);
           
            $this->load->model('RutasDiaModel','RDM',true);
            $rutaDia = $this->RDM->getRutaDia($idRutaDia);
            $datos['titulo']=$rutaDia[0]['Fecha'];
            $datos['idRuta']=$rutaDia[0]['IdRuta'];

            $this->load->model('VisitadosModel','VM',true);
            $listaMunicipiosDia = $this->VM->getVisitadosDia($rutaDia[0]['Fecha']);
            $datos['listaMunicipiosDia']=$listaMunicipiosDia;

            $listaMunicipiosVisitados = $this->RMM->getMunicipiosRutaDia($idRutaDia);
            $datos['listaMunicipiosVisitados']=$listaMunicipiosVisitados;

            $queries = $this->db->queries;

            $output = null;
            foreach ($queries as $key => $query) {

                $output .= $query . "<br>";
            
            }
            print ("Querys: ".$output);

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/municipios_dia', $datos);
        }

        public function borrarMunicipioDia($idMunicipioRuta, $idRutaDia){

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];
  
            $datos['idRutaDia']=$idRutaDia;

            $this->load->model('RutasMunicipiosModel','RMM',true);
            $this->RMM->eliminar($idMunicipioRuta);

            $this->load->model('RutasDiaModel','RDM',true);
            $rutaDia = $this->RDM->getRutaDia($idRutaDia);
            $datos['titulo']=$rutaDia[0]['Fecha'];
            $datos['idRuta']=$rutaDia[0]['IdRuta'];

            $this->load->model('VisitadosModel','VM',true);
            $listaMunicipiosDia = $this->VM->getVisitadosDia($rutaDia[0]['Fecha']);
            $datos['listaMunicipiosDia']=$listaMunicipiosDia;

            $listaMunicipiosVisitados = $this->RMM->getMunicipiosRutaDia($idRutaDia);
            $datos['listaMunicipiosVisitados']=$listaMunicipiosVisitados;

            $queries = $this->db->queries;

            $output = null;
            foreach ($queries as $key => $query) {

                $output .= $query . "<br>";
            
            }
            print ("Querys: ".$output);

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/municipios_dia', $datos);
        }

        public function ponerComentarios($idRutaDia){

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];
  
            $datos['idRutaDia']=$idRutaDia;
            $datos['idRutaComentario']=null;
            $datos['comentarioES']=null;
            $datos['comentarioCA']=null;
            $datos['comentarioEN']=null;
            

            $this->load->model('RutasDiaModel','RDM',true);
            $rutaDia = $this->RDM->getRutaDia($idRutaDia);
            $datos['titulo']=$rutaDia[0]['Fecha'];
            $datos['idRuta']=$rutaDia[0]['IdRuta'];

            $this->load->model('RutasComentariosModel','RCM',true);
            $listaComentariosDia = $this->RCM->getComentarioRutaDia($idRutaDia);
            $datos['listaComentariosDia']=$listaComentariosDia;


            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/comentarios_dia', $datos);
        }

        public function subirComentariosDia(){
            $idRutaDia = null;
            $idRutaComentario = null;
            $comentarioES = null;
            $comentarioCA = null;
            $comentarioEN = null;
            
            if (!is_null($this->input->post('idRutaDia')) && $this->input->post('idRutaDia') != 0){
                $idRutaDia = $this->input->post('idRutaDia');
            }

            if (!is_null($this->input->post('idRutaComentario')) && $this->input->post('idRutaComentario') != 0){
                $idRutaComentario = $this->input->post('idRutaComentario');
            }

            if (!is_null($this->input->post('comentarioES')) && $this->input->post('comentarioES') != 0){
                $comentarioES = $this->input->post('comentarioES');
                $comentarioES = str_replace("'", "''", $comentarioES);
            }

            if (!is_null($this->input->post('comentarioCA')) && $this->input->post('comentarioCA') != 0){
                $comentarioCA = $this->input->post('comentarioCA');
                $comentarioCA = str_replace("'", "''", $comentarioCA);
            }

            if (!is_null($this->input->post('comentarioEN')) && $this->input->post('comentarioEN') != 0){
                $comentarioEN = $this->input->post('comentarioEN');
                $comentarioEN = str_replace("'", "''", $comentarioEN);
            }

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];

            $datos['idRutaDia']=$idRutaDia;
            $datos['idRutaComentario']=null;
            $datos['comentarioES']=null;
            $datos['comentarioCA']=null;
            $datos['comentarioEN']=null;

            $this->load->model('RutasComentariosModel','RCM',true);
            if ($idRutaComentario == null){
                
                $idRutaComentario = $this->RCM->maxComentariosRuta() + 1;
                $data = array(
                    'IdRutaComentario'  => $idRutaComentario,
                    'IdRutaDia'  => $idRutaDia,
                    'ComentarioES' => $comentarioES,
                    'ComentarioCA' => $comentarioCA,
                    'ComentarioEN' => $comentarioEN
                );
                $this->RCM->guardar($data);
            } else {
                $data = array(
                    'IdRutaComentario'  => $idRutaComentario,
                    'IdRutaDia'  => $idRutaDia,
                    'ComentarioES' => $comentarioES,
                    'ComentarioCA' => $comentarioCA,
                    'ComentarioEN' => $comentarioEN
                );
                $this->RCM->modificar($data);
            }
           
            $this->load->model('RutasDiaModel','RDM',true);
            $rutaDia = $this->RDM->getRutaDia($idRutaDia);
            $datos['titulo']=$rutaDia[0]['Fecha'];
            $datos['idRuta']=$rutaDia[0]['IdRuta'];

            $listaComentariosDia = $this->RCM->getComentarioRutaDia($idRutaDia);
            $datos['listaComentariosDia']=$listaComentariosDia;

            $queries = $this->db->queries;

            $output = null;
            foreach ($queries as $key => $query) {

                $output .= $query . "<br>";
            
            }
            print ("Querys: ".$output);

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/comentarios_dia', $datos);
        }

        public function ponerComentarioDia($idRutaComentario, $idRutaDia){

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];
  
            $datos['idRutaDia']=$idRutaDia;
            $datos['idRutaComentario']=$idRutaComentario;
            

            $this->load->model('RutasDiaModel','RDM',true);
            $rutaDia = $this->RDM->getRutaDia($idRutaDia);
            $datos['titulo']=$rutaDia[0]['Fecha'];
            $datos['idRuta']=$rutaDia[0]['IdRuta'];

            $this->load->model('RutasComentariosModel','RCM',true);
            $comentarioRuta = $this->RCM->getComentarioRuta($idRutaComentario);
            $datos['comentarioES']=$comentarioRuta[0]['ComentarioES'];
            $datos['comentarioCA']=$comentarioRuta[0]['ComentarioCA'];
            $datos['comentarioEN']=$comentarioRuta[0]['ComentarioEN'];

            $listaComentariosDia = $this->RCM->getComentarioRutaDia($idRutaDia);
            $datos['listaComentariosDia']=$listaComentariosDia;

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/comentarios_dia', $datos);
        }

        public function borrarComentarioDia($idRutaComentario, $idRutaDia){

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];
  
            $datos['idRutaDia']=$idRutaDia;
            $datos['idRutaComentario']=null;
            $datos['comentarioES']=null;
            $datos['comentarioCA']=null;
            $datos['comentarioEN']=null;

            $this->load->model('RutasComentariosModel','RCM',true);
            $this->RCM->eliminar($idRutaComentario);

            $this->load->model('RutasDiaModel','RDM',true);
            $rutaDia = $this->RDM->getRutaDia($idRutaDia);
            $datos['titulo']=$rutaDia[0]['Fecha'];
            $datos['idRuta']=$rutaDia[0]['IdRuta'];
            
            $listaComentariosDia = $this->RCM->getComentarioRutaDia($idRutaDia);
            $datos['listaComentariosDia']=$listaComentariosDia;

            $queries = $this->db->queries;

            $output = null;
            foreach ($queries as $key => $query) {

                $output .= $query . "<br>";
            
            }
            print ("Querys: ".$output);

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/comentarios_dia', $datos);
        }
        
    }