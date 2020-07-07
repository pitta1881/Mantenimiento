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
      protected $tableTarea ='tarea';


 public function getPermisos($idRol){
    $roles = $this->db->selectPermisosByRol($idRol);
    $misRoles = json_decode(json_encode($roles), True);
    return $misRoles; 
}

 public function getSectores($fechaDesde,$fechaHasta){
     
        $datos=$this->db->dameSectores($this->tablePedidos,$this->tableSectores,$fechaDesde,$fechaHasta);
    
        $todosDatos = json_decode(json_encode($datos), True);
  
     return $todosDatos;
    }

public function getEspXtarea($fechaDesde,$fechaHasta){
    $datosEsp=$datos=$this->db->dameinformeEspe($this->tableTarea,$this->tableEspecializacion,$this->tablePedidos,$fechaDesde,$fechaHasta);
    $todosDatos = json_decode(json_encode($datosEsp), True);
   
     return $todosDatos;
}

    public function getEstados($fechaDesde,$fechaHasta){
         $datosEstados=$this->db->dameinformeEstado($this->tablePedidos,$fechaDesde,$fechaHasta);
    $todosEstados = json_decode(json_encode($datosEstados), True);
  
     return $todosEstados;
    }
    
}