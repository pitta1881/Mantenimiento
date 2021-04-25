<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\EventoModel;

define("table", "eventos");

class EventoController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new EventoModel();
        session_start();
    }
    
    public function index()
    {
        $datos["diaHoy"] = date("Y-m-d");
        $_SESSION['urlHeader'] = array(
            array("url" => "/home",
                 "nombre" => "HOME"),
            array("url" => "/eventos",
                "nombre" => "EVENTOS")
                );
        $datos['datosSesion'] = $_SESSION;
        return view('/eventos/EventosView', compact('datos'));
    }
    
    public function create()
    {
        $fechaFin = date("Y-m-d", strtotime($_POST['fechaInicio']."+ ".$_POST['periodicidad']." days"));
        $evento = [
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'],
            'fechaInicio' => $_POST['fechaInicio'],
            'fechaFin' => $fechaFin,
            'periodicidad' => $_POST['periodicidad'],
            'idEstado' => 3
        ];
        $insert = $this->model->insert(table, $evento, "Evento");
        return json_encode($insert);
    }
 
    public function update()
    {
        $fechaFin = date("Y-m-d", strtotime($_POST['fechaInicio']."+ ".$_POST['periodicidad']." days"));
        $evento = [
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'],
            'fechaInicio' => $_POST['fechaInicio'],
            'fechaFin' => $fechaFin,
            'periodicidad'=> $_POST['periodicidad']
        ];
        $update = $this->model->update(table, $evento, array('id' => $_POST['id']), 'Evento');
        return json_encode($update);
    }

    public function updateEstado()
    {
        $evento = [
            'idEstado' => 6
        ];
        $update = $this->model->update(table, $evento, array('id' => $_POST['id']), 'Evento');
        return json_encode($update);
    }

    public function delete()
    {
        $delete = $this->model->delete(table, array('id' => $_POST['id']), 'Evento');
        return json_encode($delete);
    }
}
