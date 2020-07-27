<?php

namespace App\Models;

use App\Core\Model;

class OrdenDeCompra extends Model
{
    protected $table = 'OrdenDeCompra';
    protected $tableItemOC = 'itemOC';
    protected $tableInsumo = 'insumo';
    protected $tableItemInsumo = 'iteminsumo';
    protected $tableMovimiento = 'movimiento';

    public function get(){
        $oc = $this->db->selectAll($this->table);
        $todasOC = json_decode(json_encode($oc), True);
        foreach ($todasOC as $indice => $datos) {
            $todasOC[$indice]['cantInsumos'] = $this->getCantInsumosAsignadas($datos['idOC']);
            foreach ($datos as $key => $value) {
                if ($key == 'fecha') {
                    $todasOC[$indice]['fecha'] = date("d/m/Y", strtotime($todasOC[$indice]['fecha']));
                }
            }        
        }
        return $todasOC;
    }
    
    public function getPermisos($idRol){
        $roles = $this->db->selectPermisosByRol($idRol);
        $misRoles = json_decode(json_encode($roles), True);
        return $misRoles; 
    }

    public function getInsumos(){
        $insumos = $this->db->selectAll($this->tableInsumo);
        $todosInsumos = json_decode(json_encode($insumos), True);
        return $todosInsumos;
    }

    public function newOC($costo,$estado){
        $this->db->newOC($this->table,$costo,$estado);
        $ultimoOC = $this->db->getIdUltimoOC($this->table);
        if (is_null($ultimoOC)){
            $ultimoOC = 0;
        }
        return $ultimoOC[0][0];
    }

    public function insertItemOC($datos){
        return $this->db->insert($this->tableItemOC,$datos);
    }

    public function getCantInsumosAsignadas($idOC){
        $contadorInsumos = $this->db->getCantInsumosOC($this->tableItemOC,$idOC);
        return $contadorInsumos[0][0];
    }

    public function getByIdOC($idOC){
        $OC = $this->db->selectOCById($this->table,$idOC);
        $miOC = json_decode(json_encode($OC[0]), True);
        $miOC['fecha'] = date("d/m/Y", strtotime($miOC['fecha']));
        $miOC['insumos'] = $this->getInsumosByIdOC($miOC['idOC']);
        return $miOC;
    }
    
    public function getInsumosByIdOC($idOC){
        $insumos = $this->db->selectInsumosPorNOC($this->tableInsumo,$this->tableItemOC,$idOC);
        $todosInsumos = json_decode(json_encode($insumos), True);
        return $todosInsumos;
    }

    public function updateItemOC(array $datos){
        $this->db->updateItemOC($this->tableItemOC, $datos);           
    }

    public function registrarMovimiento($idInsumo,$datos,$cantidad){
        $oldStock = $this->db->getStock($this->tableInsumo,$idInsumo);
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
            $this->db->sumarInsumo($this->tableInsumo,$idInsumo,$cantidad);
        } else {
            $this->db->restarInsumo($this->tableInsumo,$idInsumo,$cantidad);
        }        
    }

    public function verificarFinOC($idOC){
        $estadoFinOC = true;
        $itemInsumos = $this->db->selectItemOCPorNOC($this->tableItemOC,$idOC);
        $todosItemInsumos = json_decode(json_encode($itemInsumos), True);
        for ($i=0; $i < count($todosItemInsumos); $i++) { 
            if ($todosItemInsumos[$i]['cantidad'] != $todosItemInsumos[$i]['cantidadIngresada']) {
                $estadoFinOC = false;
            }
        }
        if ($estadoFinOC) {
            $this->db->updateEstadoOC($this->table,$idOC,'Finalizado');
        }
    }
}
