<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\InsumoModel;

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
        $datos["todasMedidas"] = $this->model->getFichaAll(tableMedidas);
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
        $insumo = [
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'],
            'stockReal' => $_POST['stock'],
            'stockMinimo' => $_POST['stockMinimo'],
            'idMedida' => $_POST['idMedida']
        ];
        $insert = $this->model->insert(table, $insumo, "Insumo");
        return json_encode($insert);
    }

    public function update()
    {
        $insumo = [
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'],
            'stockMinimo' => $_POST['stockMinimo'],
            'idMedida' => $_POST['idMedida']
        ];
        $update = $this->model->update(table, $insumo, array('id' => $_POST['id']), "Insumo");
        return json_encode($update);
    }

    public function delete()
    {
        $delete = $this->model->delete(table, array('id' => $_POST['id']), "Insumo");
        return json_encode($delete);
    }
}
