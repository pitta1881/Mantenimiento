<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\UsuarioModel;

define("table", "usuarios");
define("tableRxU", "roles_x_usuarios");
define("tablePedidos", "pedidos");
define("tableMovimientos", "movimientos");
define("tableRoles", "roles");
define("tablePersonas", "personas");

class UsuarioController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new UsuarioModel();
        session_start();
    }

    public function index($alerta = null)
    {
        $comparaTablasIfUsado = array(
                                    array(  "tabla" => tablePedidos,
                                            "comparaKeyOrig" => "id",
                                            "comparaKeyDest" => "idUsuario",
                                        ),
                                    array(  "tabla" => tableMovimientos,
                                            "comparaKeyOrig" => "id",
                                            "comparaKeyDest" => "idUsuario"
                                        )
        );
        $comparaTablasIfUsado_2 = array(
                                    array(  "tabla" => table,
                                            "comparaKeyOrig" => "id",
                                            "comparaKeyDest" => "idPersona"
                                        )
        );
        $datos['todosUsuarios'] = $this->model->getFichaAll(table, $comparaTablasIfUsado);
        $datos['todosRoles'] = $this->model->getFichaAll(tableRoles);
        $datos['todosPersonas'] = $this->model->getFichaAll(tablePersonas, $comparaTablasIfUsado_2);
        $datos['alertas'] = $alerta;
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
            return $this->index($insert);
        }
    }

    public function update()
    {
        $usuario = [
            'id' => $_POST['id'],
            'password' => $_POST['password']
        ];
        $update = $this->model->update(table, $usuario, "Usuario");
        return $this->index($update);
    }

    public function updateRolesUsuario()
    {
        $usuario['idUsuario'] = $_POST['id'];
        $this->model->delete(tableRxU, $usuario, "RxU");
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
        $usuarioRxU['idUsuario'] = $_POST['id'];
        $usuario['id'] = $_POST['id'];
        $this->model->delete(tableRxU, $usuarioRxU, "RxU");
        $delete = $this->model->delete(table, $usuario, "Usuario");
        return $this->index($delete);
    }
}
