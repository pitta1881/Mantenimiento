<?php

namespace App\Models;

use App\Core\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';
    protected $tableRol='roles';
    protected $tablePersona='personas';
    protected $tablePermisos='permisos';
    
    public function get()
    {
        //$usuarios = $this->db->selectAll($this->table);
        return  $this->db->selectUsuarioPorPersonaPorRol($this->table,$this->tableRol,$this->tablePersona);
     //   $persona=$this->db->selectAll($this->'personas');
       
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
   
    public function  getPersonas(){
    $personas = $this->db->selectAllPersonas($this->tablePersona);
    $misPersonas = json_decode(json_encode($personas), True);
    return $misPersonas; 
}
  
public function buscarPersona($user){
       //comparo si existe el nombre de usuario 
       return $this->db->comparaPersona($this->tablePersona,$user);
    }

   
    
}
