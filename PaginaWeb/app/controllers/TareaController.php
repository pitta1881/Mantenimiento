<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\TareaModel;
use App\Core\MyInterface;

define("table", "tareas");

class TareaController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new TareaModel();
        session_start();
    }

    public function index()
    {
        $pedidoModel = new PedidoController(false);
        $view = $pedidoModel->index();
        return $view;
    }

    public function create()
    {
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
        if ($insert['estado']) {
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
        }
        return json_encode($insert);
    }

    public function update()
    {
        $ahora = date('Y-m-d H:i:s');
        $pedidoRelacionado = $this->getPedido($_POST['idPedido']);
        $tarea = [
            'idEspecializacion' => $_POST['idEspecializacion'],
            'idPrioridad' => $_POST['idPrioridad'],
            'descripcion' => $_POST['descripcion']
        ];
        $update = $this->model->update(table, $tarea, array('id' => $_POST['idTarea'],'idPedido' => $_POST['idPedido']), "Tarea");
        if ($update['estado']) {
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
        }
        return json_encode($update);
    }

    public function cancel()    //idEstado = 4
    {
        $ahora = date('Y-m-d H:i:s');
        $pedidoRelacionado = $this->getPedido($_POST['idPedido']);
        $tarea = [
            'idEstado' => 4,
            'fechaFin' => $ahora
        ];
        $update = $this->model->update(table, $tarea, array('id' => $_POST['idTarea'],'idPedido' => $_POST['idPedido']), "Tarea");
        if ($update['estado']) {
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
            $this->desasignarAgentesInsumos($_POST['idTarea'], $_POST['idPedido']);
        }
        return json_encode($update);
    }

    public function delete()
    {
    }

    private function getPedido($idPedido)
    {
        return $this->model->getFichaOne(tablePedidos, array('id'=>$idPedido));
    }

    private function getIdHistorial($idTarea, $idPedido)
    {
        $datos['unaTarea'] = $this->model->getFichaOne(table, array('id'=>$idTarea, 'idPedido' => $idPedido));
        return end($datos['unaTarea']['historial'])['id'] + 1;
    }

    private function desasignarAgentesInsumos($idTarea, $idPedido)
    {
        $datos['unaTarea'] = $this->model->getFichaOne(table, array('id'=>$idTarea, 'idPedido' => $idPedido));
        //agentes
        if (!empty($datos['unaTarea']['agentes'])) {
            foreach ($datos['unaTarea']['agentes'] as $agente) {
                if ($agente['idEstadoPersona'] == 1) {
                    $this->model->update(tableAgentes, array('isDisponible' => 1), array('id' => $agente['idAgente']), "Agente");
                }
            }
            $this->model->delete(tableAxT, array('idTarea' => $idTarea, 'idPedido' => $idPedido), "AxT");
        }
        //insumos
        if (!empty($datos['unaTarea']['insumos'])) {
            foreach ($datos['unaTarea']['insumos'] as $insumo) {
                $insumoRelacionado = $this->model->getFichaOne(tableInsumos, array('id' => $insumo['idInsumo']));
                $insumoToUpdate = [
                    'stockReal' => $insumoRelacionado['stockReal'] + $insumo['cantidad'],
                    'stockComprometido' => $insumoRelacionado['stockComprometido'] - $insumo['cantidad']
                ];
                $this->model->update(tableInsumos, $insumoToUpdate, array('id' => $insumo['idInsumo']), "Insumo");
                $historialInsumo = [
                'id' => $this->getIdHistorialInsumo($insumo['idInsumo']),
                'idInsumo' => $insumo['idInsumo'],
                'fecha' => date('Y-m-d H:i:s'),
                'idUsuario' => $_SESSION['idUser'],
                'oldStock' => $insumoRelacionado['stockReal'],
                'newStock' => $insumoRelacionado['stockReal'] + $insumo['cantidad'],
                'inOrOut' => 1,
                'idTarea' => $idTarea,
                'idPedido' => $idPedido
            ];
                $this->model->insert(tableHistorialInsumo, $historialInsumo, "historialInsumo");
            }
            $this->model->delete(tableIxT, array('idTarea' => $idTarea, 'idPedido' => $idPedido), "IxT");
        }
    }

    private function getIdHistorialInsumo($idInsumo)
    {
        $datos['unInsumo'] = $this->model->getFichaOne(tableInsumos, array('id'=>$idInsumo));
        return (empty($datos['unInsumo']['historial']) ? 1 : end($datos['unInsumo']['historial'])['id'] + 1);
    }
}
