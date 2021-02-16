<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\PermisoModel;

define("table", "permisos");

class PermisoController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new PermisoModel();
        session_start();
    }

    public function index($alerta = null)
    {
        $comparaTablasIfUsado = array(
            array(  "tabla" => tableRxP,
                    "comparaKeyOrig" => "id",
                    "comparaKeyDest" => "idPermiso"
                )
        );
        $datos['todosPermisos'] = $this->model->getFichaAll(table, $comparaTablasIfUsado);
        $datos['alertas'] = $alerta;
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
        $permiso['nombre'] = $_POST['nombre'];
        $insert = $this->model->insert(table, $permiso, "Permiso");
        return $this->index($insert);
    }

    public function update()
    {
        $permiso = [
            'id' => $_POST['id'],
            'nombre' => $_POST['nombre']
        ];
        $update = $this->model->update(table, $permiso, "Permiso");
        return $this->index($update);
    }

    public function delete()
    {
        $permiso['id'] = $_POST['id'];
        $delete = $this->model->delete(table, $permiso, "Permiso");
        return $this->index($delete);
    }
}
