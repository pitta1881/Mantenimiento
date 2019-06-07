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
        foreach ($todosPedidos as $indice => $datos) {
            foreach ($datos as $key => $value) {
                if ($key == 'id') {
                    $todosPedidos[$indice]['tareasAsignadas'] = $this->model->getTareasAsignadasAPedido($value);
                }
            }
        }        
        $datos['todosPedidos'] = $todosPedidos;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('pedidosVerTodos', compact('datos'));
    }

    /*muestra un solo pedido especifico ingresado por GET*/
    public function ficha(){
        $unPedido = $this->model->getByIdPedido($_GET['id']);
        $miPedido = $unPedido[0];        //hago esto xq nose como es q toma que necesito solo el 1er elemento del array
        $tareas = $this->model->getTareasByIdPedido($_GET['id']); //todavia no está esto
        $datos["miPedido"] = $miPedido;        
        $datos["tareas"] = $tareas;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('pedidoVerFicha', compact('datos'));
    }

    public function create()
    {
       $datos["diaHoy"] = date("Y-m-d");
       $datos["sectores"] = $this->model->getSectores();
       $datos["prioridades"] = $this->model->getPrioridades();
       $datos["estados"] = $this->model->getEstados();
       $datos["userLogueado"] = $_SESSION['user'];
       return view('pedidoCrear',compact('datos'));
    }

    public function validar(){
       /*
       //ACA SE PODRIA VALIDAR ALGO MAS ADELANTE
       //
       $estaBien = $this->model->validarDatos($_POST);
       if ($estaBien) {
           $arrayTurno = $this->save();
           return view('verFormularioEnviado',compact('arrayTurno'));
       } else {
           echo "<h2>Algo salio Mal</h2>";
       }       
       */
      $datos['arrayPedido'] = $this->save();
      $datos["userLogueado"] = $_SESSION['user'];
      $idNuevoPedido = $this->model->getIdUltimoPedido();
      redirect("fichaPedido?id=".$idNuevoPedido);
    }

    public function save()
    {
        $pedido = [
            'fechaInicio' => $_POST['fechaInicio'],
            'estado' => $_POST['estado'],
            'descripcion' => $_POST['descripcion'],
            'sector' => preg_replace('/\s+/', '_', $_POST['sector']),
            'prioridad' => $_POST['prioridad'],
            'nombreUsuario' => $_POST['nombreUsuario']
        ];
        $this->model->insert($pedido);
        return $pedido;
    }

    public function modificarPedidoSeleccionado(){
        $unPedido = $this->model->getByIdPedido($_GET['id']);
        $miPedido = $unPedido[0]; 
        $datos["sectores"] = $this->model->getSectores();
        $datos["prioridades"] = $this->model->getPrioridades();
        $datos["estados"] = $this->model->getEstados();
        $datos["miPedido"] = $miPedido;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('pedidoModificar',compact('datos'));
    }

    public function verTareas(){
    $todasTareas = $this->model->getTareasByIdPedido($_GET['idPedido']);
    $datos['todasTareas'] = $todasTareas;
    $datos['idPedido'] = $_GET['idPedido'];
    $datos["prioridades"] = $this->model->getPrioridades();
    $datos["estados"] = $this->model->getEstados();
    $datos['especializaciones'] = $this->model->getTareaEspecializaciones();
    $datos["userLogueado"] = $_SESSION['user'];
    return view('tareasVerTodas', compact('datos'));
    }

    public function modificar(){
        $idPedido = $_POST['id'];
         $arrayPedido = [
             'fechaInicio' => $_POST['fechaInicio'],
             'estado' => $_POST['estado'],
             'descripcion' => $_POST['descripcion'],
             'sector' => preg_replace('/\s+/', '_', $_POST['sector']),
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
        return view('pedidosVerTodos', compact('datos'));
         
     }
}
