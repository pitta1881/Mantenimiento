<?php

namespace App\Models;

use App\Core\Model;

class Pedido extends Model{
    
    protected $table = 'pedido';
    protected $tableTarea = 'tarea';

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
        $miPedido = json_decode(json_encode($pedido), True);
        foreach ($miPedido as $key => $value) {
            $miPedido[$key]['sector'] = str_replace("_"," ",$value['sector']);
        }        
        return $miPedido;
    }
    
    public function getAllbyFilter($filter,$value){
        $pedido = $this->db->buscar($this->table,$filter,$value);
        $miPedido = json_decode(json_encode($pedido), True);
        foreach ($miPedido as $key => $value) {
            $miPedido[$key]['sector'] = str_replace("_"," ",$value['sector']);
        }        
        return $miPedido;
    }
    
   
    public function getByIdPedido($id){        
        $pedido = $this->db->selectNumeroPedido($this->table,$id);
        $miPedido = json_decode(json_encode($pedido), True);
        $miPedido[0]['sector'] = str_replace("_"," ",$miPedido[0]['sector']);
        return $miPedido;
    }

    public function insert(array $pedido){
        $this->db->insert($this->table, $pedido);
    }

    public function updatePedido (array $pedidoModificado,$idPedido){
        $this->db->updatePedido($this->table, $pedidoModificado,$idPedido);
    }


    public function getTareasByIdPedido($idPedido){
        return $this->db->selectTareasPorNPedido($this->tableTarea,$idPedido);
    }

    public function getTareasAsignadasAPedido($idPedido){
        $contadorTareasObj = $this->db->countTareasAsignadas($this->tableTarea,$idPedido);
     //   echo $contadorTareasObj[0][0];
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
}
