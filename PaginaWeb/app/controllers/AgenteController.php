<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\AgenteModel;

class AgenteController extends Controller
{
   public function __construct()
    {
      $this->model = new AgenteModel();
      session_start();   
   }

   private $table = 'agentes';
   private $tablePersonas = 'personas';
   private $tableEspecializaciones = 'especializaciones';
   private $tableTxA = 'tareas_x_agentes';
   private $tableExA = 'especializaciones_x_agentes';


    public function administracionAgentes($new = null,$update = null,$delete = null){
        $comparaTablasIfUsado = array(
                                    array(  "tabla" => $this->tableTxA, 
                                            "comparaKeyOrig" => "id",
                                            "comparaKeyDest" => "idAgente"
                                    )
                                );
        $datos['todosAgentes'] = $this->model->get($this->table,$comparaTablasIfUsado);        
        $datos['personas'] = $this->model->get($this->tablePersonas);
        foreach ($datos['todosAgentes'] as $keyAgente => $valueAgente) {
            foreach ($datos['personas'] as $keyPersona => $valuePersona) {
                if ($valueAgente['idPersona'] == $valuePersona['id'] || $valuePersona['id'] == 0) {
                    unset($datos['personas'][$keyPersona]);
                }
            }
        }
        $datos['todasEspecializaciones'] = $this->model->get($this->tableEspecializaciones);
        $alertas = [
            'new' => $new,
            'update' => $update,
            'delete' => $delete
        ];
        $datos['alertas'] = $alertas;
        $_SESSION['urlHeader'] = array(
                                        array("url" => "/home",
                                             "nombre" => "HOME"),
                                        array("url" => "/administracion",
                                             "nombre" => "ADMINISTRACION"),
                                        array("url" => "/agentes",
                                            "nombre" => "AGENTES")    
                                            );
        $datos['datosSesion'] = $_SESSION;
        return view('/agentes/AgentesView', compact('datos'));
    }       
    
    public function new() {
        $agente = [
            'idPersona' => $_POST['idPersona']
        ];
        $insertOk = $this->model->insert($this->table,$agente);
        if($insertOk){ //si falla la insercion(seguramente x nick repetido)
            foreach ($_POST['idEspecializacion'] as $key => $value) {
                $ExA = [
                    'idEspecializacion' => $value,
                    'idAgente' => $insertOk['lastInsertId']
                ];
                $this->model->insert($this->tableExA,$ExA);
            }
           return $this->administracionAgentes($insertOk);            
        }
    }

     public function update(){
        $agente['idAgente'] = $_POST['id'];
        $this->model->delete($this->tableExA,$agente);
        foreach ($_POST['idEspecializacion'] as $key => $value) {
            $ExA = [
                'idEspecializacion' => $value,
                'idAgente' => $_POST['id']
            ];
            $insertOk = $this->model->insert($this->tableExA,$ExA);
        }
        if($insertOk['estado']){
            $updateOk = $insertOk;
        }
        return $this->administracionAgentes(null,$updateOk);
    }

    public function delete(){
        $agenteExA['idAgente'] = $_POST['id'];
        $agente['id'] = $_POST['id'];
        $this->model->delete($this->tableExA,$agenteExA);
        $deleteOk = $this->model->delete($this->table,$agente);
        return $this->administracionAgentes(null,null,$deleteOk);
    }
    
}
