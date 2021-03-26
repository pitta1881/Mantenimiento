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
    }

    public function update()
    {
    }

    public function delete()
    {
    }
}
