<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\PersonaModel;
use Exception;

define("table", "personas");

class PersonaController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new PersonaModel();
        session_start();
    }
    
    public function index()
    {
        $datos['todosEstados'] = $this->model->getFichaAllModel(tableEstadosPersona);
        $datos['minimo18'] = date('Y-m-d', strtotime('18 years ago'));
        $datos['maximo70'] = date('Y-m-d', strtotime('70 years ago'));
        $_SESSION['urlHeader'] = array(
            array("url" => "/home",
            "nombre" => "HOME"),
            array("url" => "/administracion",
            "nombre" => "ADMINISTRACION"),
            array("url" => "/administracion/personas",
            "nombre" => "PERSONAS")
        );
        $datos['datosSesion'] = $_SESSION;
        return view('/administracion/PersonasView', compact('datos'));
    }

    public function create()
    {
        try {
            $this->model->startTransaction();
            $persona = [
                'id' => $_POST['id'],
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'direccion' => $_POST['direccion'],
                'email' => $_POST['email'],
                'fechaNacimiento' => $_POST['fechaNacimiento'],
                'idEstadoPersona' => 1
            ];
            $insert = $this->model->insert(table, $persona, "Persona");
            $this->model->commit();
            return json_encode($insert);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Persona',
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
            $persona = [
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'direccion' => $_POST['direccion'],
                'email' => $_POST['email'],
                'fechaNacimiento' => $_POST['fechaNacimiento']
            ];
            $update = $this->model->update(table, $persona, array('id' => $_POST['id']), "Persona");
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                "tipo" => 'Persona',
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
            $delete = $this->model->delete(table, array('id' => $_POST['id']), "Persona");
            $this->model->commit();
            return json_encode($delete);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                "tipo" => 'Persona',
                "operacion" => "delete",
                "estado" => false,
                "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }

    public function updateEstado()
    {
        try {
            $this->model->startTransaction();
            $persona = [
                'idEstadoPersona' => $_POST['idEstadoPersona']
            ];
            $update = $this->model->update(table, $persona, array('id' => $_POST['idPersona']), "Persona");
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                "tipo" => 'Persona',
                "operacion" => "update",
                "estado" => false,
                "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }
}
