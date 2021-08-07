<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\InformeModel;
use App\Models\PedidoModel;

class InformesController extends Controller
{
    public function __construct()
    {
        $this->model = new InformeModel();
        $this->modelPedido = new PedidoModel();
        session_start();
    }

    public function index()
    {
        $_SESSION['urlHeader'] = array(
            array("url" => "/home",
            "nombre" => "HOME"),
            array("url" => "/informes",
            "nombre" => "INFORMES")
        );
        $datos['datosSesion'] = $_SESSION;
        return view('/informes/InformesView', compact('datos'));
    }

    public function readFiltros()
    {
        $what = $this->modelPedido->getFichaAll(tablePedidos, $_POST['start'], $_POST['end']);
        return json_encode($what);
    }
}
