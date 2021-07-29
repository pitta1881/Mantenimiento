<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\EspecializacionModel;

use Exception;

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
        try {
            $this->model->startTransaction();
            $especializacion['nombre'] = $_POST['nombre'];
            $insert = $this->model->insert(table, $especializacion, "Especializacion");
            $this->model->commit();
            return json_encode($insert);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                        "tipo" => 'Especializacion',
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
            $especializacion = [
                'nombre' => $_POST['nombre']
            ];
            $update = $this->model->update(table, $especializacion, array('id' => $_POST['id']), "Especializacion");
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Especializacion',
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
            $delete = $this->model->delete(table, array('id' => $_POST['id']), "Especializacion");
            $this->model->commit();
            return json_encode($delete);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                "tipo" => 'Especializacion',
                "operacion" => "delete",
                "estado" => false,
                "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }
}
