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
          $nombresEspecialidades=$this->model->getEspecializacion();
   
          
          return view('agentes.alta',compact('nombresEspecialidades'));
         
    }
    
 public function validarAgente(){
       $datos['nombre']=$_POST['nombre'];
       $datos['apellido']=$_POST['apellido'];
      $datos['nombreEspecializacion']=$_POST['nombreEspecializacion'];
    
     $statement= $this->model->buscarAgente($datos['nombre'],$datos['apellido']);      

     if(empty($statement)){
        $this->saveAgente($datos);
            $nombresEspecialidades=$this->model->getEspecializacion();    
   return view('agentes.alta',compact('nombresEspecialidades'));
    }else{
       $nombresEspecialidades=$this->model->getEspecializacion(); 
     return view('agentes.alta',compact('nombresEspecialidades'));
    }       
 }
public function saveAgente($datos){
       var_dump($datos);
    $this->model->insert($datos);            
 
}
    

//public function saveAgentexEspecializacion($datos,$arraySelect){
        //$this->model->insertEspecialidades($datos,$arraySelect);            
 
//}
    


     public function vistaModificarAgente(){
        
        return view('agentes.modificar');
   
    }
}