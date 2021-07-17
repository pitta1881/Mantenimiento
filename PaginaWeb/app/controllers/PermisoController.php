<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\PermisoModel;
use Exception;

define("table", "permisos");

class PermisoController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new PermisoModel();
        session_start();
    }

    public function index()
    {
        $_SESSION['urlHeader'] = array(
            array("url" => "/home",
            "nombre" => "HOME"),
            array("url" => "/administracion",
            "nombre" => "ADMINISTRACION"),
            array("url" => "/administracion/permisos",
            "nombre" => "PERMISOS")
        );
        $datos['datosSesion'] = $_SESSION;
        return view('/administracion/PermisosView', compact('datos'));
    }

    public function create()
    {
        try {
            $this->model->startTransaction();
            $permiso['nombre'] = $_POST['nombre'];
            $insert = $this->model->insert(table, $permiso, "Permiso");
            $this->model->commit();
            return json_encode($insert);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                        "tipo" => 'Permiso',
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
            $permiso = [
                'nombre' => $_POST['nombre']
            ];
            $update = $this->model->update(table, $permiso, array('id' => $_POST['id']), "Permiso");
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Permiso',
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
            $delete = $this->model->delete(table, array('id' => $_POST['id']), "Permiso");
            $this->model->commit();
            return json_encode($delete);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                "tipo" => 'Permiso',
                "operacion" => "delete",
                "estado" => false,
                "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }
}
