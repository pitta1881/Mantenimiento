<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\RolModel;

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
        $rol['nombre'] = $_POST['nombre'];
        $insert = $this->model->insert(table, $rol, "Rol");
        return json_encode($insert);
    }

    public function update()
    {
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
        }
        $update = $insert;
        $update['tipo'] = 'Rol';
        $update['operacion'] = 'update';
        $_SESSION['listaPermisos'] = $this->model->getPermisos();
        return json_encode($update);
    }

    public function delete()
    {
        $this->model->delete(tableRxP, array('idRol' => $_POST['id']), "RxP");
        $delete = $this->model->delete(table, array('id' => $_POST['id']), "Rol");
        return json_encode($delete);
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
