<?php

namespace App\Models;

use App\Core\Model;

class Insumos extends Model
{
    protected $table = 'insumos';
    
 /*   public function get()
    {
        $insumos = $this->db->selectAll($this->table);
    }
*/
   public function buscarInsumo($nombreInsumo){
       //comparo si existe el insumo
       return $this->db->comparaInsumo($this->table,$nombreInsumo);
    }

    public function insert(array $datos)
    {
        $this->db->insert($this->table, $datos);
    }

 /*   public function update (array $usuarioModificado,$nombre)
    {
        $this->db->update($this->table, $usuarioModificado,$nombre);
    }

public function getRoles(){
    $roles = $this->db->selectAllRoles($this->tableRol);
    $misRoles = json_decode(json_encode($roles), True);
    return $misRoles; 
}
   
    
*/    
}
