<?php

namespace App\Models;

use App\Core\Model;

class Pedido extends Model
{
    public function get()
    {
        return $this->db->selectAll($this->table);
    }

    public function getByNumeroTurno($numero)
    {
        return $this->db->selectNumeroTurno($this->table,$numero);
    }

    public function insert(array $turnosFormulario)
    {
        $this->db->insert($this->table, $turnosFormulario);
    }

    
}
