<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Usuarios;

class UsuariosControler extends Controller
{
   public function __construct()
    {
      $this->model = new Usuarios();
    
   }
    public function vistaGestionUsuario(){
        
        return view('gestionUsuario');
    
    }
public function vistaAdministracionUsuario(){
    return view('administracionUsuario');
    
}
public function vistaAltaUsuario(){
    return view('administracionUsuario.alta');
}
    
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
       $nombreUsuario=$_POST['nombreUsuario'];
       
        $statement= $this->model->buscarUsuario($nombreUsuario);        
    if(empty($statement)){
       
        
        return view('administracionUsuario.alta');
     
    }else{
$this->saveUsuario();
       
        return view('administracionUsuario.alta');
    }       
    }

 public function saveUsuario( ){
        $usuario= [
            'nombreUsuario' => $_POST['nombreUsuario'],
            'password' => $_POST['password']
        ];
        $this->model->insert($usuario);
      
            
 }

//roles que van a aparecer en el select del alta de usuario
    public function selectRol(){
        $nombresRoles=$this->model->getRoles();
   
      
           return view('administracionUsuario.alta',compact('nombresRoles'));
    }
    
    
}
       
       
   
