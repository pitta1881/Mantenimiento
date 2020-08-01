<?php

namespace App\Models;

use App\Core\Model;

class RolModel extends Model{
   
    protected $tableRP = 'rolesxpermisos';

    public function borrarPermisosAsoc($idRol){
        $this->db->delete($this->tableRP,$idRol);
    }

    public function agregarPermisosAsoc(array $datos){
        return $this->db->insert($this->tableRP,$datos);
    }

}