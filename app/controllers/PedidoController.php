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
       if (!empty($_GET)) {
        $datos['idEvento']=$_GET['idEvento'];
       }       
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
      if(!empty($_POST['idEvento'])){
        var_dump($_POST['idEvento']);  
        $this->model->eliminarEvento($_POST['idEvento']);
      }
      $datos['arrayPedido'] = $pedido;
      $datos["userLogueado"] = $_SESSION['user'];
      $idNuevoPedido = $this->model->getIdUltimoPedido();
      redirect("fichaPedido?id=".$idNuevoPedido);
    }

    public function modificarPedidoSeleccionado(){
        $unPedido = $this->model->getByIdPedido($_GET['id']);
        $unPedido['fechaInicio'] = date("Y-m-d",strtotime(str_replace('/', '-', $unPedido['fechaInicio'])));
        $datos["sectores"] = $this->model->getSectores();
        $datos["prioridades"] = $this->model->getPrioridades();
        $datos["estados"] = $this->model->getEstados();
        $datos["miPedido"] = $unPedido;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/pedidos/pedidoModificar',compact('datos'));
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

     public function finalizar(){
         $this->model->updateEstadoPedido($_POST['id'],'Finalizado');
         redirect("fichaPedido?id=".$_POST['id']);
     }
}
