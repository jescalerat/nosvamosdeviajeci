<?php

    class Cambioidioma extends CI_Controller {

        public function index(){
            
       
        }

        public function cambio($idioma){
            
            if ("es" == $idioma){
                $nuevoIdioma = "spanish";
            } else if ("en" == $idioma) {
                $nuevoIdioma = "english";
            } else if ("ca" == $idioma) {
                $nuevoIdioma = "catalan";
            } else {
                $nuevoIdioma = "spanish";
            }

            $this->session->set_userdata('cambioIdioma',$nuevoIdioma);
            
            redirect('', 'refresh');
        }

    }
