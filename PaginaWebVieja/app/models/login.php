<?php

namespace App\Models;

use App\Core\Model;

class login extends Model{
    protected $table = 'usuarios';

    public function buscarUsuario($user, $password){
        $datos = $this->db->validarLogin($this->table,$user, $password);
        if(empty($datos)){
            return $datos;
        } else {
            return json_decode(json_encode($datos[0]),true);
        }
    }

}
