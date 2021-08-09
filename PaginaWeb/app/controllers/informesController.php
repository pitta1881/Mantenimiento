<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\InformeModel;
use App\Models\OCModel;
use App\Models\OTModel;
use App\Models\PedidoModel;

class InformesController extends Controller
{
    public function __construct()
    {
        $this->model = new InformeModel();
        $this->modelPedido = new PedidoModel();
        $this->modelOT = new OTModel();
        $this->modelOC = new OCModel();
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
        $fin = $_POST['end'].' 23:59:59';
        switch ($_POST['dataset']) {
            case 'pedido':
            case 'sector':
            case 'especializacion':
                $what = $this->modelPedido->getFichaAll(tablePedidos, $_POST['start'], $fin);
                break;
            case 'ot':
                $what = $this->modelOT->getFichaAll(tableOT, $_POST['start'], $fin);
                break;
            case 'oc':
                $what = $this->modelOC->getFichaAll(tableOC, $_POST['start'], $fin);
                break;
            default:
                # code...
                break;
        }
        return json_encode($what);
    }
}
