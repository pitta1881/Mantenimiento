<?php

namespace App\Models;

use App\Core\Model;

class Especializacion extends Model
{
    protected $table ='especializacion';


   public function get()
    {
        $especializaciones = $this->db->selectAll($this->table);
        $todasEspecializaciones = json_decode(json_encode($especializaciones), True);
        return $todasEspecializaciones;
    }

   public function buscarEspecializacion($nombre){
    //   comparo si existe el nombre de usuario 
      return $this->db->comparaEspecializacion($this->table,$nombre);
    }

    public function insert(array $datos){
      $this->db->insert($this->table, $datos);
    }

    public function getByIdEspecializacion($idEspecializacion){
      $especializacion = $this->db->selectEspecializacionById($this->table,$idEspecializacion);
      $miEspecializacion = json_decode(json_encode($especializacion), True);  
      return $miEspecializacion[0];
    }

    public function update(array $datos,$idEspecializacion)
    {
        $this->db->updateEspecializacion($this->table, $datos,$idEspecializacion);
    }

    public function delete($nEspecializacion){
      //habria que verificar que la Especializacion no este asignado a una tarea o un agente
      $this->db->deleteEspecializacion($this->table,$nEspecializacion);
    }  
    /* public function insertEspecialidades(array $especialidades)
    {       
         for ($i=0;$i<count($especialidades);$i++) 
      	{ 
      $this->db->insert($this->tableEspecializacion, $especialidades);
    }*/

       
}
