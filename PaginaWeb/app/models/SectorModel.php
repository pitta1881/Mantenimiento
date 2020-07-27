<?php

namespace App\Models;

use App\Core\Model;

class SectorModel extends Model
{
    protected $table = 'sectores';
    protected $tablePedido = 'pedido';
    

    public function getPermisos($idRol){
        $roles = $this->db->selectPermisosByRol($idRol);
        $misRoles = json_decode(json_encode($roles), True);
        return $misRoles; 
    }


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

    public function insert(array $datos){
        if(!($this->db->buscarIfExists($this->table,$datos))){
            return $this->db->insert($this->table, $datos);
            } else {
            return false;
          }
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

    public function update (array $datos){
        if($this->db->update($this->table, $datos)){
            return true;
        } else {
            return false;
        }
    }
    public function delete($nSector){
        
        $this->db->deleteSector($this->table,$nSector);
     }  
}
