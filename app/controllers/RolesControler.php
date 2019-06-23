<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Roles;
use App\Models\Permisos;

class RolesControler extends Controller{

    public function __construct(){
        $this->model = new Roles();
        session_start();
    }

    /*Show all pedidos*/
    public function index(){
        $todosRoles = $this->model->get(); 
        $datos["todosRoles"] = $todosRoles;
        $datos["userLogueado"] = $_SESSION['user'];
         $datos['rol']=$_SESSION['rol'];
        return view('/roles/administracionRol', compact('datos'));
    }

    public function guardar(){
        $rol = [
            'nombreRol' => $_POST['nombreRol'],
        ];
      $this->model->insert($rol);   
      $datos["userLogueado"] = $_SESSION['user'];
         $datos['rol']=$_SESSION['rol'];
      return $this->index();
    }
}

