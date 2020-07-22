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
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
        return view('/roles/administracionRol', compact('datos'));
    }

    public function ficha(){
        $idRol= $_GET['id'];
        $miRol = $this->model->getRol($idRol); 
        $datos['miRol'] = $miRol;
        $misPermisos=$this->model->getPermisos($idRol);
        $datos["misPermisos"]= $misPermisos;
        $datos["userLogueado"] = $_SESSION['user'];
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
      
        return view('/roles/fichaRol', compact('datos'));
    }

    public function guardar(){
        $rol = [
            'nombreRol' => $_POST['nombreRol'],
        ];
      $this->model->insert($rol);   
      $datos["userLogueado"] = $_SESSION['user'];
      $permisos=$this->model->getPermisos($_SESSION['rol']);
      $datos['permisos']= $permisos;
      return $this->index();
    }

    public function modificarRolSeleccionado(){
        $idRol= $_GET['id'];
        $miRol = $this->model->getRol($idRol); 
        $datos['miRol'] = $miRol;
        $datos["userLogueado"] = $_SESSION['user'];
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
        return view('/roles/administracionRol.modificar', compact('datos'));
    }

    public function modificar(){
      
      $idRol= $_POST['idRol'];
        $rol = [
            'nombreRol' => $_POST['nombreRol']
        ];
        $this->model->updateRol($rol,$idRol);
        $this->model->borrarPermisosAsoc($idRol);

        $permisos=$_POST["permisos"];
 
        for ($i=0;$i<count($permisos);$i++)    {  
            $rol = [
                'idRol' => $_POST['idRol'],
                'idPermiso' => $permisos[$i]
                
            ];
            $this->model->agregarPermisosAsoc($idRol,$rol);
        }
        return $this->index();
    }




}

