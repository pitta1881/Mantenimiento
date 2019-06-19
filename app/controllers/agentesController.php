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
        if(isset($_GET["page"])){
            $pagina=$_GET["page"];
        }else{
            $pagina=1;
        }
        $todosAgentes = $this->model->getPaginacion($pagina); 
        $datos['todosAgentes'] = $todosAgentes;
        $totalPaginas=$this->model->getsize();
        $datos["totalPaginas"] =   $totalPaginas;
        $datos['personas'] = $this->model->getPersonasNoAgentes();
        $datos['especializaciones'] = $this->model->getEspecializaciones();
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/agentes/agentes.administracion', compact('datos'));
    }
       
    
    public function guardarAgente() {
            $idEspecializacion = $this->model->getIdEspecializacionPorNombre($_POST['especializacion']);
            $datos['idAgente']=$_POST['idAgente'];
            $datos['idEspecializacion']= $idEspecializacion; 
            $this->model->insert($datos); 
            return $this->vistaAdministracionAgentes();
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
