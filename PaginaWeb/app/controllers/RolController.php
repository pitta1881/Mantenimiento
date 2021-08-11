<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\RolModel;
use Exception;

define("table", "roles");

class RolController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new RolModel();
        session_start();
    }

    public function index()
    {
        $_SESSION['urlHeader'] = array(
            array("url" => "/home",
            "nombre" => "HOME"),
            array("url" => "/administracion",
            "nombre" => "ADMINISTRACION"),
            array("url" => "/administracion/roles",
            "nombre" => "ROLES")
        );
        $datos['datosSesion'] = $_SESSION;
        return view('/administracion/RolesView', compact('datos'));
    }

    public function create()
    {
        try {
            $this->model->startTransaction();
            $rol['nombre'] = $_POST['nombre'];
            $insert = $this->model->insert(table, $rol, "Rol");
            $this->model->commit();
            return json_encode($insert);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Rol',
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
            $this->model->delete(tableRxP, array('idRol' => $_POST["id"]), "RxP");
            if (isset($_POST["permisos"])) {
                $permisos= $_POST["permisos"];
                for ($i=0;$i<count($permisos);$i++) {
                    $rol = [
                        'idRol' => $_POST["id"],
                        'idPermiso' => $permisos[$i]
                    ];
                    $insert = $this->model->insert(tableRxP, $rol, "RxP");
                }
            } else {
                $insert['estado'] = true;
                $insert['mensaje'] = 1;
            }
            $update = $insert;
            $update['tipo'] = 'Rol';
            $update['operacion'] = 'update';
            $_SESSION['listaPermisos'] = $this->model->getPermisos();
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Rol',
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
            $this->model->delete(tableRxP, array('idRol' => $_POST['id']), "RxP");
            $delete = $this->model->delete(table, array('id' => $_POST['id']), "Rol");
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

    public function getPermisos()
    {
        $listaPermisos = $this->model->getPermisos();          //en cada clase q implementa ésta, defino que es 'table'
        if ($listaPermisos) {
            http_response_code(200);
        } else {
            http_response_code(404);
        }
        header("Content-Type: application/json");
        return json_encode($listaPermisos);
    }
}
