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
         $datos['rol']=$_SESSION['rol'];
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
    $Usuario= $this->model-> getDatosUsuario($_GET['nombre']);

 //  $Permiso = $this->model->getByIdPermiso($_GET['idPermiso']);      
    $datos["Usuario"] = $Usuario;
    $datos["userLogueado"] = $_SESSION['user'];
  
    return view('/usuarios/administracionUsuario.modificar', compact('datos'));
}


    public function update(){
        $idPermiso = $_POST['nombre'];
        $datos = [
            'password' => $_POST['password']
        ];
        $this->model->update($datos,$idPermiso);
        return $this->vistaAdministracionUsuario();
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
