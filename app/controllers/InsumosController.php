<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Insumos;

class InsumosController extends Controller{
   public function __construct()
    {
      $this->model = new Insumos();
    
   }
    public function vistaAdministracionInsumos(){
        
        return view('/insumos/insumos.administracion');    
    }
    

public function vistaAgregarInsumos(){
    return view('insumos.administracion.agregarInsumos');
}
/*    
  public function vistamodificarUsuario(){
    return view('administracionUsuario.modificar');
}
    public function vistaeliminarUsuario(){
    return view('administracionUsuario.eliminar');
}
    public function vistaAdministracionRol(){
    return view('administracionRol');
    
}
    public function vistaAltaRol(){
          return view('administracionRol.alta');
    }
    public function vistaModificarRol(){
          return view('administracionRol.modificar');
    }
    public function vistaEliminarRol(){
          return view('administracionRol.eliminar');
    }
    public function vistaAdministracionPermisos(){
           return view('administracionPermisos');
    }
     public function vistaAsignarPermiso(){
          return view('administracionPermisos.asignar');
    }
    
     public function vistaEliminarPermiso(){
          return view('administracionPermisos.eliminar');
    }
    public function vistaAdministracionPersona(){
    return view('administracionPersona');
    
}
public function vistaAltaPersona(){
    return view('administracionPersona.alta');
}
    
  public function vistamodificarPersona(){
    return view('administracionPersona.modificar');
}
    public function vistaeliminarPersona(){
    return view('administracionPersona.eliminar');
}
    
    
    
    public function validarUsuario(){
       $datos['nombre']=$_POST['nombre'];
       $datos['password']=$_POST['password'];
       
        $statement= $this->model->buscarUsuario($datos['nombre']);      
    if(empty($statement)){
        $this->saveUsuario($datos);
        return view('administracionUsuario.alta');
    }else{
        echo 'ya hay uno';
        return view('administracionUsuario.alta');
    }       
    }

 public function saveUsuario($datos){
        $this->model->insert($datos);            
 }
 */   
}