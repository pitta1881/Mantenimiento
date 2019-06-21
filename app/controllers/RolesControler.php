<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Roles;
use App\Models\Permisos;

class RolesControler extends Controller{

    public function __construct(){
        $this->model = new Roles();
        session_start();
    }

    /*Show all pedidos*/
    public function index(){
        if(isset($_GET["page"])){
            $pagina=$_GET["page"];
        }else{
            $pagina=1;
        }
        $todosRoles = $this->model->getPaginacion($pagina); 
        $datos["todosRoles"] = $todosRoles;
        $totalPaginas=$this->model->getsize();
        $datos["totalPaginas"] =   $totalPaginas;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/roles/administracionRol', compact('datos'));
    }

    /*muestra un solo pedido especifico ingresado por GET*/
    public function ficha(){
        $miPedido = $this->model->getByIdPedido($_GET['id']);
        $datos["miROL"] = $miPedido;  
        $datos["permisos"] = $this->model->getPermisos();
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/pedidos/pedidoVerFicha', compact('datos'));
    }

    public function guardar(){
        $rol = [
            'nombre' => $_POST['nombreRol'],
            'descripcion' => $_POST['descripcion'],
        ];
      $this->model->insert($rol);
   
      $datos['arrayPedido'] = $rol;
      $datos["userLogueado"] = $_SESSION['user'];
      $idNuevoPedido = $this->model->getIdUltimoRol();
      redirect("fichaRol?id=".$idNuevoPedido);
    }

    public function modificarPedidoSeleccionado(){
        $unPedido = $this->model->getByIdPedido($_GET['id']);
        $unPedido['fechaInicio'] = date("Y-m-d",strtotime(str_replace('/', '-', $unPedido['fechaInicio'])));
        $datos["sectores"] = $this->model->getSectores();
        $datos["prioridades"] = $this->model->getPrioridades();
        $datos["estados"] = $this->model->getEstados();
        $datos["miPedido"] = $unPedido;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/pedidos/pedidoModificar',compact('datos'));
    }
       

    public function modificar(){
        $idPedido = $_POST['id'];
        $idSector = $this->model->getIdSectorPorNombre($_POST['sector']);
        $datos['idSector']= $idSector;
        $arrayPedido = [
            'fechaInicio' => $_POST['fechaInicio'],
            'estado' => $_POST['estado'],
            'descripcion' => $_POST['descripcion'],
            'idSector' => $idSector,
            'prioridad' => $_POST['prioridad'],
        ];
        $this->model->updatePedido($arrayPedido,$idPedido);
        redirect("fichaPedido?id=".$idPedido);
    }
    
    public function buscarPor(){
        $filter = $_POST['filtro'];
        $value = $_POST['textBusqueda'];
        $datos['todosPedidos'] = $this->model->getAllbyFilter($filter,$value);
        $datos['userLogueado'] = $_SESSION['user'];           
        return view('/pedidos/pedidosVerTodos', compact('datos'));         
     }

     public function finalizar(){
         $this->model->updateEstadoPedido($_POST['id'],'Finalizado');
         redirect("fichaPedido?id=".$_POST['id']);
     }
}

