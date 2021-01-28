<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\RolModel;

define("table", "roles");
define("tableRxP", "roles_x_permisos");
define("tableRxU", "roles_x_usuarios");

class RolController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new RolModel();
        session_start();
    }

    public function index($alerta = null)
    {
        $comparaTablasIfUsado = array(
                                    array(  "tabla" => tableRxU,
                                            "comparaKeyOrig" => "id",
                                            "comparaKeyDest" => "idRol"
                                    )
                                );
        $datos["todosRoles"] = $this->model->getFichaAll(table, $comparaTablasIfUsado);
        $datos['alertas'] = $alerta;
        $_SESSION['urlHeader'] = array(
            array("url" => "/home",
            "nombre" => "HOME"),
            array("url" => "/administracion",
            "nombre" => "ADMINISTRACION"),
            array("url" => "/administracion/roles",
            "nombre" => "ROLES")
        );
        if (!is_null($alerta) && ($alerta["operacion"] == "update")) {
            $_SESSION['listaPermisos'] = $this->model->getPermisos();
        }
        $datos['datosSesion'] = $_SESSION;
        return view('/administracion/RolesView', compact('datos'));
    }

    public function create()
    {
        $rol['nombre'] = $_POST['nombre'];
        $insert = $this->model->insert(table, $rol, "Rol");
        return $this->index($insert);
    }

    public function update()
    {
        $rol['idRol'] = $_POST["id"];
        $this->model->delete(tableRxP, $rol, "RxP");
        if (isset($_POST["permisos"])) {
            $permisos= $_POST["permisos"];
            for ($i=0;$i<count($permisos);$i++) {
                $rol['idPermiso'] = $permisos[$i];
                $insert = $this->model->insert(tableRxP, $rol, "RxP");
            }
        }
        $update = $insert;
        $update['tipo'] = 'Rol';
        $update['operacion'] = 'update';
        return $this->index($update);
    }

    public function delete()
    {
        $rol['id'] = $_POST['id'];
        $rolRxP['idRol'] = $_POST['id'];
        $this->model->delete(tableRxP, $rolRxP, "RxP");
        $delete = $this->model->delete(table, $rol, "Rol");
        return $this->index($delete);
    }
}
