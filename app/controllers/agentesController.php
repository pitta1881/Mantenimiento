<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Agentes;

class agentesController extends Controller
{
   public function __construct()
    {
      $this->model = new Agentes();
      session_start();   
   }


    public function vistaAdministracionAgentes(){
        $todosAgentes = $this->model->get();      
        $datos['todosAgentes'] = $todosAgentes;
        $datos['especializaciones'] = $this->model->getEspecializaciones();
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/agentes/agentes.administracion', compact('datos'));
    }
       
    
    public function guardarAgente() {
        $datos['nombre'] = $_POST['nombre'];
        $datos['apellido'] = $_POST['apellido'];
        $statement = $this->model->buscarAgente($datos['nombre'],$datos['apellido']);     
        if (empty($statement)) {
            $idEspecializacion = $this->model->getIdEspecializacionPorNombre($_POST['especializacion']);
            $datos['idEspecializacion']= $idEspecializacion; 
            $this->model->insert($datos); 
            return $this->vistaAdministracionAgentes();
        }
    }

    public function vistaModificar(){
        $agente = $this->model->getByIdAgente($_GET['idAgente']);      
        $datos['agente'] = $agente;
        $datos["userLogueado"] = $_SESSION['user'];
        $datos['especializaciones'] = $this->model->getEspecializaciones(); 
        return view('/agentes/agente.modificar', compact('datos'));
    }

    public function update(){
        $idAgente = $_POST['idAgente'];
        $idEspecializacion = $this->model->getIdEspecializacionPorNombre($_POST['especializacion']); 
        $datos = [
            'nombre' => $_POST['nombre'],
            'apellido' => $_POST['apellido'],
            'idEspecializacion' => $idEspecializacion
        ];
        $this->model->update($datos,$idAgente);
        return $this->vistaAdministracionAgentes();
     }

     public function delete(){
        $this->model->delete($_POST['idAgente']);
        return $this->vistaAdministracionAgentes();
    }
    

//public function saveAgentexEspecializacion($datos,$arraySelect){
        //$this->model->insertEspecialidades($datos,$arraySelect);            
 
//}
}
