<?php

namespace App\Models;

use App\Core\Model;

class Tarea extends Model
{
    protected $table = 'tarea';

    //ESTO ESTA HARDCODEADO PARA MUESTRAR ALGO NOMAS
    public function getEspecialidades() {
        return array("ALBAÑIL","ELECTRICISTA","PLOMERO","PINTOR","GASISTA");
    }

    public function insert(array $tarea, $nPedido)
    {
        $this->db->insertTarea($this->table, $tarea, $nPedido);
    }

    public function updateTarea (array $tareaModificada,$idPedido)
    {
        $this->db->updateTarea($this->table, $tareaModificado,$idPedido);
    }


    public function getTareasByIdPedido($id)
    {
        return $this->db->selectTareasPorNPedido($this->tableTarea,$id);
    }
    
    
}
