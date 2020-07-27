<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\PermisoModel;

class PermisoController extends Controller{
    public function __construct(){
        $this->model = new PermisoModel();
        session_start();
    }

    /*Show all pedidos*/

    public function administracionPermisos($new = null,$update = null,$delete = null){
        $todosPermisos= $this->model->get(); 
        $datos['todosPermisos'] = $todosPermisos;
        $datos["userLogueado"] = $_SESSION['user'];
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
        if(!is_null($new)){
            $datos['newOK'] = $new;
        }
        if(!is_null($update)){
            $datos['updateOK'] = $update;
        }
        if(!is_null($delete)){
            $datos['deleteOK'] = $delete;
        }
        $datos['urlheader']="> HOME > ADMINISTRACIÓN > PERMISOS";
        return view('/administracion/PermisosView', compact('datos'));
    }

    public function new() {
        $permiso = [
            'nombrePermiso' => $_POST['nombrePermiso']
        ];
        $insertOk = $this->model->insert($permiso);
        return $this->administracionPermisos($insertOk); 
    }

    public function update(){
        $idPermiso = $_POST['idPermiso'];
        $datos = [
            'nombrePermiso' => $_POST['nombrePermiso']
        ];
        $this->model->update($datos,$idPermiso);
        return $this->administracionPermisos();
     }

     public function delete(){
        $this->model->delete($_POST['idPermiso']);
        return $this->administracionPermisos();
    }

}
