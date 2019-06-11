<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Especializacion;

class EspecializacionController extends Controller
{
   public function __construct()
    {
      $this->model = new Especializacion();
      session_start();   
   }


    public function vistaAdministracionEspecializacion(){
        $todasEspecializaciones = $this->model->get();      
        $datos['todasEspecializaciones'] = $todasEspecializaciones;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/especializacion/especializacion.administracion', compact('datos'));
    }
       
    
    public function guardarEspecializacion() {
        $datos['nombre'] = $_POST['nombre'];
        $statement = $this->model->buscarEspecializacion($datos['nombre']);        
        if (empty($statement)) {
            $this->model->insert($datos); 
            return $this->vistaAdministracionEspecializacion();
        }
    }

    public function vistaModificar(){
        $especializacion = $this->model->getByIdEspecializacion($_GET['idEspecializacion']);      
        $datos['especializacion'] = $especializacion;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/especializacion/especializacion.modificar', compact('datos'));
    }

    public function update(){
        $idEspecializacion = $_POST['idEspecializacion'];
        $datos = [
            'nombre' => $_POST['nombre']
        ];
        $this->model->update($datos,$idEspecializacion);
        return $this->vistaAdministracionEspecializacion();
     }

     public function delete(){
        $this->model->delete($_POST['idEspecializacion']);
        return $this->vistaAdministracionEspecializacion();
    }
    

}