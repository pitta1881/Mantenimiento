<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\SectorModel;

define("table", "sectores");
define("tablePedido", "pedidos");
define("tableTiposSector", "tipossector");

class SectorController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new SectorModel();
        session_start();
    }
    
    public function index($alerta = null)
    {
        $comparaTablasIfUsado = array(
                                        array(  "tabla" => tablePedido,
                                            "comparaKeyOrig" => "id",
                                            "comparaKeyDest" => "idSector"
                                    )
        );
        $datos['todosSectores'] = $this->model->getFichaAll(table, $comparaTablasIfUsado);
        $datos['todosTiposSectores'] = $this->model->getFichaAll(tableTiposSector);
        $datos['alertas'] = $alerta;
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
        return $this->index($insert);
    }

    public function update()
    {
        $sector = [
            'id' => $_POST['id'],
            'nombre' => $_POST['nombre'],
            'responsable' => $_POST['responsable'],
            'telefono' => $_POST['telefono'],
            'email' => $_POST['email'],
            'idTipoSector' => $_POST['idTipoSector']
        ];
        $update = $this->model->update(table, $sector, "Sector");
        return $this->index($update);
    }

    public function delete()
    {
        $sector['id'] = $_POST['id'];
        $delete = $this->model->delete(table, $sector, "Sector");
        return $this->index($delete);
    }
}
