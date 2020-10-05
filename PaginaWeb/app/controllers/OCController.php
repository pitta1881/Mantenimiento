<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\OrdenDeCompra;

class OCController extends Controller{

    public function __construct(){
        $this->model = new OrdenDeCompra();
        
    }

    public function index(){
        $todasOC = $this->model->get(); 
        $datos['todasOC'] = $todasOC;
        
        $datos['rol']=$_SESSION['rol'];
        $permisos=$this->model->getPermisos($_SESSION['rol']);
        $datos['permisos']= $permisos;
        return view('/ordendecompra/OCVerTodos', compact('datos'));
    }

    public function verInsumos(){
        $insumos = $this->model->getInsumos();
        $datos['insumos'] = $insumos;
        
        $datos['rol']=$_SESSION['rol'];
        return view('/ordendecompra/ocVerInsumosParaAsignar',compact('datos'));
    }

    public function crearOC(){
        $idOCCreada = $this->model->newOC($_POST['costoEstimado'],'Creado');
        $itemOC['idOC'] = $idOCCreada;
        for ($i=0; $i < count($_POST['idInsumo']); $i++) { 
            $itemOC['idInsumo'] = $_POST['idInsumo'][$i];
            $itemOC['cantidad'] = $_POST['cantidad'][$i];
            $this->model->insertItemOC($itemOC);
        }            
        redirect('fichaOC?idOC='.$idOCCreada);
    }

    public function ficha(){
        $miOC = $this->model->getByIdOC($_GET['idOC']);
        $datos["miOC"] = $miOC;  
        
        $datos['rol']=$_SESSION['rol'];
        return view('/ordendecompra/ocVerFicha', compact('datos'));
    }

    public function ingreso(){
        $itemOC = [
            'idOC' => $_POST['idOC'],
            'idInsumo' => $_POST['idInsumo'],
            'cantidadIngresada' => $_POST['cantidadIngresada']
        ];
        $itemMovimiento = [
            'idInsumo' => $_POST['idInsumo'],
            'nombreUsuario' => $_POST['nombreUsuario'],
            'descripcion' => $_POST['descripcion'],
            'tipoMovimiento' => $_POST['tipoMovimiento']
        ];
        $this->model->updateItemOC($itemOC);
        $this->model->registrarMovimiento($_POST['idInsumo'],$itemMovimiento,$_POST['cantidadIngresada']);
        $this->model->updateStock($_POST['idInsumo'],$_POST['cantidadIngresada'],$_POST['tipoMovimiento']);
        $this->model->verificarFinOC($_POST['idOC']);
        redirect('fichaOC?idOC='.$_POST['idOC']);
    }



}
