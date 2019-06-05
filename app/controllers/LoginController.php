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
        $password=$_POST['contraseña'];
        $statement= $this->model->buscarUsuario($user,$password);
        
    if($stmt->num_rows === 0){
         return view ('index');
     }else{
        return view ('index.home');
          
        }
        
    }

               


}
