<?php

namespace App\Models;

use App\Core\Model;

class Pedido extends Model{
    
    protected $table = 'pedido';
    protected $tableTarea = 'tarea';
    protected $tableEspecializacion='especializacion';
    protected $tableSectores='sectores';
    protected $tableItemAgentes='itemAgente';
    protected $tableOT = 'OrdenDeTrabajo';
    protected $tableItemOT='itemot';
    protected $tableEvento='eventos';
    protected $size_pagina=2;

    public function getSectores() {
        $array = [];
        $sectores = $this->db->getSectores($this->tableSectores);
        $misSectores = json_decode(json_encode($sectores), True);
        for ($i=0; $i < count($misSectores); $i++) { 
            $array[$i]=$misSectores[$i]['nombreSector'];
        }
        return $array;
    }

    public function getPrioridades() {
        return array("Baja","Media","Alta","Urgente");
    }

    public function getEstados() {
        return array("Iniciado","En Curso","Pendiente","Finalizado");
    }


    public function get(){
        $pedido = $this->db->selectAll($this->table);
        $todosPedidos = json_decode(json_encode($pedido), True);      
        foreach ($todosPedidos as $indice => $datos) {
            $todosPedidos[$indice]['nombreSector'] = $this->getNombreSectorPorId($todosPedidos[$indice]['idSector']);
            foreach ($datos as $key => $value) {
                if ($key == 'id') {
                    $todosPedidos[$indice]['tareasAsignadas'] = $this->getTareasAsignadasAPedido($value);
                }
                if ($key == 'fechaInicio') {
                    $todosPedidos[$indice]['fechaInicio'] = date("d/m/Y", strtotime($todosPedidos[$indice]['fechaInicio']));
                }
                if (($key == 'fechaFin') && (is_null($value))) {
                    $todosPedidos[$indice]['fechaFin'] = 'En Curso';
                } elseif (($key == 'fechaFin') && (!is_null($value))) {
                    $todosPedidos[$indice]['fechaFin'] = date("d/m/Y", strtotime($todosPedidos[$indice]['fechaFin']));
                }
            }
        }  
        return $todosPedidos;
    }
    
    public function getAllbyFilter($filter,$value){
        $pedido = $this->db->buscar($this->table,$filter,$value);
        $miPedido = json_decode(json_encode($pedido), True);
        return $miPedido;
    }
    
   
    public function getByIdPedido($id){        
        $pedido = $this->db->selectNumeroPedido($this->table,$id);
        $miPedido = json_decode(json_encode($pedido[0]), True);
        $tareas = $this->getTareasByIdPedido($id);
        $miPedido['fechaInicio'] = date("d/m/Y",strtotime($miPedido['fechaInicio']));
        if (is_null($miPedido['fechaFin'])) {
            $miPedido['fechaFin'] = 'En Curso';
        } else {
            $miPedido['fechaFin'] = date("d/m/Y", strtotime($miPedido['fechaFin']));
        }
        $miPedido['nombreSector'] = $this->getNombreSectorPorId($miPedido['idSector']);
        $miPedido['tareas'] = $tareas;
        return $miPedido;
    }

    public function insert(array $pedido){
        $this->db->insert($this->table, $pedido);
    }

    public function updatePedido (array $pedidoModificado,$idPedido){
        $this->db->updatePedido($this->table, $pedidoModificado,$idPedido);
    }


    public function getTareasByIdPedido($idPedido){
        $tareas = $this->db->selectTareasPorNPedido($this->tableTarea,$idPedido);
        $todasTareas = json_decode(json_encode($tareas), True);
        for ($i=0; $i < count($todasTareas); $i++) { 
            $todasTareas[$i]['especializacionNombre']=$this->getNombreEspecializacionPorId($todasTareas[$i]['idEspecializacion']);
            $todasTareas[$i]['agentesAsignados']=$this->getAgentesAsignadosPorIdId($idPedido,$todasTareas[$i]['idTarea']);
            $todasTareas[$i]['idOT']=$this->getOTByIdId($idPedido,$todasTareas[$i]['idTarea']);
          }
          return $todasTareas;
    }

