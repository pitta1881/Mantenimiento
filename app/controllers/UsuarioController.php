<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\UsuarioModel;
use App\Models\RolModel;
use App\Models\PersonaModel;
use Exception;

define("table", "usuarios");

class UsuarioController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new UsuarioModel();
        $this->rolModel = new RolModel();
        $this->personaModel = new PersonaModel();
        session_start();
    }

    public function index()
    {
        $datos['todosRoles'] = $this->rolModel->getFichaAll(tableRoles);
        $datos['todosPersonas'] = $this->personaModel->getFichaAll(tablePersonas);
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
        try {
            $this->model->startTransaction();
            $usuario = [
                'nick' => $_POST['nick'],
                'password' => $_POST['password'],
                'idPersona' => $_POST['idPersona'],
            ];
            $insert = $this->model->insert(table, $usuario, "Usuario");
            foreach ($_POST['idRol'] as $key => $value) {
                $RxU = [
                'idRol' => $value,
                'idUsuario' => $insert['mensaje']
            ];
                $this->model->insert(tableRxU, $RxU, "RxU");
            }
            $this->model->commit();
            return json_encode($insert);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Usuario',
                    "operacion" => "insert",
                    "estado" => false,
                    "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }

    public function update()
    {
        try {
            $this->model->startTransaction();
            $usuario = [
                'password' => $_POST['password']
            ];
            $update = $this->model->update(table, $usuario, array('id' => $_POST['id']), "Usuario");
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Usuario',
                    "operacion" => "update",
                    "estado" => false,
                    "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }

    public function updateRolesUsuario()
    {
        try {
            $this->model->startTransaction();
            $this->model->delete(tableRxU, array('idUsuario' => $_POST['id']), "RxU");
            foreach ($_POST['idRol'] as $key => $value) {
                $RxU = [
                    'idRol' => $value,
                    'idUsuario' => $_POST['id']
                ];
                $update = $this->model->insert(tableRxU, $RxU, "Usuario");
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
                return json_encode(array('redirect' => true));
            }
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Rol',
                    "operacion" => "update",
                    "estado" => false,
                    "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }

    public function delete()
    {
        try {
            $this->model->startTransaction();
            $this->model->delete(tableRxU, array('idUsuario' => $_POST['id']), "RxU");
            $delete = $this->model->delete(table, array('id' => $_POST['id']), "Usuario");
            $this->model->commit();
            return json_encode($delete);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                "tipo" => 'Usuario',
                "operacion" => "delete",
                "estado" => false,
                "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }
}
