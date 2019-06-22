<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Permisos;

class PermisosControler extends Controller{
    public function __construct(){
        $this->model = new Permisos();
    }

    /*Show all pedidos*/
    public function index(){
        if(isset($_GET["page"])){
            $pagina=$_GET["page"];
        }else{
            $pagina=1;
        }
        $todosPermisos= $this->model->getPaginacion($pagina); 
        $datos['todosPermisos'] = $todosPermisos;
        $totalPaginas=$this->model->getsize();
        $datos["totalPaginas"] =   $totalPaginas;
        return view('verTodosPedidos', compact('datos'));
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
            'estado' => preg_replace('/\s+/', '_', $_POST['estado']),
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

}
