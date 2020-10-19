<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\EspecializacionModel;

class EspecializacionController extends Controller
{
   public function __construct()
    {
      $this->model = new EspecializacionModel();
      session_start();    
   }

    private $table = 'especializaciones';
    private $tableTarea = 'tareas';  
    private $tableExA = 'especializaciones_x_agentes';

    public function administracionEspecializaciones($new = null,$update = null,$delete = null){
        $comparaTablasIfUsado = array(
                                    array(  "tabla" => $this->tableTarea, 
                                            "comparaKeyOrig" => "id",
                                            "comparaKeyDest" => "idEspecializacion"
                                        ),
                                    array(  "tabla" => $this->tableExA, 
                                            "comparaKeyOrig" => "id",
                                            "comparaKeyDest" => "idEspecializacion"
                                        )
                                );
        $datos['todasEspecializaciones'] = $this->model->get($this->table,$comparaTablasIfUsado);       
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
            array("url" => "/especializaciones",
                "nombre" => "ESPECIALIZACIONES")    
                );
        $datos['datosSesion'] = $_SESSION;
        return view('/administracion/EspecializacionesView', compact('datos'));
    }       
    
    public function new() {
        $especializacion['nombre'] = $_POST['nombre'];       
        $insertOk = $this->model->insert($this->table,$especializacion);
        return $this->administracionEspecializaciones($insertOk);
    }
    
    public function update(){
        $especializacion = [
            'id' => $_POST['id'],
            'nombre' => $_POST['nombre']
        ];
        $updateOk = $this->model->update($this->table,$especializacion);
        return $this->administracionEspecializaciones(null,$updateOk);
     }

     public function delete(){
        $especializacion['id'] = $_POST['id'];  
        $deleteOk = $this->model->delete($this->table,$especializacion);
        return $this->administracionEspecializaciones(null,null,$deleteOk);
    }
    

}
