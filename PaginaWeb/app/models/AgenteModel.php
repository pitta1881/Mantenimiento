<?php

namespace App\Models;

use App\Core\Model;

class AgenteModel extends Model
{
    protected $table = 'agentes';
    protected $tableEspecializacion='especializacion';
    protected $tableItemAgentes='itemAgente';
    protected $tablePersona = 'personas';
    
    public function getPermisos($idRol){
      $roles = $this->db->selectPermisosByRol($idRol);
      $misRoles = json_decode(json_encode($roles), True);
      return $misRoles; 
  }

    public function getEspecializaciones() {
      $array = [];
      $especializaciones = $this->db->getEspecializaciones($this->tableEspecializacion);
      $misEspecializaciones = json_decode(json_encode($especializaciones), True);
      return $misEspecializaciones;
      
  }

    
   public function get()
    {
        $agentes = $this->db->selectAll($this->table);
        $todosAgentes = json_decode(json_encode($agentes), True);
        for ($i=0; $i < count($todosAgentes); $i++) { 
          $todosAgentes[$i]['especializacionNombre']=$this->getNombreEspecializacionPorId($todosAgentes[$i]['idEspecializacion']);
          $persona = $this->getPersonaPorId($todosAgentes[$i]['idAgente']);
          $todosAgentes[$i]['nombre']=$persona['nombre'];
          $todosAgentes[$i]['apellido']=$persona['apellido'];
          $yaEstaUsado = [];
          $yaEstaUsado = $this->db->getFromItemAgenteConIdAgente($this->tableItemAgentes,$todosAgentes[$i]['idAgente']);
          if(empty($yaEstaUsado)){
            $todosAgentes[$i]['usado'] = false;
        } else{
            $todosAgentes[$i]['usado'] = true;
        }
        }
        return $todosAgentes;
    }

    public function insert(array $datos){
      if(!($this->db->buscarIfExists($this->table,$datos))){
        return $this->db->insert($this->table, $datos);
        } else {
        return false;
      }
    }


    public function getByIdAgente($idAgente){
      $agente = $this->db->selectAgenteById($this->table,$idAgente);
      $miAgente = json_decode(json_encode($agente[0]), True);  
      $persona = $this->getPersonaPorId($idAgente);
      $miAgente['nombre']=$persona['nombre'];
      $miAgente['apellido']=$persona['apellido'];
      $miAgente['especializacionNombre']=$this->getNombreEspecializacionPorId($miAgente['idEspecializacion']);
      return $miAgente;
    }

    public function update(array $datos,$idAgente)
    {
        $this->db->updateAgente($this->table, $datos,$idAgente);
    }

    public function delete($nAgente){
      //habria que verificar que el insumo no este asignado a una tarea
      $this->db->deleteAgente($this->table,$nAgente);
    }  

    public function getIdEspecializacionPorNombre($nombreEspecializacion) {
      $id = $this->db->getIdFromNombreEspecializacion($this->tableEspecializacion, $nombreEspecializacion);
      return $id[0][0];
    } 
    
    public function getNombreEspecializacionPorId($idEspecializacion) {
      $nombre = $this->db->getNombreFromIdEspecializacion($this->tableEspecializacion, $idEspecializacion);
      return $nombre[0][0];
    } 

    public function getPersonasNoAgentes(){
      $personas = $this->db->selectPersonasNoAgentes($this->tablePersona,$this->table);
      $personasNoAgentes = json_decode(json_encode($personas), True);  
      return $personasNoAgentes;
    }

    public function getPersonaPorId($idAgente){
      $persona = $this->db->selectPersonaByDNI($this->tablePersona,$idAgente);
      $miPersona = json_decode(json_encode($persona[0]), True);  
      return $miPersona;
    }
}

