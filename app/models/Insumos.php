<?php

namespace App\Models;

use App\Core\Model;

class Insumos extends Model
{
    protected $table = 'insumos';
    
 /*   public function get()
    {
        $insumos = $this->db->selectAll($this->table);
    }

   public function buscarUsuario($user){
       //comparo si existe el nombre de usuario 
       return $this->db->comparaUsuario($this->table,$user);
    }

    public function insert(array $usuarios)
    {
        $this->db->insert($this->table, $usuarios);
    }

    public function update (array $usuarioModificado,$nombre)
    {
        $this->db->update($this->table, $usuarioModificado,$nombre);
    }

public function getRoles(){
    $roles = $this->db->selectAllRoles($this->tableRol);
    $misRoles = json_decode(json_encode($roles), True);
    return $misRoles; 
}
   
    
*/    
}
