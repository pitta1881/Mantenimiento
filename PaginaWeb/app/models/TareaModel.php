<?php

namespace App\Models;

use App\Core\Model;

class TareaModel extends Model
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
        $sectorID = $this->db->selectWhatWhere(tablePedidos, 'idSector', array('id' => $datoUno['idPedido']))[0]['idSector'];
        $datoUno['sectorNombre'] = $this->db->selectWhatWhere(tableSectores, 'nombre', array('id' => $sectorID))[0]['nombre'];
        $datoUno['especializacionNombre'] = $this->db->selectWhatWhere(tableEspecializaciones, 'nombre', array('id' => $datoUno['idEspecializacion']))[0]['nombre'];
        $datoUno['prioridadNombre'] = $this->db->selectWhatWhere(tablePrioridades, 'nombre', array('id' => $datoUno['idPrioridad']))[0]['nombre'];
        $datoUno['historial'] = $this->db->selectAllWhere(tableHistorialTarea, array('idTarea' => $datoUno['id'], 'idPedido' => $datoUno['idPedido']));
        foreach ($datoUno['historial'] as &$rowHistorial) {
            $rowHistorial['nickUsuario'] = $this->db->selectWhatWhere(tableUsuarios, 'nick', array('id' => $rowHistorial['idUsuario']))[0]['nick'];
            $rowHistorial['estadoNombre'] = $this->db->selectWhatWhere(tableEstados, 'nombre', array('id' => $rowHistorial['idEstado']))[0]['nombre'];
        }
        $datoUno['agentes'] = $this->db->selectWhatWhere(tableAxT, 'idAgente', array('idTarea' => $datoUno['id'],'idPedido'=>$datoUno['idPedido']));
        foreach ($datoUno['agentes'] as &$agente) {
            $agenteOne = $this->db->selectWhatWhere(tableAgentes, 'idPersona, tareasActuales', array('id' => $agente['idAgente']))[0];
            $agente['idPersona'] = $agenteOne['idPersona'];
            $agente['tareasActuales'] = $agenteOne['tareasActuales'];
            $personaOne = $this->db->selectWhatWhere(tablePersonas, 'nombre, apellido, idEstadoPersona', array('id' => $agente['idPersona']))[0];
            $agente['idEstadoPersona'] = $personaOne['idEstadoPersona'];
            $agente['nombre'] = $personaOne['nombre'];
            $agente['apellido'] = $personaOne['apellido'];
        }
        $datoUno['insumos'] = $this->db->selectWhatWhere(tableIxT, 'idInsumo, cantidad', array('idTarea' => $datoUno['id'],'idPedido'=>$datoUno['idPedido']));
        foreach ($datoUno['insumos'] as &$insumo) {
            $insumoOne = $this->db->selectWhatWhere(tableInsumos, 'nombre, descripcion', array('id' => $insumo['idInsumo']))[0];
            $insumo['nombre'] = $insumoOne['nombre'];
            $insumo['descripcion'] = $insumoOne['descripcion'];
        }
        return $datoUno;
    }

    public function getTareasSinOT(){
        $tareasSinOT = $this->db->selectAllWhere(tableTareas, 'idOrdenDeTrabajo is null and idEstado = 1');
        foreach ($tareasSinOT as &$tarea) {
            $tarea = $this->retornoUnoLogic($tarea);
        }
        return $tareasSinOT;
    }
}
