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
    private $tableRxP = 'roles_x_permisos';
    private $tableRxU = 'roles_x_usuarios';


    public function administracionRoles($new = null,$update = null,$delete = null){
        $comparaTablasIfUsado = array(
                                    array(  "tabla" => $this->tableRxU, 
                                            "comparaKeyOrig" => "id",
                                            "comparaKeyDest" => "idRol"
                                    )
                                );
        $datos["todosRoles"] = $this->model->get($this->table,$comparaTablasIfUsado);
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
            array("url" => "/administracion/roles",
            "nombre" => "ROLES")    
        );
        if(!is_null($update)){
            $_SESSION['listaPermisos'] = $this->model->getPermisos();
        }
        $datos['datosSesion'] = $_SESSION;
        return view('/administracion/RolesView', compact('datos'));
    }

    public function new(){
        $rol['nombre'] = $_POST['nombre'];
        $insertOk = $this->model->insert($this->table,$rol);
        return $this->administracionRoles($insertOk);
    }

    public function update(){     
        $rol['idRol'] = $_POST["id"];
        $this->model->delete($this->tableRxP,$rol);
        if(isset($_POST["permisos"])){
            $permisos= $_POST["permisos"];
            for ($i=0;$i<count($permisos);$i++)    {  
                $rol['idPermiso'] = $permisos[$i];
                $insertOk = $this->model->insert($this->tableRxP,$rol);
            }
        }
        return $this->administracionRoles(null,$insertOk);
    }

    public function delete(){
        $rol['id'] = $_POST['id'];
        $rolRxP['idRol'] = $_POST['id'];
        $this->model->delete($this->tableRxP,$rolRxP);
        $deleteOk = $this->model->delete($this->table,$rol);
        return $this->administracionRoles(null,null,$deleteOk);
    }

    public function ficha(){
        $rol['id'] = $_POST['id'];
        $miRol['miRol'] = $this->model->getFicha($this->table,$rol);
        $miRol["misPermisos"] = $this->model->getPermisos($rol['id']);
        echo json_encode($miRol);
    }
}