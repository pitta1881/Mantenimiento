<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\pages;


class HomeController extends Controller{
    
    public function __construct(){
        $this->model = new Pages();
        session_start();        
    }

    public function home($rolChange = null){               
        if(empty($_SESSION)){
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
         /*$datos['cantidadPedidos'] = $this->model->getActivos('pedido','id');
         $datos['cantTareasSinAsignar'] = $this->model->getActivos('tarea','idTarea');
         $datos['agentesDisponibles'] = $this->model->getAgentesDisponibles('agentes');
         $datos['otActivas'] = $this->model->getActivos('ordendetrabajo','idOT');
         
        //tabla de eventos en home
        $todosEventos = $this->model->getEventos();
        $datos['todosEventos']=$todosEventos;

        //tabla tareas sin asignar en home
        $tareasSinAsignar = $this->model->getTareasSinAsignar();
        $datos['tareasSinAsignar'] = $tareasSinAsignar;
        */
        return view ('HomeView',compact('datos'));
        }
    }

    public function changeRol(){
        $rol = explode("|", $_GET['rolChangeID']);
        $rol['id'] = $rol[0];
        $rol['nombre'] = $rol[1];
        $_SESSION['rolActual'] = $rol;
        $_SESSION['listaPermisos'] = $this->model->getPermisos();
        return $this->home(true);
    }

    public function administracionCards(){
        $datos['alertas'] = [];
        $_SESSION['urlHeader'] = array(
            array("url" => "/home",
                  "nombre" => "HOME"),
            array("url" => "/administracion",
                  "nombre" => "ADMINISTRACION")
                );
        $datos['datosSesion'] = $_SESSION;
        return view ('/administracion/AdministracionView',compact('datos'));
    }
}
