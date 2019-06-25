<?php

namespace App\Models;

use App\Core\Model;

class Tarea extends Model
{
    protected $table = 'tarea';
    protected $tableEspecializacion='especializacion';
    protected $tableAgentes='agentes';
    protected $tableItemAgentes='itemAgente';
    protected $tableItemOT='itemot';
    protected $tableOT = 'OrdenDeTrabajo';
    protected $tablePedido = 'pedido';
    protected $tablePersona = 'personas';
    protected $tableHistoria = 'historialEstado';
    protected $tableItemInsumo = 'iteminsumo';
    protected $tableInsumo = 'insumo';

    public function getEspecializaciones() {
        $especializaciones = $this->db->getEspecializaciones($this->tableEspecializacion);
        $misEspecializaciones = json_decode(json_encode($especializaciones), True);
        return $misEspecializaciones;
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
        $miTarea['miOT']=$this->getOTByIdId($miTarea['idPedido'],$miTarea['idTarea']);
        $miTarea['insumos']=$this->getInsumosByIdId($miTarea['idPedido'],$miTarea['idTarea']);
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

    public function verAgentesDisponibles($urgencia){
    $agentes = $this->db->selectAgentesDisponibles($this->tableAgentes,$urgencia);
    $misAgentes = json_decode(json_encode($agentes), True);
    for ($i=0; $i < count($misAgentes); $i++) { 
        $misAgentes[$i]['especializacionNombre']=$this->getNombreEspecializacionPorId($misAgentes[$i]['idEspecializacion']);
        $persona = $this->getPersonaPorId($misAgentes[$i]['idAgente']);
        $misAgentes[$i]['nombre']=$persona['nombre'];
        $misAgentes[$i]['apellido']=$persona['apellido'];
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
            $persona = $this->getPersonaPorId($todosAgentes[$i]['idAgente']);
            $todosAgentes[$i]['nombre']=$persona['nombre'];
            $todosAgentes[$i]['apellido']=$persona['apellido'];
          }
          return $todosAgentes;
    }

    public function desasignarAgente($nPedido, $nTarea, $nAgente){
        $tareaDespues = $this->db->selectUltimoItemAgente($this->tableItemAgentes,$nAgente);
        $miTareaDespues = json_decode(json_encode($tareaDespues[0]), True);
        $tarea = $this->db->selectTareaByIdId($this->table,$nPedido,$nTarea);
        $miTarea = json_decode(json_encode($tarea[0]), True);
     if ($miTareaDespues['idPedido']==$nPedido && $miTareaDespues['idTarea']==$nTarea) { //si el ultimo item soy yo
        if ($miTarea['prioridad'] != 'Urgente') {   //ultimo y no urgente
            $this->cambiarEstadoAgente($nAgente,1);
        } else {
            $tareaAntes = $this->db->selectAnteUltimoItemAgente($this->tableItemAgentes,$nAgente);
            if (empty($tareaAntes)) {
                $this->cambiarEstadoAgente($nAgente,1);
            } else {
                $miTareaAntes = json_decode(json_encode($tareaAntes[0]), True);
                $tarea2 = $this->db->selectTareaByIdId($this->table,$miTareaAntes['idPedido'],$miTareaAntes['idTarea']);
                $miTarea2 = json_decode(json_encode($tarea2[0]), True);
                if ($miTarea2['estado'] == 'Finalizado') {
                    $this->cambiarEstadoAgente($nAgente,1);
                }
            }
        }
     }  else {          // no soy el ultimo item
        if ($miTarea['estado'] == 'Finalizado') {  //si la tarea urgente finalizo
            $this->cambiarEstadoAgente($nAgente,1);
        }
     }          
        $this->db->desasignarAgente($this->tableItemAgentes,$nPedido,$nTarea,$nAgente);
    }
    
    public function getOTByIdId($idPedido, $idTarea){
        $miOT = [];
        $OT = $this->db->selectOTPorNPedidoNTarea($this->tableOT,$this->tableItemOT,$idPedido,$idTarea);
        if (!empty($OT)) {
            $miOT = json_decode(json_encode($OT[0]), True);
            $miOT['fechaInicio'] = date("d/m/Y", strtotime($miOT['fechaInicio']));
            if (is_null($miOT['fechaFin'])) {
                $miOT['fechaFin'] = 'En Curso';
            } else {
                $miOT['fechaFin'] = date("d/m/Y", strtotime($miOT['fechaFin']));
            }
        }        
        return $miOT;
    }

    public function updateEstadoTarea($idPedido,$idTarea,$estado){
        $this->db->updateEstadoTarea($this->table,$idPedido,$idTarea,$estado);
    }

    public function verificarFinOT($idOT){
        $estadoFinOT = true;
        $tareas = $this->db->selectTareasPorNOT($this->table,$this->tableItemOT,$idOT);
        $todasTareas = json_decode(json_encode($tareas), True);
        for ($i=0; $i < count($todasTareas); $i++) { 
            if ($todasTareas[$i]['estado'] != "Finalizado") {
                $estadoFinOT = false;
            }
        }
        if ($estadoFinOT) {
            $this->db->updateEstadoOT($this->tableOT,$idOT,'Finalizado');
            $this->db->updateFechaFinOT($this->tableOT,$idOT,date("Y-m-d"));
        }
    }

    public function verificarFinPedido($idPedido){
        $estadoFinPedido = true;
        $tareas = $this->db->selectTareasPorNPedido($this->table,$idPedido);
        $todasTareas = json_decode(json_encode($tareas), True);
        for ($i=0; $i < count($todasTareas); $i++) { 
            if ($todasTareas[$i]['estado'] != "Finalizado") {
                $estadoFinPedido = false;
            }
        }
        if ($estadoFinPedido) {
            $this->db->updateEstadoPedido($this->tablePedido,$idPedido,'Para Finalizar');
        }
    }

    public function desocuparAgentes($idPedido,$idTarea){
        $agentes = $this->db->selectAgentesPorNPedidoNTarea($this->tableAgentes,$this->tableItemAgentes,$idPedido,$idTarea);
        $todosAgentes = json_decode(json_encode($agentes), True);
        for ($i=0; $i < count($todosAgentes); $i++) { 
            $this->cambiarEstadoAgente($todosAgentes[$i]['idAgente'],1);
        }
    }

    public function updateEstadoPedido($idPedido,$estado){
        $this->db->updateEstadoPedido($this->tablePedido,$idPedido,$estado);
        if ($estado == "Finalizado") {
            $this->db->updateFechaFinPedido($this->tablePedido,$idPedido,date("Y-m-d"));
        }
    }

    
    public function getPersonaPorId($idAgente){
        $persona = $this->db->selectPersonaByDNI($this->tablePersona,$idAgente);
        $miPersona = json_decode(json_encode($persona[0]), True);  
        return $miPersona;
    }

    public function buscarNHistoriaSiguiente($idPedido, $idTarea)
    {
        $nHistoriaSiguiente = 1;
        $nHistoriaObj =  $this->db->idHistoriaSiguiente($this->tableHistoria,$idPedido,$idTarea);
        $nHistoriaActual = $nHistoriaObj[0][0];
        if (!is_null($nHistoriaObj)) {
            $nHistoriaSiguiente = $nHistoriaActual + 1;
        }       
        return $nHistoriaSiguiente;
    }

    public function insertHistorialEstado(array $historia)
    {
        $this->db->insert($this->tableHistoria, $historia);
    }

    public function verHistorial($idPedido,$idTarea){
        $historias = $this->db->selectHistorias($this->tableHistoria,$idPedido,$idTarea);
        $misHistorias = json_decode(json_encode($historias), True);
        for ($i=0; $i < count($misHistorias); $i++) { 
            $misHistorias[$i]['fecha'] = date("d/m/Y H:i", strtotime($misHistorias[$i]['fecha']));
            }
        return $misHistorias;
    }

    public function getInsumosByIdId($idPedido, $idTarea){
        $insumos = $this->db->selectInsumosPorNPedidoNTarea($this->tableInsumo,$this->tableItemInsumo,$idPedido,$idTarea);
        $todosInsumos = json_decode(json_encode($insumos), True);
        return $todosInsumos;
    }
}
