<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\LogInOutModel;

define("table", "usuarios");


class LogInOutController extends Controller
{
    public function __construct()
    {
        $this->model = new LogInOutModel();
    }

    public function index($errorLogin = null)
    {
        return view('login');
    }

    public function validarLogin()
    {
        $user = [
            'nick' => $_POST['nick'],
        ];
        $userMatch = $this->model->buscarUsuario(table, $user);
        if (!empty($userMatch)) {
            if (password_verify($_POST['password'], $userMatch['password'])) {
                $usuario['idUsuario'] = $userMatch['id'];
                session_start();
                $_SESSION['idUser'] = $userMatch['id'];
                $_SESSION['nickUser'] = $_POST['nick'];
                $_SESSION['listaRoles'] = $this->model->buscarRoles_x_Usuario($usuario);
                if (sizeof($_SESSION['listaRoles']) > 1) {
                    $_SESSION['firstOrUnique'] = false;
                } else {
                    $_SESSION['firstOrUnique'] = true;
                }
                $_SESSION['rolActual'] = $_SESSION['listaRoles'][0];
                $_SESSION['listaPermisos'] = $this->model->getPermisos();
                $token = null;
                if (isset($_POST['rememberme'])) {
                    $token = $this->model->setRememberme($userMatch);
                }
                return json_encode(
                    array('login' => true,
                    'token' => $token)
                );
            }
        }
        return json_encode(
            array('login' => false)
        );
    }

    public function validarToken()
    {
        $data = $this->model->validarToken($_POST['token']);
        return json_encode($data);
    }

    public function logOut()
    {
        session_destroy();
        redirect('');
    }
}
