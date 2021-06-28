<?php

namespace App\Models;

use App\Core\Model;

class OTModel extends Model
{

    public function getFichaOne($table, $where)
    {
        return $this->getFichaOneModel($table, $where, 'retornoUnoLogic');
    }

    public function getFichaAll($table)
    {
        return $this->getFichaAllModel($table, 'retornoUnoLogic');
    }

    public function retornoUnoLogic($datoUno)
    {
        $datoUno['estadoNombre'] = $this->db->selectWhatWhere(tableEstados, 'nombre', array('id' => $datoUno['idEstado']))[0]['nombre'];
        $datoUno['cantidadTareas'] = $this->db->countWhatFromWhere(tableTareas, 'idOrdenDeTrabajo', array('idOrdenDeTrabajo' => $datoUno['id']))[0];
        return $datoUno;
    }

}
