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
        //crear Orden De Compra
        $ordenDeCompra = [
            'fecha' => $ahora,
            'costoEstimado' => $_POST['costoEstimado'],
            'idEstadoOC' => 1,
            'idTipoOrdenDeCompra' => $_POST['idTiposOC'],
            'idUsuario' => $_SESSION['idUser']
        ];
        $insert = $this->model->insert(table, $ordenDeCompra, "Orden De Compra");
        //crear items IxOC
        if ($insert) {
            $insumos = json_decode($_POST['insumos'], true);
            foreach ($insumos as $insumo) {
                $IxOC = [
                'idInsumo' => $insumo['id'],
                'idOC' => $insert['mensaje'],
                'cantidadPedida' => $insumo['cantidad'],
                'idEstado' => 1
            ];
                $insert2 = $this->model->insert(tableIxOC, $IxOC, "IxOC");
                //actualizo stockFuturo del insumos
                if ($insert2) {
                    $insumo = [
                        'id' => $insumo['id'],
                        'stockFuturo' => $insumo['cantidad']
                    ];
                    $update = $this->model->update(tableInsumos, $insumo, "Insumo");
                }
            }
        }
        return json_encode($insert);
    }

    public function update()
    {
    }

    public function delete()
    {
    }

    public function updateInsumos()
    {
        //update cantidad recibida en item IxOC
        $insumos = json_decode($_POST['insumos'], true);
        foreach ($insumos as $insumo) {
            $insumoRelacionado = $this->getInsumo($insumo['id']);
            $IxOC = [
                'idInsumo' => $insumo['id'],
                'idOC' => $_POST['idOC'],
                'cantidadRecibida' => $insumo['cantidad'],
                'idEstado' => $insumo['idEstado']
            ];
            $update = $this->model->update(tableIxOC, $IxOC, "IxOC");
            //update +stockReal y -stockFuturo del Insumo
            if ($update) {
                $cantidadRecibidaAhora = $insumo['cantidad'] - $insumo['cantidadInicial'];
                $insumo = [
                    'id' => $insumo['id'],
                    'stockReal' => $insumoRelacionado['stockReal'] + $cantidadRecibidaAhora,
                    'stockFuturo' => $insumoRelacionado['stockFuturo'] - $cantidadRecibidaAhora
                ];
                $update = $this->model->update(tableInsumos, $insumo, "Insumo");
            }
        }
        //update estado de la Orden de Compra
        $ordenDeCompra = [
            'id' => $_POST['idOC'],
            'idEstadoOC' => ($this->checkOCCompleto($_POST['idOC']) ? 3 : 2)
        ];
        $this->model->update(table, $ordenDeCompra, "Orden De Compra");
        return json_encode($update);
    }

    public function cancelInsumo()
    {
        //update item IxOC cantRecibida == 0 ? Cancelado(4) : Parcial Completo(5)
        $insumoRelacionado = $this->getInsumo($_POST['idInsumo']);
        $IxOC = [
                'idInsumo' => $_POST['idInsumo'],
                'idOC' => $_POST['idOC'],
                'idEstado' => $_POST['idEstado'] //4 o 5
            ];
        $update = $this->model->update(tableIxOC, $IxOC, "IxOC");
        //update solo -stockFuturo del Insumo
        if ($update) {
            $insumo = [
                    'id' => $_POST['idInsumo'],
                    'stockFuturo' => $insumoRelacionado['stockFuturo'] - $_POST['cantidadFaltanteCancelada']
                ];
            $update = $this->model->update(tableInsumos, $insumo, "Insumo");
        }
        //update estado de la Orden de Compra
        $ordenDeCompra = [
            'id' => $_POST['idOC'],
            'idEstadoOC' => ($this->checkOCCompleto($_POST['idOC']) ? 3 : 2)
        ];
        $this->model->update(table, $ordenDeCompra, "Orden De Compra");
        return json_encode($update);
    }

    private function getInsumo($idInsumo)
    {
        return $this->model->getFichaOne(tableInsumos, array('id'=>$idInsumo));
    }

    private function checkOCCompleto($idOC)
    {
        $oc = $this->model->getFichaOne(table, array('id'=>$idOC));
        foreach ($oc['insumos'] as $insumo) {
            if ($insumo['idEstado'] == 1 || $insumo['idEstado'] == 2) {
                return false;
            };
        }
        return true;
    }
}
