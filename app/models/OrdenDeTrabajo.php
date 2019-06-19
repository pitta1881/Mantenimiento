<?php

namespace App\Models;

use App\Core\Model;

class OrdenDeTrabajo extends Model
{
    protected $tableOT = 'OrdenDeTrabajo';
    protected $tableItem = 'itemOT';
    protected $tableTarea = 'tarea';
    protected $tableEspecializacion='especializacion';
    protected $tablePedido='pedido';
    protected $tableSector='sectores';
    protected $tableAgentes='agentes';
    protected $tableItemAgentes='itemAgente';
    protected $tablePersona = 'personas';
    protected $size_pagina=2;

    public function get(){
        $ot = $this->db->selectAll($this->tableOT);
        $todasOT = json_decode(json_encode($ot), True);
        foreach ($todasOT as $indice => $datos) {
            $todasOT[$indice]['cantTareas'] = $this->getCantTareasAsignadas($datos['idOT']);
            foreach ($datos as $key => $value) {
                if ($key == 'fechaInicio') {
                    $todasOT[$indice]['fechaInicio'] = date("d/m/Y", strtotime($todasOT[$indice]['fechaInicio']));
                }
                if (($key == 'fechaFin') && (is_null($value))) {
                    $todasOT[$indice]['fechaFin'] = 'En Curso';
                } elseif (($key == 'fechaFin') && (!is_null($value))) {
                    $todasOT[$indice]['fechaFin'] = date("d/m/Y", strtotime($todasOT[$indice]['fechaFin']));
                }
            }        
        }
        return $todasOT;
    }

    public function verTareasSinAsignar(){
        $tareas = $this->db->selectTareasSinAsignar($this->tableTarea);
        $misTareas = json_decode(json_encode($tareas), True);
        for ($i=0; $i < count($misTareas); $i++) { 
            $misTareas[$i]['especializacionNombre']=$this->getNombreEspecializacionPorId($misTareas[$i]['idEspecializacion']);
          }
        return $misTareas;
    }

    public function newOT(){
        $this->db->newOT($this->tableOT);
        $ultimoOT = $this->db->getIdUltimoOT($this->tableOT);
        if (is_null($ultimoOT)){
            $ultimoOT = 0;
        }
        return $ultimoOT[0][0];
    }

    public function insertItemOT($datos){
        $this->db->insert($this->tableItem,$datos);
    }

    public function updateEstadoTarea($idPedido,$idTarea,$estado){
        $this->db->updateEstadoTarea($this->tableTarea,$idPedido,$idTarea,$estado);
    }

    public function getCantTareasAsignadas($idOT){
        $contadorTareas = $this->db->getCantTareasOT($this->tableItem,$idOT);
        return $contadorTareas[0][0];
    }

    public function getNombreEspecializacionPorId($idEspecializacion) {
        $nombre = $this->db->getNombreFromIdEspecializacion($this->tableEspecializacion, $idEspecializacion);
        return $nombre[0][0];
      } 

    public function getNombreSectorPorIdPedido($idPedido) {
    $nombre = $this->db->getNombreSectorPorIdPedido($this->tablePedido, $this->tableSector, $idPedido);
    return $nombre[0][0];
    } 

    public function getByIdOT($idOT){
        $OT = $this->db->selectOTById($this->tableOT,$idOT);
        $miOT = json_decode(json_encode($OT[0]), True);
        $miOT['fechaInicio'] = date("d/m/Y", strtotime($miOT['fechaInicio']));
        if (is_null($miOT['fechaFin'])) {
            $miOT['fechaFin'] = 'En Curso';
        } else {
            $miOT['fechaFin'] = date("d/m/Y", strtotime($miOT['fechaFin']));
        }
        $miOT['tareas'] = $this->getTareasByIdOT($miOT['idOT']);
        return $miOT;
    }

    public function getTareasByIdOT($idOT){
        $tareas = $this->db->selectTareasPorNOT($this->tableTarea,$this->tableItem,$idOT);
        $todasTareas = json_decode(json_encode($tareas), True);
        for ($i=0; $i < count($todasTareas); $i++) { 
            $todasTareas[$i]['especializacionNombre']=$this->getNombreEspecializacionPorId($todasTareas[$i]['idEspecializacion']);
            $todasTareas[$i]['sector']=$this->getNombreSectorPorIdPedido($todasTareas[$i]['idPedido']);
            $todasTareas[$i]['agentes']=$this->getAgentesByIdId($todasTareas[$i]['idPedido'],$todasTareas[$i]['idTarea']);
        }
        return $todasTareas;
    }

    public function getAgentesByIdId($idPedido, $idTarea){
        $agentes = $this->db->selectAgentesPorNPedidoNTarea($this->tableAgentes,$this->tableItemAgentes,$idPedido,$idTarea);
        $todosAgentes = json_decode(json_encode($agentes), True);
        for ($i=0; $i < count($todosAgentes); $i++) { 
            $persona = $this->getPersonaPorId($todosAgentes[$i]['idAgente']);
            $todosAgentes[$i]['nombre']=$persona['nombre'];
            $todosAgentes[$i]['apellido']=$persona['apellido'];
          }
          return $todosAgentes;
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
      $ot = $this->db->getAllLimit($this->table,$empezar_desde,$this->size_pagina);
      $todasOT = json_decode(json_encode($ot), True);
      foreach ($todasOT as $indice => $datos) {
          $todasOT[$indice]['cantTareas'] = $this->getCantTareasAsignadas($datos['idOT']);
          foreach ($datos as $key => $value) {
              if ($key == 'fechaInicio') {
                  $todasOT[$indice]['fechaInicio'] = date("d/m/Y", strtotime($todasOT[$indice]['fechaInicio']));
              }
              if (($key == 'fechaFin') && (is_null($value))) {
                  $todasOT[$indice]['fechaFin'] = 'En Curso';
              } elseif (($key == 'fechaFin') && (!is_null($value))) {
                  $todasOT[$indice]['fechaFin'] = date("d/m/Y", strtotime($todasOT[$indice]['fechaFin']));
              }
          }        
      }
      return $todasOT;
  }
}
