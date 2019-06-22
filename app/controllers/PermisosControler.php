<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Permisos;

class PermisosControler extends Controller{
    public function __construct(){
        $this->model = new Permisos();
        session_start();
    }

    /*Show all pedidos*/
    public function index(){
        if(isset($_GET["page"])){
            $pagina=$_GET["page"];
        }else{
            $pagina=1;
        }
        $todosPermisos= $this->model->getPaginacion($pagina); 
        $datos['todosPermisos'] = $todosPermisos;
        $totalPaginas=$this->model->getsize();
        $datos["totalPaginas"] =   $totalPaginas;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/permisos/administracionPermisos', compact('datos'));
    }

}
