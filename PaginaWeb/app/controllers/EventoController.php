<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\EventoModel;
use Exception;

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
        try {
            $this->model->startTransaction();
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
            $this->model->commit();
            return json_encode($insert);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Evento',
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
            $fechaFin = date("Y-m-d", strtotime($_POST['fechaInicio']."+ ".$_POST['periodicidad']." days"));
            $evento = [
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'],
            'fechaInicio' => $_POST['fechaInicio'],
            'fechaFin' => $fechaFin,
            'periodicidad'=> $_POST['periodicidad']
        ];
            $update = $this->model->update(table, $evento, array('id' => $_POST['id']), 'Evento');
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                "tipo" => 'Evento',
                "operacion" => "update",
                "estado" => false,
                "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }

    public function updateEstado()
    {
        try {
            $this->model->startTransaction();
            $evento = [
                'idEstado' => 6
            ];
            $update = $this->model->update(table, $evento, array('id' => $_POST['id']), 'Evento');
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                "tipo" => 'Evento',
                "operacion" => "update",
                "estado" => false,
                "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }

    public function delete()
    {
        try {
            $this->model->startTransaction();
            $delete = $this->model->delete(table, array('id' => $_POST['id']), 'Evento');
            $this->model->commit();
            return json_encode($delete);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                "tipo" => 'Evento',
                "operacion" => "delete",
                "estado" => false,
                "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }
}
