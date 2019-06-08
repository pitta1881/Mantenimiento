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

    public function crearOT(){
        $idOTCreada = $this->model->newOT();
        $i = 0;
        var_dump($_POST);
        foreach ($_POST as $idPedido => $idTarea) {
            $itemOT = [
                'idOT' => $idOTCreada,
                'idPedido' => $idPedido,
                'idTarea' => $idTarea
            ];
            $this->model->insertItemOT($itemOT);
            $datosItem[$i++] = $itemOT;
        }
        $datos['itemOT'] = $datosItem;
        $datos["userLogueado"] = $_SESSION['user'];
        //cambiar estados tareas
        return view('OTverItem',compact('datos'));
    }

}
