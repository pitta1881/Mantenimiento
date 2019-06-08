<?php

namespace App\Models;

use App\Core\Model;

class OrdenDeTrabajo extends Model
{
    protected $tableOT = 'OrdenDeTrabajo';
    protected $tableItem = 'itemOT';
    protected $tableTarea = 'tarea';

    public function get(){
        $ot = $this->db->selectAllOT($this->tableOT);
        $miOT = json_decode(json_encode($ot), True);
        return $miOT;
    }

    public function verTareasSinAsignar(){
        $tareas = $this->db->selectTareasSinAsignar($this->tableTarea);
        $misTareas = json_decode(json_encode($tareas), True);
        return $misTareas;
    }

    public function newOT(){
        $this->db->newOT($this->tableOT);
    }

    public function crearItemOT(){

    }


}
