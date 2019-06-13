<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\pages;


class PagesController extends Controller{
    
    public function __construct(){
        $this->model = new Pages();
        session_start();        
    }

    public function home()
    {               
        if(empty($_SESSION)){
            redirect("");
        } else {
         $datos['cantidadPedidos'] = $this->model->getActivos('pedido','id');
         $datos['cantTareasSinAsignar'] = $this->model->getActivos('tarea','idTarea');
         $datos['agentesDisponibles'] = $this->model->getAgentesDisponibles('agentes');
         $datos['otActivas'] = $this->model->getActivos('ordendetrabajo','idOT');
         $datos['userLogueado'] = $_SESSION['user'];
        
        //tabla de eventos en home
        $todosEventos = $this->model->get();
        $datos['todosEventos']=$todosEventos;

        //tabla tareas sin asignar en home
        $tareasSinAsignar = $this->model->getTareasSinAsignar();
        $datos['tareasSinAsignar'] = $tareasSinAsignar;
        
        
        return view ('index.home',compact('datos'));
        }
    }

    public function login()
    {
        return view('index');
    }

    public function cerrarSesion(){
        session_unset();
        session_destroy();
        redirect('');
    }



}
