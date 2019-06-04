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
        $unPedido = $this->model->getByNumeroPedido($_GET['numeroPedido']);
        $miPedido = $unPedido[0];        //hago esto xq nose como es q toma que necesito solo el 1er elemento del array
        return view('verUnPedido', compact('miPedido'));
    }

    public function create()
    {
        $hairColors = $this->model->getHairColors();
        $horaTurnos = $this->model->getTurnos();
        $datos["colorPelo"] = $hairColors;
        $datos["horaTurnos"] = $horaTurnos;
        return view('formulario.create',compact('datos'));
    }

    public function validar(){
       $estaBien = $this->model->validarDatos($_POST);
       if ($estaBien) {
           $arrayTurno = $this->save();
           return view('verFormularioEnviado',compact('arrayTurno'));
       } else {
           echo "<h2>Algo salio Mal</h2>";
       }
       
    }

    public function save()
    {
        $turno = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'age' => $_POST['age'],
            'calzado' => $_POST['calzado'],
            'height' => $_POST['height'],
            'birth' => $_POST['birth'],
            'haircolor' => $_POST['haircolor'],
            'adate' => $_POST['adate'],
            'atime' => $_POST['atime']
        ];
        $this->model->insert($turno);
        return $turno;
    }
}
