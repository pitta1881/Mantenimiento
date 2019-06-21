<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Insumos;

class InsumosController extends Controller{
   
    public function __construct()
    {
      $this->model = new Insumos();
      session_start();    
   }
    
    public function vistaAdministracionInsumos(){
        if(isset($_GET["page"])){
            $pagina=$_GET["page"];
        }else{
            $pagina=1;
        }
        $todosInsumos = $this->model->getPaginacion($pagina); 
        $datos['todosInsumos'] = $todosInsumos;
        $totalPaginas=$this->model->getsize();
        $datos["totalPaginas"] =   $totalPaginas;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/insumos/insumos.administracion', compact('datos'));
    }
    
    public function guardarInsumo() {
        $datos['nombreInsumo'] = $_POST['nombreInsumo'];
        $datos['stock'] = $_POST['stock'];
        $datos['descripcion'] = $_POST['descripcion'];        
        $statement = $this->model->buscarInsumo($datos['nombreInsumo'],$datos['descripcion']);
        if (empty($statement)) {
            $this->model->insert($datos); 
            return $this->vistaAdministracionInsumos();
        }
    }

    public function vistaModificar(){
        $insumo = $this->model->getByIdInsumo($_GET['idInsumo']);      
        $datos['insumo'] = $insumo;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/insumos/insumo.modificar', compact('datos'));
    }

    public function update(){
        $idInsumo = $_POST['idInsumo'];
        $datos = [
            'nombreInsumo' => $_POST['nombreInsumo'],
            'descripcion' => $_POST['descripcion']
        ];
        $this->model->update($datos,$idInsumo);
        return $this->vistaAdministracionInsumos();
     }

     public function delete(){
        $this->model->delete($_POST['idInsumo']);
        return $this->vistaAdministracionInsumos();
    }


    public function verInsumosDisponibles(){
        $insumosDisponibles = $this->model->verInsumosDisponibles();
        $datos['idPedido'] = $_GET['idPedido'];
        $datos['idTarea'] = $_GET['idTarea'];
        $datos['insumosDisponibles'] = $insumosDisponibles;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/insumos/tareasInsumosDisponibles',compact('datos'));
    }

    public function asignarInsumos(){
        foreach ($_POST as $datos => $datos2) {
            if (explode("_",$datos)[1]=='cantidad') {
                $itemInsumo['cantidad']=$datos2;
                $this->model->insertItem($itemInsumo);
                $this->model->registrarMovimiento($idInsumoFinal,$datos2,1); //el 1 para restar
                $this->model->updateStock($idInsumoFinal,$datos2,1);
            } else {
                $idPedidoFinal = explode('_',$datos)[1];
                $idTareaFinal = explode('_',$datos2)[0];
                $idInsumoFinal = explode('_',$datos2)[1];
                $itemInsumo = [
                    'idPedido' => $idPedidoFinal,
                    'idTarea' => $idTareaFinal,
                    'idInsumo' => $idInsumoFinal
                ];
            }
        }
        redirect("fichaTarea?idPedido=".$idPedidoFinal."&idTarea=".$idTareaFinal);
    }

    public function verHistorial(){
        $historial = $this->model->verHistorial($_GET['idInsumo']);
        $datos['historial'] = $historial;
        $datos["userLogueado"] = $_SESSION['user'];
        return view('/insumos/insumoVerHistorial',compact('datos'));
    }

    public function sumarStock(){
        $this->model->registrarMovimiento($_POST['idInsumo'],$_POST['cantidad'],0); //el 1 para restar
        $this->model->updateStock($_POST['idInsumo'],$_POST['cantidad'],0);
        if (empty($_GET)) {
            return $this->vistaAdministracionInsumos();
        } else {
            # code...
        }
    }
}