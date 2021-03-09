<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\AgenteModel;

define("table", "agentes");

class AgenteController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new AgenteModel();
        session_start();
    }

    public function index()
    {
        $datos['todasPersonas'] = $this->model->getFichaAll(tablePersonas);
        $datos['todasEspecializaciones'] = $this->model->getFichaAll(tableEspecializaciones);
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
        $agente = [
            'idPersona' => $_POST['idPersona']
        ];
        $insert = $this->model->insert(table, $agente, "Agente");
        if ($insert) { //si falla la insercion(seguramente x nick repetido)
            foreach ($_POST['idEspecializacion'] as $key => $value) {
                $ExA = [
                    'idEspecializacion' => $value,
                    'idAgente' => $insert['mensaje']
                ];
                $this->model->insert(tableExA, $ExA, "ExA");
            }
        }
        echo json_encode($insert);
    }

    public function update()
    {
        $agente['idAgente'] = $_POST['id'];
        $this->model->delete(tableExA, $agente, "ExA");
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
        echo json_encode($update);
    }

    public function delete()
    {
        $agenteExA['idAgente'] = $_POST['id'];
        $agente['id'] = $_POST['id'];
        $this->model->delete(tableExA, $agenteExA, "ExA");
        $delete = $this->model->delete(table, $agente, "Agente");
        echo json_encode($delete);
    }
}
