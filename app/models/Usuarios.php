<?php

namespace App\Models;

use App\Core\Model;

class Usuarios extends Model
{
    protected $table = 'usuarios';
    protected $tableRol='roles';
    protected $tablePersona='personas';
    protected $tablePermisos='permisos';
    protected $tableAgentes='agentes';
    protected $size_pagina=2;
    protected $tableRolXPermiso='rolesxpermisos';

    public function get(){
        $Usuario=$this->db->selectUsuarioPorPersonaPorRol($this->table,$this->tablePersona,$this->tableRol);
        $misUsuarios = json_decode(json_encode($Usuario), True);
        return  $misUsuarios;
    }

   public function buscarUsuario($user){
       //comparo si existe el nombre de usuario 
       return $this->db->comparaUsuario($this->table,$user);
    }

    public function buscarPersona($persona){
        //comparo si existe el nombre de usuario 
        return $this->db->comparaPersona($this->tablePersona,$persona);
     }

    public function AllPermisos($nombreUser){
        $cantidad = $this->db->selectPermisosNombre($nombreUser);
        return $cantidad;
    }

    public function insert(array $usuarios){
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
  public function  getPermisos(){
    $permisos = $this->db->selectAllPermisos($this->tablePermisos);
    $misPermisos = json_decode(json_encode($permisos), True);
    return $misPermisos; 
}
    
public function getSize(){
    $num_filas= $this->db->getSize($this->table);
    $total_paginas= ceil($num_filas/$this->size_pagina);
    return $total_paginas;
}    

public function getPaginacion($page){
    $pagina=$page;
    $empezar_desde=($pagina-1)*$this->size_pagina;
    $num_filas= $this->getSize();
    $total_paginas= ceil($num_filas/$this->size_pagina);
    $usuarios = $this->db->selectUsuarioPorPersonaPorRolLimit($this->table, $this->tablePersona, $this->tableRol,$empezar_desde,$this->size_pagina);
    $todosUsuarios = json_decode(json_encode($usuarios), True);
    return $todosUsuarios;
}

    public function guardarPermisosXRol($datos){   
        $this->db->insert($this->tableRolXPermiso, $datos);
    }

    public function permisosxrol($idRol,$nombreRol){
        $permisos = $this->db->selectAllpermisosByIdRol($this->tableRolXPermiso,$idRol);
        $todosPermisos = json_decode(json_encode($permisos), True);
        $todosPermisos['nombreRol']=$nombreRol;
        return $todosPermisos;
    }

}
