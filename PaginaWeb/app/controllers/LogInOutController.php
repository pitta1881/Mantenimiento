<?php

namespace App\Controllers;

use App\Core\Controller;

use App\Models\LogInOutModel;

class LogInOutController extends Controller{
    public function __construct(){
        $this->model = new LogInOutModel();
    }

    private $table = 'usuarios';

    public function logIn(){
        return view('login');
    }

    public function validarLogin(){
        $user = [
            'nombre' => $_POST['nombre'],
            'password' => $_POST['password']
        ];
        $userMatch = $this->model->buscarUsuario($this->table, $user); 
        if(empty($userMatch)){
            $datos['error'] = true;
            return view ('login',compact('datos'));
        }else{
            session_start();
            $_SESSION['user'] = $_POST['nombre'];
            $_SESSION['rol'] = $userMatch['idRol'];
            redirect('home');         
        }       
    }

    public function logOut(){
        session_unset();
        session_destroy();
        redirect('');
    }
}
