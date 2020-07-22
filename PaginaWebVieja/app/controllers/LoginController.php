<?php

namespace App\Controllers;

use App\Core\Controller;

use App\Models\login;

class LoginController extends Controller{
    public function __construct(){
        $this->model = new login();
    }

    public function validarLogin(){
        $user=$_POST['nombre'];
        $password=$_POST['password'];
        $statement= $this->model->buscarUsuario($user,$password); 
        if(empty($statement)){
            $datos['error'] = true;
            return view ('login',compact('datos'));
        }else{
            session_start();
            $_SESSION['user']=$_POST['nombre'];
            $_SESSION['rol']=$statement['idRol'];
            redirect('home');         
        }       
    }
}
