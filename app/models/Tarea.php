<?php

namespace App\Models;

use App\Core\Model;

class Tarea extends Model
{
    protected $table = 'tarea';

    //ESTO ESTA HARDCODEADO PARA MUESTRAR ALGO NOMAS
    public function getEspecializaciones() {
        return array("ALBAnIL","ELECTRICISTA","PLOMERO","PINTOR","GASISTA");
    }

    public function getPrioridades() {
        return array("Baja","Media","Alta","Urgente");
    }

    public function getEstados() {
        return array("Iniciado","En Curso","Pendiente","Finalizado");
    }

    public function insert(array $tarea)
    {
        $this->db->insert($this->table, $tarea);
    }

       
    public function buscarNTareaSiguiente ($idPedido)
    {
    $nTareaSiguiente = 1;
       $nTareaObj =  $this->db->idTareaSiguiente($this->table,$idPedido);
       $nTareaActual = $nTareaObj[0][0];
       if (!is_null($nTareaActual)) {
           $nTareaSiguiente = $nTareaActual + 1;
       }       
       return $nTareaSiguiente;
    }

    
    public function update (array $tareaModificada,$idTarea,$idPedido)
    {
        $this->db->updateTarea($this->table, $tareaModificada,$idTarea,$idPedido);
    }

    
    public function getTareasByIdPedido($id)
    {
        return $this->db->selectTareasPorNPedido($this->tableTarea,$id);
    }

    public function delete($nPedido, $nTarea){
        $this->db->deleteTarea($this->table,$nPedido,$nTarea);
    }    
    
    public function getByIdPedidoIdTarea($idPedido,$idTarea){
        return $this->db->selectTareaByIdId($this->table,$idPedido,$idTarea);
    }

}
