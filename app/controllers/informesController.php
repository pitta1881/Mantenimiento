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
         $datos['rol']=$_SESSION['rol'];
  
        
        return view('/informes/vistaInforme',compact('datos'));
    }
     public function getDatos(){
   echo "acaaaaa";
   var_dump($_POST['filtro']);
         if($_POST['filtro']== "Reparaciones_por_sector"){
       echo "entro";
        $fechaDesde=$_POST['fechaInicio'];
        $fechaHasta=$_POST['fechaFin'];
        var_dump($fechaDesde);
             var_dump($fechaHasta);
             $sectores=$this->model->getSectores($fechaDesde,$fechaHasta);
var_dump($sectores);
    }
        return view('informes/vistaInforme',compact('datos','sectores'));
}  


}