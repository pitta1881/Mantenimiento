<?php

namespace App\Models;

use App\Core\Model;

class login extends Model{
    protected $table = 'usuarios';

    public function buscarUsuario($user, $password){
        return $this->db->validarLogin($this->table,$user, $password);
    }

    public function getActivos($tabla,$columna){
        $cantidad = $this->db->getActivos($tabla,$columna);
        var_dump($cantidad);
        return $cantidad[0];
    }
}
