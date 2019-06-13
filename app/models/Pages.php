<?php

namespace App\Models;

use App\Core\Model;

class Pages extends Model
{
    protected $table = 'eventos';

    public function getActivos($tabla,$columna){
        $cantidad = $this->db->getActivos($tabla,$columna);
        return $cantidad[0][0];
    }

    public function getAgentesDisponibles($tabla){
        $cantidad = $this->db->getAgentesDisponibles($tabla);
        return $cantidad[0][0];
   
    }

 public function get()
    {
        $eventos = $this->db->selectAllEventosOrdenados($this->table);
      
        $todosEventos = json_decode(json_encode($eventos), True);
        return $todosEventos;
    }
    
    
}
