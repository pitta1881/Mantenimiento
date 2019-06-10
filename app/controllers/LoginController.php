<?php

namespace App\Controllers;

use App\Core\Controller;

use App\Models\login;

class LoginController extends Controller{
    public function __construct(){
        $this->model = new login();
    }

    public function validarLogin(){
        //$arrayUsuarios=$this->model->get();
       // compact('arrayUsuarios');
        $user=$_POST['nombre'];
        $password=$_POST['password'];
        $statement= $this->model->buscarUsuario($user,$password); 
    if(empty($statement)){
        echo '<script language="javascript">';
        echo 'alert("Usuario o Contraseña Incorrecta")';
        echo '</script>';
        return view ('index');
     }else{
         session_start();
         $_SESSION['user']=$_POST['nombre'];
         $datos['cantidadPedidos'] = $this->model->getActivos('pedido','id');
         $datos['tareasSinAsignar'] = $this->model->getActivos('tarea','idTarea');
         $datos['agentesDisponibles'] = 0;
         $datos['otActivas'] = $this->model->getActivos('ordendetrabajo','idOT');
         $datos['userLogueado'] = $_SESSION['user'];
        return view ('index.home',compact('datos'));
        }       
    }
}
