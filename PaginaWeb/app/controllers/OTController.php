<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
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
            'idEstado' => 2
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
                $this->model->update(tablePedidos, array('idEstado'=> 2), array('idPedido'=>$tarea['idPedido']), "Pedido");
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
    }
    
    public function delete()
    {
    }

    private function getIdHistorialTarea($idTarea, $idPedido)
    {
        $datos['unaTarea'] = $this->modelTarea->getFichaOne(tableTareas, array('id'=>$idTarea, 'idPedido' => $idPedido));
        //var_dump($datos['unaTarea']);
        return end($datos['unaTarea']['historial'])['id'] + 1;
    }

    private function getIdHistorialPedido($idPedido)
    {
        $datos['unPedido'] = $this->modelPedido->getFichaOne(tablePedidos, array('id'=>$idPedido));
        return end($datos['unPedido']['historial'])['id'] + 1;
    }
}
