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

    private $table='especializacion';
    private $tableTarea = 'tarea';  
    private $tableAgentes='agentes';

    public function administracionEspecializaciones($new = null,$update = null,$delete = null){
        $datos['todasEspecializaciones'] = $this->model->get($this->table,array($this->tableTarea,$this->tableAgentes)); 
        $datos["userLogueado"] = $_SESSION['user'];
        $datos['permisos'] = $this->model->getPermisos();
        if(!is_null($new)){
            $datos['newOK'] = $new;
        }
        if(!is_null($update)){
            $datos['updateOK'] = $update;
        }
        if(!is_null($delete)){
            $datos['deleteOK'] = $delete;
        }
        $datos['urlheader']="> HOME > ESPECIALIZACION";
        return view('/especializacion/EspecializacionesView', compact('datos'));
    }       
    
    public function new() {
        $especializacion['nombre'] = $_POST['nombre'];       
        $insertOk = $this->model->insert($this->table,$especializacion);
        return $this->administracionEspecializaciones($insertOk);
    }
    public function update(){
        $especializacion = [
            'idEspecializacion' => $_POST['idEspecializacion'],
            'nombre' => $_POST['nombre']
        ];
        $updateOk = $this->model->update($this->table,$especializacion);
        return $this->administracionEspecializaciones(null,$updateOk);
     }

     public function delete(){
        $especializacion['idEspecializacion'] = $_POST['idEspecializacion'];  
        $deleteOk = $this->model->delete($this->table,$especializacion);
        return $this->administracionEspecializaciones(null,null,$deleteOk);
    }
    

}
