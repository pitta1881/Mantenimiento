<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Tarea;

class TareaController extends Controller{
    public function __construct(){
        $this->model = new Tarea();
        session_start();
    }

    public function guardar()
    {
        $idTareaSiguiente = $this->model->buscarNTareaSiguiente($_POST['idPedido']);
        $tarea = [
            'idTarea' =>$idTareaSiguiente,
            'idPedido' =>$_POST['idPedido'],
            'estado' => $_POST['estado'],
            'descripcion' => $_POST['descripcion'],
            'prioridad' => $_POST['prioridad'],
            'especializacion' => $_POST['especializacion']
        ];
        $this->model->insert($tarea);
        redirect("fichaPedido?id=".$tarea['idPedido']);
    }

    public function eliminar(){
        $this->model->delete($_GET['idPedido'],$_GET['idTarea']);
        redirect("pedido/verTareas?idPedido=".$_GET['idPedido']);
    }

    public function modificarTareaSeleccionada(){
        $unaTarea = $this->model->getByIdPedidoIdTarea($_GET['idPedido'],$_GET['idTarea']);
        $miTarea = $unaTarea[0]; 
        $datos["prioridades"] = $this->model->getPrioridades();
        $datos["estados"] = $this->model->getEstados();
        $datos["especializaciones"] = $this->model->getEspecializaciones();
        $datos["unaTarea"] = $miTarea;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('tareaModificar',compact('datos'));
    }

    public function modificar(){
        $idTarea = $_POST['idTarea'];
        $idPedido = $_POST['idPedido'];
        $tarea = [
            'estado' => $_POST['estado'],
            'descripcion' => $_POST['descripcion'],
            'prioridad' => $_POST['prioridad'],
            'especializacion' => $_POST['especializacion']
        ];
        $this->model->update($tarea,$idTarea,$idPedido);
        redirect("fichaPedido?id=".$idPedido);
     }
}
