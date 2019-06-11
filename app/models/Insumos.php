<?php

namespace App\Models;

use App\Core\Model;

class Insumos extends Model
{
    protected $table = 'insumos';
    
    public function get()
    {
        $insumos = $this->db->selectAll($this->table);
        $todosInsumos = json_decode(json_encode($insumos), True);
        return $todosInsumos;

    }

   public function buscarInsumo($nombreInsumo){
       //comparo si existe el insumo
       return $this->db->comparaInsumos($this->table,$nombreInsumo);
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
    
}
