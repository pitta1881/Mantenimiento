<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Roles;
use App\Models\Permisos;

class RolesController extends Controller{

    public function __construct(){
        $newError = false;
        $this->model = new Roles();
        session_start();
    }

    /*Show all pedidos*/
    public function administracionRoles($newError = false, $boolOk = false){
        $todosRoles = $this->model->get(); 
        $datos["todosRoles"] = $todosRoles;
        $datos["userLogueado"] = $_SESSION['user'];
        $datos['permisos'] = $this->model->getPermisos($_SESSION['rol']);
        if ($newError) {
            $datos['newError'] = $newError;
        }
        if ($boolOk) {
            $datos['okUpdate'] = true;
        }
        $datos['urlheader']="> HOME > ADMINISTRACIÓN > ROLES";
        return view('/administracion/RolesView', compact('datos'));
    }

    public function new(){
        $rol = [
            'nombreRol' => $_POST['nombreRol']
        ];
        $statement = $this->model->buscarRol($rol['nombreRol']);
        if (empty($statement)) {   
            $this->model->insert($rol);    
            return $this->administracionRoles();
        }else{
            return $this->administracionRoles(true);
        }
    }

    public function update(){      
        $idRol= $_POST["idRol"];
        $permisos= $_POST["permisos"];
        $this->model->borrarPermisosAsoc($idRol);
        for ($i=0;$i<count($permisos);$i++)    {  
            $rol = [
                'idRol' => $idRol,
                'idPermiso' => $permisos[$i]                
            ];
            $this->model->agregarPermisosAsoc($idRol,$rol);
        }
        return $this->administracionRoles(false,true);
    }

    public function ficha(){
        $idRol= $_POST['idRol'];
        $miRol['miRol'] = $this->model->getRol($idRol); 
        $miRol["misPermisos"]= $this->model->getPermisos($idRol);
        echo json_encode($miRol);
    }
}