<?php

namespace App\Models;

use App\Core\Model;

class Agentes extends Model
{
    protected $table = 'agentes';
    protected $tableEspecializacion='especializacion';
    protected $tableItemAgentes='itemAgente';
    protected $tablePersona = 'personas';
    protected $size_pagina=2;

    public function getEspecializaciones() {
      $array = [];
      $especializaciones = $this->db->getEspecializaciones($this->tableEspecializacion);
      $misEspecializaciones = json_decode(json_encode($especializaciones), True);
      /*for ($i=0; $i < count($misEspecializaciones); $i++) { 
        $array[$i]=$misEspecializaciones[$i]['nombre'];
      }*/
      return $misEspecializaciones;
  }

    
   public function get()
    {
        $agentes = $this->db->selectAll($this->table);
        $todosAgentes = json_decode(json_encode($agentes), True);
        for ($i=0; $i < count($todosAgentes); $i++) { 
          $todosAgentes[$i]['especializacionNombre']=$this->getNombreEspecializacionPorId($todosAgentes[$i]['idEspecializacion']);
          $persona = $this->getPersonaPorId($todosAgentes[$i]['idAgente']);
          $todosAgentes[$i]['nombre']=$persona['nombre'];
          $todosAgentes[$i]['apellido']=$persona['apellido'];
          $yaEstaUsado = [];
          $yaEstaUsado = $this->db->getFromItemAgenteConIdAgente($this->tableItemAgentes,$todosAgentes[$i]['idAgente']);
          if(empty($yaEstaUsado)){
            $todosAgentes[$i]['usado'] = false;
        } else{
            $todosAgentes[$i]['usado'] = true;
        }
        }
        return $todosAgentes;
    }

    public function insert(array $datos){
      $this->db->insert($this->table, $datos);
    }


    public function getByIdAgente($idAgente){
      $agente = $this->db->selectAgenteById($this->table,$idAgente);
      $miAgente = json_decode(json_encode($agente[0]), True);  
      $persona = $this->getPersonaPorId($idAgente);
      $miAgente['nombre']=$persona['nombre'];
      $miAgente['apellido']=$persona['apellido'];
      $miAgente['especializacionNombre']=$this->getNombreEspecializacionPorId($miAgente['idEspecializacion']);
      return $miAgente;
    }

    public function update(array $datos,$idAgente)
    {
        $this->db->updateAgente($this->table, $datos,$idAgente);
    }

    public function delete($nAgente){
      //habria que verificar que el insumo no este asignado a una tarea
      $this->db->deleteAgente($this->table,$nAgente);
    }  

    public function getIdEspecializacionPorNombre($nombreEspecializacion) {
      $id = $this->db->getIdFromNombreEspecializacion($this->tableEspecializacion, $nombreEspecializacion);
      return $id[0][0];
    } 
    
    public function getNombreEspecializacionPorId($idEspecializacion) {
      $nombre = $this->db->getNombreFromIdEspecializacion($this->tableEspecializacion, $idEspecializacion);
      return $nombre[0][0];
    } 

    public function getPersonasNoAgentes(){
      $personas = $this->db->selectPersonasNoAgentes($this->tablePersona,$this->table);
      $personasNoAgentes = json_decode(json_encode($personas), True);  
      return $personasNoAgentes;
    }

    public function getPersonaPorId($idAgente){
      $persona = $this->db->selectPersonaByDNI($this->tablePersona,$idAgente);
      $miPersona = json_decode(json_encode($persona[0]), True);  
      return $miPersona;
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
      $agentes = $this->db->getAllLimit($this->table,$empezar_desde,$this->size_pagina);
      $todosAgentes = json_decode(json_encode($agentes), True);
      for ($i=0; $i < count($todosAgentes); $i++) { 
        $todosAgentes[$i]['especializacionNombre']=$this->getNombreEspecializacionPorId($todosAgentes[$i]['idEspecializacion']);
        $persona = $this->getPersonaPorId($todosAgentes[$i]['idAgente']);
        $todosAgentes[$i]['nombre']=$persona['nombre'];
        $todosAgentes[$i]['apellido']=$persona['apellido'];
        $yaEstaUsado = [];
        $yaEstaUsado = $this->db->getFromItemAgenteConIdAgente($this->tableItemAgentes,$todosAgentes[$i]['idAgente']);
        if(empty($yaEstaUsado)){
          $todosAgentes[$i]['usado'] = false;
      } else{
          $todosAgentes[$i]['usado'] = true;
      }
      }
      return $todosAgentes;
  }



}

