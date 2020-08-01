<?php

namespace App\Models;

use App\Core\Model;

class LogInOutModel extends Model{

    public function buscarUsuario($table, array $datos){
        if($this->db->buscarIfExistsAnd($table,$datos)){
            return $this->db->selectWhatWhere($table,'idRol',$datos)[0]['idRol'];
        } else {
            return false;
        }
    }

}
