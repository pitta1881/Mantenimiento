<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\UsuarioModel;

define("table", "usuarios");

class UsuarioController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new UsuarioModel();
        session_start();
    }

    public function index()
    {
        $datos['todosRoles'] = $this->model->getFichaAll(tableRoles);
        $datos['todosPersonas'] = $this->model->getFichaAll(tablePersonas);
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

    public function create()
    {
        $usuario = [
            'nick' => $_POST['nick'],
            'password' => $_POST['password'],
            'idPersona' => $_POST['idPersona'],
        ];
        $insert = $this->model->insert(table, $usuario, "Usuario");
        if ($insert) { //si falla la insercion(seguramente x nick repetido)
            foreach ($_POST['idRol'] as $key => $value) {
                $RxU = [
                    'idRol' => $value,
                    'idUsuario' => $insert['mensaje']
                ];
                $this->model->insert(tableRxU, $RxU, "RxU");
            }
            return json_encode($insert);
        }
    }

    public function update()
    {
        $usuario = [
            'password' => $_POST['password']
        ];
        $update = $this->model->update(table, $usuario, array('id' => $_POST['id']), "Usuario");
        return json_encode($update);
    }

    public function updateRolesUsuario()
    {
        $this->model->delete(tableRxU, array(['idUsuario'] => $_POST['id']), "RxU");
        foreach ($_POST['idRol'] as $key => $value) {
            $RxU = [
                'idRol' => $value,
                'idUsuario' => $_POST['id']
            ];
            $this->model->insert(tableRxU, $RxU, "RxU");
        }
        if ($_POST['id'] == $_SESSION['idUser']) {
            $usuario['idUsuario'] = $_SESSION['idUser'];
            $_SESSION['listaRoles'] = $this->model->buscarRoles_x_Usuario($usuario);
            $_SESSION['rolActual'] = $_SESSION['listaRoles'][0];
            if (sizeof($_SESSION['listaRoles']) > 1) {
                $_SESSION['firstOrUnique'] = false;
            } else {
                $_SESSION['firstOrUnique'] = true;
            }
            $_SESSION['listaPermisos'] = $this->model->getPermisos();
            redirect('home');
        }
    }

    public function delete()
    {
        $this->model->delete(tableRxU, array('idUsuario' => $_POST['id']), "RxU");
        $delete = $this->model->delete(table, array('id' => $_POST['id']), "Usuario");
        return json_encode($delete);
    }
}
