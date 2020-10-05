<?php

namespace App\Models;

use App\Core\Model;

class AgenteModel extends Model
{
    protected $table = 'agentes';
    protected $tableEspecializacion='especializacion';
    protected $tablePersona = 'personas';
    
    public function getPersonasNoAgentes(){
      return $this->db->selectPersonasNoAgentes($this->tablePersona,$this->table);
    }
}

