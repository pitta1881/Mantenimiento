<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\PedidoModel;
use App\Core\MyInterface;

class PedidoController extends Controller implements MyInterface
{
    public function __construct($session = true)
    {
        $this->model = new PedidoModel();
        if ($session) {
            session_start();
            define("table", "pedidos");
        }
    }

    public function index($model = null)
    {
        if (!is_null($model)) {
            $this->model = $model;
        }
        $datos['estados'] = $this->model->getFichaAll(tableEstados);
        $datos['prioridades'] = $this->model->getFichaAll(tablePrioridades);
        $datos["sectores"] = $this->model->getFichaAll(tableSectores);
        $datos["usuarios"] = $this->model->getFichaAll(tableUsuarios);
        $datos["especializaciones"] = $this->model->getFichaAll(tableEspecializaciones);
        $_SESSION['urlHeader'] = array(
            array("url" => "/home",
            "nombre" => "HOME"),
            array("url" => "/pedidos",
            "nombre" => "PEDIDOS")
        );
        $datos['datosSesion'] = $_SESSION;
        return view('/pedidos/PedidosView', compact('datos'));
    }

    public function create()
    {
        $ahora = date('Y-m-d H:i:s');
        $pedido = [
            'fechaInicio' => $ahora,
            'idUsuario' => $_SESSION['idUser'],
            'idEstado' => 1,
            'idSector' => $_POST['idSector'],
            'idPrioridad' => $_POST['idPrioridad'],
            'descripcion' => $_POST['descripcion']
        ];
        $insert = $this->model->insert(table, $pedido, "Pedido");
        if ($insert['estado']) {
            $historialPedido = [
                'id' => 1,
                'idPedido' => $insert['mensaje'],
                'fecha' => $ahora,
                'idUsuario' => $_SESSION['idUser'],
                'idEstado' => 1,
                'idSector' => $_POST['idSector'],
                'idPrioridad' => $_POST['idPrioridad'],
                'descripcion' => $_POST['descripcion'],
                'observacion' => 'Pedido Creado'
            ];
            $this->model->insert(tableHistorialPedido, $historialPedido, "historialPedido");
        }
        return json_encode($insert);
    }

    public function update()
    {
        $pedido = [
            'id' => $_POST['id'],
            'idSector' => $_POST['idSector'],
            'idPrioridad' => $_POST['idPrioridad'],
            'descripcion' => $_POST['descripcion']
        ];
        $update = $this->model->update(table, $pedido, "Pedido");
        if ($update['estado']) {
            $historialPedido = [
                'id' => $this->getIdHistorial($_POST['id']),
                'idPedido' => $_POST['id'],
                'fecha' => date('Y-m-d H:i:s'),
                'idUsuario' => $_SESSION['idUser'],
                'idEstado' => $_POST['idEstado'],
                'idSector' => $_POST['idSector'],
                'idPrioridad' => $_POST['idPrioridad'],
                'descripcion' => $_POST['descripcion'],
                'observacion' => 'Pedido Modificado'
            ];
            $this->model->insert(tableHistorialPedido, $historialPedido, "historialPedido");
        }
        return json_encode($update);
    }
    
    public function finish()    //idEstado = 5
    {
        $pedido = [
            'id' => $_POST['id'],
            'idEstado' => 5,
            'fechaFin' => date("Y-m-d")
        ];
        $update = $this->model->update(table, $pedido, "Pedido");
        return json_encode($update);
    }

    public function cancel()    //idEstado = 4
    {
        $ahora = date('Y-m-d H:i:s');
        $pedido = [
            'id' => $_POST['id'],
            'idEstado' => 4,
            'fechaFin' => $ahora
        ];
        $update = $this->model->update(table, $pedido, "Pedido");
        if ($update['estado']) {
            $historialPedido = [
                'id' => $this->getIdHistorial($_POST['id']),
                'idPedido' => $_POST['id'],
                'fecha' => $ahora,
                'idEstado' => 4,
                'idUsuario' => $_SESSION['idUser'],
                'observacion' => 'Pedido Cancelado > '.$_POST['observacion']
            ];
            $this->model->insert(tableHistorialPedido, $historialPedido, "historialPedido");
        }
        return json_encode($update);
    }


    public function delete()
    {
    }

    private function getIdHistorial($idPedido)
    {
        $datos['unPedido'] = $this->model->getFichaOne(table, array('id'=>$idPedido));
        return end($datos['unPedido']['historial'])['id'] + 1;
    }
}
