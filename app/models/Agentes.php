<?php

namespace App\Models;

use App\Core\Model;

class Agentes extends Model
{
    protected $table = 'agentes';
    protected $tableEspecializacion='especializacion';

    
   public function get()
    {
        $agentes = $this->db->selectAll($this->table);
       
       
    }

   public function buscarAgente($nombre,$apellido){
    //   comparo si existe el nombre de usuario 
      return $this->db->comparaAgente($this->table,$nombre,$apellido);
    }

  public function insert(array $datos)
    { echo "aca";   
      var_dump($datos);    
      $this->db->insert($this->table, $datos);
    }

    /* public function insertEspecialidades(array $especialidades)
    {       
         for ($i=0;$i<count($especialidades);$i++) 
      	{ 
      $this->db->insert($this->tableEspecializacion, $especialidades);
    }*/

   /* public function update (array $agenteModificado,$nombre)
    {
        $this->db->update($this->table, $agenteModificado,$nombre);
    }

*/
   
    public function getEspecializacion(){
    $especializacion = $this->db->selectAllEspecializacion($this->tableEspecializacion);
    $misEspecializaciones = json_decode(json_encode($especializacion), True);
    return $misEspecializaciones; 
}
   
    
}
