<?php

namespace App\Models;

use App\Core\Model;

class Agentes extends Model
{
    protected $table = 'agentes';
    protected $tableEspecializacion='especializacion';

    public function getEspecializaciones() {
      $array;
      $especializaciones = $this->db->getEspecializaciones($this->tableEspecializacion);
      $misEspecializaciones = json_decode(json_encode($especializaciones), True);
      for ($i=0; $i < count($misEspecializaciones); $i++) { 
        $array[$i]=$misEspecializaciones[$i]['nombre'];
      }
      return $array;
  }

    
   public function get()
    {
        $agentes = $this->db->selectAll($this->table);
        $todosAgentes = json_decode(json_encode($agentes), True);
        for ($i=0; $i < count($todosAgentes); $i++) { 
          $todosAgentes[$i]['idEspecializacion']=$this->getNombreEspecializacionPorId($todosAgentes[$i]['idEspecializacion']);
        }
        return $todosAgentes;
    }

   public function buscarAgente($nombre,$apellido){
    //   comparo si existe el nombre de usuario 
      return $this->db->comparaAgente($this->table,$nombre,$apellido);
    }

    public function insert(array $datos){
      $this->db->insert($this->table, $datos);
    }


    public function getByIdAgente($idAgente){
      $agente = $this->db->selectAgenteById($this->table,$idAgente);
      $miAgente = json_decode(json_encode($agente), True);  
      $miAgente[0]['idEspecializacion']=$this->getNombreEspecializacionPorId($miAgente[0]['idEspecializacion']);
      return $miAgente[0];
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
}
