<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Pedido;
use App\Models\Tarea;

class PedidoController extends Controller{
    public function __construct(){
        $this->model = new Pedido();
    }

    /*Show all pedidos*/
    public function index(){
        $todosPedidos = $this->model->get();
        return view('verTodosPedidos', compact('todosPedidos'));
    }

    /*muestra un solo pedido especifico ingresado por GET*/
    public function ficha(){
        $unPedido = $this->model->getByIdPedido($_GET['id']);
        $miPedido = $unPedido[0];        //hago esto xq nose como es q toma que necesito solo el 1er elemento del array
        $tareas = $this->model->getTareasByIdPedido($_GET['id']); //todavia no está esto
        $datosPedidoTareas["miPedido"] = $miPedido;        
        $datosPedidoTareas["tareas"] = $tareas;
        return view('verUnPedido', compact('datosPedidoTareas'));
    }

    public function create()
    {
       $arrayDatos["diaHoy"] = date("Y-m-d");
       $arrayDatos["sectores"] = $this->model->getSectores();
       $arrayDatos["prioridades"] = $this->model->getPrioridades();
       $arrayDatos["estados"] = $this->model->getEstados();
       return view('crearPedido',compact('arrayDatos'));
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
      $arrayPedido = $this->save();
      return view('verPedidoCreado',compact('arrayPedido'));
    }

    public function save()
    {
        $pedido = [
            'fechaInicio' => $_POST['fechaInicio'],
            'estado' => $_POST['estado'],
            'descripcion' => $_POST['descripcion'],
            'sector' => preg_replace('/\s+/', '_', $_POST['sector']),
            'prioridad' => $_POST['prioridad']
        ];
        $this->model->insert($pedido);
        return $pedido;
    }

    public function modificarPedidoListado(){
        $todosPedidos = $this->model->get();
        return view('verTodosPedidosParaModificar', compact('todosPedidos'));
    }

    public function modificarPedidoSeleccionado(){
        $unPedido = $this->model->getByIdPedido($_GET['id']);
        $miPedido = $unPedido[0]; 
        $arrayDatos["sectores"] = $this->model->getSectores();
        $arrayDatos["prioridades"] = $this->model->getPrioridades();
        $arrayDatos["estados"] = $this->model->getEstados();
        $arrayDatos["miPedido"] = $miPedido;
        return view('modificarPedido',compact('arrayDatos'));
    }

    public function verTareas(){
    $todasTareas = $this->model->getTareasByIdPedido($_GET['id']);
    $datos['todasTareas'] = $todasTareas;
    $datos['idPedido'] = $_GET['id'];
    $datos["prioridades"] = $this->model->getPrioridades();
    $datos["estados"] = $this->model->getEstados();
    $datos['especialidades'] = $this->model->getTareaEspecialidades();
    return view('verTodasTareas', compact('datos'));
    }

    public function modificar(){
       $arrayPedido = $this->saveModificar();
       return view('verPedidoCreado',compact('arrayPedido'));
     }

     public function saveModificar()
     {
        $idPedido = $_POST['id'];
         $pedido = [
             'fechaInicio' => $_POST['fechaInicio'],
             'estado' => $_POST['estado'],
             'descripcion' => $_POST['descripcion'],
             'sector' => preg_replace('/\s+/', '_', $_POST['sector']),
             'prioridad' => $_POST['prioridad']
         ];
         $this->model->update($pedido,$idPedido);
         return $pedido;
     }
    
    
       public function buscarPor(){
        $filter = $_POST['filtro'];
        $value = $_POST['textBusqueda'];
        $todosPedidos = $this->model->getAllbyFilter($filter,$value);
           
        return view('verTodosPedidos', compact('todosPedidos'));
         
     }
}
