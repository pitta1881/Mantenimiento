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
        $this->model->updateEstadoPedido($_POST['idPedido'],'En Curso');
        //guardar estado historial
        $fechaHoy = date("Y-m-d H:i:s");
        $historia = [
            'idPedido' => $_POST['idPedido'],
            'idTarea' => $idTareaSiguiente,
            'idHistorial' => 1,
            'fecha' => $fechaHoy,
            'estado' => $_POST['estado'],
            'descripcion' => 'Tarea Iniciada'
        ];
        $this->model->insertHistorialEstado($historia);
        redirect("fichaPedido?id=".$tarea['idPedido']);
    }

    public function modificarTareaSeleccionada(){
        $unaTarea = $this->model->getByIdPedidoIdTarea($_GET['idPedido'],$_GET['idTarea']);
        $datos["prioridades"] = $this->model->getPrioridades();
        $datos["estados"] = $this->model->getEstados();
        $datos["especializaciones"] = $this->model->getEspecializaciones();
        $datos["unaTarea"] = $unaTarea;
        $datos["userLogueado"] = $_SESSION['user'];
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
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
        redirect("fichaTarea?idPedido=".$idPedido."&idTarea=".$idTarea);
     }

     public function verAgentesDisponibles(){
         $urgente = false;
         $miTarea = $this->model->getByIdPedidoIdTarea($_GET['idPedido'],$_GET['idTarea']);
         if ($miTarea['prioridad'] == 'Urgente') {
             $urgente = true;
         }
        $agentesDisponibles = $this->model->verAgentesDisponibles($urgente);
        $datos["miTarea"] = $miTarea;
        $datos['agentesDisponibles'] = $agentesDisponibles;
        $datos["userLogueado"] = $_SESSION['user'];
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
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
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
        redirect("fichaTarea?idPedido=".$idPedidoFinal."&idTarea=".$idTareaFinal);
    }

        /*muestra un solo pedido especifico ingresado por GET*/
        public function ficha(){
            $miTarea = $this->model->getByIdPedidoIdTarea($_GET['idPedido'],$_GET['idTarea']);
            $datos["miTarea"] = $miTarea;  
            $datos["userLogueado"] = $_SESSION['user'];
            $permisos=$this->model->getPermisos($_SESSION['rol']);
            $datos['permisos']= $permisos;
            return view('/tareas/tareaVerFicha', compact('datos'));
        }

        public function desasignarAgente(){
            $this->model->desasignarAgente($_POST['idPedido'],$_POST['idTarea'],$_POST['idAgente']);
            redirect("fichaTarea?idPedido=".$_POST['idPedido']."&idTarea=".$_POST['idTarea']);
        }

        public function cambiarEstado(){
            $this->model->updateEstadoTarea($_POST['idPedido'],$_POST['idTarea'],$_POST['estado']);
            $fechaHoy = date("Y-m-d H:i:s");
            $idHistoria = $this->model->buscarNHistoriaSiguiente($_POST['idPedido'],$_POST['idTarea']);
            $historia = [
                'idPedido' => $_POST['idPedido'],
                'idTarea' => $_POST['idTarea'],
                'idHistorial' => $idHistoria,
                'fecha' => $fechaHoy,
                'estado' => $_POST['estado'],
                'descripcion' => $_POST['descripcion']
            ];
            $this->model->insertHistorialEstado($historia);
            if ($_POST['estado'] == "Finalizado") {
                $this->model->verificarFinOT($_POST['idOT']);
                $this->model->verificarFinPedido($_POST['idPedido']);
                $this->model->desocuparAgentes($_POST['idPedido'],$_POST['idTarea']);
            }            
            header("location: ".$_SERVER['HTTP_REFERER'] ." "); //esto me vuelve a la pagina de donde hice el cambio, maravilloso
        }

        public function verHistorial(){
            $historial = $this->model->verHistorial($_GET['idPedido'],$_GET['idTarea']);
            $datos['historial'] = $historial;
            $datos["userLogueado"] = $_SESSION['user'];
            $permisos=$this->model->getPermisos($_SESSION['rol']);
            $datos['permisos']= $permisos;
            return view('/tareas/verHistorial',compact('datos'));
        }

}