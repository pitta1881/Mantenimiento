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

    private $table = 'roles';

    /*Show all pedidos*/
    public function administracionRoles($new = null,$update = null,$delete = null){
        $datos["todosRoles"] = $this->model->get($this->table); 
        $datos["userLogueado"] = $_SESSION['user'];
        $datos['permisos'] = $this->model->getPermisos();
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
        $rol['nombreRol'] = $_POST['nombreRol'];
        $insertOk = $this->model->insert($rol);
        return $this->administracionRoles($insertOk);
    }

    public function update(){     
        $rol['idRol'] = $_POST["idRol"];
        $permisos= $_POST["permisos"];
        $this->model->borrarPermisosAsoc($rol);
        for ($i=0;$i<count($permisos);$i++)    {  
            $rol['idPermiso'] = $permisos[$i];
            $this->model->agregarPermisosAsoc($rol);
        }
        return $this->administracionRoles(null,true);
    }

    public function ficha(){
        $rol['idRol'] = $_POST['idRol'];
        $miRol['miRol'] = $this->model->getFicha($this->table,$rol);
        $miRol["misPermisos"] = $this->model->getPermisos($rol['idRol']);
        echo json_encode($miRol);
    }
}