<?php

namespace App\Models;

use App\Core\Model;

class UsuarioModel extends Model
{
    protected $tableRol='roles';
    protected $tablePersona='personas';
      
    public function getRoles(){
        return $this->db->selectAll($this->tableRol);
    }
   
    public function getPersonas(){
        return $this->db->selectAll($this->tablePersona);
    }
}
