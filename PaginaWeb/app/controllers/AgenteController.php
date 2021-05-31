<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\AgenteModel;
use App\Models\EspecializacionModel;
use App\Models\PersonaModel;

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
        $agente = [
            'idPersona' => $_POST['idPersona']
        ];
        $insert = $this->model->insert(table, $agente, "Agente");
        if ($insert['estado']) { //si falla la insercion(seguramente x nick repetido)
            foreach ($_POST['idEspecializacion'] as $key => $value) {
                $ExA = [
                    'idEspecializacion' => $value,
                    'idAgente' => $insert['mensaje']
                ];
                $this->model->insert(tableExA, $ExA, "ExA");
            }
        }
        return json_encode($insert);
    }

    public function update()
    {
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
        return json_encode($update);
    }

    public function delete()
    {
        $this->model->delete(tableExA, array('idAgente' => $_POST['id']), "ExA");
        $delete = $this->model->delete(table, array('id' => $_POST['id']), "Agente");
        return json_encode($delete);
    }
}
