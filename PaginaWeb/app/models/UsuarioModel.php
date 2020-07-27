<?php

namespace App\Models;

use App\Core\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $tableRol='roles';
    protected $tablePersona='personas';
    protected $tablePermisos='permisos';
    protected $tableAgentes='agentes';
    
    protected $tableRolXPermiso='rolesxpermisos';

    
    public function getPermisos($idRol){
        $roles = $this->db->selectPermisosByRol($idRol);
        $misRoles = json_decode(json_encode($roles), True);
        return $misRoles; 
    }

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

    public function AllPermisos($nombreUser){
        $cantidad = $this->db->selectPermisosNombre($nombreUser);
        return $cantidad;
    }

    public function insert(array $datos){
        if(!($this->db->buscarIfExists($this->table,$datos))){
          return $this->db->insert($this->table, $datos);
          } else {
          return false;
        }
    }    

    public function update (array $datos){
        if($this->db->update($this->table, $datos)){
            return true;
        } else {
            return false;
        }
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

    public function guardarPermisosXRol($datos){   
        return $this->db->insert($this->tableRolXPermiso, $datos);
    }

    public function permisosxrol($idRol,$nombreRol){
        $permisos = $this->db->selectAllpermisosByIdRol($this->tableRolXPermiso,$idRol);
        $todosPermisos = json_decode(json_encode($permisos), True);
        $todosPermisos['nombreRol']=$nombreRol;
        return $todosPermisos;
    }

    public function getDatosUsuario($nombreUsuario){
        $usuario=$this->db->selectUsuarioByNombre($this->table,$nombreUsuario);
        $misUsuarios = json_decode(json_encode($usuario), True);
        for ($i=0; $i < count($misUsuarios); $i++) { 
            $persona = $this->getPersonaPorId($misUsuarios[$i]['idPersona']);
            $misUsuarios[$i]['nombreApe'] = $persona['nombre'].' '.$persona['apellido'];
            $rol = $this->getRolPorId($misUsuarios[$i]['idRol']);
            $misUsuarios[$i]['nombreRol'] = $rol['nombreRol'];
          }
        return $misUsuarios;
    }
}
