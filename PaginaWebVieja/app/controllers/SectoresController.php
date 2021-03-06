<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Sectores;

class SectoresController extends Controller{
   
    public function __construct()
    {
      $this->model = new Sectores();
      session_start();    
   }
    
    public function vistaAdministracionSectores($boolError = false){
        $todosSectores = $this->model->get(); 
        $datos['todosSectores'] = $todosSectores;
        $datos['tipoSectores'] = $this->model->getTipoSector();
        $datos["userLogueado"] = $_SESSION['user'];
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
        if ($boolError) {
            $datos['errorInsert'] = true;
        }
        return view('/sectores/sectores.administracion', compact('datos'));
    }
    
    public function guardarSector() {
        $datos['nombreSector'] = $_POST['nombreSector'];
        $datos['tipo'] = $_POST['tipo']; 
        $datos['responsable'] = $_POST['responsable']; 
        $datos['telefono'] = $_POST['telefono'];
        $datos['email'] = $_POST['email']; 
        $statement = $this->model->buscarSector($datos['nombreSector']);          
        if (empty($statement)) {            
            $this->model->insert($datos); 
            return $this->vistaAdministracionSectores();
        } else{
            return $this->vistaAdministracionSectores(true);
        }
    }

    public function update(){
        $idSector = $_POST['idSector'];
        $datos = [
            'nombreSector' => $_POST['nombreSector'],
            'tipo' => $_POST['tipo'],
            'responsable' => $_POST['responsable'],
            'telefono' => $_POST['telefono'],
            'email' => $_POST['email']
        ];
        $this->model->update($datos,$idSector);
        return $this->vistaAdministracionSectores();
     }

     public function delete(){
        $this->model->delete($_POST['idSector']);
        return $this->vistaAdministracionSectores();
    }

    public function ficha(){
        $miSector = $this->model->getByIdSector($_POST['idSector']);
        echo json_encode($miSector);
    }
}