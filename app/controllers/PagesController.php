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
         $datos['cantidadPedidos'] = $this->model->getActivos('pedido','id');
         $datos['tareasSinAsignar'] = $this->model->getActivos('tarea','idTarea');
         $datos['agentesDisponibles'] = 'PROXIMAMENTE';
         $datos['otActivas'] = $this->model->getActivos('ordendetrabajo','idOT');
         $datos['userLogueado'] = $_SESSION['user'];
         return view ('index.home',compact('datos'));
    }

    /**
     * Show the about page.
     */
    public function about()
    {
        $company = 'Laracasts';

        return view('about', ['company' => $company]);
    }
    public function login()
    {
        $company = 'Laracasts';

        return view('index');
    }
}
