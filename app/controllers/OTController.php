<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\AgenteModel;
use App\Models\InsumoModel;
use App\Models\OTModel;
use App\Models\PedidoModel;
use App\Models\TareaModel;
use Exception;

define("table", "ordenesdetrabajo");

class OTController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new OTModel();
        $this->modelTarea = new TareaModel();
        $this->modelPedido = new PedidoModel();
        $this->modelAgente = new AgenteModel();
        $this->modelInsumo = new InsumoModel();
        session_start();
    }

    public function index()
    {
        $datos['estados'] = $this->model->getFichaAllModel(tableEstados);
        $_SESSION['urlHeader'] = array(
            array("url" => "/home",
                 "nombre" => "HOME"),
            array("url" => "/ordendetrabajo",
                "nombre" => "ORDEN DE TRABAJO")
                );
        $datos['datosSesion'] = $_SESSION;
        return view('/ordendetrabajo/OrdenDeTrabajoView', compact('datos'));
    }

    public function create()
    {
        try {
            $this->model->startTransaction();
            $ahora = date('Y-m-d H:i:s');
            $datosOT = [
                'fechaInicio' => $ahora,
                'idEstado' => 2,
                'idUsuario' => $_SESSION['idUser']
            ];
            $insert = $this->model->insert(tableOT, $datosOT, "Orden de Trabajo");
            $tareas = json_decode($_POST['tareas'], true);
            foreach ($tareas as $tarea) {
                //actualizo tabla Tarea e historial
                $datos = [
                    'idOrdenDeTrabajo' => $insert['mensaje'],
                    'idEstado' => 2
                ];
                $this->model->update(tableTareas, $datos, array('idPedido'=>$tarea['idPedido'],'id'=>$tarea['idTarea']), "Tarea");
                $historialTarea = [
                    'id' => $this->getIdHistorialTarea($tarea['idTarea'], $tarea['idPedido']),
                    'idTarea' => $tarea['idTarea'],
                    'idPedido' => $tarea['idPedido'],
                    'fecha' => $ahora,
                    'idUsuario' => $_SESSION['idUser'],
                    'idEstado' => 2,
                    'observacion' => 'Tarea Asignada a la OT Nº '.$insert['mensaje']
                ];
                $this->model->insert(tableHistorialTarea, $historialTarea, "historialTarea");
                //actualizo tabla Pedido e historial
                $this->model->update(tablePedidos, array('idEstado'=> 2), array('id'=>$tarea['idPedido']), "Pedido");
                $historialPedido = [
                    'id' => $this->getIdHistorialPedido($tarea['idPedido']),
                    'idPedido' => $tarea['idPedido'],
                    'fecha' => $ahora,
                    'idUsuario' => $_SESSION['idUser'],
                    'idEstado' => 2,
                    'observacion' => 'La Tarea Nº '.$tarea['idTarea'].' se agregó a la OT Nº '.$insert['mensaje']
                ];
                $this->model->insert(tableHistorialPedido, $historialPedido, "historialPedido");
            }
            $this->model->commit();
            return json_encode($insert);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                        "tipo" => 'Orden de Trabajo',
                        "operacion" => "insert",
                        "estado" => false,
                        "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }

    public function update()
    {
        try {
            $this->model->startTransaction();
            $ahora = date('Y-m-d H:i:s');
            $tareas = json_decode($_POST['tareas'], true);
            foreach ($tareas as $tarea) {
                //actualizo tabla Tarea e historial
                $tareaUpdate = [
                    'idEstado' => 5,
                    'fechaFin' => $ahora
                ];
                $insert = $this->model->update(tableTareas, $tareaUpdate, array('idPedido'=>$tarea['idPedido'],'id'=>$tarea['idTarea']), "Tarea");
                $historialTarea = [
                    'id' => $this->getIdHistorialTarea($tarea['idTarea'], $tarea['idPedido']),
                    'idTarea' => $tarea['idTarea'],
                    'idPedido' => $tarea['idPedido'],
                    'fecha' => $ahora,
                    'idUsuario' => $_SESSION['idUser'],
                    'idEstado' => 5,
                    'observacion' => 'Tarea Finalizada'
                ];
                $this->model->insert(tableHistorialTarea, $historialTarea, "historialTarea");
                //actualizo cantidad tareas del agente
                $tareaRelacionada = $this->modelTarea->getFichaOne(tableTareas, array('id'=>$tarea['idTarea'], 'idPedido' => $tarea['idPedido']));
                foreach ($tareaRelacionada['agentes'] as $agente) {
                    $this->model->update(tableAgentes, array('tareasActuales' => $agente['tareasActuales']-1), array('id' => $agente['idAgente']), "Agente");
                }
                //actualizo stock comprometido de insumos si tenia
                foreach ($tareaRelacionada['insumos'] as $insumo) {
                    $insumoRelacionado = $this->modelInsumo->getFichaOne(tableInsumos, array('id' => $insumo['idInsumo']));
                    $insumoToUpdate = [
                        'stockComprometido' => $insumoRelacionado['stockComprometido'] - $insumo['cantidad'],
                        'stockReal' => $insumoRelacionado['stockReal'] - $insumo['cantidad']
                    ];
                    $this->model->update(tableInsumos, $insumoToUpdate, array('id' => $insumo['idInsumo']), "Insumo");
                    $historialInsumo = [
                        'id' => $this->getIdHistorialInsumo($insumo['idInsumo']),
                        'idInsumo' => $insumo['idInsumo'],
                        'fecha' => $ahora,
                        'idUsuario' => $_SESSION['idUser'],
                        'oldStock' => $insumoRelacionado['stockReal'],
                        'newStock' => $insumoRelacionado['stockReal'] - $insumo['cantidad'],
                        'inOrOut' => 0,
                        'idTarea' => $tarea['idTarea'],
                        'idPedido' => $tarea['idPedido']
                    ];
                    $this->model->insert(tableHistorialInsumo, $historialInsumo, "historialInsumo");
                }
            }
            //verifico si terminaron todas las tareas correspondientes a una OT
            $otTerminado = true;
            $ordendetrabajo = $this->model->getFichaOne(table, array('id'=>$_POST['idOT']));
            foreach ($ordendetrabajo['tareas'] as $tarea) {
                if (!($tarea['idEstado'] == 5)) {
                    $otTerminado = false;
                }
            }
            if ($otTerminado) {
                $ordendetrabajoUpdate = [
                    'idEstado' => 5,
                    'fechaFin' => $ahora
                ];
                $this->model->update(table, $ordendetrabajoUpdate, array('id' => $_POST['idOT']), "Orden de Trabajo");
            }
            $this->model->commit();
            return json_encode($insert);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                        "tipo" => 'Orden de Trabajo',
                        "operacion" => "update",
                        "estado" => false,
                        "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }
    
    public function delete()
    {
    }

    private function getIdHistorialTarea($idTarea, $idPedido)
    {
        $datos['unaTarea'] = $this->modelTarea->getFichaOne(tableTareas, array('id'=>$idTarea, 'idPedido' => $idPedido));
        return end($datos['unaTarea']['historial'])['id'] + 1;
    }

    private function getIdHistorialPedido($idPedido)
    {
        $datos['unPedido'] = $this->modelPedido->getFichaOne(tablePedidos, array('id'=>$idPedido));
        return end($datos['unPedido']['historial'])['id'] + 1;
    }

    private function getIdHistorialInsumo($idInsumo)
    {
        $datos['unInsumo'] = $this->modelInsumo->getFichaOne(tableInsumos, array('id'=>$idInsumo));
        return (empty($datos['unInsumo']['historial']) ? 1 : end($datos['unInsumo']['historial'])['id'] + 1);
    }
}
