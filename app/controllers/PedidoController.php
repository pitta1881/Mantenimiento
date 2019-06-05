<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->model = new Pedido();
    }

    /*Show all pedidos*/
    public function index()
    {
        $todosPedidos = $this->model->get();
        return view('verTodosPedidos', compact('todosPedidos'));
    }

    /*muestra un solo pedido especifico ingresado por GET*/
    public function ficha()
    {
        $unPedido = $this->model->getByIdPedido($_GET['id']);
        $miPedido = $unPedido[0];        //hago esto xq nose como es q toma que necesito solo el 1er elemento del array
        $tareas = $this->model->getTareasByIdPedido($_GET['id']); //todavia no está esto
        $datosPedidoTareas["miPedido"] = $miPedido;        
        $datosPedidoTareas["tareas"] = $tareas;
        return view('verUnPedido', compact('datosPedidoTareas'));
    }

    public function create()
    {
       // $hairColors = $this->model->getHairColors();
       // $datos["colorPelo"] = $hairColors;

       //aca voy a hardcodear Sectores y Prioridad como para ver como quedaria
       //al dia de ultima lo podria dejar asi, hay q ver como lo guarda en la bdd
       $diaHoy = date("Y/m/d");
       $sectores = $this->model->getSectores();
       $prioridades = $this->model->getPrioridades();
       $estados = $this->model->getEstados();
       $arrayDatos["sectores"] = $sectores;
       $arrayDatos["diaHoy"] = $diaHoy;
       $arrayDatos["prioridades"] = $prioridades;
       $arrayDatos["estados"] = $estados;
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
            'sector' => $_POST['sector'],
            'prioridad' => $_POST['prioridad']
        ];
        $this->model->insert($pedido);
        return $pedido;
    }
}
