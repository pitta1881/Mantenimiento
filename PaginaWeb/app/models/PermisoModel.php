<?php

namespace App\Models;

use App\Core\Model;

class PermisoModel extends Model{
    protected $table = 'permisos';

  
    public function getPermisos($idRol){
        $roles = $this->db->selectPermisosByRol($idRol);
        $misRoles = json_decode(json_encode($roles), True);
        return $misRoles; 
    }
  
    public function get(){
        $permisos = $this->db->selectAll($this->table);
        $todosPermisos = json_decode(json_encode($permisos), True);       
        return $todosPermisos;
    }

    public function insert(array $datos){
        if(!($this->db->buscarIfExists($this->table,$datos))){
            return $this->db->insert($this->table, $datos);
            } else {
            return false;
          }       
    }     
        
    public function getByIdPermiso($idEspecializacion){
        $especializacion = $this->db->getNombreFromIdPermiso($this->table,$idEspecializacion);
        $miEspecializacion = json_decode(json_encode($especializacion), True);  
        return $miEspecializacion[0];
    }
    
    public function update(array $datos,$idEspecializacion){
        $this->db->updatePermiso($this->table, $datos,$idEspecializacion);
    }
    
    public function delete($nEspecializacion){
        $this->db->deletePermiso($this->table,$nEspecializacion);
    }  

}
