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
    
    public function vistaAdministracionInsumos($boolError = false){
        $todosInsumos = $this->model->get(); 
        $datos['todosInsumos'] = $todosInsumos;
        $datos["userLogueado"] = $_SESSION['user'];
         $datos['rol']=$_SESSION['rol'];
        if ($boolError) {
            $datos['errorInsert'] = true;
        }
        return view('/insumos/insumos.administracion', compact('datos'));
    }
    
    public function guardarInsumo() {
        $datos['nombreInsumo'] = $_POST['nombreInsumo'];
        $datos['stock'] = $_POST['stock'];
        $datos['descripcion'] = $_POST['descripcion'];        
        $datos['stockMinimo'] = $_POST['stockMinimo'];   
        $statement = $this->model->buscarInsumo($datos['nombreInsumo'],$datos['descripcion']);
        if (empty($statement)) {
            $this->model->insert($datos); 
            return $this->vistaAdministracionInsumos();
        } else {
            return $this->vistaAdministracionInsumos(true);
        }
    }

    public function update(){
        $idInsumo = $_POST['idInsumo'];
        $datos = [
            'nombreInsumo' => $_POST['nombreInsumo'],
            'descripcion' => $_POST['descripcion'],
            'stockMinimo' => $_POST['stockMinimo']
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
        $insumosUsados = $this->model->verInsumosUsados($_GET['idPedido'],$_GET['idTarea']);
        $datos['idPedido'] = $_GET['idPedido'];
        $datos['idTarea'] = $_GET['idTarea'];
        $datos['insumosDisponibles'] = $insumosDisponibles;
        $datos['insumosUsados'] = $insumosUsados;
        $datos["userLogueado"] = $_SESSION['user'];
         $datos['rol']=$_SESSION['rol'];
        return view('/insumos/tareasInsumosDisponibles',compact('datos'));
    }

    public function asignarInsumos(){
        $tipoMovimiento = 1;
        foreach ($_POST as $datos => $datos2) {
            if (explode("_",$datos)[1]=='cantidad') {
                $itemInsumo['cantidad']=$datos2;
                $itemMovimiento = [
                    'idInsumo' => $idInsumoFinal,
                    'idPedido' => $idPedidoFinal,
                    'idTarea' => $idTareaFinal,
                    'nombreUsuario' => $_SESSION['user'],
                    'descripcion' => 'Insumo asignado a la Tarea '.$idTareaFinal.' del Pedido '.$idPedidoFinal,
                    'tipoMovimiento' => $tipoMovimiento
                ];
                $this->model->insertItem($itemInsumo);
                $this->model->registrarMovimiento($idInsumoFinal,$itemMovimiento,$datos2);
                $this->model->updateStock($idInsumoFinal,$datos2,$tipoMovimiento);
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
         $datos['rol']=$_SESSION['rol'];
        return view('/insumos/insumoVerHistorial',compact('datos'));
    }

    public function verHistorialParticular(){
        $historial = $this->model->verHistorialParticular($_GET['idPedido'],$_GET['idTarea'],$_GET['idInsumo']);
        $datos['historial'] = $historial;
        $datos["userLogueado"] = $_SESSION['user'];
         $datos['rol']=$_SESSION['rol'];
        return view('/insumos/insumoVerHistorial',compact('datos'));
    }

    public function updateStockSinItem(){
        foreach ($_POST as $key => $value) {
            $nombreKey = explode('_',$key)[0];
            if ($nombreKey == 'cantidad') {
                $cantidad = $value;
                $cantidad = abs($cantidad);
            }
            if ($nombreKey == 'descripcion') {
                $descripcion = $value;
            }
            if ($nombreKey == 'tipoMovimiento') {
                $tipoMovimiento = $value;
            }
        }
        $itemMovimiento = [
            'idInsumo' => $_POST['idInsumo'],
            'nombreUsuario' => $_POST['nombreUsuario'],
            'descripcion' => $descripcion,
            'tipoMovimiento' => $tipoMovimiento
        ];        
        $this->model->registrarMovimiento($_POST['idInsumo'],$itemMovimiento,$cantidad);
        $this->model->updateStock($_POST['idInsumo'],$cantidad,$tipoMovimiento);
        return $this->vistaAdministracionInsumos();
    }

    public function reasignarInsumo(){
        foreach ($_POST as $key => $value) {
            $nombreKey = explode('_',$key)[0];
            if ($nombreKey == 'cantidad') {
                $cantidad = $value;
            }
            if ($nombreKey == 'descripcion') {
                $descripcion = $value;
            }
            if ($nombreKey == 'tipoMovimiento') {
                $tipoMovimiento = $value;
            }
        }
        $itemInsumo = [
            'idPedido' => $_POST['idPedido'],
            'idTarea' => $_POST['idTarea'],
            'idInsumo' => $_POST['idInsumo'],
            'cantidad' => $cantidad
        ];
        $itemMovimiento = [
            'idInsumo' => $_POST['idInsumo'],
            'idPedido' => $_POST['idPedido'],
            'idTarea' => $_POST['idTarea'],
            'nombreUsuario' => $_POST['nombreUsuario'],
            'descripcion' => $descripcion,
            'tipoMovimiento' => $tipoMovimiento
        ];
        $this->model->updateItem($itemInsumo,$tipoMovimiento);
        $this->model->registrarMovimiento($_POST['idInsumo'],$itemMovimiento,$cantidad);
        $this->model->updateStock($_POST['idInsumo'],$cantidad,$tipoMovimiento);
        redirect("fichaTarea?idPedido=".$_POST['idPedido']."&idTarea=".$_POST['idTarea']);
    }
}