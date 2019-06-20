<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Usuarios;

class UsuariosController extends Controller
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
        $userPer= $this->model->AllPermisos($_SESSION['user']);
        var_dump($userPer);
        $datos["userPermisos"]= $userPer;
        return view('usuario/AdministracionUsuario', compact('datos'));
    }

    public function vistaGestionUsuario(){    
        return view('/usuarios/gestionUsuario');    
    }

    public function vistaAdministracionUsuario(){
        $todosUsuarios = $this->model->get();     
        $datos['todosUsuarios'] = $todosUsuarios;
        $datos["userLogueado"] = $_SESSION['user'];
        $userPer= $this->model->AllPermisos($_SESSION['user']);
        
        $datos["userPermisos"]= $userPer;
        $todosRoles=$this->model->getRoles(); 
        $todosPersonas=$this->model->getPersonas(); 
        $datos['nombresRoles'] = $todosRoles; 
        $datos['todosPersonas'] = $todosPersonas; 
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
        $roles=$this->model->getRoles();
        $permisos=$this->model->getPermisos();
        $datos['roles'] = $roles;
        $datos['permisos'] = $permisos;
        if (empty($_GET)) {
           $datos['permisosxrol'] = $this->model->permisosxrol($roles[0]['idRol'],$roles[0]['nombreRol']);
        } else {
           $datos['permisosxrol'] = $this->model->permisosxrol(explode("_",$_GET['rol'])[0],explode("_",$_GET['rol'])[1]);
        }   
        return view('/usuarios/administracionPermisos',compact('datos'));
    }

    public function guardarPermisos(){      
        $arrayPermisos=$_POST['idPermiso'];
        foreach ($arrayPermisos as $key => $value) {
            $datos = [
                'idRol' => $_POST['idRol'],
                'idPermiso' => $value,
            ];
            $this->model->guardarPermisosXRol($datos);
        }
        redirect("usuario/AdministracionPermisos");
    }
    
    public function vistaEliminarPermiso(){
          return view('/usuarios/administracionPermisos.eliminar');
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
