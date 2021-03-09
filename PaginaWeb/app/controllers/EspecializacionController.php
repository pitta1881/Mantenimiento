<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\EspecializacionModel;

define("table", "especializaciones");

class EspecializacionController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new EspecializacionModel();
        session_start();
    }

    public function index()
    {
        $_SESSION['urlHeader'] = array(
            array("url" => "/home",
                 "nombre" => "HOME"),
            array("url" => "/administracion",
                 "nombre" => "ADMINISTRACION"),
            array("url" => "/especializaciones",
                "nombre" => "ESPECIALIZACIONES")
                );
        $datos['datosSesion'] = $_SESSION;
        return view('/administracion/EspecializacionesView', compact('datos'));
    }
    
    public function create()
    {
        $especializacion['nombre'] = $_POST['nombre'];
        $insert = $this->model->insert(table, $especializacion, "Especializacion");
        echo json_encode($insert);
    }
    
    public function update()
    {
        $especializacion = [
            'id' => $_POST['id'],
            'nombre' => $_POST['nombre']
        ];
        $update = $this->model->update(table, $especializacion, "Especializacion");
        echo json_encode($update);
    }

    public function delete()
    {
        $especializacion['id'] = $_POST['id'];
        $delete = $this->model->delete(table, $especializacion, "Especializacion");
        echo json_encode($delete);
    }
}
