<?php

namespace App\Models;

use App\Core\Model;

class informes extends Model
{
    protected $table = 'agentes';
    protected $tableEspecializacion='especializacion';
    protected $tableItemAgentes='itemAgente';
    protected $tablePersona = 'personas';
    

   


    public function insert(array $datos){
      $this->db->insert($this->table, $datos);
    }
}