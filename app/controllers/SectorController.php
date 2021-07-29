<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\SectorModel;
use Exception;

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
        try {
            $this->model->startTransaction();
            $sector = [
                'nombre' => $_POST['nombre'],
                'responsable' => $_POST['responsable'],
                'telefono' => $_POST['telefono'],
                'email' => $_POST['email'],
                'idTipoSector' => $_POST['idTipoSector']
            ];
            $insert = $this->model->insert(table, $sector, "Sector");
            $this->model->commit();
            return json_encode($insert);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Sector',
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
            $sector = [
                'nombre' => $_POST['nombre'],
                'responsable' => $_POST['responsable'],
                'telefono' => $_POST['telefono'],
                'email' => $_POST['email'],
                'idTipoSector' => $_POST['idTipoSector']
            ];
            $update = $this->model->update(table, $sector, array('id' => $_POST['id']), "Sector");
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Sector',
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
            $delete = $this->model->delete(table, array('id' => $_POST['id']), "Sector");
            $this->model->commit();
            return json_encode($delete);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                "tipo" => 'Sector',
                "operacion" => "delete",
                "estado" => false,
                "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }
}
