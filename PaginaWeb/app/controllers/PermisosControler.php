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
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
        return view('/permisos/administracionPermisos', compact('datos'));
    }

    public function guardarPermisos() {
        $datos['nombrePermiso'] = $_POST['nombre'];
        $statement = $this->model->buscarPermiso($datos['nombrePermiso']);        
        if (empty($statement)) {
            $this->model->insert($datos); 
            return $this->index();
        }
        return $this->index();
    }

   public function vistaModificar(){
        $Permiso = $this->model->getByIdPermiso($_GET['idPermiso']);      
        $datos["Permiso"] = $Permiso;
        $datos["userLogueado"] = $_SESSION['user'];
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
        return view('/permisos/permisos.modificar', compact('datos'));
    }

    public function update(){
        $idPermiso = $_POST['idPermiso'];
        $datos = [
            'nombrePermiso' => $_POST['nombrePermiso']
        ];
        $this->model->update($datos,$idPermiso);
        return $this->index();
     }

     public function delete(){
        $this->model->delete($_POST['idPermiso']);
        return $this->index();
    }

}
