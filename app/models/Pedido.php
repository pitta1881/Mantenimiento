<?php

namespace App\Models;

use App\Core\Model;

class Pedido extends Model{
    
    protected $table = 'pedido';
    protected $tableTarea = 'tarea';
    protected $tableEspecializacion='especializacion';

    //ESTO ESTA HARDCODEADO PARA MUESTRAR ALGO NOMAS
    public function getSectores() {
        return array("DAC","CONTABILIDAD","DIRECCION","GUARDIA MEDICA","PABELLON 1","PABELLON 2");
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
}
