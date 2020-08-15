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

    private $table = 'sectores';
    private $tablePedido = 'pedido';
    
    public function administracionSectores($new = null,$update = null,$delete = null){
        $comparaTablasIfUsado = array(
                                    array(  "tabla" => $this->tablePedido, 
                                            "comparaKey" => 'idSector'
                                        )
        );
        $datos['todosSectores'] = $this->model->get($this->table,$comparaTablasIfUsado); 
        $datos["userLogueado"] = $_SESSION['user'];
        $datos['permisos'] = $this->model->getPermisos();
        $datos['tipoSectores'] = $this->model->getTipoSector();
        $alertas = [
            'new' => $new,
            'update' => $update,
            'delete' => $delete
        ];
        $datos['alertas'] = $alertas;
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
        $insertOk = $this->model->insert($this->table,$sector);
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
        $updateOk = $this->model->update($this->table,$sector);
        return $this->administracionSectores(null,$updateOk);
     }

     public function delete(){
        $sector['idSector'] = $_POST['idSector'];
        $deleteOk = $this->model->delete($this->table,$sector);
        return $this->administracionSectores(null,null,$deleteOk);
    }

    public function ficha(){
        $sector['idSector'] = $_POST['idSector'];
        $miSector = $this->model->getFicha($this->table,$sector);
        echo json_encode($miSector);
    }
}