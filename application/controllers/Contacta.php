<?php

    class Contacta extends CI_Controller {

        function __construct() {
            parent::__construct();
            
            $idiom = $this->session->userdata('language');

            $this->lang->load('mensajes', $idiom);

            $this->load->helper('funciones');
        }

        public function index(){
            
            $titulo = $this->lang->line('contacta_titulo');
            $datos['contactaTitulo']=$titulo;
            $nombre = $this->lang->line('contacta_nombre');
            $datos['contactaNombre']=$nombre;
            $email = $this->lang->line('contacta_email');
            $datos['contactaEmail']=$email;
            $mensaje = $this->lang->line('contacta_mensaje');
            $datos['contactaMensaje']=$mensaje;
            $enviar = $this->lang->line('contacta_enviar');
            $datos['contactaEnviar']=$enviar;
            $error = $this->lang->line('contacta_error_nombre');
            $datos['contactaErrorNombre']=$error;
            $error = $this->lang->line('contacta_error_email');
            $datos['contactaErrorEmail']=$error;
            $error = $this->lang->line('contacta_error_mensaje');
            $datos['contactaErrorMensaje']=$error;
            $datos['contactaCorrecto1']='';

            $datosMenu = array ('inicio' => $this->lang->line('menu_inicio'),
                                'rutas' => $this->lang->line('menu_rutas'),
                                'municipios' => $this->lang->line('menu_municipios'),
                                'contacta' => $this->lang->line('menu_contacta'));
            
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datosPie['Contador']=$contador[0]['Contador'];

            $IP = getRealIP();
            $data = array(
                'IP' => $IP,
                'Hora'  => date("H:i:s"),
                'Fecha'  => date("Y-m-d"),
                'Pagina'  => 7,
                'Observaciones'  => ''
            );

            $this->load->model('PaginasVistasModel','PVM',true);
            $this->PVM->guardar($data);
            
            $this->load->view('templates/cabecera');
            $this->load->view('templates/menu', $datosMenu);
            $this->load->view('paginas/contacta.php', $datos);
            $this->load->view('templates/pie', $datosPie);
        }

        public function mensaje(){
            
            $titulo = $this->lang->line('contacta_titulo');
            $datos['contactaTitulo']=$titulo;
            $nombre = $this->lang->line('contacta_nombre');
            $datos['contactaNombre']=$nombre;
            $email = $this->lang->line('contacta_email');
            $datos['contactaEmail']=$email;
            $mensaje = $this->lang->line('contacta_mensaje');
            $datos['contactaMensaje']=$mensaje;
            $enviar = $this->lang->line('contacta_enviar');
            $datos['contactaEnviar']=$enviar;
            $error = $this->lang->line('contacta_error_nombre');
            $datos['contactaErrorNombre']=$error;
            $error = $this->lang->line('contacta_error_email');
            $datos['contactaErrorEmail']=$error;
            $error = $this->lang->line('contacta_error_mensaje');
            $datos['contactaErrorMensaje']=$error;
            $correcto = $this->lang->line('contacta_respuesta1');
            $datos['contactaCorrecto1']=$correcto;
            $correcto = $this->lang->line('contacta_respuesta2');
            $datos['contactaCorrecto2']=$correcto;
            $correcto = $this->lang->line('contacta_otra');
            $datos['contactaOtra']=$correcto;

            $nombre = null;
            if (!is_null($this->input->post('nombre'))){
                $nombre = $this->input->post('nombre');
            }
            $email = null;
            if (!is_null($this->input->post('correo'))){
                $email = $this->input->post('correo');
            }
            $mensaje = null;
            if (!is_null($this->input->post('mensaje'))){
                $mensaje = $this->input->post('mensaje');
            }

            $IP = getRealIP();
            $data = array(
                    'Nombre' => $nombre,
                    'Email'  => $email,
                    'Mensaje'  => $mensaje,
                    'IP' => $IP
            );

            $this->load->model('CorreoModel','EM',true);
            $this->EM->guardar($data);

            $datosMenu = array ('inicio' => $this->lang->line('menu_inicio'),
                                'rutas' => $this->lang->line('menu_rutas'),
                                'municipios' => $this->lang->line('menu_municipios'),
                                'contacta' => $this->lang->line('menu_contacta'));
            
            $this->load->model('ContadorModel','CM',true);
            $contador = $this->CM->getAll();
            $datosPie['Contador']=$contador[0]['Contador'];

            
            $data = array(
                'IP' => $IP,
                'Hora'  => date("H:i:s"),
                'Fecha'  => date("Y-m-d"),
                'Pagina'  => 72,
                'Observaciones'  => ''
            );

            $this->load->model('PaginasVistasModel','PVM',true);
            $this->PVM->guardar($data);
            
            $this->load->view('templates/cabecera');
            $this->load->view('templates/menu', $datosMenu);
            $this->load->view('paginas/contacta.php', $datos);
            $this->load->view('templates/pie', $datosPie);
        }

       
    }