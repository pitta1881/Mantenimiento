<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\PersonaModel;

class PersonaController extends Controller{
    public function __construct(){
        $this->model = new PersonaModel();
        session_start();    
    }
    
    public function administracionPersonas($new = null,$update = null,$delete = null){
        $todasPersonas = $this->model->get(); 
        $datos['todasPersonas'] = $todasPersonas;
        $datos['estados'] = $this->model->getEstadosPersona();
        $datos['minimo18'] = date('Y-m-d',strtotime('18 years ago'));
        $datos['maximo70'] = date('Y-m-d',strtotime('70 years ago'));
        $datos["userLogueado"] = $_SESSION['user'];
        $datos['permisos'] = $this->model->getPermisos($_SESSION['rol']);
        if(!is_null($new)){
            $datos['newOK'] = $new;
        }
        if(!is_null($update)){
            $datos['updateOK'] = $update;
        }
        if(!is_null($delete)){
            $datos['deleteOK'] = $delete;
        }
        $datos['urlheader']="> HOME > ADMINISTRACIÓN > PERSONAS";
        return view('/administracion/PersonasView', compact('datos'));
    }

    public function new(){
        $persona = [
            'dni' => $_POST['dni'],
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'direccion' => $_POST['direccion'],
            'email' => $_POST['email'],
            'fecha_nacimiento' => $_POST['fecha_nacimiento'],
            'estado' => $_POST['estado']
        ]; 
        $insertOk = $this->model->insert($persona);
        return $this->administracionPersonas($insertOk);
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
