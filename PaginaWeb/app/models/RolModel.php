<?php

namespace App\Models;

use App\Core\Model;

class RolModel extends Model{
    protected $table = 'roles';
    protected $tableRP = 'rolesxpermisos';


    public function get(){
        $roles = $this->db->selectAll($this->table);
        $misRoles = json_decode(json_encode($roles), True);
        return $misRoles; 
    }

    public function getRol($idRol){
        $roles = $this->db->selectRolById($this->table,$idRol);
        $misRoles = json_decode(json_encode($roles), True);
        return $misRoles; 
    }

    public function getPermisos($idRol){
        $roles = $this->db->selectPermisosByRol($idRol);
        $misRoles = json_decode(json_encode($roles), True);
        return $misRoles; 
    }
    

    public function insert(array $datos){
        if(!($this->db->buscarIfExists($this->table,$datos))){
            return $this->db->insert($this->table, $datos);
            } else {
            return false;
          }           
    }

    public function updateRol (array $rolModificado,$idRol){
        $this->db->updateRol($this->table, $rolModificado,$idRol);
    }

    public function borrarPermisosAsoc ($idRol){
        $this->db->borrarPermisosAsociados($idRol);
    }

    public function agregarPermisosAsoc ($idRol,array $datos){
        return $this->db->insert($this->tableRP,$datos);
    }

}