<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\OTModel;
use App\Models\TareaModel;

define("table", "ordenesdetrabajo");

class OTController extends Controller implements MyInterface{

    public function __construct(){
        $this->model = new OTModel();
        $this->modelTarea = new TareaModel();
        session_start();
    }

    public function index(){
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
        $ahora = date('Y-m-d H:i:s');
        $datosOT = [
            'fechaInicio' => $ahora,
            'idEstado' => 2
        ];
        $insert = $this->model->insert(tableOT, $datosOT, "Orden de Trabajo");
        $tareas = json_decode($_POST['tareas'], true);
        foreach ($tareas as $tarea) {
            $datos = [
                'idOrdenDeTrabajo' => $insert['mensaje'],
                'idEstado' => 2
            ];
            $this->model->update(tableTareas, $datos, array('idPedido'=>$tarea['idPedido'],'id'=>$tarea['idTarea']), "Tarea");
            $historialTarea = [
                'id' => $this->getIdHistorial($tarea['idTarea'], $tarea['idPedido']),
                'idTarea' => $tarea['idTarea'],
                'idPedido' => $tarea['idPedido'],
                'fecha' => $ahora,
                'idUsuario' => $_SESSION['idUser'],
                'idEstado' => 2,
                'observacion' => 'Tarea Asignada a la Orden de Trabajo Nº '.$insert['mensaje']
            ];
            $this->model->insert(tableHistorialTarea, $historialTarea, "historialTarea");
        }
        return json_encode($insert);
    }

    public function update()
    {}
    
    public function delete()
    {}

    private function getIdHistorial($idTarea, $idPedido)
    {
        $datos['unaTarea'] = $this->modelTarea->getFichaOne(tableTareas, array('id'=>$idTarea, 'idPedido' => $idPedido));
        //var_dump($datos['unaTarea']);
        return end($datos['unaTarea']['historial'])['id'] + 1;
    }
}
