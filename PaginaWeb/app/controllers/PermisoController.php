<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\PermisoModel;

class PermisoController extends Controller{
    public function __construct(){
        $this->model = new PermisoModel();
        
    }   

    private $table = 'permisos';
    private $tableRxP = 'rolesxpermisos';


    public function administracionPermisos($new = null,$update = null,$delete = null){
        $comparaTablasIfUsado = array(
            array(  "tabla" => $this->tableRxP,
                    "comparaKey" => "idPermiso"
                )
        );
        $datos['todosPermisos'] = $this->model->get($this->table,$comparaTablasIfUsado);
        
        
        $alertas = [
            'new' => $new,
            'update' => $update,
            'delete' => $delete
        ];
        $datos['alertas'] = $alertas;
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
