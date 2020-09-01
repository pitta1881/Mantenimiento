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
    
    public function administracionPersonas($new = null,$update = null,$delete = null){
        $comparaTablasIfUsado = array(
                                    array(  "tabla" => $this->tableAgentes,
                                            "comparaKey" => "idAgente"
                                        )
                                );
        $datos['todasPersonas'] = $this->model->get($this->table,$comparaTablasIfUsado); 
        $datos["userLogueado"] = $_SESSION['user'];
        $datos['permisos'] = $this->model->getPermisos();
        $datos['estados'] = $this->model->getEstadosPersona();
        $datos['minimo18'] = date('Y-m-d',strtotime('18 years ago'));
        $datos['maximo70'] = date('Y-m-d',strtotime('70 years ago'));
        $alertas = [
            'new' => $new,
            'update' => $update,
            'delete' => $delete
        ];
        $datos['alertas'] = $alertas;
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
        $insertOk = $this->model->insert($this->table,$persona);
        return $this->administracionPersonas($insertOk);
    }

    public function update(){
        $persona = [
            'dni' => $_POST['dni'],
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'direccion' => $_POST['direccion'],
            'email' => $_POST['email'],
            'fecha_nacimiento' => $_POST['fecha_nacimiento']
        ];
        $updateOk = $this->model->update($this->table,$persona);
        return $this->administracionPersonas(null,$updateOk);
    }
    
    public function delete(){
        $persona['dni'] = $_POST['dni'];
        $deleteOk = $this->model->delete($this->table,$persona);
        return $this->administracionPersonas(null,null,$deleteOk);
    }

    public function updateEstado(){
        var_dump($_POST);
    }

    public function ficha(){
        $persona['dni'] = $_POST['dni'];
        $miPersona = $this->model->getFicha($this->table,$persona);
        echo json_encode($miPersona);
    }
    
}
