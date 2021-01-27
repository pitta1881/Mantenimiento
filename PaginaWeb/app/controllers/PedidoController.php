<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\PedidoModel;
use App\Models\Tarea;

class PedidoController extends Controller{

    public function __construct(){
        $this->model = new PedidoModel();
        
    }

    protected $table = 'pedido';

    /*Show all pedidos*/
    public function administracionPedidos($new = null,$update = null,$delete = null){
        $datos['todosPedidos'] = $this->model->get($this->table); 
        
        
        $datos["sectores"] = $this->model->getSectores();
        $datos["prioridades"] = $this->model->getPrioridades();
        $datos['especializaciones'] = $this->model->getEspecializaciones();
        $datos["estados"] = $this->model->getEstados();
        $datos["diaHoy"] = date("Y-m-d");
        $alertas = [
            'new' => $new,
            'update' => $update,
            'delete' => $delete
        ];
        $datos['alertas'] = $alertas;
        $datos['urlheader']="> HOME > PEDIDOS";
        return view('/pedidos/PedidosView', compact('datos'));
    }

    public function create(){
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
        
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
        return view('/pedidos/pedidoVerFicha', compact('datos'));
    }
}
