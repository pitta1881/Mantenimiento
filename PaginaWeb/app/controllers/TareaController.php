<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\TareaModel;
use App\Core\MyInterface;

define("table", "tareas");

class TareaController extends Controller implements MyInterface
{
    public function __construct()
    {
        $this->model = new TareaModel();
        session_start();
    }

    public function index()
    {
        $pedidoModel = new PedidoController(false);
        $view = $pedidoModel->index();
        return $view;
    }

    public function create()
    {
        $ahora = date('Y-m-d H:i:s');
        $pedidoRelacionado = $this->getPedido($_POST['idPedido']);
        $idTarea = $pedidoRelacionado['tareasAsignadas'] + 1;
        $tarea = [
            'id' => $idTarea,
            'idPedido' => $_POST['idPedido'],
            'fechaInicio' => $ahora,
            'idUsuario' => $_SESSION['idUser'],
            'idEstado' => 1,
            'idEspecializacion' => $_POST['idEspecializacion'],
            'idPrioridad' => $_POST['idPrioridad'],
            'descripcion' => $_POST['descripcion']
        ];
        $insert = $this->model->insert(table, $tarea, "Tareas");
        if ($insert['estado']) {
            $historialTarea = [
                'id' => 1,
                'idTarea' => $idTarea,
                'idPedido' => $_POST['idPedido'],
                'fecha' => $ahora,
                'idUsuario' => $_SESSION['idUser'],
                'idEstado' => 1,
                'idEspecializacion' => $_POST['idEspecializacion'],
                'idPrioridad' => $_POST['idPrioridad'],
                'descripcion' => $_POST['descripcion'],
                'observacion' => 'Tarea Creada'
            ];
            $insert2 = $this->model->insert(tableHistorialTarea, $historialTarea, "historialTarea");
            $historialPedido = [
                'id' => end($pedidoRelacionado['historial'])['id'] + 1,
                'idPedido' => $_POST['idPedido'],
                'fecha' => $ahora,
                'idUsuario' => $_SESSION['idUser'],
                'idEstado' => $pedidoRelacionado['idEstado'],
                'idSector' => $pedidoRelacionado['idSector'],
                'idPrioridad' => $pedidoRelacionado['idPrioridad'],
                'descripcion' => $pedidoRelacionado['descripcion'],
                'observacion' => 'Tarea Creada -> '.$_POST['descripcion']
            ];
            $this->model->insert(tableHistorialPedido, $historialPedido, "historialPedido");
        }
        return json_encode($insert);
    }

    public function update()
    {
    }

    public function delete()
    {
    }

    private function getPedido($idPedido)
    {
        return $this->model->getFichaOne(tablePedidos, array('id'=>$idPedido));
    }
}
