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
    private $tablePedido = 'pedido';
    private $tableMovimiento = 'movimiento';

    public function administracionUsuarios($new = null,$update = null,$delete = null){
        $comparaTablasIfUsado = array(
                                    array(  "tabla" => $this->tablePedido, 
                                            "comparaKey" => "nombreUsuario"
                                        ),
                                    array(  "tabla" => $this->tableMovimiento, 
                                            "comparaKey" => "nombreUsuario"
                                        )
        );
        $datos['todosUsuarios'] = $this->model->get($this->table,$comparaTablasIfUsado);
        $datos['userLogueado'] = $_SESSION['user'];
        $datos['permisos'] = $this->model->getPermisos();
        $datos['roles'] = $this->model->getRoles();  
        $datos['todosPersonas'] = $this->model->getPersonas(); 
        $alertas = [
            'new' => $new,
            'update' => $update,
            'delete' => $delete
        ];
        $datos['alertas'] = $alertas;
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

    public function delete(){
        $usuario['nombre'] = $_POST['nombre'];
        $deleteOk = $this->model->delete($this->table,$usuario);
        return $this->administracionUsuarios(null,null,$deleteOk);
    }
    
}
