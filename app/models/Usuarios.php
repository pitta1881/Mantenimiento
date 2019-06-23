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
    
    protected $tableRolXPermiso='rolesxpermisos';

    public function get(){
        $usuario=$this->db->selectAll($this->table);
        $misUsuarios = json_decode(json_encode($usuario), True);
        for ($i=0; $i < count($misUsuarios); $i++) { 
            $persona = $this->getPersonaPorId($misUsuarios[$i]['idPersona']);
            $misUsuarios[$i]['nombreApe'] = $persona['nombre'].' '.$persona['apellido'];
            $rol = $this->getRolPorId($misUsuarios[$i]['idRol']);
            $misUsuarios[$i]['nombreRol'] = $rol['nombreRol'];
          }
        return $misUsuarios;
    }

    public function getPersonaPorId($idPersona){
        $persona = $this->db->selectPersonaByDNI($this->tablePersona,$idPersona);
        $miPersona = json_decode(json_encode($persona[0]), True);  
        return $miPersona;
    }

    public function getRolPorId($idRol){
        $rol = $this->db->selectRolById($this->tableRol,$idRol);
        $miRol = json_decode(json_encode($rol[0]), True);  
        return $miRol;
    }

   public function buscarUsuario($user){
       //comparo si existe el nombre de usuario 
       return $this->db->comparaUsuario($this->table,$user);
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
    $roles = $this->db->selectAll($this->tableRol);
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
