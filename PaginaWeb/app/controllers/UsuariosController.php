<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Usuarios;

class UsuariosController extends Controller
{
    public function __construct(){
        $newError = false;
        $this->model = new Usuarios();
        session_start();    
    }

    public function administracionUsuarios($newError = false){
        $todosUsuarios = $this->model->get();     
        $datos['todosUsuarios'] = $todosUsuarios;
        $datos["userLogueado"] = $_SESSION['user'];
        $datos['permisos']= $this->model->getPermisos($_SESSION['rol']);
        $datos['roles'] = $this->model->getRoles();  
        $datos['todosPersonas'] = $this->model->getPersonas(); 
        if ($newError) {
            $datos['newError'] = $newError;
        }
        $datos['urlheader']="> HOME > ADMINISTRACIÓN > USUARIOS";
        return view('/administracion/UsuariosView', compact('datos'));
    }

    public function new(){
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
             return $this->administracionUsuarios();
         }else{
             return $this->administracionUsuarios(true);
         }       
     }

    public function update(){
        $nombreUsuario = $_POST['nombre'];
        $datos = [
            'password' => $_POST['password']
        ];
        $this->model->update($datos,$nombreUsuario);
        return $this->administracionUsuarios();
     }
    
}
