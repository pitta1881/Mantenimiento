<?php

namespace App\Models;

use App\Core\Model;

class PedidoModel extends Model
{
    public function getFichaOne($table, $where)
    {
        return $this->getFichaOneModel($table, $where, 'retornoUnoLogic');
    }

    public function getFichaAll($table)
    {
        return $this->getFichaAllModel($table, 'retornoUnoLogic');
    }

    public function retornoUnoLogic( $datoUno)
    {
        $datoUno['tareasAsignadas'] = $this->db->countWhatFromWhere(tableTareas, 'id', array('idPedido' => $datoUno['id']))[0];
        $datoUno['sectorNombre'] = $this->db->selectWhatWhere(tableSectores, 'nombre', array('id' => $datoUno['idSector']))[0]['nombre'];
        $datoUno['prioridadNombre'] = $this->db->selectWhatWhere(tablePrioridades, 'nombre', array('id' => $datoUno['idPrioridad']))[0]['nombre'];
        $datoUno['nickUsuario'] = $this->db->selectWhatWhere(tableUsuarios, 'nick', array('id' => $datoUno['idUsuario']))[0]['nick'];
        $datoUno['estadoNombre'] = $this->db->selectWhatWhere(tableEstados, 'nombre', array('id' => $datoUno['idEstado']))[0]['nombre'];
        $datoUno['historial'] = $this->db->selectAllWhere(tableHistorialPedido, array('idPedido' => $datoUno['id']));
        foreach ($datoUno['historial'] as &$rowHistorial) {
            $rowHistorial['nickUsuario'] = $this->db->selectWhatWhere(tableUsuarios, 'nick', array('id' => $rowHistorial['idUsuario']))[0]['nick'];
            $rowHistorial['estadoNombre'] = $this->db->selectWhatWhere(tableEstados, 'nombre', array('id' => $rowHistorial['idEstado']))[0]['nombre'];
        }
        $datoUno['tareas'] = $this->db->selectAllWhere(tableTareas, array('idPedido' => $datoUno['id']));
        foreach ($datoUno['tareas'] as &$tarea) {
            $tarea = $this->verificarFechasyVacios($tarea);
            $tarea['nickUsuario'] = $this->db->selectWhatWhere(tableUsuarios, 'nick', array('id' => $tarea['idUsuario']))[0]['nick'];
            $tarea['estadoNombre'] = $this->db->selectWhatWhere(tableEstados, 'nombre', array('id' => $tarea['idEstado']))[0]['nombre'];
            $tarea['especializacionNombre'] = $this->db->selectWhatWhere(tableEspecializaciones, 'nombre', array('id' => $tarea['idEspecializacion']))[0]['nombre'];
            $tarea['prioridadNombre'] = $this->db->selectWhatWhere(tablePrioridades, 'nombre', array('id' => $tarea['idPrioridad']))[0]['nombre'];
            $tarea['agentes'] = $this->db->selectWhatWhere(tableAxT, 'idAgente', array('idTarea' => $tarea['id'],'idPedido'=>$tarea['idPedido']));
            foreach ($tarea['agentes'] as &$agente) {
                $agente['idPersona'] = $this->db->selectWhatWhere(tableAgentes, 'idPersona', array('id' => $agente['idAgente']))[0]['idPersona'];
                $returnPersona = $this->db->selectWhatWhere(tablePersonas, 'nombre, apellido', array('id' => $agente['idPersona']))[0];
                $agente['nombre'] = $returnPersona['nombre'];
                $agente['apellido'] = $returnPersona['apellido'];
            }
            $tarea['insumos'] = $this->db->selectWhatWhere(tableIxT, 'idInsumo', array('idTarea' => $tarea['id'],'idPedido'=>$tarea['idPedido']));
            foreach ($tarea['insumos'] as &$insumo) {
                $returnInsumo = $this->db->selectWhatWhere(tableInsumos, 'nombre, descripcion', array('id' => $insumo['idInsumo']))[0];
                $insumo['nombre'] = $returnInsumo['nombre'];
                $insumo['descripcion'] = $returnInsumo['descripcion'];
            }
        }
        return $datoUno;
    }
}
