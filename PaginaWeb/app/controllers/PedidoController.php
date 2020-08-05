<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\PedidoModel;
use App\Models\Tarea;

class PedidoController extends Controller{

    public function __construct(){
        $this->model = new PedidoModel();
        session_start();
    }

    protected $table = 'pedido';

    /*Show all pedidos*/
    public function administracionPedidos($new = null,$update = null,$delete = null){
        $datos['todosPedidos'] = $this->model->get($this->table); 
        $datos["userLogueado"] = $_SESSION['user'];
        $datos['permisos'] = $this->model->getPermisos();
        $datos["sectores"] = $this->model->getSectores();
        $datos["prioridades"] = $this->model->getPrioridades();
        $datos["estados"] = $this->model->getEstados();
        $datos["diaHoy"] = date("Y-m-d");
        if(!is_null($new)){
            $datos['newOK'] = $new;
        }
        if(!is_null($update)){
            $datos['updateOK'] = $update;
        }
        if(!is_null($delete)){
            $datos['deleteOK'] = $delete;
        }
        $datos['urlheader']="> HOME > PEDIDOS";
        return view('/pedidos/PedidosView', compact('datos'));
    }

    public function new(){
        $pedido = [
            'fechaInicio' => $_POST['fechaInicio'],
            'estado' => $_POST['estado'],
            'descripcion' => $_POST['descripcion'],
            'idSector' => $_POST['idSector'],
            'prioridad' => $_POST['prioridad'],
            'nombreUsuario' => $_POST['nombreUsuario']
        ];
      $insertOk = $this->model->insert($this->table,$pedido,true);
      return $this->administracionPedidos($insertOk);
    }

    public function update(){
        $pedido = [
            'id' => $_POST['id'],
            'estado' => $_POST['estado'],
            'descripcion' => $_POST['descripcion'],
            'idSector' => $_POST['idSector'],
            'prioridad' => $_POST['prioridad'],
        ];
        $updateOk = $this->model->update($this->table,$pedido);
        return $this->administracionPedidos(null,$updateOk);
    }
    
     public function finish(){
        $pedido = [
            'id' => $_POST['id'],
            'estado' => 'Finalizado',
            'fechaFin' => date("Y-m-d")
        ];
        $deleteOk = $this->model->update($this->table,$pedido);
        return $this->administracionPedidos(null,null,$deleteOk);
     }

     public function cancel(){
        $pedido = [
            'id' => $_POST['id'],
            'estado' => 'Cancelado',
            'fechaFin' => date("Y-m-d")
        ];
        $deleteOk = $this->model->update($this->table,$pedido);
        return $this->administracionPedidos(null,null,$deleteOk);
    }

    public function getDatos(){
        $todosPedidos = $this->model->get(); 
        echo json_encode($todosPedidos);
    }

    /*muestra un solo pedido especifico ingresado por GET*/
    public function ficha(){
        $miPedido = $this->model->getByIdPedido($_GET['id']);
        $datos["miPedido"] = $miPedido;  
        $datos["estados"] = $this->model->getEstados();
        $datos["sectores"] = $this->model->getSectores();
        $datos["prioridades"] = $this->model->getPrioridades();
        $datos['especializaciones'] = $this->model->getTareaEspecializaciones();
        $datos["userLogueado"] = $_SESSION['user'];
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
        return view('/pedidos/pedidoVerFicha', compact('datos'));
    }
}
