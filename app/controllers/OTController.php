<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\OrdenDeTrabajo;

class OTController extends Controller{

    public function __construct(){
        $this->model = new OrdenDeTrabajo();
        session_start();
    }

    /*Show all pedidos*/
    public function index(){
        $todasOT = $this->model->get();        
        $datos['todasOT'] = $todasOT;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('OTVerTodos', compact('datos'));
    }

    public function verTareasSinAsignar(){
        $tareasSinAsignar = $this->model->verTareasSinAsignar();
        $datos['tareasSinAsignar'] = $tareasSinAsignar;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('OTTareasSinAsignar',compact('datos'));
    }

}
