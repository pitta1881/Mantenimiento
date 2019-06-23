<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Persona;

class PersonaController extends Controller{
   public function __construct(){
      $this->model = new Persona();
      session_start();    
   }
    
    public function vistaAdministracionPersona($boolError = false){
        $todasPersonas = $this->model->get(); 
        $datos['todasPersonas'] = $todasPersonas;
        $datos['minimo18'] = date('Y-m-d',strtotime('18 years ago'));
        $datos['maximo70'] = date('Y-m-d',strtotime('70 years ago'));
        $datos["userLogueado"] = $_SESSION['user'];
         $datos['rol']=$_SESSION['rol'];
        if ($boolError) {
            $datos['errorInsert'] = true;
        }
        return view('/personas/personas.administracion', compact('datos'));
    }

    public function altaPersona(){
        $datos = [
            'dni' => $_POST['dni'],
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'direccion' => $_POST['direccion'],
            'email' => $_POST['email'],
            'fecha_nacimiento' => $_POST['fecha_nacimiento']
        ]; 
        $statement = $this->model->buscarPersona($datos['dni']);
        if (empty($statement)) {            
            $this->model->insert($datos); 
            return $this->vistaAdministracionPersona();
        }else{
            return $this->vistaAdministracionPersona(true);
        }
    }

    public function modificarPersonaSeleccionada(){
        $miPersona = $this->model->getByIdPersona($_GET['dni']);
        $miPersona['fecha_nacimiento'] = date("Y-m-d", strtotime($miPersona['fecha_nacimiento']));
        $datos["miPersona"] = $miPersona;
        $datos['minimo18'] = date('Y-m-d',strtotime('18 years ago'));
        $datos['maximo70'] = date('Y-m-d',strtotime('70 years ago'));
        $datos["userLogueado"] = $_SESSION['user'];
         $datos['rol']=$_SESSION['rol'];
        return view('/personas/personas.modificar',compact('datos'));
    }

    public function modificar(){
        $idPersona = $_POST['dni'];
        $persona = [
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'direccion' => $_POST['direccion'],
            'email' => $_POST['email'],
            'fecha_nacimiento' => $_POST['fecha_nacimiento']
        ];
        $this->model->update($persona,$idPersona);
        return $this->vistaAdministracionPersona();
    }
    
    public function eliminar(){
        $this->model->delete($_POST['dni']);
        return $this->vistaAdministracionPersona();
    }

    public function ficha(){
        $miPersona = $this->model->getByIdPersona($_GET['idAgente']);
        $datos["miPersona"] = $miPersona;  
        $datos["userLogueado"] = $_SESSION['user'];
         $datos['rol']=$_SESSION['rol'];
        return view('/personas/personaVerFicha', compact('datos'));
    }
    
}
