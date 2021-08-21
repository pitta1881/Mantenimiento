<?php

namespace App\Models;

use App\Core\Model;

class AgenteModel extends Model
{
    public function getFichaOne($table, $where)
    {
        return $this->getFichaOneModel($table, $where, 'retornoUnoLogic');
    }

    public function getFichaAll($table)
    {
        $comparaTablasIfUsado = array(
            array(  "tabla" => tableAxT,
                    "comparaKeyOrig" => "id",
                    "comparaKeyDest" => "idAgente",
                )
        );
        return $this->getFichaAllModel($table, 'retornoUnoLogic', $comparaTablasIfUsado);
    }

    public function retornoUnoLogic($datoUno)
    {
        $persona = $this->db->selectWhatWhere(tablePersonas, 'nombre,apellido,idEstadoPersona', array('id' => $datoUno['idPersona']))[0];
        $datoUno['nombre']=$persona['nombre'];
        $datoUno['apellido']=$persona['apellido'];
        $datoUno['idEstadoPersona'] = $persona['idEstadoPersona'];
        $datoUno['listaTareas'] = $this->db->selectAllWhere(tableAxT, array('idAgente' => $datoUno['id']));
        $listaTareasActualesIniciado = array();
        $listaTareasActualesEnCurso = array();
        foreach ($datoUno['listaTareas'] as &$tarea) {
            $tareasActualesIniciado = $this->db->selectAllWhere(tableTareas, array('id' => $tarea['idTarea'], 'idPedido' => $tarea['idPedido'], 'idEstado' => 1));
            $tareasActualesEnCurso = $this->db->selectAllWhere(tableTareas, array('id' => $tarea['idTarea'], 'idPedido' => $tarea['idPedido'], 'idEstado' => 2));
            (empty($datoUno['listaTareasActualesIniciado']) ? $listaTareasActualesIniciado = $tareasActualesIniciado : array_push($listaTareasActualesIniciado, $tareasActualesIniciado));
            (empty($datoUno['listaTareasActualesEnCurso']) ? $listaTareasActualesEnCurso = $tareasActualesEnCurso : array_push($listaTareasActualesEnCurso, $tareasActualesEnCurso));
        };
        $datoUno['listaTareasActuales'] = array_merge($listaTareasActualesIniciado, $listaTareasActualesEnCurso);
        $datoUno['listaEspecializaciones'] = $this->db->selectWhatWhere(tableExA, 'idEspecializacion', array('idAgente' => $datoUno['id']));
        foreach ($datoUno['listaEspecializaciones'] as &$especializacion) {
            $returnEspecializacion = $this->db->selectWhatWhere(tableEspecializaciones, 'id, nombre', array('id' => $especializacion['idEspecializacion']))[0];
            $especializacion['id'] =  $returnEspecializacion['id'];
            $especializacion['nombre'] =  $returnEspecializacion['nombre'];
        }
        return $datoUno;
    }
}
