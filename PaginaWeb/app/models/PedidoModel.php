<?php

namespace App\Models;

use App\Core\Model;

class PedidoModel extends Model{
    
    protected $table = 'pedido';
    protected $tableTarea = 'tarea';
    protected $tableEspecializacion='especializacion';
    protected $tableSectores='sectores';
    protected $tableItemAgentes='itemAgente';
    protected $tableOT = 'OrdenDeTrabajo';
    protected $tableItemOT='itemot';
    protected $tableEvento='eventos';
    protected $tableItemInsumo = 'iteminsumo';

    public function getSectores() {
        return $this->db->selectWhat($this->tableSectores,'idSector, nombreSector');
    }

    public function getPrioridades() {
        return array("Baja","Media","Alta","Urgente");
    }

    public function getEstados() {
        return array("Iniciado","En Curso","Pendiente","Finalizado");
    }


    public function get($table, $datos = null){
        $pedidos = $this->db->selectAll($this->table);    
        foreach ($pedidos as &$miPedido) {
            $miPedido['nombreSector'] = $this->db->selectWhatWhere($this->tableSectores,'nombreSector',array('idSector' => $miPedido['idSector']))[0]['nombreSector'];
            $miPedido['tareasAsignadas'] = $this->db->countTareasAsignadas($this->tableTarea,$miPedido['id'])[0][0];
            if (is_null($miPedido['fechaFin'])){
                $miPedido['fechaFin'] = $miPedido['estado'];
            }
        }  
        return $pedidos;
    }
    
   
    public function getByIdPedido($id){        
        $pedido = $this->db->selectNumeroPedido($this->table,$id);
        $miPedido = json_decode(json_encode($pedido[0]), True);
        $tareas = $this->getTareasByIdPedido($id);
        if (is_null($miPedido['fechaFin'])) {
            $miPedido['fechaFin'] = 'En Curso';
        }
        $miPedido['nombreSector'] = $this->db->selectWhatWhere($this->tableSectores,'nombreSector',array('idSector' => $miPedido['idSector']))[0]['nombreSector'];
        $miPedido['tareas'] = $tareas;
        return $miPedido;
    }


    public function getTareasByIdPedido($idPedido){
        $tareas = $this->db->selectTareasPorNPedido($this->tableTarea,$idPedido);
        $todasTareas = json_decode(json_encode($tareas), True);
        for ($i=0; $i < count($todasTareas); $i++) { 
            $todasTareas[$i]['especializacionNombre']=$this->getNombreEspecializacionPorId($todasTareas[$i]['idEspecializacion']);
            $todasTareas[$i]['agentesAsignados']=$this->getAgentesAsignadosPorIdId($idPedido,$todasTareas[$i]['idTarea']);
            $todasTareas[$i]['insumosAsignados']=$this->getInsumosAsignadosPorIdId($idPedido,$todasTareas[$i]['idTarea']);
            $todasTareas[$i]['idOT']=$this->getOTByIdId($idPedido,$todasTareas[$i]['idTarea']);
          }
          return $todasTareas;
    }

    public function getTareaEspecializaciones(){
        $tarea = new Tarea();
        return $tarea->getEspecializaciones();
    }    

    public function getNombreEspecializacionPorId($idEspecializacion) {
        $nombre = $this->db->getNombreFromIdEspecializacion($this->tableEspecializacion, $idEspecializacion);
        return $nombre[0][0];
      }

      public function getAgentesAsignadosPorIdId($idPedido, $idTarea) {
        $cantidad = $this->db->getAgentesAsignadosPorIdId($this->tableItemAgentes, $idPedido, $idTarea);
        return $cantidad[0][0];
      }

      public function getInsumosAsignadosPorIdId($idPedido, $idTarea) {
        $cantidad = $this->db->getInsumosAsignadosPorIdId($this->tableItemInsumo, $idPedido, $idTarea);
        return $cantidad[0][0];
      }

    public function getOTByIdId($idPedido, $idTarea){
        $miOTid['idOT'] = "";
        $OTid = $this->db->selectOTPorNPedidoNTarea($this->tableOT,$this->tableItemOT,$idPedido,$idTarea);
        if (!empty($OTid)) {
            $miOTid = json_decode(json_encode($OTid[0]), True);
        }        
        return $miOTid['idOT'];
    }

}
