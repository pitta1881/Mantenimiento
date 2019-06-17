<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Persona;

class PersonaController extends Controller
{
   public function __construct()
    {
      $this->model = new Persona();
      session_start();    
   }
    
    public function vistaAdministracionPersona(){
        $todasPersonas = $this->model->get();      
        $datos['todasPersonas'] = $todasPersonas;
        $datos["userLogueado"] = $_SESSION['user'];
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
        }/*else{
            mostrar mensaje de que ya existe
        }*/
    }

    public function modificarPersonaSeleccionada(){
        $miPersona = $this->model->getByIdPersona($_GET['dni']);
        $datos["miPersona"] = $miPersona;
        $datos["userLogueado"] = $_SESSION['user'];
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
        return view('/personas/personaVerFicha', compact('datos'));
    }
    
}
