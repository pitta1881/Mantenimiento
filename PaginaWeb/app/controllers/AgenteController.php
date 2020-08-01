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


    public function administracionAgentes($new = null,$update = null,$delete = null){
        $datos['todosAgentes'] = $this->model->get($this->table); 
        $datos["userLogueado"] = $_SESSION['user'];
        $datos['permisos'] = $this->model->getPermisos();
        $datos['personas'] = $this->model->getPersonasNoAgentes();
        $datos['especializaciones'] = $this->model->getEspecializaciones();
        if(!is_null($new)){
            $datos['newOK'] = $new;
        }
        if(!is_null($update)){
            $datos['updateOK'] = $update;
        }
        if(!is_null($delete)){
            $datos['deleteOK'] = $delete;
        }
        $datos['urlheader']="> HOME > AGENTES";
        return view('/agentes/AgentesView', compact('datos'));
    }       
    
    public function new() {
        $agente = [
            'idAgente' => $_POST['idAgente'],
            'idEspecializacion' => $_POST['idEspecializacion']
        ];
        $insertOk = $this->model->insert($this->table,$agente);
        return $this->administracionAgentes($insertOk);
    }

    public function update(){
        $agente = [
            'idAgente' => $_POST['idAgente'],
            'idEspecializacion' => $_POST['idEspecializacion']
        ];
        $updateOk = $this->model->update($this->table,$agente);
        return $this->administracionAgentes(null,$updateOk);
     }

     public function delete(){
        $agente['idAgente'] = $_POST['idAgente'];
        $deleteOk = $this->model->delete($this->table,$agente);
        return $this->administracionAgentes(null,null,$deleteOk);
    }
    
}
