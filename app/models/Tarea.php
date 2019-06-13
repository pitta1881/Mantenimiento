<?php

namespace App\Models;

use App\Core\Model;

class Tarea extends Model
{
    protected $table = 'tarea';
    protected $tableEspecializacion='especializacion';
    protected $tableAgentes='agentes';
    protected $tableItemAgentes='itemAgente';

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
        $miTarea = json_decode(json_encode($tarea[0]), True);
        $miTarea['especializacionNombre']=$this->getNombreEspecializacionPorId($miTarea['idEspecializacion']);
        $miTarea['agentes']=$this->getAgentesByIdId($miTarea['idPedido'],$miTarea['idTarea']);
        return $miTarea;
    }

    public function getIdEspecializacionPorNombre($nombreEspecializacion) {
        $id = $this->db->getIdFromNombreEspecializacion($this->tableEspecializacion, $nombreEspecializacion);
        return $id[0][0];
      } 

      public function getNombreEspecializacionPorId($idEspecializacion) {
        $nombre = $this->db->getNombreFromIdEspecializacion($this->tableEspecializacion, $idEspecializacion);
        return $nombre[0][0];
      } 

      public function verAgentesDisponibles(){
        $agentes = $this->db->selectAgentesDisponibles($this->tableAgentes);
        $misAgentes = json_decode(json_encode($agentes), True);
        for ($i=0; $i < count($misAgentes); $i++) { 
            $misAgentes[$i]['especializacionNombre']=$this->getNombreEspecializacionPorId($misAgentes[$i]['idEspecializacion']);
          }
        return $misAgentes;
    }

    public function insertItemAgente($datos){
        $this->db->insert($this->tableItemAgentes,$datos);
    }

    public function cambiarEstadoAgente($idAgente,$estado){
        $this->db->updateEstadoAgente($this->tableAgentes,$idAgente,$estado);
    }

    public function getAgentesByIdId($idPedido, $idTarea){
        $agentes = $this->db->selectAgentesPorNPedidoNTarea($this->tableAgentes,$this->tableItemAgentes,$idPedido,$idTarea);
        $todosAgentes = json_decode(json_encode($agentes), True);
        for ($i=0; $i < count($todosAgentes); $i++) { 
            $todosAgentes[$i]['especializacionNombre']=$this->getNombreEspecializacionPorId($todosAgentes[$i]['idEspecializacion']);
          }
          return $todosAgentes;
    }

    public function desasignarAgente($nPedido, $nTarea, $nAgente){
        $this->db->desasignarAgente($this->tableItemAgentes,$nPedido,$nTarea,$nAgente);
        $this->cambiarEstadoAgente($nAgente,1);
    }
}
