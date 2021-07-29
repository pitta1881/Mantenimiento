<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\InsumoModel;
use Exception;

define("table", "insumos");

class InsumoController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new InsumoModel();
        session_start();
    }

    
    public function index()
    {
        $datos["todasMedidas"] = $this->model->getFichaAllModel(tableMedidas);
        $_SESSION['urlHeader'] = array(
            array("url" => "/home",
                 "nombre" => "HOME"),
            array("url" => "/insumos",
                "nombre" => "INSUMOS")
                );
        $datos['datosSesion'] = $_SESSION;
        return view('/insumos/InsumosView', compact('datos'));
    }
    
    public function create()
    {
        try {
            $this->model->startTransaction();
            $insumo = [
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'],
            'stockReal' => $_POST['stock'],
            'stockMinimo' => $_POST['stockMinimo'],
            'idMedida' => $_POST['idMedida']
        ];
            $insert = $this->model->insert(table, $insumo, "Insumo");
            $this->model->commit();
            return json_encode($insert);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Insumo',
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
            $insumo = [
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'],
            'stockMinimo' => $_POST['stockMinimo'],
            'idMedida' => $_POST['idMedida']
        ];
            $update = $this->model->update(table, $insumo, array('id' => $_POST['id']), "Insumo");
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

    public function delete()
    {
        try {
            $this->model->startTransaction();
            $delete = $this->model->delete(table, array('id' => $_POST['id']), "Insumo");
            $this->model->commit();
            return json_encode($delete);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                "tipo" => 'Insumo',
                "operacion" => "delete",
                "estado" => false,
                "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }
}
