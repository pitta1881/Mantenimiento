<?php

namespace App\Controllers;

use App\Core\Controller;

use App\Models\login;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->model = new login();
    }




    public function validarLogin(){
$arrayUsuarios=$this->model->get();
        compact('arrayUsuarios');
        $user=$_POST['nombre'];
        $password=$_POST['contraseña'];
        
           

            $sql='SELECT * FROM usuarios WHERE nombre=$user AND contraseña=$password'; 
    

    if(!empty($sql))

  {
  return view ('index.home');
    
     }else{
           return view ('index');     
            }
            
            
       
             
        }

               


}
              


              
              
