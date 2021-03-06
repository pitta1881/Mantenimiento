<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\OrdenDeTrabajo;

class OTController extends Controller{

    public function __construct(){
        $this->model = new OrdenDeTrabajo();
        session_start();
    }

    public function index(){
        $todasOT = $this->model->get(); 
        $datos['todasOT'] = $todasOT;
        $datos["userLogueado"] = $_SESSION['user'];
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
        return view('/ordendetrabajo/OTVerTodos', compact('datos'));
    }

    public function verTareasSinAsignar(){
        $tareasSinAsignar = $this->model->verTareasSinAsignar();
        $datos['tareasSinAsignar'] = $tareasSinAsignar;
        $datos["userLogueado"] = $_SESSION['user'];
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
        return view('/ordendetrabajo/OTTareasSinAsignar',compact('datos'));
    }

    public function crearOT(){
        $idOTCreada = $this->model->newOT();
        $i = 0;
        foreach ($_POST as $idPedido => $idTarea) {
            $idPedidoFinal = explode('_',$idPedido)[1];
            $itemOT = [
                'idOT' => $idOTCreada,
                'idPedido' => $idPedidoFinal,
                'idTarea' => $idTarea
            ];
            $this->model->insertItemOT($itemOT);
            $this->model->updateEstadoTarea($idPedidoFinal,$idTarea,'En Curso');
            $datosItem[$i++] = $itemOT;
        }
        redirect('fichaOT?idOT='.$idOTCreada);
    }

    public function ficha(){
        $miOT = $this->model->getByIdOT($_GET['idOT']);
        $datos["miOT"] = $miOT;  
        $datos["userLogueado"] = $_SESSION['user'];
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
        return view('/ordendetrabajo/otVerFicha', compact('datos'));
    }

}
