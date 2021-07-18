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
        $datoUno['tareas'] = $this->db->selectAllWhere(tableTareas, array('idOrdenDeTrabajo' => $datoUno['id']));
        $datoUno['nickUsuario'] = $this->db->selectWhatWhere(tableUsuarios, 'nick', array('id' => $datoUno['idUsuario']))[0]['nick'];
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
            $idSector = $this->db->selectWhatWhere(tablePedidos, 'idSector', array('id' => $tarea['idPedido']))[0]['idSector'];
            $tarea['sectorNombre'] = $this->db->selectWhatWhere(tableSectores, 'nombre', array('id' => $idSector))[0]['nombre'];
        }
        return $datoUno;
    }
}
