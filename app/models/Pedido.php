<?php

namespace App\Models;

use App\Core\Model;

class Pedido extends Model{
    
    protected $table = 'pedido';
    protected $tableTarea = 'tarea';
    protected $tableEspecializacion='especializacion';
    protected $tableSectores='sectores';
    protected $tableItemAgentes='itemAgente';

    //ESTO ESTA HARDCODEADO PARA MUESTRAR ALGO NOMAS
    public function getSectores() {
        $array;
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
        $miPedido = json_decode(json_encode($pedido), True);
        $tareas = $this->getTareasByIdPedido($id);
        $miPedido[0]['fechaInicio'] = date("d/m/Y",strtotime($miPedido[0]['fechaInicio']));
        $miPedido[0]['nombreSector'] = $this->getNombreSectorPorId($miPedido[0]['idSector']);
        $miPedido[0]['tareas'] = $tareas;
        return $miPedido[0];
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
}
