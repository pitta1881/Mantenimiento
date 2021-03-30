<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\OCModel;

define("table", "ordenesdecompra");

class OCController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new OCModel();
        session_start();
    }

    public function index()
    {
        $datos["todosEstadosOC"] = $this->model->getFichaAll(tableEstadosOC);
        $datos["todosTiposOC"] = $this->model->getFichaAll(tableTiposOC);
        
        $_SESSION['urlHeader'] = array(
            array("url" => "/home",
                 "nombre" => "HOME"),
            array("url" => "/ordendecompra",
                "nombre" => "ORDEN DE COMPRA")
                );
        $datos['datosSesion'] = $_SESSION;
        return view('/ordendecompra/OrdenDeCompraView', compact('datos'));
    }

    public function create()
    {
        $ahora = date('Y-m-d H:i:s');
        $ordenDeCompra = [
            'fecha' => $ahora,
            'costoEstimado' => $_POST['costoEstimado'],
            'idEstadoOC' => 1,
            'idTipoOrdenDeCompra' => $_POST['idTiposOC'],
            'idUsuario' => $_SESSION['idUser']
        ];
        $insert = $this->model->insert(table, $ordenDeCompra, "Orden De Compra");
        $insumos = json_decode($_POST['insumos'], true);
        foreach ($insumos as $insumo) {
            $IxOC = [
                'idInsumo' => $insumo['id'],
                'idOC' => $insert['mensaje'],
                'cantidadPedida' => $insumo['cantidad']
            ];
            $this->model->insert(tableIxOC, $IxOC, "IxOC");
            $insumo = [
                'id' => $insumo['id'],
                'stockFuturo' => $insumo['cantidad']
            ];
            $update = $this->model->update(tableInsumos, $insumo, "Insumo");
        }
        return json_encode($insert);
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
