<?php

namespace App\Models;

use App\Core\Model;

class Especializacion extends Model
{
  protected $tableTarea = 'tarea';
  protected $table='especializacion';
  protected $tableAgentes='agentes';

  public function get()
  {
      $especializaciones = $this->db->selectAll($this->table);
      $todasEspecializaciones = json_decode(json_encode($especializaciones), True);
      for ($i=0; $i < count($todasEspecializaciones); $i++) { 
        $yaEstaUsado = [];
        $yaEstaUsado = $this->db->getFromAgenteConIdEspecializacion($this->tableAgentes,$todasEspecializaciones[$i]['idEspecializacion']);
        $yaEstaUsado2 = $this->db->getFromTareaConIdEspecializacion($this->tableTarea,$todasEspecializaciones[$i]['idEspecializacion']);
        if(empty($yaEstaUsado) && (empty($yaEstaUsado2))){
            $todasEspecializaciones[$i]['usado'] = false;
        } else{
            $todasEspecializaciones[$i]['usado'] = true;
        }
      }
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
      $this->db->deleteEspecializacion($this->table,$nEspecializacion);
    }  
       
}
