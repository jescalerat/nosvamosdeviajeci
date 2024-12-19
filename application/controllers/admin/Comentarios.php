<?php

    class Comentarios extends CI_Controller {

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

            $datos['municipio']=null;
            $datos['idMunicipio']=null;
            $datos['idComentario']=null;
            $datos['idVisitado']=null;
            $datos['comentarioES']=null;
            $datos['comentarioCA']=null;
            $datos['comentarioEN']=null;

            $this->load->model('ComentariosModel','COM',true);
            $listaSinComentarios = $this->COM->sinComentarios();
            $datos['listaSinComentarios']=$listaSinComentarios;

            $listaConComentarios = $this->COM->conComentarios();
            $datos['listaConComentarios']=$listaConComentarios;
            
            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/comentarios', $datos);
        }

        public function ponerComentario($idMunicipio,$idVisitado){
            
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];

            $municipio = obtenerMunicipio($idMunicipio, false);

            $datos['municipio']=$municipio;
            $datos['idMunicipio']=$idMunicipio;
            $datos['idComentario']=null;
            $datos['idVisitado']=$idVisitado;
            $datos['comentarioES']=null;
            $datos['comentarioCA']=null;
            $datos['comentarioEN']=null;

            $this->load->model('ComentariosModel','COM',true);
            $comentario = $this->COM->getComentario($idVisitado);
            if ($comentario != null) {
                $datos['comentarioES']=$comentario[0]['ComentarioES'];
                $datos['comentarioEN']=$comentario[0]['ComentarioEN'];
                $datos['comentarioCA']=$comentario[0]['ComentarioCA'];
                $datos['idComentario']=$comentario[0]['IdComentario'];
            }

            $listaSinComentarios = null;
            $datos['listaSinComentarios']=$listaSinComentarios;

            $listaConComentarios = null;
            $datos['listaConComentarios']=$listaConComentarios;
            
            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/comentarios', $datos);
        }

        public function subirComentarios(){
            $comentarioES = null;
            $comentarioCA = null;
            $comentarioEN = null;
            $idVisitado = null;
            $idMunicipio = null;
            $idComentario = null;
            
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

            if (!is_null($this->input->post('idVisitado')) && $this->input->post('idVisitado') != 0){
                $idVisitado = $this->input->post('idVisitado');
            }

            if (!is_null($this->input->post('idMunicipio')) && $this->input->post('idMunicipio') != 0){
                $idMunicipio = $this->input->post('idMunicipio');
            }

            if (!is_null($this->input->post('idComentario')) && $this->input->post('idComentario') != 0){
                $idComentario = $this->input->post('idComentario');
            }

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];

            $municipio = obtenerMunicipio($idMunicipio, false);
            
            $datos['municipio']=null;
            $datos['idMunicipio']=null;
            $datos['idComentario']=null;
            $datos['idVisitado']=null;
            $datos['comentarioES']=null;
            $datos['comentarioCA']=null;
            $datos['comentarioEN']=null;

            $this->load->model('ComentariosModel','COM',true);
            if ($idComentario == null){
                $data = array(
                    'IdVisitado'  => $idVisitado,
                    'ComentarioES'  => $comentarioES,
                    'ComentarioCA' => $comentarioCA,
                    'ComentarioEN' => $comentarioEN
                );
                $this->COM->guardar($data);
            } else {
                $data = array(
                    'IdComentario'  => $idComentario,
                    'IdVisitado'  => $idVisitado,
                    'ComentarioES'  => $comentarioES,
                    'ComentarioCA' => $comentarioCA,
                    'ComentarioEN' => $comentarioEN
                );
                $this->COM->modificar($data);
            }
            

            $listaSinComentarios = $this->COM->sinComentarios();
            $datos['listaSinComentarios']=$listaSinComentarios;

            $listaConComentarios = $this->COM->conComentarios();
            $datos['listaConComentarios']=$listaConComentarios;
            
            $queries = $this->db->queries;

            $output = null;
            foreach ($queries as $key => $query) {

                $output .= $query . "<br>";
            
            }
            print ("Querys: ".$output);

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/comentarios', $datos);
        }

        public function borrarComentarios($idComentario){

            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];
  
            $datos['municipio']=null;
            $datos['idMunicipio']=null;
            $datos['idComentario']=null;
            $datos['idVisitado']=null;
            $datos['comentarioES']=null;
            $datos['comentarioCA']=null;
            $datos['comentarioEN']=null;

            $this->load->model('ComentariosModel','COM',true);

            $this->COM->eliminar($idComentario);

            $listaSinComentarios = $this->COM->sinComentarios();
            $datos['listaSinComentarios']=$listaSinComentarios;

            $listaConComentarios = $this->COM->conComentarios();
            $datos['listaConComentarios']=$listaConComentarios;
            
            $queries = $this->db->queries;

            $output = null;
            foreach ($queries as $key => $query) {

                $output .= $query . "<br>";
            
            }
            print ("Querys: ".$output);

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/comentarios', $datos);
        }

        
    }