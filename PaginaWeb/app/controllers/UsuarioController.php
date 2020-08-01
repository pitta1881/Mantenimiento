<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\UsuarioModel;

class UsuarioController extends Controller
{
    public function __construct(){
        $this->model = new UsuarioModel();
        session_start();    
    }

    private $table = 'usuarios';

    public function administracionUsuarios($new = null,$update = null,$delete = null){
        $datos['todosUsuarios'] = $this->model->get($this->table);
        $datos['userLogueado'] = $_SESSION['user'];
        $datos['permisos'] = $this->model->getPermisos();
        $datos['roles'] = $this->model->getRoles();  
        $datos['todosPersonas'] = $this->model->getPersonas(); 
        if(!is_null($new)){
            $datos['newOK'] = $new;
        }
        if(!is_null($update)){
            $datos['updateOK'] = $update;
        }
        if(!is_null($delete)){
            $datos['deleteOK'] = $delete;
        }
        $datos['urlheader']="> HOME > ADMINISTRACIÓN > USUARIOS";
        return view('/administracion/UsuariosView', compact('datos'));
    }

    public function new(){
        $usuario = [
            'nombre' => $_POST['nombre'],
            'password' => $_POST['password'],
            'idRol' => $_POST['idRol'],
            'idPersona' => $_POST['dni'],
        ];
        $insertOk = $this->model->insert($this->table,$usuario);
        return $this->administracionUsuarios($insertOk);
    }

    public function update(){
        $usuario = [
            'nombre' => $_POST['nombre'],
            'password' => $_POST['password']
        ];
        $updateOk = $this->model->update($this->table,$usuario);
        return $this->administracionUsuarios(null,$updateOk);
     }
    
}
