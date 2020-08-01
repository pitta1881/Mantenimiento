<?php

namespace App\Models;

use App\Core\Model;

class AgenteModel extends Model
{
    protected $table = 'agentes';
    protected $tableEspecializacion='especializacion';
    protected $tableItemAgentes='itemAgente';
    protected $tablePersona = 'personas';
    
   
   public function get($table, $datos = null){
        $agentes = $this->db->selectAll($this->table);
        foreach ($agentes as &$miAgente){ 
          $miAgente['especializacionNombre']=$this->db->selectWhatWhere($this->tableEspecializacion,'nombre',array('idEspecializacion' => $miAgente['idEspecializacion']))[0]['nombre'];
          $persona = $this->db->selectWhatWhere($this->tablePersona,'nombre,apellido',array('dni' => $miAgente['idAgente']))[0];
          $miAgente['nombre']=$persona['nombre'];
          $miAgente['apellido']=$persona['apellido'];
          if($this->db->buscarIfExists($this->tableItemAgentes,$miAgente)){
            $miAgente['usado'] = true;
          } else {
            $miAgente['usado'] = false;
          }
        }
        return $agentes;
    }

    public function getEspecializaciones() {
      return $this->db->selectWhat($this->tableEspecializacion,'idEspecializacion, nombre');
    }

    
    public function getPersonasNoAgentes(){
      return $this->db->selectPersonasNoAgentes($this->tablePersona,$this->table);
    }
}

