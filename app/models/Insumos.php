<?php

namespace App\Models;

use App\Core\Model;

class Insumos extends Model
{
    protected $table = 'insumo';
    protected $tableItemInsumo = 'iteminsumo';
    protected $tableMovimiento = 'movimiento';
    protected $size_pagina=2;

    public function get(){
        $insumos = $this->db->selectAll($this->table);
        $todosInsumos = json_decode(json_encode($insumos), True);
        for ($i=0; $i < count($todosInsumos); $i++) { 
            $bool = $this->boolEliminarInsumo($todosInsumos[$i]['idInsumo']);
            if ($bool) {
                $todosInsumos[$i]['eliminarBool'] = true;
            } else {
                $todosInsumos[$i]['eliminarBool'] = false;
            }
        }
        return $todosInsumos;
    }

    public function boolEliminarInsumo($idInsumo){
        $bool = false;
        $cantidad = $this->db->selectCantidadInsumoItem($this->tableItemInsumo,$idInsumo);
        if (is_null($cantidad[0][0])) {
            $bool = true;
        }
        return $bool;
    }

   public function buscarInsumo($nombreInsumo, $descripcion){
       //comparo si existe el insumo
       return $this->db->comparaInsumos($this->table,$nombreInsumo, $descripcion);
    }

    public function insert(array $datos)
    {
        $this->db->insert($this->table, $datos);
    }

    public function getByIdInsumo($idInsumo){
        $insumo = $this->db->selectInsumoById($this->table,$idInsumo);
        $miInsumo = json_decode(json_encode($insumo), True);  
        return $miInsumo[0];
    }

    public function update(array $datos,$idInsumo)
    {
        $this->db->updateInsumo($this->table, $datos,$idInsumo);
    }

    public function delete($nInsumo){
        //habria que verificar que el insumo no este asignado a una tarea
        $this->db->deleteInsumo($this->table,$nInsumo);
     }  

   
    public function getSize(){
      $num_filas= $this->db->getSize($this->table);
      $total_paginas= ceil($num_filas/$this->size_pagina);
      return $total_paginas;
  }    

  public function getPaginacion($page){
      $pagina=$page;
      $empezar_desde=($pagina-1)*$this->size_pagina;
      $num_filas= $this->getSize();
      $total_paginas= ceil($num_filas/$this->size_pagina);
      $insumos = $this->db->getAllLimit($this->table,$empezar_desde,$this->size_pagina);
      $todosInsumos = json_decode(json_encode($insumos), True);
     return $todosInsumos;
  }

  public function verInsumosDisponibles(){
    $insumos = $this->db->selectInsumosDisponibles($this->table);
    $misInsumos = json_decode(json_encode($insumos), True);
    return $misInsumos;
    }


    public function insertItem(array $datos)
    {
        $this->db->insert($this->tableItemInsumo, $datos);
    }

    public function registrarMovimiento($idInsumo,$cantidad,$tipo){
        $oldStock = $this->db->getStock($this->table,$idInsumo);
        if ($tipo == 0) {
            $newStock = $oldStock[0][0] + $cantidad;
        } else {
            $newStock = $oldStock[0][0] - $cantidad;
        }
        $datos = [
            'idInsumo' => $idInsumo,
            'fechaMovimiento' => date("Y-m-d"),
            'tipoMovimiento' => $tipo,
            'oldStock' => $oldStock[0][0],
            'newStock' => $newStock            
        ];
        $this->db->insert($this->tableMovimiento,$datos);
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
        }
        return $misHistorias;
    }

    
}

