<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\SectorModel;

class SectorController extends Controller{
   
    public function __construct()
    {
      $this->model = new SectorModel();
      session_start();    
   }
    
    public function administracionSectores($new = null,$update = null,$delete = null){
        $todosSectores = $this->model->get(); 
        $datos['todosSectores'] = $todosSectores;
        $datos['tipoSectores'] = $this->model->getTipoSector();
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
        $datos['urlheader']="> HOME > SECTORES";
        return view('/sectores/SectoresView', compact('datos'));
    }
    
    public function new() {
        $sector = [
            'nombreSector' => $_POST['nombreSector'],
            'tipo' => $_POST['tipo'],
            'responsable' => $_POST['responsable'],
            'telefono' => $_POST['telefono'],
            'email' => $_POST['email']
        ];  
        $insertOk = $this->model->insert($sector);
        return $this->administracionSectores($insertOk);
    }

    public function update(){
        $sector = [
            'idSector' => $_POST['idSector'],
            'nombreSector' => $_POST['nombreSector'],
            'tipo' => $_POST['tipo'],
            'responsable' => $_POST['responsable'],
            'telefono' => $_POST['telefono'],
            'email' => $_POST['email']
        ];
        $updateOk = $this->model->update($sector);
        return $this->administracionSectores(null,$updateOk);
     }

     public function delete(){
        $this->model->delete($_POST['idSector']);
        return $this->administracionSectores();
    }

    public function ficha(){
        $miSector = $this->model->getByIdSector($_POST['idSector']);
        echo json_encode($miSector);
    }
}