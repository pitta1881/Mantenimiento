<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\SectorModel;

define("table", "sectores");

class SectorController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new SectorModel();
        session_start();
    }
    
    public function index($alerta = null)
    {
        $datos['todosTiposSectores'] = $this->model->getFichaAllModel(tableTiposSector);
        $_SESSION['urlHeader'] = array(
            array("url" => "/home",
            "nombre" => "HOME"),
            array("url" => "/administracion",
            "nombre" => "ADMINISTRACION"),
            array("url" => "/sectores",
            "nombre" => "SECTORES")
        );
        $datos['datosSesion'] = $_SESSION;
        return view('/administracion/SectoresView', compact('datos'));
    }
    
    public function create()
    {
        $sector = [
            'nombre' => $_POST['nombre'],
            'responsable' => $_POST['responsable'],
            'telefono' => $_POST['telefono'],
            'email' => $_POST['email'],
            'idTipoSector' => $_POST['idTipoSector']
        ];
        $insert = $this->model->insert(table, $sector, "Sector");
        return json_encode($insert);
    }

    public function update()
    {
        $sector = [
            'nombre' => $_POST['nombre'],
            'responsable' => $_POST['responsable'],
            'telefono' => $_POST['telefono'],
            'email' => $_POST['email'],
            'idTipoSector' => $_POST['idTipoSector']
        ];
        $update = $this->model->update(table, $sector, array('id' => $_POST['id']), "Sector");
        return json_encode($update);
    }

    public function delete()
    {
        $delete = $this->model->delete(table, array('id' => $_POST['id']), "Sector");
        return json_encode($delete);
    }
}
