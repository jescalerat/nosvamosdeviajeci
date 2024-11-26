<?php

    class CambioPass extends CI_Controller {

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

            $message = $this->session->flashdata('mensajeError');
            $this->session->set_flashdata('mensajeError', null);
            $datos['mensajeError']=$message;

            $this->load->view('templates/cabecera');
            $this->load->view('paginas/admin/cambioPass', $datos);
        }
        
        public function mensaje(){
            
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datos['contador']=$contador[0]['Contador'];

            $usuario = $this->session->userdata('usuario');
            $pass_actual = null;
            if (!is_null($this->input->post('pass_actual'))){
                $pass_actual = $this->input->post('pass_actual');
            }

            $pass_nueva = null;
            if (!is_null($this->input->post('pass_nueva'))){
                $pass_nueva = $this->input->post('pass_nueva');
            }

            $pass_nueva_r = null;
            if (!is_null($this->input->post('pass_nueva_r'))){
                $pass_nueva_r = $this->input->post('pass_nueva_r');
            }
         
            $this->load->model('UsuariosModel','UM',true);
            $usuarioBBDD = $this->UM->getUsuario($usuario);
    
            $passBBDD = $usuarioBBDD[0]['Password'];
            $idUsuario = $usuarioBBDD[0]['IdUsuario'];

            $mensajeError="";
            if ($pass_nueva != $pass_nueva_r){
                $mensajeError="<p class=\"text-center text-danger\">No coinciden la contraseña nueva con la repetición</p>";
            } else if ($pass_actual != $passBBDD){
                $mensajeError="<p class=\"text-center text-danger\">La contraseña actual no coincide con la contraseña que tiene en base de datos</p>";
            } else {
                $data = array(
                    'IdUsuario' => $idUsuario,
                    'Password'  => $pass_nueva
                );
                $this->UM->actualizar($data);
                $mensajeError="<p class=\"text-center text-info\">Cambio realizado correctamente</p>";
            }

            $this->session->set_flashdata('mensajeError', $mensajeError);

            redirect('admin/cambioPass', 'refresh');
        }

    }