<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\AgenteModel;
use App\Models\EspecializacionModel;
use App\Models\PersonaModel;
use Exception;

define("table", "agentes");

class AgenteController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new AgenteModel();
        $this->especializacionModel = new EspecializacionModel();
        $this->personaModel = new PersonaModel();
        session_start();
    }

    public function index()
    {
        $datos['todasEspecializaciones'] = $this->especializacionModel->getFichaAll(tableEspecializaciones);
        $datos['todasPersonas'] = $this->personaModel->getFichaAll(tablePersonas);
        $_SESSION['urlHeader'] = array(
                                        array("url" => "/home",
                                             "nombre" => "HOME"),
                                        array("url" => "/administracion",
                                             "nombre" => "ADMINISTRACION"),
                                        array("url" => "/agentes",
                                            "nombre" => "AGENTES")
                                            );
        $datos['datosSesion'] = $_SESSION;
        return view('/administracion/AgentesView', compact('datos'));
    }
    
    public function create()
    {
        try {
            $this->model->startTransaction();
            $agente = [
                'idPersona' => $_POST['idPersona']
            ];
            $insert = $this->model->insert(table, $agente, "Agente");
            foreach ($_POST['idEspecializacion'] as $key => $value) {
                $ExA = [
                    'idEspecializacion' => $value,
                    'idAgente' => $insert['mensaje']
                ];
                $this->model->insert(tableExA, $ExA, "ExA");
            }
            $this->model->commit();
            return json_encode($insert);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Agente',
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
            $this->model->delete(tableExA, array('idAgente' => $_POST['id']), "ExA");
            foreach ($_POST['idEspecializacion'] as $key => $value) {
                $ExA = [
                'idEspecializacion' => $value,
                'idAgente' => $_POST['id']
            ];
                $insert = $this->model->insert(tableExA, $ExA, "ExA");
            }
            $update = $insert;
            $update['tipo'] = 'Agente';
            $update['operacion'] = 'update';
            $this->model->commit();
            return json_encode($update);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                    "tipo" => 'Agente',
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
            $this->model->delete(tableExA, array('idAgente' => $_POST['id']), "ExA");
            $delete = $this->model->delete(table, array('id' => $_POST['id']), "Agente");
            $this->model->commit();
            return json_encode($delete);
        } catch (Exception $e) {
            $this->model->rollback();
            $error = array(
                "tipo" => 'Agente',
                "operacion" => "delete",
                "estado" => false,
                "mensaje" => $e->getMessage());
            return json_encode($error);
        }
    }
}
