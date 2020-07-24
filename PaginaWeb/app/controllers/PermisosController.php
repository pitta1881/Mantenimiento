<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Permisos;

class PermisosController extends Controller{
    public function __construct(){
        $newError = false;
        $this->model = new Permisos();
        session_start();
    }

    /*Show all pedidos*/

    public function administracionPermisos($newError = false){
        $todosPermisos= $this->model->get(); 
        $datos['todosPermisos'] = $todosPermisos;
        $datos["userLogueado"] = $_SESSION['user'];
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
        if ($newError) {
            $datos['newError'] = $newError;
        }
        $datos['urlheader']="> HOME > ADMINISTRACIÓN > PERMISOS";
        return view('/administracion/PermisosView', compact('datos'));
    }

    public function new() {
        $datos['nombrePermiso'] = $_POST['nombrePermiso'];
        $statement = $this->model->buscarPermiso($datos['nombrePermiso']);        
        if (empty($statement)) {
            $this->model->insert($datos); 
            return $this->administracionPermisos();
        }
        return $this->administracionPermisos(true);
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
