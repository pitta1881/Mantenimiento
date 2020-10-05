<?php

namespace App\Models;

use App\Core\Model;

class InsumoModel extends Model
{
    protected $table = 'insumo';
    protected $tableItemInsumo = 'iteminsumo';
    protected $tableMovimiento = 'movimiento';
    

    public function getUnidades() {
        return array("unidad","g","Kg","cm","m","ml","l","cm3","m3");
    }

   public function buscarInsumo($nombreInsumo, $descripcion){
       //comparo si existe el insumo
       return $this->db->comparaInsumos($this->table,$nombreInsumo, $descripcion);
    }



  public function verInsumosDisponibles(){
    $insumos = $this->db->selectInsumosDisponibles($this->table);
    $misInsumos = json_decode(json_encode($insumos), True);
    return $misInsumos;
    }


    public function insertItem(array $datos)
    {
        return $this->db->insert($this->tableItemInsumo, $datos);
    }

    public function registrarMovimiento($idInsumo,$datos,$cantidad){
        $oldStock = $this->db->getStock($this->table,$idInsumo);
        if ($datos['tipoMovimiento'] == 0) {
            $newStock = $oldStock[0][0] + $cantidad;
        } else {
            $newStock = $oldStock[0][0] - $cantidad;
        }
        $datos['fechaMovimiento'] = date("Y-m-d");
        $datos['oldStock'] = $oldStock[0][0];
        $datos['newStock'] = $newStock;
        return $this->db->insert($this->tableMovimiento,$datos);
    }

    public function updateStock($idInsumo,$cantidad,$tipo){
        if ($tipo == 0) {
            $this->db->sumarInsumo($this->table,$idInsumo,$cantidad);
        } else {
            $this->db->restarInsumo($this->table,$idInsumo,$cantidad);
        }        
    }

    public function verHistorial($idInsumo){
        $historias = $this->db->selectHistoriasInsumo($this->tableMovimiento,$idInsumo);
        $misHistorias = json_decode(json_encode($historias), True);
        for ($i=0; $i < count($misHistorias); $i++) { 
            $nombre = $this->db->getNombreInsumoFromId($this->table,$misHistorias[$i]['idInsumo'])[0];
            $misHistorias[$i]['nombreDescripcion'] = $nombre[0].' '.$nombre[1];
            $misHistorias[$i]['fechaMovimiento'] = date("d/m/Y", strtotime($misHistorias[$i]['fechaMovimiento']));
            if ($misHistorias[$i]['tipoMovimiento'] == 0) {
                $misHistorias[$i]['tipoMovimiento'] = 'Sumo Stock';
            } else {
                $misHistorias[$i]['tipoMovimiento'] = 'Resto Stock';
            }
            $misHistorias[$i]['cantidad'] = abs($misHistorias[$i]['oldStock'] - $misHistorias[$i]['newStock']);
        }
        return $misHistorias;
    }

    public function verHistorialParticular($idPedido,$idTarea,$idInsumo){
        $historias = $this->db->selectHistoriasInsumoPorIdIdId($this->tableMovimiento,$idPedido,$idTarea,$idInsumo);
        $misHistorias = json_decode(json_encode($historias), True);
        for ($i=0; $i < count($misHistorias); $i++) { 
            $nombre = $this->db->getNombreInsumoFromId($this->table,$misHistorias[$i]['idInsumo'])[0];
            $misHistorias[$i]['nombreDescripcion'] = $nombre[0].' '.$nombre[1];
            $misHistorias[$i]['fechaMovimiento'] = date("d/m/Y", strtotime($misHistorias[$i]['fechaMovimiento']));
            if ($misHistorias[$i]['tipoMovimiento'] == 0) {
                $misHistorias[$i]['tipoMovimiento'] = 'Resto Stock';
            } else {
                $misHistorias[$i]['tipoMovimiento'] = 'Sumo Stock';
            }
            $misHistorias[$i]['cantidad'] = abs($misHistorias[$i]['oldStock'] - $misHistorias[$i]['newStock']);
            if ($i == 0) {
                $misHistorias[$i]['oldStock'] = '-';
                $misHistorias[$i]['newStock'] = $misHistorias[$i]['cantidad'];
            } else {
                $misHistorias[$i]['oldStock'] = $misHistorias[$i-1]['newStock'];
                if ($misHistorias[$i]['tipoMovimiento'] == 'Resto Stock') {
                    $misHistorias[$i]['newStock'] = abs($misHistorias[$i]['oldStock']-$misHistorias[$i]['cantidad']);
                } else {                    
                    $misHistorias[$i]['newStock'] = abs($misHistorias[$i]['oldStock']+$misHistorias[$i]['cantidad']);
                }
            }
            
            
        }
        return $misHistorias;
    }

    public function verInsumosUsados($idPedido,$idTarea){
        $insumosUsados = $this->db->selectInsumosUsados($this->tableItemInsumo, $this->table,$idPedido,$idTarea);
        $misInsumos = json_decode(json_encode($insumosUsados), True);
        return $misInsumos;
        }

        public function updateItem(array $datos,$tipo)
        {
            $cantidadActual = $this->db->selectCantidadByIdIdId($this->tableItemInsumo, $datos['idPedido'],$datos['idTarea'],$datos['idInsumo']);
            $cantidadActual2 = json_decode(json_encode($cantidadActual[0][0]),true);
            if ($tipo == 1) {
                $cantidad = $cantidadActual2 + $datos['cantidad'];
            } else {
                $cantidad = $cantidadActual2 - $datos['cantidad'];
            }
            if ($cantidad == 0) {
                $this->db->deleteItemInsumo($this->tableItemInsumo, $datos['idPedido'],$datos['idTarea'],$datos['idInsumo']);
            } else {
                $this->db->updateItemInsumo($this->tableItemInsumo, $datos,$tipo);
            }           
        }
    
}

