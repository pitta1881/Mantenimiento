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


    public function administracionAgentes($new = null,$update = null,$delete = null){
        $todosAgentes = $this->model->get(); 
        $datos['todosAgentes'] = $todosAgentes;
        $datos['personas'] = $this->model->getPersonasNoAgentes();
        $datos['especializaciones'] = $this->model->getEspecializaciones();
        $datos["userLogueado"] = $_SESSION['user'];
        $datos['permisos'] = $this->model->getPermisos($_SESSION['rol']);
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
        $idEspecializacion = $this->model->getIdEspecializacionPorNombre($_POST['especializacion']);
        $agente = [
            'idAgente' => $_POST['idAgente'],
            'idEspecializacion' => $idEspecializacion
        ];
        $insertOk = $this->model->insert($agente);
        return $this->administracionAgentes($insertOk);
    }

    public function update(){
        $idAgente = $_POST['idAgente'];
        $idEspecializacion = $this->model->getIdEspecializacionPorNombre($_POST['especializacion']); 
        $datos = [
            'idEspecializacion' => $idEspecializacion
        ];
        $this->model->update($datos,$idAgente);
        return $this->administracionAgentes(null,true);
     }

     public function delete(){
        $this->model->delete($_POST['idAgente']);
        return $this->administracionAgentes(null,null,true);
    }
    
}
