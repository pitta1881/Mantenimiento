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
        $datos['nombrePermiso'] = $_POST['nombre'];
        $statement = $this->model->buscarPermiso($datos['nombrePermiso']);        
        if (empty($statement)) {
            $this->model->insert($datos); 
            return $this->index();
        }
        return $this->index();
    }

  /*  public function vistaModificar(){
        $especializacion = $this->model->getByIdEspecializacion($_GET['idEspecializacion']);      
        $datos['especializacion'] = $especializacion;
        $datos["userLogueado"] = $_SESSION['user'];
         $datos['rol']=$_SESSION['rol'];
        return view('/especializacion/especializacion.modificar', compact('datos'));
    }

    public function update(){
        $idEspecializacion = $_POST['idEspecializacion'];
        $datos = [
            'nombre' => $_POST['nombre']
        ];
        $this->model->update($datos,$idEspecializacion);
        return $this->vistaAdministracionEspecializacion();
     }

     public function delete(){
        $this->model->delete($_POST['idEspecializacion']);
        return $this->vistaAdministracionEspecializacion();
    }*/

}
