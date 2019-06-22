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
        
return view('informes/administracionInforme');     
    
}
}