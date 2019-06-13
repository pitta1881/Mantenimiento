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
        //redirect("pedido/verTareas?idPedido=".$tarea['idPedido']);
        redirect("fichaPedido?id=".$tarea['idPedido']);
    }

    public function eliminar(){
        $arrayAgentes = $this->model->getAgentesByIdId($_POST['idPedido'],$_POST['idTarea']);
        foreach ($arrayAgentes as $key => $value) {
            $this->model->desasignarAgente($_POST['idPedido'],$_POST['idTarea'],$arrayAgentes[$key]['idAgente']);
        }
        $this->model->delete($_POST['idPedido'],$_POST['idTarea']);
        redirect("fichaPedido?id=".$_POST['idPedido']);
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
        $i = 0;
        foreach ($_POST as $idPedido => $idTarea_Agente) {
            $idPedidoFinal = explode('_',$idPedido)[1];
            $idTareaFinal = explode('_',$idTarea_Agente)[0];
            $idAgenteFinal = explode('_',$idTarea_Agente)[1];
            $itemAgente = [
                'idPedido' => $idPedidoFinal,
                'idTarea' => $idTareaFinal,
                'idAgente' => $idAgenteFinal
            ];
            $this->model->insertItemAgente($itemAgente);
            $this->model->cambiarEstadoAgente($idAgenteFinal,0);
            $datosItem[$i++] = $itemAgente;
        }
        $datos['itemAgente'] = $datosItem;
        $datos["userLogueado"] = $_SESSION['user'];
        redirect("fichaTarea?idPedido=".$idPedidoFinal."&idTarea=".$idTareaFinal);
    }

        /*muestra un solo pedido especifico ingresado por GET*/
        public function ficha(){
            $miTarea = $this->model->getByIdPedidoIdTarea($_GET['idPedido'],$_GET['idTarea']);
            $datos["miTarea"] = $miTarea;  
            $datos["userLogueado"] = $_SESSION['user'];
            return view('/tareas/tareaVerFicha', compact('datos'));
        }

        public function desasignarAgente(){
            $this->model->desasignarAgente($_POST['idPedido'],$_POST['idTarea'],$_POST['idAgente']);
            $this->model->cambiarEstadoAgente($_POST['idAgente'],1);
            redirect("fichaTarea?idPedido=".$_POST['idPedido']."&idTarea=".$_POST['idTarea']);
        }

}