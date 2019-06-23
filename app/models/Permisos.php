<?php

namespace App\Models;

use App\Core\Model;

class Permisos extends Model{
    protected $table = 'permisos';

  
    public function get(){
        $permisos = $this->db->selectAll($this->table);
        $todosPermisos = json_decode(json_encode($permisos), True);       
        return $todosPermisos;
    }

}
