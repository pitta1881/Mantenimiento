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
        $alertas = [
            'errorLogin' => $errorLogin
        ];
        $datos['alertas'] = $alertas;
        return view('login', compact('datos'));
    }

    public function validarLogin()
    {
        $user = [
            'nick' => $_POST['nick'],
        ];
        $userMatch = $this->model->buscarUsuario(table, $user);
        if (empty($userMatch)) {
            return $this->logInError();
        } else {
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
                redirect('home');
            } else {
                return $this->logInError();
            }
        }
    }

    public function logOut()
    {
        session_destroy();
        redirect('');
    }

    public function logInError()
    {
        $datos['error'] = true;
        return view('/login', compact('datos'));
    }
}
