<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Pedido;
use App\Models\Tarea;

class PedidoController extends Controller{

    public function __construct(){
        $this->model = new Pedido();
        session_start();
    }

    /*Show all pedidos*/
    public function index(){
        $todosPedidos = $this->model->get();      
        $datos['todosPedidos'] = $todosPedidos;
        $datos["diaHoy"] = date("Y-m-d");
       $datos["sectores"] = $this->model->getSectores();
       $datos["prioridades"] = $this->model->getPrioridades();
       $datos["estados"] = $this->model->getEstados();
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/pedidos/pedidosVerTodos', compact('datos'));
    }

    /*muestra un solo pedido especifico ingresado por GET*/
    public function ficha(){
        $miPedido = $this->model->getByIdPedido($_GET['id']);
        $todasTareas = $this->model->getTareasByIdPedido($_GET['id']);
        $datos["miPedido"] = $miPedido;  
        $datos["prioridades"] = $this->model->getPrioridades();
        $datos["estados"] = $this->model->getEstados();
        $datos['especializaciones'] = $this->model->getTareaEspecializaciones();
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/pedidos/pedidoVerFicha', compact('datos'));
    }

    public function guardar(){
        $idSector = $this->model->getIdSectorPorNombre($_POST['sector']);
        $datos['idSector']= $idSector;
        $pedido = [
            'fechaInicio' => $_POST['fechaInicio'],
            'estado' => $_POST['estado'],
            'descripcion' => $_POST['descripcion'],
            'idSector' => $idSector,
            'prioridad' => $_POST['prioridad'],
            'nombreUsuario' => $_POST['nombreUsuario']
        ];
        $this->model->insert($pedido);
      $datos['arrayPedido'] = $pedido;
      $datos["userLogueado"] = $_SESSION['user'];
      $idNuevoPedido = $this->model->getIdUltimoPedido();
      var_dump($idNuevoPedido);
      redirect("fichaPedido?id=".$idNuevoPedido);
    }

    public function modificarPedidoSeleccionado(){
        $unPedido = $this->model->getByIdPedido($_GET['id']);
        $unPedido['fechaInicio'] = date("Y-d-m",strtotime($unPedido['fechaInicio']));
        $datos["sectores"] = $this->model->getSectores();
        $datos["prioridades"] = $this->model->getPrioridades();
        $datos["estados"] = $this->model->getEstados();
        $datos["miPedido"] = $unPedido;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/pedidos/pedidoModificar',compact('datos'));
    }
       

    public function verTareas(){
    $todasTareas = $this->model->getTareasByIdPedido($_GET['idPedido']);
    $datos['todasTareas'] = $todasTareas;
    $datos['idPedido'] = $_GET['idPedido'];
    $datos["prioridades"] = $this->model->getPrioridades();
    $datos["estados"] = $this->model->getEstados();
    $datos['especializaciones'] = $this->model->getTareaEspecializaciones();
    $datos["userLogueado"] = $_SESSION['user'];
    return view('/tareas/tareasVerTodas', compact('datos'));
    }

    public function modificar(){
        $idPedido = $_POST['id'];
        $idSector = $this->model->getIdSectorPorNombre($_POST['sector']);
        $datos['idSector']= $idSector;
         $arrayPedido = [
             'fechaInicio' => $_POST['fechaInicio'],
             'estado' => $_POST['estado'],
             'descripcion' => $_POST['descripcion'],
             'idSector' => $idSector,
             'prioridad' => $_POST['prioridad'],
         ];
         $this->model->updatePedido($arrayPedido,$idPedido);
         redirect("fichaPedido?id=".$idPedido);
     }
    
    public function buscarPor(){
        $filter = $_POST['filtro'];
        $value = $_POST['textBusqueda'];
        $datos['todosPedidos'] = $this->model->getAllbyFilter($filter,$value);
        $datos['userLogueado'] = $_SESSION['user'];           
        return view('/pedidos/pedidosVerTodos', compact('datos'));         
     }
}
