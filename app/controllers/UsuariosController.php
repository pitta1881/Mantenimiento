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

    public function vistaAdministracionUsuario($boolError = false){
        $todosUsuarios = $this->model->get();     
        $datos['todosUsuarios'] = $todosUsuarios;
        $datos["userLogueado"] = $_SESSION['user'];
        $userPer= $this->model->AllPermisos($_SESSION['user']);
        $datos["userPermisos"]= $userPer;
        $todosRoles=$this->model->getRoles(); 
        $todosPersonas=$this->model->getPersonas(); 
        $datos['roles'] = $todosRoles; 
        $datos['todosPersonas'] = $todosPersonas; 
        if ($boolError) {
            $datos['errorInsert'] = true;
        }
        return view('/usuarios/administracionUsuario', compact('datos'));
    }
    
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
       //verifico si existe el usuario
        $statement= $this->model->buscarUsuario($_POST['nombre']);      
    if(empty($statement)){
        $usuario = [
            'nombre' => $_POST['nombre'],
            'password' => $_POST['password'],
            'idRol' => $_POST['idRol'],
            'idPersona' => $_POST['dni'],
            ];
        $this->model->insert($usuario);
        return $this->vistaAdministracionUsuario();
    }else{
        return $this->vistaAdministracionUsuario(true);
    }       
}
    
}
