<?php

namespace App\Models;

use App\Core\Model;

class Agentes extends Model
{
    protected $table = 'agentes';
    //protected $tableEspecializacion='especializacion';

    
  /*  public function get()
    {
        $agentes = $this->db->selectAll($this->table);
       
       
    }*/

   public function buscarAgente($nombre,$apellido){
       //comparo si existe el nombre de usuario 
       return $this->db->comparaAgente($this->table,$nombre,$apellido);
    }

  public function insert(array $agente)
    {
        $this->db->insert($this->table, $agente);
    }

   /* public function update (array $agenteModificado,$nombre)
    {
        $this->db->update($this->table, $agenteModificado,$nombre);
    }

*/
   
    
    
}
