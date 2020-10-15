<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\PermisoModel;

class PermisoController extends Controller{
    public function __construct(){
        $this->model = new PermisoModel();
        session_start();
    }   

    private $table = 'permisos';
    private $tableRxP = 'roles_x_permisos';

    public function administracionPermisos($new = null,$update = null,$delete = null){
        $comparaTablasIfUsado = array(
            array(  "tabla" => $this->tableRxP,
                    "comparaKeyOrig" => "id",
                    "comparaKeyDest" => "idPermiso"
                )
        );
        $datos['todosPermisos'] = $this->model->get($this->table,$comparaTablasIfUsado);
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
            array("url" => "/administracion/permisos",
            "nombre" => "PERMISOS")    
        );
        $datos['datosSesion'] = $_SESSION;
        return view('/administracion/PermisosView', compact('datos'));
    }

    public function new() {
        $permiso['nombre'] = $_POST['nombre'];
        $insertOk = $this->model->insert($this->table,$permiso);
        return $this->administracionPermisos($insertOk); 
    }

    public function update(){
        $permiso = [
            'id' => $_POST['id'],
            'nombre' => $_POST['nombre']
        ];
        $updateOk = $this->model->update($this->table,$permiso);
        return $this->administracionPermisos(null,$updateOk);
     }

     public function delete(){
        $permiso['id'] = $_POST['id'];
        $deleteOk = $this->model->delete($this->table,$permiso);
        return $this->administracionPermisos(null,null,$deleteOk);
    }
}
