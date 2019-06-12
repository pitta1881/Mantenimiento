<?php

namespace App\Models;

use App\Core\Model;

class OrdenDeTrabajo extends Model
{
    protected $tableOT = 'OrdenDeTrabajo';
    protected $tableItem = 'itemOT';
    protected $tableTarea = 'tarea';
    protected $tableEspecializacion='especializacion';

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

    public function cambiarEstadoTarea($idPedido,$idTarea){
        $this->db->updateEstadoTarea($this->tableTarea,$idPedido,$idTarea);
    }

    public function getCantTareasAsignadas($idOT){
        $contadorTareas = $this->db->getCantTareasOT($this->tableItem,$idOT);
        return $contadorTareas[0][0];
    }

    public function getNombreEspecializacionPorId($idEspecializacion) {
        $nombre = $this->db->getNombreFromIdEspecializacion($this->tableEspecializacion, $idEspecializacion);
        return $nombre[0][0];
      } 


}
