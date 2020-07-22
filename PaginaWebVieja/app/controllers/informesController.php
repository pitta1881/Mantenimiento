<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\informes;

class informesController extends Controller
{
   public function __construct()
    {
      $this->model = new informes();
      session_start();   
   
   }


   public function vistaAdministracionInformes(){
      
         $datos["userLogueado"] = $_SESSION['user'];
         $permisos=$this->model->getPermisos($_SESSION['rol']);
         $datos['permisos']= $permisos;
  
        
        return view('/informes/vistaInforme',compact('datos'));
    }
     public function getDatos(){

  $datos["userLogueado"] = $_SESSION['user'];
  $permisos=$this->model->getPermisos($_SESSION['rol']);
  $datos['permisos']= $permisos;
      
      
         if($_POST['filtro']=="Reparaciones_por_sector"){
        $fechaDesde=$_POST['fechaInicio'];
        $fechaHasta=$_POST['fechaFin'];
 
             $sectores=$this->model->getSectores($fechaDesde,$fechaHasta);

             //$todosSectores=json_encode($sectores);
        $datos["filtro"]=$_POST['filtro'];
 
             return view('/informes/repaPorSectores',compact('datos','sectores'));

         }  
      if($_POST['filtro']== "Especializacion_por_tarea"){
      $fechaDesde=$_POST['fechaInicio'];
        $fechaHasta=$_POST['fechaFin'];
          $especializaciones=$this->model->getEspXtarea($fechaDesde,$fechaHasta);
   
       return view('/informes/especializacionXpedidos',compact('datos','especializaciones'));
      }
        if($_POST['filtro']== "Estados"){
    $fechaDesde=$_POST['fechaInicio'];
        $fechaHasta=$_POST['fechaFin'];
            $estados=$this->model->getEstados($fechaDesde,$fechaHasta);
 
       return view('/informes/estadoPedidos',compact('datos','estados'));
      
      
      }
     }

}