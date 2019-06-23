<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Permisos;

class PermisosControler extends Controller{
    public function __construct(){
        $this->model = new Permisos();
        session_start();
    }

    /*Show all pedidos*/
    public function index(){
        $todosPermisos= $this->model->get(); 
        $datos['todosPermisos'] = $todosPermisos;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/permisos/administracionPermisos', compact('datos'));
    }

    public function guardarPermisos() {
        $datos['nombre'] = $_POST['nombre'];
        $statement = $this->model->buscarPermiso($datos['nombre']);        
        if (empty($statement)) {
            $this->model->insert($datos); 
            return $this->index();
        }
    }

}
