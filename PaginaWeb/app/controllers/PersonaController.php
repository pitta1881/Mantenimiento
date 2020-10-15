<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\PersonaModel;

class PersonaController extends Controller{
    public function __construct(){
        $this->model = new PersonaModel();
        session_start();        
    }

    private $table = 'personas';
    private $tableAgentes = 'agentes';
    private $tableUsuarios = 'usuarios';
    private $tableEstadosPersona = 'estadospersona';
    
    public function administracionPersonas($new = null,$update = null,$delete = null){
        $comparaTablasIfUsado = array(
                                    array(  "tabla" => $this->tableAgentes,
                                            "comparaKeyOrig" => "id",
                                            "comparaKeyDest" => "idPersona"
                                    ),
                                        array(  "tabla" => $this->tableUsuarios,
                                                "comparaKeyOrig" => "id",
                                                "comparaKeyDest" => "idPersona"
                                            )
                                    );
        $datos['todasPersonas'] = $this->model->get($this->table,$comparaTablasIfUsado); 
        $datos['todosEstados'] = $this->model->get($this->tableEstadosPersona);
        $datos['minimo18'] = date('Y-m-d',strtotime('18 years ago'));
        $datos['maximo70'] = date('Y-m-d',strtotime('70 years ago'));
        $alertas = [
            'new' => $new,
            'update' => $update,
            'delete' => $delete
        ];
        $datos['alertas'] = $alertas;
        $_SESSION['urlHeader'] = array(
            array("url" => "/home",
            "nombre" => "HOME"),
            array("url" => "/administracion",
            "nombre" => "ADMINISTRACION"),
            array("url" => "/administracion/personas",
            "nombre" => "PERSONAS")    
        );
        $datos['datosSesion'] = $_SESSION;
        return view('/administracion/PersonasView', compact('datos'));
    }

    public function new(){
        $persona = [
            'id' => $_POST['id'],
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'direccion' => $_POST['direccion'],
            'email' => $_POST['email'],
            'fechaNacimiento' => $_POST['fechaNacimiento'],
            'idEstadoPersona' => 1
        ]; 
        $insertOk = $this->model->insert($this->table,$persona);
        return $this->administracionPersonas($insertOk);
    }

    public function update(){
        $persona = [
            'id' => $_POST['id'],
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'direccion' => $_POST['direccion'],
            'email' => $_POST['email'],
            'fechaNacimiento' => $_POST['fechaNacimiento']
        ];
        $updateOk = $this->model->update($this->table,$persona);
        return $this->administracionPersonas(null,$updateOk);
    }
    
    public function delete(){
        $persona['id'] = $_POST['id'];
        $deleteOk = $this->model->delete($this->table,$persona);
        return $this->administracionPersonas(null,null,$deleteOk);
    }

    public function updateEstado(){
        $persona = [
            'id' => $_POST['idEstado'],
            'idEstadoPersona' => $_POST['idEstadoPersona']
        ];
        $updateOk = $this->model->update($this->table,$persona);
        return $this->administracionPersonas(null,$updateOk);
    }

    public function ficha(){
        $persona['id'] = $_POST['id'];
        $miPersona = $this->model->getFicha($this->table,$persona);
        echo json_encode($miPersona);
    }
    
}
