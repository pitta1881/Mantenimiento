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

    public function administracionPermisos($new = null,$update = null,$delete = null){
        $datos['todosPermisos'] = $this->model->get($this->table);
        $datos['userLogueado'] = $_SESSION['user'];
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
        $datos['urlheader']="> HOME > ADMINISTRACIÓN > PERMISOS";
        return view('/administracion/PermisosView', compact('datos'));
    }

    public function new() {
        $permiso['nombrePermiso'] = $_POST['nombrePermiso'];
        $insertOk = $this->model->insert($this->table,$permiso);
        return $this->administracionPermisos($insertOk); 
    }

    public function update(){
        $permiso = [
            'idPermiso' => $_POST['idPermiso'],
            'nombrePermiso' => $_POST['nombrePermiso']
        ];
        $updateOk = $this->model->update($this->table,$permiso);
        return $this->administracionPermisos(null,$updateOk);
     }

     public function delete(){
        $permiso['idPermiso'] = $_POST['idPermiso'];
        $deleteOk = $this->model->delete($this->table,$permiso);
        return $this->administracionPermisos(null,null,$deleteOk);
    }
}
