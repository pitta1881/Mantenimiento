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
    private $tableRxU = 'roles_x_usuarios';
    private $tablePedidos = 'pedidos';
    private $tableMovimientos = 'movimientos';
    private $tableRoles = 'roles';
    private $tablePersonas = 'personas';

    public function administracionUsuarios($new = null,$update = null,$delete = null){
        $comparaTablasIfUsado = array(
                                    array(  "tabla" => $this->tablePedidos, 
                                            "comparaKeyOrig" => "id",
                                            "comparaKeyDest" => "idUsuario",
                                        ),
                                    array(  "tabla" => $this->tableMovimientos, 
                                            "comparaKeyOrig" => "id",
                                            "comparaKeyDest" => "idUsuario"
                                        )
        );
        $comparaTablasIfUsado_2 = array(
                                    array(  "tabla" => $this->table, 
                                            "comparaKeyOrig" => "id",
                                            "comparaKeyDest" => "idPersona"
                                        )
        );
        $datos['todosUsuarios'] = $this->model->get($this->table,$comparaTablasIfUsado);        
        $datos['todosRoles'] = $this->model->get($this->tableRoles);  
        $datos['todosPersonas'] = $this->model->get($this->tablePersonas, $comparaTablasIfUsado_2);
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
            array("url" => "/administracion/usuarios",
            "nombre" => "USUARIOS") 
        );
        $datos['datosSesion'] = $_SESSION;
        return view('/administracion/UsuariosView', compact('datos'));
    }

    public function new(){
        $usuario = [
            'nick' => $_POST['nick'],
            'password' => $_POST['password'],
            'idPersona' => $_POST['idPersona'],
        ];
        $insertOk = $this->model->insert($this->table,$usuario);   
        if($insertOk){ //si falla la insercion(seguramente x nick repetido)
            foreach ($_POST['idRol'] as $key => $value) {
                $RxU = [
                    'idRol' => $value,
                    'idUsuario' => $insertOk['lastInsertId']
                ];
                $this->model->insert($this->tableRxU,$RxU);
            }
            return $this->administracionUsuarios($insertOk);            
        }
    }

    public function update(){
        $usuario = [
            'id' => $_POST['id'],
            'password' => $_POST['password']
        ];
        $updateOk = $this->model->update($this->table,$usuario);
        return $this->administracionUsuarios(null,$updateOk);
    }

    public function updateRolesUsuario(){
        $usuario['idUsuario'] = $_POST['id'];
        $this->model->delete($this->tableRxU,$usuario);
        foreach ($_POST['idRol'] as $key => $value) {
            $RxU = [
                'idRol' => $value,
                'idUsuario' => $_POST['id']
            ];
            $this->model->insert($this->tableRxU,$RxU);
        }
        if($_POST['id'] == $_SESSION['idUser']){
            $usuario['idUsuario'] = $_SESSION['idUser'];
            $_SESSION['listaRoles'] = $this->model->buscarRoles_x_Usuario($usuario);
            $_SESSION['rolActual'] = $_SESSION['listaRoles'][0];
            if(sizeof($_SESSION['listaRoles']) > 1){
                $_SESSION['firstOrUnique'] = false;
            } else {
                $_SESSION['firstOrUnique'] = true;
            }
            $_SESSION['listaPermisos'] = $this->model->getPermisos();
            redirect('home');
        }
    }

    public function delete(){
        $usuarioRxU['idUsuario'] = $_POST['id'];
        $usuario['id'] = $_POST['id'];
        $this->model->delete($this->tableRxU,$usuarioRxU);
        $deleteOk = $this->model->delete($this->table,$usuario);
        return $this->administracionUsuarios(null,null,$deleteOk);
    }
    
}
