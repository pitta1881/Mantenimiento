<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Usuarios;

class UsuariosControler extends Controller
{
   public function __construct()
    {
      $this->model = new Usuarios();
      session_start();
    
   }
    
       /*Show all pedidos*/
    public function index(){
        $todosUsuarios = $this->model->get();      
        $datos['$todosUsuarios'] = $todosUsuarios;
        $datos["userLogueado"] = $_SESSION['user'];        
        return view('usuario/AdministracionUsuario', compact('datos'));
    }

    public function vistaGestionUsuario(){    
        return view('/usuarios/gestionUsuario');    
    }

    public function vistaAdministracionUsuario(){
        $todosUsuarios = $this->model->get();     
        $datos['todosUsuarios'] = $todosUsuarios;
        $datos["userLogueado"] = $_SESSION['user'];
        $todosRoles=$this->model->getRoles();
        $todosPersonas=$this->model->getPersonas();
        $datos['nombresRoles'] = $todosRoles;
        $datos['nombresPersonas'] = $todosPersonas;
        return view('/usuarios/administracionUsuario', compact('datos'));
    }
/*public function vistaAltaUsuario(){
   
}*/
    
  public function vistamodificarUsuario(){
    return view('/usuarios/administracionUsuario.modificar');
}
    public function vistaeliminarUsuario(){
    return view('/usuarios/administracionUsuario.eliminar');
}
    public function vistaAdministracionRol(){
    return view('/usuarios/administracionRol');
    
}
    public function vistaAltaRol(){
          return view('/usuarios/administracionRol.alta');
    }
    public function vistaModificarRol(){
          return view('/usuarios/administracionRol.modificar');
    }
    public function vistaEliminarRol(){
          return view('/usuarios/administracionRol.eliminar');
    }
    public function vistaAdministracionPermisos(){
           return view('/usuarios/administracionPermisos');
    }
     public function vistaAsignarPermiso(){
          return view('/usuarios/administracionPermisos.asignar');
    }
    
     public function vistaEliminarPermiso(){
          return view('/usuarios/administracionPermisos.eliminar');
    }
    public function vistaAdministracionPersona(){
    return view('/usuarios/administracionPersona');
    
}
public function vistaAltaPersona(){
    return view('/usuarios/administracionPersona.alta');
}
    
  public function vistamodificarPersona(){
    return view('/usuarios/administracionPersona.modificar');
}
    public function vistaeliminarPersona(){
    return view('/usuarios/administracionPersona.eliminar');
}
    
    
    
    public function validarUsuario(){
       $datos['nombre']=$_POST['nombre'];
       $datos['password']=$_POST['password'];
       
        $statement= $this->model->buscarUsuario($datos['nombre']);      
    if(empty($statement)){
        //verifico si existe la persona o no 
        /*
        $persona=$this->model->buscarPersona($datos['nombre']); 
       
        
        if(empty($persona)){
        
           $this->saveUsuario($datos); //guardo el usuario asi al dar de alta la persona no tengo q volver a dar de alta al usuario    
           //llamar a la vista alta persona 
       }*/
        
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
    
}
