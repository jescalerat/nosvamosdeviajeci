<?php

class BbddModel extends CI_Model
{
    public function lanzar($sql){
        $error = false;        

        if ($this->db->simple_query($sql))
        {
            $error = false;
        }
        else
        {
            $error = true;
        }

        return $error;
    }
}