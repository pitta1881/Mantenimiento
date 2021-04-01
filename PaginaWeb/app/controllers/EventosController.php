<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\MyInterface;
use App\Models\Eventos;

class EventosController extends Controller implements MyInterface {
   
    public function __construct(){
      $this->model = new Eventos();
      session_start();  
   }
    
  public function vistaAdministracionEventos(){
      
    $todosEventos = $this->model->getEvento(); 
        $datos['todosEventos'] = $todosEventos;
        $datos["diaHoy"] = date("Y-m-d");
      // var_dump( $_SESSION['rolActual']['id']);
     $idRol=$_SESSION['rolActual']['id'];
     
     $datos['datosSesion'] = $_SESSION;
    // var_dump($datos); 
    //  $permisos=$this->model->getPermisos($idRol);
      // $datos['permisos']= $permisos;
  //var_dump($datos);
        return view('/eventos/administracionEventos', compact('datos'));
    }
    
    public function guardarEvento() {
           /*$originalDate = $_POST['fechaInicio'];
$newDate = date("d/m/Y", strtotime($originalDate));
        var_dump($newDate);
             $originalDate2 = $_POST['fechaFin'];
$newDate2 = date("d/m/Y", strtotime($originalDate2));*/
     
        
        
        
    $datos['nombreEvento'] = $_POST['nombreEvento'];
        $datos['descripcion'] = $_POST['descripcion'];
        $datos['fechaInicio'] = $_POST['fechaInicio'];
        $datos['fechaFin'] =  $_POST['fechaFin'];
        $datos['periodicidad']=$_POST['periodicidad'];
        $statement = $this->model->buscarEvento($datos['nombreEvento']);        
      
        if (empty($statement)) {
            
            $this->model->insert($datos); 
            return $this->vistaAdministracionEventos();
        }
    }

   /* public function vistaModificar(){
        $evento = $this->model->getByIdEvento($_GET['idEvento']);      
        $datos['evento'] = $evento;
        
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
        return view('/eventos/eventos.modificar', compact('datos'));
    }*/

 
    public function index()
    {
        
        return view('/administracion/AgentesView', compact('datos'));
    }
    
    public function create()
    {
        
    }
 
 
 
 
 
    public function update(){
       /* $originalDate = $_POST['fechaInicio'];
$newDate = date("d/m/Y", strtotime($originalDate));
        var_dump($newDate);*/
        $idEvento = $_POST['idEvento'];
        $datos = [
            'nombreEvento' => $_POST['nombreEvento'],
            'descripcion' => $_POST['descripcion'],
            'fechaInicio' => $_POST['fechaInicio'],
            'fechaFin' => $_POST['fechaFin']
        ];
        $this->model->update($datos,$idEvento);
        return $this->vistaAdministracionEventos();
     }

     public function delete(){
        $this->model->delete($_POST['idEvento']);
        return $this->vistaAdministracionEventos();
    }
}