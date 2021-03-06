<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\OCModel;
use App\Models\InsumoModel;
use Exception;

define("table", "ordenesdecompra");

class OCController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new OCModel();
        $this->insumoModel = new InsumoModel();
        session_start();
    }

    public function index()
    {
        $datos["todosEstadosOC"] = $this->model->getFichaAllModel(tableEstadosOC);
        $datos["todosTiposOC"] = $this->model->getFichaAllModel(tableTiposOC);
        
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
        try {
            $this->model->startTransaction();
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
                    $insumoToUpdate = [
                            'stockFuturo' => $insumo['cantidad']
                        ];
                    $this->model->update(tableInsumos, $insumoToUpdate, array('id' => $insumo['id']), "Insumo");
                }
            }
            $this->model->commit();
            return json_encode($insert);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Orden De Compra',
                    "operacion" => "insert",
                    "estado" => false,
                    "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }

    public function update()
    {
        try {
            $this->model->startTransaction();
            $ordenDeCompra = [
                'idTipoOrdenDeCompra' => $_POST['idTiposOC']
            ];
            $update = $this->model->update(table, $ordenDeCompra, array('id' => $_POST['idOC']), "Orden de Compra");
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Orden De Compra',
                    "operacion" => "update",
                    "estado" => false,
                    "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }

    public function updateCostoFinal()
    {
        try {
            $this->model->startTransaction();
            $ordenDeCompra = [
                'costoFinal' => $_POST['costoFinal']
            ];
            $update = $this->model->update(table, $ordenDeCompra, array('id' => $_POST['idOC']), "Orden de Compra");
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Orden De Compra',
                    "operacion" => "update",
                    "estado" => false,
                    "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }

    public function delete()
    {
    }

    public function updateInsumos()
    {
        try {
            $this->model->startTransaction();
            $ahora = date('Y-m-d H:i:s');
            //update cantidad recibida en item IxOC
            $insumos = json_decode($_POST['insumos'], true);
            foreach ($insumos as $insumo) {
                $insumoRelacionado = $this->getInsumo($insumo['id']);
                $IxOC = [
                    'cantidadRecibida' => $insumo['cantidad'],
                    'idEstado' => $insumo['idEstado']
                ];
                $update = $this->model->update(tableIxOC, $IxOC, array('idInsumo' => $insumo['id'],
                                                                    'idOC' => $_POST['idOC']), "IxOC");
                //update +stockReal y -stockFuturo del Insumo
                $cantidadRecibidaAhora = $insumo['cantidad'] - $insumo['cantidadInicial'];
                $insumoToUpdate = [
                    'stockReal' => $insumoRelacionado['stockReal'] + $cantidadRecibidaAhora,
                    'stockFuturo' => $insumoRelacionado['stockFuturo'] - $cantidadRecibidaAhora
                ];
                $update = $this->model->update(tableInsumos, $insumoToUpdate, array('id' => $insumo['id']), "Insumo");
                //create item historialInsumo
                $historialInsumo = [
                    'id' => $this->getIdHistorial($insumo['id']),
                    'idInsumo' => $insumo['id'],
                    'fecha' => $ahora,
                    'idUsuario' => $_SESSION['idUser'],
                    'oldStock' => $insumoRelacionado['stockReal'],
                    'newStock' => $insumoRelacionado['stockReal'] + $cantidadRecibidaAhora,
                    'inOrOut' => 1,
                    'idOC' => $_POST['idOC']
                ];
                $this->model->insert(tableHistorialInsumo, $historialInsumo, "historialInsumo");
            }
            //update estado de la Orden de Compra
            $ordenDeCompra = [
                'idEstadoOC' => ($this->checkOCCompleto($_POST['idOC']) ? 3 : 2)
            ];
            $this->model->update(table, $ordenDeCompra, array('id' => $_POST['idOC']), "Orden De Compra");
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                "tipo" => 'Insumo',
                "operacion" => "update",
                "estado" => false,
                "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }

    public function cancelInsumo()
    {
        try {
            $this->model->startTransaction();
            //update item IxOC cantRecibida == 0 ? Cancelado(4) : Parcial Completo(5)
            $insumoRelacionado = $this->getInsumo($_POST['idInsumo']);
            $IxOC = [
                'idEstado' => $_POST['idEstado'] //4 o 5
            ];
            $update = $this->model->update(tableIxOC, $IxOC, array('idInsumo' => $_POST['idInsumo'],
                                                                'idOC' => $_POST['idOC']), "IxOC");
            //update solo -stockFuturo del Insumo
            $insumoToUpdate = [
                'stockFuturo' => $insumoRelacionado['stockFuturo'] - $_POST['cantidadFaltanteCancelada']
            ];
            $update = $this->model->update(tableInsumos, $insumoToUpdate, array('id' => $_POST['idInsumo']), "Insumo");
            //update estado de la Orden de Compra
            $estadoOC = ($this->checkOCCancelada($_POST['idOC']) ? 4 : ($this->checkOCCompleto($_POST['idOC']) ? 3 : 2));
            $ordenDeCompra = [
                'idEstadoOC' => $estadoOC
            ];
            $this->model->update(table, $ordenDeCompra, array('id' => $_POST['idOC']), "Orden De Compra");
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Insumo',
                    "operacion" => "update",
                    "estado" => false,
                    "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }

    private function getInsumo($idInsumo)
    {
        return $this->insumoModel->getFichaOne(tableInsumos, array('id'=>$idInsumo));
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

    private function checkOCCancelada($idOC)
    {
        $oc = $this->model->getFichaOne(table, array('id'=>$idOC));
        foreach ($oc['insumos'] as $insumo) {
            if ($insumo['idEstado'] != 4) {
                return false;
            };
        }
        return true;
    }

    private function getIdHistorial($idInsumo)
    {
        $datos['unInsumo'] = $this->insumoModel->getFichaOne(tableInsumos, array('id'=>$idInsumo));
        return (empty($datos['unInsumo']['historial']) ? 1 : end($datos['unInsumo']['historial'])['id'] + 1);
    }
}
