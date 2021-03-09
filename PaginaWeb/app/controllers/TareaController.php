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
        $idTarea = $this->getIdTarea($_POST['idPedido']);
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
        }
        return $this->index($insert);
    }

    public function update()
    {
    }

    public function delete()
    {
    }

    private function getIdTarea($idPedido)
    {
        $datos['unPedido'] = $this->model->getFichaOne(tablePedidos, array('id'=>$idPedido));
        return ($datos['unPedido']['tareasAsignadas'] + 1);
    }
}
