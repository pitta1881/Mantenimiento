<?php

namespace App\Models;

use App\Core\Model;

class Roles extends Model{
    protected $table = 'roles';
    protected $tablePermisos = 'permisos';
    protected $size_pagina=2;

/*
    public function get(){
            $roles = $this->db->selectAllRoles($this->tableRol);
            $misRoles = json_decode(json_encode($roles), True);
            return $misRoles; 
    }
    
/*

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
    */

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
        $roles = $this->db->getAllLimit($this->table,$empezar_desde,$this->size_pagina);    
        $todosRoles = json_decode(json_encode($roles), True);

        return $todosRoles;
    }
}