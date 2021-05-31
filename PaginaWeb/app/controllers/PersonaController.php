<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\PersonaModel;

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
        json_encode($insert);
    }

    public function update()
    {
        $persona = [
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'direccion' => $_POST['direccion'],
            'email' => $_POST['email'],
            'fechaNacimiento' => $_POST['fechaNacimiento']
        ];
        $update = $this->model->update(table, $persona, array('id' => $_POST['id']), "Persona");
        return json_encode($update);
    }
    
    public function delete()
    {
        $delete = $this->model->delete(table, array('id' => $_POST['id']), "Persona");
        return json_encode($delete);
    }

    public function updateEstado()
    {
        $persona = [
            'idEstadoPersona' => $_POST['idEstadoPersona']
        ];
        $update = $this->model->update(table, $persona, array('id' => $_POST['idPersona']), "Persona");
        return json_encode($update);
    }
}
