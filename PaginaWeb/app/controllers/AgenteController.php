<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\AgenteModel;

define("table", "agentes");
define("tablePersonas", "personas");
define("tableEspecializaciones", "especializaciones");
define("tableTxA", "tareas_x_agentes");
define("tableExA", "especializaciones_x_agentes");

class AgenteController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new AgenteModel();
        session_start();
    }

    public function index($alerta = null)
    {
        $comparaTablasIfUsado = array(
                                    array(  "tabla" => tableTxA,
                                            "comparaKeyOrig" => "id",
                                            "comparaKeyDest" => "idAgente"
                                    )
                                );
        $datos['todosAgentes'] = $this->model->get(table, $comparaTablasIfUsado);
        $datos['personas'] = $this->model->get(tablePersonas);
        foreach ($datos['todosAgentes'] as $keyAgente => $valueAgente) {
            foreach ($datos['personas'] as $keyPersona => $valuePersona) {
                if ($valueAgente['idPersona'] == $valuePersona['id'] || $valuePersona['id'] == 0) {
                    unset($datos['personas'][$keyPersona]);
                }
            }
        }
        $datos['todasEspecializaciones'] = $this->model->get(tableEspecializaciones);
        $datos['alertas'] = $alerta;
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
        return $this->index($insert);
    }

    public function update()
    {
        $agente['idAgente'] = $_POST['id'];
        $this->model->delete(tableExA, $agente);
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
        return $this->index($update);
    }

    public function delete()
    {
        $agenteExA['idAgente'] = $_POST['id'];
        $agente['id'] = $_POST['id'];
        $this->model->delete(tableExA, $agenteExA, "ExA");
        $delete = $this->model->delete(table, $agente, "Agente");
        return $this->index($delete);
    }
}
