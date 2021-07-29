<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\TareaModel;
use App\Models\PedidoModel;
use App\Models\InsumoModel;
use App\Models\AgenteModel;
use Exception;

define("table", "tareas");

class TareaController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new TareaModel();
        $this->modelPedido = new PedidoModel();
        $this->modelInsumo = new InsumoModel();
        $this->modelAgente = new AgenteModel();
        session_start();
    }

    public function index()
    {
    }

    public function create()
    {
        try {
            $this->model->startTransaction();
            $ahora = date('Y-m-d H:i:s');
            $pedidoRelacionado = $this->getPedido($_POST['idPedido']);
            $idTarea = $pedidoRelacionado['tareasAsignadas'] + 1;
            $tarea = [
                'id' => $idTarea,
                'idPedido' => $_POST['idPedido'],
                'fechaInicio' => $ahora,
                'idUsuario' => $_SESSION['idUser'],
                'idEstado' => 1,
                'idEspecializacion' => $_POST['idEspecializacion'],
                'idPrioridad' => $_POST['idPrioridad'],
                'descripcion' => $_POST['descripcion']
            ];
            $insert = $this->model->insert(table, $tarea, "Tareas");
            $historialTarea = [
                'id' => 1,
                'idTarea' => $idTarea,
                'idPedido' => $_POST['idPedido'],
                'fecha' => $ahora,
                'idUsuario' => $_SESSION['idUser'],
                'idEstado' => 1,
                'idEspecializacion' => $_POST['idEspecializacion'],
                'idPrioridad' => $_POST['idPrioridad'],
                'descripcion' => $_POST['descripcion'],
                'observacion' => 'Tarea Creada'
            ];
            $this->model->insert(tableHistorialTarea, $historialTarea, "historialTarea");
            $historialPedido = [
                'id' => end($pedidoRelacionado['historial'])['id'] + 1,
                'idPedido' => $_POST['idPedido'],
                'fecha' => $ahora,
                'idUsuario' => $_SESSION['idUser'],
                'idEstado' => $pedidoRelacionado['idEstado'],
                'idSector' => $pedidoRelacionado['idSector'],
                'idPrioridad' => $pedidoRelacionado['idPrioridad'],
                'descripcion' => $pedidoRelacionado['descripcion'],
                'observacion' => 'Tarea Creada -> '.$_POST['descripcion']
            ];
            $this->model->insert(tableHistorialPedido, $historialPedido, "historialPedido");
            $this->model->commit();
            return json_encode($insert);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Tarea',
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
            $pedidoRelacionado = $this->getPedido($_POST['idPedido']);
            $tarea = [
                'idEspecializacion' => $_POST['idEspecializacion'],
                'idPrioridad' => $_POST['idPrioridad'],
                'descripcion' => $_POST['descripcion']
            ];
            $update = $this->model->update(table, $tarea, array('id' => $_POST['idTarea'],'idPedido' => $_POST['idPedido']), "Tarea");
            $historialTarea = [
                'id' => $this->getIdHistorial($_POST['idTarea'], $_POST['idPedido']),
                'idTarea' => $_POST['idTarea'],
                'idPedido' => $_POST['idPedido'],
                'fecha' => $ahora,
                'idUsuario' => $_SESSION['idUser'],
                'idEstado' => $_POST['idEstado'],
                'idEspecializacion' => $_POST['idEspecializacion'],
                'idPrioridad' => $_POST['idPrioridad'],
                'descripcion' => $_POST['descripcion'],
                'observacion' => 'Tarea Modificada'
            ];
            $this->model->insert(tableHistorialTarea, $historialTarea, "historialTarea");
            $historialPedido = [
                'id' => end($pedidoRelacionado['historial'])['id'] + 1,
                'idPedido' => $_POST['idPedido'],
                'fecha' => $ahora,
                'idUsuario' => $_SESSION['idUser'],
                'idEstado' => $pedidoRelacionado['idEstado'],
                'idSector' => $pedidoRelacionado['idSector'],
                'idPrioridad' => $pedidoRelacionado['idPrioridad'],
                'descripcion' => $pedidoRelacionado['descripcion'],
                'observacion' => 'Tarea Nº'.$_POST['idTarea'].' Modificada'
            ];
            $this->model->insert(tableHistorialPedido, $historialPedido, "historialPedido");
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Tarea',
                    "operacion" => "update",
                    "estado" => false,
                    "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }

    public function cancel()    //idEstado = 4
    {
        try {
            $this->model->startTransaction();
            $ahora = date('Y-m-d H:i:s');
            $pedidoRelacionado = $this->getPedido($_POST['idPedido']);
            $tarea = [
                'idEstado' => 4,
                'fechaFin' => $ahora
            ];
            $update = $this->model->update(table, $tarea, array('id' => $_POST['idTarea'],'idPedido' => $_POST['idPedido']), "Tarea");
            $historialTarea = [
                'id' => $this->getIdHistorial($_POST['idTarea'], $_POST['idPedido']),
                'idTarea' => $_POST['idTarea'],
                'idPedido' => $_POST['idPedido'],
                'fecha' => $ahora,
                'idEstado' => 4,
                'idUsuario' => $_SESSION['idUser'],
                'observacion' => 'Tarea Cancelada > '.$_POST['observacion']
            ];
            $this->model->insert(tableHistorialTarea, $historialTarea, "historialTarea");
            $historialPedido = [
                'id' => end($pedidoRelacionado['historial'])['id'] + 1,
                'idPedido' => $_POST['idPedido'],
                'fecha' => $ahora,
                'idUsuario' => $_SESSION['idUser'],
                'idEstado' => $pedidoRelacionado['idEstado'],
                'idSector' => $pedidoRelacionado['idSector'],
                'idPrioridad' => $pedidoRelacionado['idPrioridad'],
                'descripcion' => $pedidoRelacionado['descripcion'],
                'observacion' => 'Tarea Nº'.$_POST['idTarea'].' Cancelada > '.$_POST['observacion']
            ];
            $this->model->insert(tableHistorialPedido, $historialPedido, "historialPedido");
            $this->desasignarTodosAgentesInsumos($_POST['idTarea'], $_POST['idPedido']);
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Tarea',
                    "operacion" => "update",
                    "estado" => false,
                    "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }

    public function delete()
    {
    }

    private function getPedido($idPedido)
    {
        return $this->modelPedido->getFichaOne(tablePedidos, array('id'=>$idPedido));
    }

    private function getIdHistorial($idTarea, $idPedido)
    {
        $datos['unaTarea'] = $this->model->getFichaOne(table, array('id'=>$idTarea, 'idPedido' => $idPedido));
        return end($datos['unaTarea']['historial'])['id'] + 1;
    }

    private function desasignarTodosAgentesInsumos($idTarea, $idPedido)
    {
        $datos['unaTarea'] = $this->model->getFichaOne(table, array('id'=>$idTarea, 'idPedido' => $idPedido));
        //agentes
        if (!empty($datos['unaTarea']['agentes'])) {
            foreach ($datos['unaTarea']['agentes'] as $agente) {
                if ($agente['idEstadoPersona'] == 1) {
                    $this->model->update(tableAgentes, array('tareasActuales' => $agente['tareasActuales']-1), array('id' => $agente['idAgente']), "Agente");
                }
            }
            $this->model->delete(tableAxT, array('idTarea' => $idTarea, 'idPedido' => $idPedido), "AxT");
        }
        //insumos
        if (!empty($datos['unaTarea']['insumos'])) {
            foreach ($datos['unaTarea']['insumos'] as $insumo) {
                $insumoRelacionado = $this->modelInsumo->getFichaOne(tableInsumos, array('id' => $insumo['idInsumo']));
                $insumoToUpdate = [
                    'stockComprometido' => $insumoRelacionado['stockComprometido'] - $insumo['cantidad']
                ];
                $this->model->update(tableInsumos, $insumoToUpdate, array('id' => $insumo['idInsumo']), "Insumo");
            }
            $this->model->delete(tableIxT, array('idTarea' => $idTarea, 'idPedido' => $idPedido), "IxT");
        }
    }

    private function getIdHistorialInsumo($idInsumo)
    {
        $datos['unInsumo'] = $this->modelInsumo->getFichaOne(tableInsumos, array('id'=>$idInsumo));
        return (empty($datos['unInsumo']['historial']) ? 1 : end($datos['unInsumo']['historial'])['id'] + 1);
    }

    public function getAgentesInsumos()
    {
        $datos['agentes'] = $this->modelAgente->getFichaAll(tableAgentes);
        $datos['insumos'] = $this->modelInsumo->getFichaAll(tableInsumos);
        return json_encode($datos);
    }

    public function asignarAgentesInsumos()
    {
        try {
            $this->model->startTransaction();
            $idTarea = $_POST['idTarea'];
            $idPedido = $_POST['idPedido'];
            if (isset($_POST['agentes']) && !empty($_POST['agentes'])) {
                $agentes = json_decode($_POST['agentes'], true);
                foreach ($agentes as $agente) {
                    $datos = [
                        'idTarea' => $idTarea,
                        'idPedido' => $idPedido,
                        'idAgente' => $agente['id']
                    ];
                    $this->model->insert(tableAxT, $datos, "Agente");
                    $datosAgenteBDD = $this->modelAgente->getFichaOne(tableAgentes, array('id'=>$agente['id']));
                    $update = $this->model->update(tableAgentes, array('tareasActuales' => $datosAgenteBDD['tareasActuales']+1), array('id' => $agente['id']), "Tarea");
                }
            }
            if (isset($_POST['insumos']) && !empty($_POST['insumos'])) {
                $insumos = json_decode($_POST['insumos'], true);
                foreach ($insumos as $insumo) {
                    $insumoRelacionado = $this->modelInsumo->getFichaOne(tableInsumos, array('id' => $insumo['id']));
                    $insumoToUpdate = [
                        'stockComprometido' => $insumoRelacionado['stockComprometido'] + $insumo['cantidad']
                    ];
                    $update = $this->model->update(tableInsumos, $insumoToUpdate, array('id' => $insumo['id']), "Tarea");
                    $datos = [
                        'idTarea' => $idTarea,
                        'idPedido' => $idPedido,
                        'idInsumo' => $insumo['id'],
                        'fecha' => date('Y-m-d H:i:s'),
                        'cantidad' => $insumo['cantidad']
                    ];
                    $this->model->insert(tableIxT, $datos, "IxT");
                }
            }
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Tarea',
                    "operacion" => "update",
                    "estado" => false,
                    "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }

    public function desasignarAgentesInsumos()
    {
        try {
            $this->model->startTransaction();
            $idTarea = $_POST['idTarea'];
            $idPedido = $_POST['idPedido'];
            if (isset($_POST['agentes']) && !empty($_POST['agentes'])) {
                $agentes = json_decode($_POST['agentes'], true);
                foreach ($agentes as $agente) {
                    $datos = [
                        'idTarea' => $idTarea,
                        'idPedido' => $idPedido,
                        'idAgente' => $agente['id']
                    ];
                    $this->model->delete(tableAxT, $datos, "AxT");
                    $datosAgenteBDD = $this->modelAgente->getFichaOne(tableAgentes, array('id'=>$agente['id']));
                    $update = $this->model->update(tableAgentes, array('tareasActuales' => $datosAgenteBDD['tareasActuales']-1), array('id' => $agente['id']), "Tarea");
                }
            }
            if (isset($_POST['insumos']) && !empty($_POST['insumos'])) {
                $insumos = json_decode($_POST['insumos'], true);
                foreach ($insumos as $insumo) {
                    $insumoRelacionado = $this->modelInsumo->getFichaOne(tableInsumos, array('id' => $insumo['id']));
                    $insumoToUpdate = [
                        'stockComprometido' => $insumoRelacionado['stockComprometido'] - $insumo['cantidad']
                    ];
                    $update = $this->model->update(tableInsumos, $insumoToUpdate, array('id' => $insumo['id']), "Tarea");
                    $datos = [
                        'fecha' => date('Y-m-d H:i:s'),
                        'cantidad' => $insumo['cantidadInicial'] - $insumo['cantidad']
                    ];
                    if ($insumo['cantidad'] == $insumo['cantidadInicial']) {
                        $this->model->delete(tableIxT, array('idTarea' => $idTarea, 'idPedido' => $idPedido, 'idInsumo' => $insumo['id']), "IxT");
                    } else {
                        $this->model->update(tableIxT, $datos, array('idTarea' => $idTarea, 'idPedido' => $idPedido, 'idInsumo' => $insumo['id']), "IxT");
                    }
                }
            }
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                "tipo" => 'Tarea',
                "operacion" => "update",
                "estado" => false,
                "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }

    public function getTareasSinOT()
    {
        $datos['tareas'] = $this->model->getTareasSinOT();
        return json_encode($datos);
    }
}
