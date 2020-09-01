<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\RolModel;
use App\Models\PermisoModel;

class RolController extends Controller{

    public function __construct(){
        $this->model = new RolModel();
        session_start();
    }

    private $table = 'roles';
    private $tableUsuarios = 'usuarios';
    private $tableRP = 'rolesxpermisos';

    /*Show all pedidos*/
    public function administracionRoles($new = null,$update = null,$delete = null){
        $comparaTablasIfUsado = array(
                                    array(  "tabla" => $this->tableRP, 
                                            "comparaKey" => 'idRol'
                                    ),
                                    array(  "tabla" => $this->tableUsuarios, 
                                    "comparaKey" => 'idRol'
                                    )
                                );
        $datos["todosRoles"] = $this->model->get($this->table,$comparaTablasIfUsado); 
        $datos["userLogueado"] = $_SESSION['user'];
        $datos['permisos'] = $this->model->getPermisos();
        $alertas = [
            'new' => $new,
            'update' => $update,
            'delete' => $delete
        ];
        $datos['alertas'] = $alertas;
        $datos['urlheader']="> HOME > ADMINISTRACIÓN > ROLES";
        return view('/administracion/RolesView', compact('datos'));
    }

    public function new(){
        $rol['nombreRol'] = $_POST['nombreRol'];
        $insertOk = $this->model->insert($this->table,$rol);
        return $this->administracionRoles($insertOk);
    }

    public function update(){     
        $rol['idRol'] = $_POST["idRol"];
        $this->model->delete($this->tableRP,$rol);
        if(isset($_POST["permisos"])){
            $permisos= $_POST["permisos"];
            for ($i=0;$i<count($permisos);$i++)    {  
                $rol['idPermiso'] = $permisos[$i];
                $this->model->insert($this->tableRP,$rol,true);
            }
        }
        return $this->administracionRoles(null,true);
    }

    public function delete(){
        $rol['idRol'] = $_POST['idRol'];
        $deleteOk = $this->model->delete($this->table,$rol);
        return $this->administracionRoles(null,null,$deleteOk);
    }

    public function ficha(){
        $rol['idRol'] = $_POST['idRol'];
        $miRol['miRol'] = $this->model->getFicha($this->table,$rol);
        $miRol["misPermisos"] = $this->model->getPermisos($rol['idRol']);
        echo json_encode($miRol);
    }
}