<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\EspecializacionModel;

class EspecializacionController extends Controller
{
   public function __construct()
    {
      $this->model = new EspecializacionModel();
      session_start();   
   }


    public function administracionEspecializaciones($new = null,$update = null,$delete = null){
        $todasEspecializaciones = $this->model->get(); 
        $datos['todasEspecializaciones'] = $todasEspecializaciones;
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
        $datos['urlheader']="> HOME > ESPECIALIZACION";
        return view('/especializacion/EspecializacionesView', compact('datos'));
    }       
    
    public function new() {
        $especializacion = [
            'nombre' => $_POST['nombre']
        ];       
        $insertOk = $this->model->insert($especializacion);
        return $this->administracionEspecializaciones($insertOk);
    }
    public function update(){
        $idEspecializacion = $_POST['idEspecializacion'];
        $datos = [
            'nombre' => $_POST['nombre']
        ];
        $this->model->update($datos,$idEspecializacion);
        return $this->administracionEspecializaciones();
     }

     public function delete(){
        $this->model->delete($_POST['idEspecializacion']);
        return $this->administracionEspecializaciones();
    }
    

}
