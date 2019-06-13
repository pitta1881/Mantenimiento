<?php

namespace App\Models;

use App\Core\Model;

class Sectores extends Model
{
    protected $table = 'sectores';
    protected $tablePedido = 'pedido';
    
    public function get()
    {
        $sectores = $this->db->selectAll($this->table);
        $todosSectores = json_decode(json_encode($sectores), True);
        foreach ($todosSectores as $indice => $datos) {
            $yaEstaUsado = [];
            $yaEstaUsado = $this->db->getFromPedidoConIdSector($this->tablePedido,$todosSectores[$indice]['idSector']);
            if(empty($yaEstaUsado)){
                $todosSectores[$indice]['usado'] = false;
            } else{
                $todosSectores[$indice]['usado'] = true;
            }
        }
        return $todosSectores;
    }

   public function buscarSector($nombreSector){
       //comparo si existe el sector
     
       return $this->db->comparaSectores($this->table,$nombreSector);
    }

    public function insert(array $datos)
    {
        $this->db->insert($this->table, $datos);
    }

    public function getByIdSector($idSector){
        $sector = $this->db->selectSectorById($this->table,$idSector);
        $miSector = json_decode(json_encode($sector), True);  
        return $miSector[0];
    }

    public function update(array $datos,$idSector)
    {
        $this->db->updateSector($this->table, $datos,$idSector);
    }

    public function delete($nSector){
        
        $this->db->deleteSector($this->table,$nSector);
     }  
    
}
