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
        $idEspecializacion = $this->model->getIdEspecializacionPorNombre($_POST['especializacion']);
        $tarea = [
            'idTarea' =>$idTareaSiguiente,
            'idPedido' =>$_POST['idPedido'],
            'estado' => $_POST['estado'],
            'descripcion' => $_POST['descripcion'],
            'prioridad' => $_POST['prioridad'],
            'idEspecializacion' => $idEspecializacion
        ];
        $this->model->insert($tarea);
        redirect("pedido/verTareas?idPedido=".$tarea['idPedido']);
    }

    public function eliminar(){
        $this->model->delete($_POST['idPedido'],$_POST['idTarea']);
        redirect("pedido/verTareas?idPedido=".$_POST['idPedido']);
    }

    public function modificarTareaSeleccionada(){
        $unaTarea = $this->model->getByIdPedidoIdTarea($_GET['idPedido'],$_GET['idTarea']);
        $datos["prioridades"] = $this->model->getPrioridades();
        $datos["estados"] = $this->model->getEstados();
        $datos["especializaciones"] = $this->model->getEspecializaciones();
        $datos["unaTarea"] = $unaTarea;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/tareas/tareaModificar',compact('datos'));
    }

    public function modificar(){
        $idTarea = $_POST['idTarea'];
        $idPedido = $_POST['idPedido'];
        $idEspecializacion = $this->model->getIdEspecializacionPorNombre($_POST['especializacion']);
        $tarea = [
            'descripcion' => $_POST['descripcion'],
            'prioridad' => $_POST['prioridad'],
            'idEspecializacion' => $idEspecializacion
        ];
        $this->model->update($tarea,$idTarea,$idPedido);
        redirect("fichaPedido?id=".$idPedido);
     }

     public function verAgentesDisponibles(){
        $agentesDisponibles = $this->model->verAgentesDisponibles();
        $datos['idPedido'] = $_GET['idPedido'];
        $datos['idTarea'] = $_GET['idTarea'];
        $datos['agentesDisponibles'] = $agentesDisponibles;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/tareas/tareasAgentesDisponibles',compact('datos'));
    }

    public function asignarAgentes(){
        /*
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
            $this->model->cambiarEstadoTarea($idPedidoFinal,$idTarea);
            $datosItem[$i++] = $itemOT;
        }
        $datos['itemOT'] = $datosItem;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/ordendetrabajo/OTverItem',compact('datos'));
        */
    }

}
