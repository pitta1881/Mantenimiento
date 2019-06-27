<?php

namespace App\Models;

use App\Core\Model;

class informes extends Model
{
    protected $table = 'agentes';
    protected $tableEspecializacion='especializacion';
    protected $tableItemAgentes='itemAgente';
    protected $tablePersona ='personas';
     protected $tableSectores ='sectores';
 protected $tablePedidos ='pedido';
      
 

 public function getPermisos($idRol){
    $roles = $this->db->selectPermisosByRol($idRol);
    $misRoles = json_decode(json_encode($roles), True);
    return $misRoles; 
}

 public function getSectores($fechaDesde,$fechaHasta){
     echo "entrooooooooo";
        $datos=$this->db->dameSectores($this->tablePedidos,$this->tableSectores,$fechaDesde,$fechaHasta);
    
        $todosDatos = json_decode(json_encode($datos), True);
     return $todosDatos;
    }
}