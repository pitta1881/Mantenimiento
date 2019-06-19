<?php

namespace App\Models;

use App\Core\Model;

class Sectores extends Model
{
    protected $table = 'sectores';
    protected $tablePedido = 'pedido';
    protected $size_pagina=2;

    public function getTipoSector(){
        return array('Hospital','Casa Comunitaria','Casa Particular');
    }
    
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
            foreach ($datos as $key => $value) {
                if (is_null($value) || $value == '') {
                    $todosSectores[$indice][$key] = '-';
                }
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
        $miSector = json_decode(json_encode($sector[0]), True);  
        foreach ($miSector as $key => $value) {
            if (is_null($value) || $value == '') {
                $miSector[$key] = '-';
            }
        }
        return $miSector;
    }

    public function update(array $datos,$idSector)
    {
        $this->db->updateSector($this->table, $datos,$idSector);
    }

    public function delete($nSector){
        
        $this->db->deleteSector($this->table,$nSector);
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
        $sectores = $this->db->getAllLimit($this->table,$empezar_desde,$this->size_pagina);    
        $todosSectores = json_decode(json_encode($sectores), True);
        foreach ($todosSectores as $indice => $datos) {
            $yaEstaUsado = [];
            $yaEstaUsado = $this->db->getFromPedidoConIdSector($this->tablePedido,$todosSectores[$indice]['idSector']);
            if(empty($yaEstaUsado)){
                $todosSectores[$indice]['usado'] = false;
            } else{
                $todosSectores[$indice]['usado'] = true;
            }
            foreach ($datos as $key => $value) {
                if (is_null($value) || $value == '') {
                    $todosSectores[$indice][$key] = '-';
                }
            }
        }
        return $todosSectores;
    }
}
