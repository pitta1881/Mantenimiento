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
    private $tablePedido = 'pedidos';
    private $tableTiposSector = 'tipossector';
    
    public function administracionSectores($new = null,$update = null,$delete = null){
        $comparaTablasIfUsado = array(
                                        array(  "tabla" => $this->tablePedido, 
                                            "comparaKeyOrig" => "id",
                                            "comparaKeyDest" => "idSector"
                                    )
        );
        $datos['todosSectores'] = $this->model->get($this->table,$comparaTablasIfUsado);
        $datos['todosTiposSectores'] = $this->model->get($this->tableTiposSector);
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
            array("url" => "/sectores",
            "nombre" => "SECTORES")    
        );
        $datos['datosSesion'] = $_SESSION;
        return view('/sectores/SectoresView', compact('datos'));
    }
    
    public function new() {
        $sector = [
            'nombre' => $_POST['nombre'],
            'responsable' => $_POST['responsable'],
            'telefono' => $_POST['telefono'],
            'email' => $_POST['email'],
            'idTipoSector' => $_POST['idTipoSector']
        ];  
        $insertOk = $this->model->insert($this->table,$sector);
        return $this->administracionSectores($insertOk);
    }

    public function update(){
        $sector = [
            'id' => $_POST['id'],
            'nombre' => $_POST['nombre'],
            'responsable' => $_POST['responsable'],
            'telefono' => $_POST['telefono'],
            'email' => $_POST['email'],
            'idTipoSector' => $_POST['idTipoSector']
        ];
        $updateOk = $this->model->update($this->table,$sector);
        return $this->administracionSectores(null,$updateOk);
     }

     public function delete(){
        $sector['id'] = $_POST['id'];
        $deleteOk = $this->model->delete($this->table,$sector);
        return $this->administracionSectores(null,null,$deleteOk);
    }

    public function ficha(){
        $sector['id'] = $_POST['id'];
        $miSector = $this->model->getFicha($this->table,$sector);
        echo json_encode($miSector);
    }
}