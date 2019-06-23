<?php

namespace App\Models;

use App\Core\Model;

class Roles extends Model{
    protected $table = 'roles';
    

    public function get(){
        $roles = $this->db->selectAll($this->table);
        $misRoles = json_decode(json_encode($roles), True);
        return $misRoles; 
    }

    public function insert(array $datos)
    {
        $this->db->insert($this->table, $datos);
    }

}