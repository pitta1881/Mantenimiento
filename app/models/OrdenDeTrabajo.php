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
        $ultimoOT = $this->db->getIdUltimoOT($this->tableOT);
        if (is_null($ultimoOT)){
            $ultimoOT = 0;
        }
        return $ultimoOT[0][0];
    }

    public function insertItemOT($datos){
        $this->db->insert($this->tableItem,$datos);
    }

    public function cambiarEstadoTarea($idPedido,$idTarea){
        $this->db->updateEstadoTarea($this->tableTarea,$idPedido,$idTarea);
    }


}
