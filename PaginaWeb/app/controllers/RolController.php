<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\RolModel;
use App\Models\PermisoModel;

class RolController extends Controller{

    public function __construct(){
        $this->model = new RolModel();
        session_start();
    }

    /*Show all pedidos*/
    public function administracionRoles($new = null,$update = null,$delete = null){
        $todosRoles = $this->model->get(); 
        $datos["todosRoles"] = $todosRoles;
        $datos["userLogueado"] = $_SESSION['user'];
        $datos['permisos'] = $this->model->getPermisos($_SESSION['rol']);
        if(!is_null($new)){
            $datos['newOK'] = $new;
        }
        if(!is_null($update)){
            $datos['updateOK'] = $update;
        }
        if(!is_null($delete)){
            $datos['deleteOK'] = $delete;
        }
        $datos['urlheader']="> HOME > ADMINISTRACIÓN > ROLES";
        return view('/administracion/RolesView', compact('datos'));
    }

    public function new(){
        $rol = [
            'nombreRol' => $_POST['nombreRol']
        ];
        $insertOk = $this->model->insert($rol);
        return $this->administracionRoles($insertOk);
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