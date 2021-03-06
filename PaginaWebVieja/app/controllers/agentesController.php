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
        $datos['personas'] = $this->model->getPersonasNoAgentes();
        $datos['especializaciones'] = $this->model->getEspecializaciones();
        $datos["userLogueado"] = $_SESSION['user'];
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
        return view('/agentes/agentes.administracion', compact('datos'));
    }
       
    
    public function guardarAgente() {
            $idEspecializacion = $this->model->getIdEspecializacionPorNombre($_POST['especializacion']);
            $datos['idAgente']=$_POST['idAgente'];
            $datos['idEspecializacion']= $idEspecializacion; 
            $this->model->insert($datos); 
            return $this->vistaAdministracionAgentes();
    }

    public function update(){
        $idAgente = $_POST['idAgente'];
        $idEspecializacion = $this->model->getIdEspecializacionPorNombre($_POST['especializacion']); 
        $datos = [
            'idEspecializacion' => $idEspecializacion
        ];
        $this->model->update($datos,$idAgente);
        return $this->vistaAdministracionAgentes();
     }

     public function delete(){
        $this->model->delete($_POST['idAgente']);
        return $this->vistaAdministracionAgentes();
    }
    
}
