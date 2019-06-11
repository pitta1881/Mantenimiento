<?php

namespace App\Models;

use App\Core\Model;

class Agentes extends Model
{
    protected $table = 'agentes';
    protected $tableEspecializacion='especializacion';

    public function getEspecializaciones() {
      return array("ALBAnIL","ELECTRICISTA","PLOMERO","PINTOR","GASISTA");
  }

    
   public function get()
    {
        $agentes = $this->db->selectAll($this->table);
        $todosAgentes = json_decode(json_encode($agentes), True);
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
    /* public function insertEspecialidades(array $especialidades)
    {       
         for ($i=0;$i<count($especialidades);$i++) 
      	{ 
      $this->db->insert($this->tableEspecializacion, $especialidades);
    }*/

    
   /*
    public function getEspecializacion(){
    $especializacion = $this->db->selectAllEspecializacion($this->tableEspecializacion);
    $misEspecializaciones = json_decode(json_encode($especializacion), True);
    return $misEspecializaciones; 
  }
    */
   
}
