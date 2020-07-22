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
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
        $todosRoles=$this->model->getRoles(); 
        $todosPersonas=$this->model->getPersonas(); 
        $datos['roles'] = $todosRoles; 
        $datos['todosPersonas'] = $todosPersonas; 
        if ($boolError) {
            $datos['errorInsert'] = true;
        }
        return view('/usuarios/administracionUsuario', compact('datos'));
    }


    public function update(){
        $nombreUsuario = $_POST['nombre'];
        $datos = [
            'password' => $_POST['password']
        ];
        $this->model->update($datos,$nombreUsuario);
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
