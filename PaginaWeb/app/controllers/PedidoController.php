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
        if (isset($_POST['eventoID'])) {
            $datos["evento"] = [
                "id" => $_POST['eventoID'],
                "nombre" => $_POST['eventoNombre'],
                "descripcion" => $_POST['eventoDescripcion']
            ];
        }
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
        if (isset($_POST['idEvento'])) {
            $pedido['idEvento'] = $_POST['idEvento'];
            $this->model->update(tableEventos, array('idEstado' => 2), array('id' => $_POST['idEvento']), "Evento");
        }
        $observacion = 'Pedido Creado'. (isset($_POST['idEvento']) ? ' por Evento Nº'.$_POST['idEvento'] : '');
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
                'observacion' => $observacion
            ];
            $this->model->insert(tableHistorialPedido, $historialPedido, "historialPedido");
        }
        return json_encode($insert);
    }

    public function update()
    {
        $pedido = [
            'idSector' => $_POST['idSector'],
            'idPrioridad' => $_POST['idPrioridad'],
            'descripcion' => $_POST['descripcion']
        ];
        $update = $this->model->update(table, $pedido, array('id' => $_POST['id']), "Pedido");
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
            'idEstado' => 5,
            'fechaFin' => date("Y-m-d")
        ];
        $update = $this->model->update(table, $pedido, array('id' => $_POST['id']), "Pedido");
        //si era por evento, le seteo el estado a terminado
        $idEvento = $this->hasEventoRelacionado($_POST['id']);
        if ($idEvento) {
            $this->model->update(tableEventos, array('idEstado' => 6), array('id' => $idEvento), "Evento");
        }
        return json_encode($update);
    }

    public function cancel()    //idEstado = 4
    {
        $ahora = date('Y-m-d H:i:s');
        $pedido = [
            'idEstado' => 4,
            'fechaFin' => $ahora
        ];
        $update = $this->model->update(table, $pedido, array('id' => $_POST['id']), "Pedido");
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

    private function hasEventoRelacionado($idPedido)
    {
        $datos['unPedido'] = $this->model->getFichaOne(table, array('id'=>$idPedido));
        return (is_null($datos['unPedido']['idEvento']) ? false : $datos['unPedido']['idEvento']);
    }
}
