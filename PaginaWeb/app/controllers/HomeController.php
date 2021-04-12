<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\HomeModel;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->model = new HomeModel();
        session_start();
    }

    public function index($rolChange = null)
    {
        if (empty($_SESSION)) {
            redirect("");
        } else {
            $alertas = [
                'rolChange' => $rolChange
            ];
            $datos['alertas'] = $alertas;
            $_SESSION['urlHeader'] = array(
                array("url" => "/home",
                      "nombre" => "HOME"));
            $datos['datosSesion'] = $_SESSION;
            return view('HomeView', compact('datos'));
        }
    }

    public function changeRol()
    {
        $rol = explode("|", $_GET['rolChangeID']);
        $rol['id'] = $rol[0];
        $rol['nombre'] = $rol[1];
        $_SESSION['rolActual'] = $rol;
        $_SESSION['listaPermisos'] = $this->model->getPermisos();
        return $this->index(true);
    }

    public function administracionCards()
    {
        $datos['alertas'] = [];
        $_SESSION['urlHeader'] = array(
            array("url" => "/home",
                  "nombre" => "HOME"),
            array("url" => "/administracion",
                  "nombre" => "ADMINISTRACION")
                );
        $datos['datosSesion'] = $_SESSION;
        return view('/administracion/AdministracionView', compact('datos'));
    }
}
