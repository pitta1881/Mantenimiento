<?php

namespace App\Models;

use App\Core\Model;

class HomeModel extends Model
{
    public function getBoxes()
    {
        $datos['countPedidosActivos'] = $this->db->countWhatFromWhere(tablePedidos, 'id', array('idEstado' => 2))[0];
        $datos['countOTActivos'] = $this->db->countWhatFromWhere(tableOT, 'id', array('idEstado' => 2))[0];
        $datos['countEventosHoy'] = $this->db->countWhatFromWhere(tableEventos, 'id', array('fechaInicio' => date('Y-m-d')))[0];
        $datos['countTareasSinAsignar'] = $this->db->countWhatFromWhere(tableTareas, 'id', array('idOrdenDeTrabajo' => null))[0];
        return $datos;
    }
}
