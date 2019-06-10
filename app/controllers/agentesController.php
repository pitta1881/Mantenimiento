<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Agentes;

class agentesController extends Controller
{
   public function __construct()
    {
      $this->model = new Agentes();
    
   }
    public function vistaAdministracionAgentes(){
        
        return view('agentes.administracion');
   
    }
       public function vistaAltaAgente(){
        
        return view('agentes.alta');
   
    }
    
    
    
 public function validarAgente(){
       $datos['nombre']=$_POST['nombre'];
       $datos['apellido']=$_POST['apellido'];
       
        $statement= $this->model->buscarAgente($datos['nombre'],$datos['apellido']);      
    if(empty($statement)){
        $this->saveAgente($datos);
        return view('agentes.alta');
    }else{
       
        return view('agentes.alta');
    }       
    }


}
/*
public function vistaAltaUsuario(){
    $nombresRoles=$this->model->getRoles();
    return view('administracionUsuario.alta',compact('nombresRoles'));
}*/