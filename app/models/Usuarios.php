<?php

namespace App\Models;

use App\Core\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';
    

    
    public function get()
    {
        $usuarios = $this->db->selectAll($this->table);
       
       
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


   
    
    
}