    public function getTareasAsignadasAPedido($idPedido){
        $contadorTareasObj = $this->db->countTareasAsignadas($this->tableTarea,$idPedido);
        return $contadorTareasObj[0][0];
    }

    public function getTareaEspecializaciones(){
        $tarea = new Tarea();
        return $tarea->getEspecializaciones();
    }    

    public function getIdUltimoPedido(){
        $ultimo =  $this->db->getIdUltimoPedidoDB($this->table);
        return $ultimo[0][0];
    }

    public function getNombreEspecializacionPorId($idEspecializacion) {
        $nombre = $this->db->getNombreFromIdEspecializacion($this->tableEspecializacion, $idEspecializacion);
        return $nombre[0][0];
      }

      public function getIdSectorPorNombre($nombreSector) {
        $id = $this->db->getIdFromNombreSector($this->tableSectores, $nombreSector);
        return $id[0][0];
      } 

      public function getNombreSectorPorId($idSector) {
        $nombre = $this->db->getNombreFromIdSector($this->tableSectores, $idSector);
        return $nombre[0][0];
      }

      public function getAgentesAsignadosPorIdId($idPedido, $idTarea) {
        $cantidad = $this->db->getAgentesAsignadosPorIdId($this->tableItemAgentes, $idPedido, $idTarea);
        return $cantidad[0][0];
      }

      public function updateEstadoPedido($idPedido,$estado){
        $this->db->updateEstadoPedido($this->table,$idPedido,$estado);
        if ($estado == "Finalizado") {
            $this->db->updateFechaFinPedido($this->table,$idPedido,date("Y-m-d"));
        }
    }

    public function getOTByIdId($idPedido, $idTarea){
        $miOTid['idOT'] = "";
        $OTid = $this->db->selectOTPorNPedidoNTarea($this->tableOT,$this->tableItemOT,$idPedido,$idTarea);
        if (!empty($OTid)) {
            $miOTid = json_decode(json_encode($OTid[0]), True);
        }        
        return $miOTid['idOT'];
    }

    public function eliminarEvento($idEvento){
        $this->db->deleteEventoValidar($this->tableEvento,$idEvento);
    }

    public function getSize(){
        $num_filas= $this->db->getSize("pedido");
        $total_paginas= ceil($num_filas/$this->size_pagina);
        return $total_paginas;
    }    

    public function getPaginacion($page){
        $pagina=$page;
        $empezar_desde=($pagina-1)*$this->size_pagina;
        $num_filas= $this->getSize();
        $total_paginas= ceil($num_filas/$this->size_pagina);
        $pedido = $this->db->getAllLimit('pedido',$empezar_desde,$this->size_pagina);
        $todosPedidos = json_decode(json_encode($pedido), True);      
        foreach ($todosPedidos as $indice => $datos) {
            $todosPedidos[$indice]['nombreSector'] = $this->getNombreSectorPorId($todosPedidos[$indice]['idSector']);
            foreach ($datos as $key => $value) {
                if ($key == 'id') {
                    $todosPedidos[$indice]['tareasAsignadas'] = $this->getTareasAsignadasAPedido($value);
                }
                if ($key == 'fechaInicio') {
                    $todosPedidos[$indice]['fechaInicio'] = date("d/m/Y", strtotime($todosPedidos[$indice]['fechaInicio']));
                }
                if (($key == 'fechaFin') && (is_null($value))) {
                    $todosPedidos[$indice]['fechaFin'] = 'En Curso';
                } elseif (($key == 'fechaFin') && (!is_null($value))) {
                    $todosPedidos[$indice]['fechaFin'] = date("d/m/Y", strtotime($todosPedidos[$indice]['fechaFin']));
                }
            }
        }  
        return $todosPedidos;








       
    }

}
