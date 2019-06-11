<?php

namespace App\Models;

use App\Core\Model;

class Tarea extends Model
{
    protected $table = 'tarea';
    protected $tableEspecializacion='especializacion';

    //ESTO ESTA HARDCODEADO PARA MUESTRAR ALGO NOMAS
    public function getEspecializaciones() {
        $array;
        $especializaciones = $this->db->getEspecializaciones($this->tableEspecializacion);
        $misEspecializaciones = json_decode(json_encode($especializaciones), True);
        for ($i=0; $i < count($misEspecializaciones); $i++) { 
          $array[$i]=$misEspecializaciones[$i]['nombre'];
        }
        return $array;
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
        $tarea = $this->db->selectTareaByIdId($this->table,$idPedido,$idTarea);
        return $tarea[0];
    }

}
