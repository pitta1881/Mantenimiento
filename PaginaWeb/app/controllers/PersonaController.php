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
        $datos['estados'] = $this->model->getEstadosPersona();
        $datos['minimo18'] = date('Y-m-d',strtotime('18 years ago'));
        $datos['maximo70'] = date('Y-m-d',strtotime('70 years ago'));
        $datos["userLogueado"] = $_SESSION['user'];
        $datos['permisos'] = $this->model->getPermisos($_SESSION['rol']);
        if ($boolError) {
            $datos['errorInsert'] = true;
        }
        $datos['urlheader']="> HOME > ADMINISTRACIÓN > PERSONAS";
        return view('/personas/personas.administracion', compact('datos'));
    }

    public function altaPersona(){
        $datos = [
            'dni' => $_POST['dni'],
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'direccion' => $_POST['direccion'],
            'email' => $_POST['email'],
            'fecha_nacimiento' => $_POST['fecha_nacimiento'],
            'estado' => $_POST['estado']
        ]; 
        $statement = $this->model->buscarPersona($datos['dni']);
        if (empty($statement)) {            
            $this->model->insert($datos); 
            return $this->vistaAdministracionPersona();
        }else{
            return $this->vistaAdministracionPersona(true);
        }
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
        $miPersona = $this->model->getByIdPersona($_POST['idAgente']);
        echo json_encode($miPersona);
    }

    public function modificarEstado(){
        var_dump($_POST);
    }
    
}
