<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Persona;

class PersonaController extends Controller{
    public function __construct(){
        $newError = false;
        $this->model = new Persona();
        session_start();    
    }
    
    public function administracionPersonas($newError = false){
        $todasPersonas = $this->model->get(); 
        $datos['todasPersonas'] = $todasPersonas;
        $datos['estados'] = $this->model->getEstadosPersona();
        $datos['minimo18'] = date('Y-m-d',strtotime('18 years ago'));
        $datos['maximo70'] = date('Y-m-d',strtotime('70 years ago'));
        $datos["userLogueado"] = $_SESSION['user'];
        $datos['permisos'] = $this->model->getPermisos($_SESSION['rol']);
        if ($newError) {
            $datos['newError'] = $newError;
        }
        $datos['urlheader']="> HOME > ADMINISTRACIÓN > PERSONAS";
        return view('/administracion/PersonasView', compact('datos'));
    }

    public function new(){
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
            return $this->administracionPersonas();
        }else{
            return $this->administracionPersonas(true);
        }
    }

    public function update(){
        $idPersona = $_POST['dni'];
        $persona = [
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'direccion' => $_POST['direccion'],
            'email' => $_POST['email'],
            'fecha_nacimiento' => $_POST['fecha_nacimiento']
        ];
        $this->model->update($persona,$idPersona);
        return $this->administracionPersonas();
    }
    
    public function delete(){
        $this->model->delete($_POST['dni']);
        return $this->administracionPersonas();
    }

    public function updateEstado(){
        var_dump($_POST);
    }

    public function ficha(){
        $miPersona = $this->model->getByIdPersona($_POST['idAgente']);
        echo json_encode($miPersona);
    }
    
}
