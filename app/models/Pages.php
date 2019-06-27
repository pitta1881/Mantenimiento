<?php

namespace App\Models;

use App\Core\Model;

class Pages extends Model
{
    protected $table = 'eventos';
    protected $tableRP = 'rolesxpermisos';
    protected $tableTarea = 'tarea';
    protected $tableEspecializacion='especializacion';

    public function getActivos($tabla,$columna){
        $cantidad = $this->db->getActivos($tabla,$columna);
        return $cantidad[0][0];
    }

    public function getAgentesDisponibles($tabla){
        $cantidad = $this->db->getAgentesDisponibles($tabla);
        return $cantidad[0][0];
   
    }

 public function get()
    {
     $this->validarEventos();
        $eventos = $this->db->selectAllEventosOrdenados($this->table);
      
        $todosEventos = json_decode(json_encode($eventos), True);
        foreach ($todosEventos as $indice => $datos) {
            foreach ($datos as $key => $value) {
                if ($key == 'fechaInicio') {
                    $todosEventos[$indice]['fechaInicio'] = date("d/m/Y", strtotime($todosEventos[$indice]['fechaInicio']));
                }
                if ($key == 'fechaFin') {
                    $todosEventos[$indice]['fechaFin'] = date("d/m/Y", strtotime($todosEventos[$indice]['fechaFin']));
                }
            }
        }
        return $todosEventos;
    }

    public function getTareasSinAsignar(){
        $tareas = $this->db->selectTareasSinAsignar($this->tableTarea);
        $misTareas = json_decode(json_encode($tareas), True);
        for ($i=0; $i < count($misTareas); $i++) { 
            $misTareas[$i]['especializacionNombre']=$this->getNombreEspecializacionPorId($misTareas[$i]['idEspecializacion']);
          }
        return $misTareas;
    }

    public function getNombreEspecializacionPorId($idEspecializacion) {
        $nombre = $this->db->getNombreFromIdEspecializacion($this->tableEspecializacion, $idEspecializacion);
        return $nombre[0][0];
      } 

      public function getPermisos($idRol){
        $roles = $this->db->selectPermisosByRol($this->tableRP,$idRol);
        $misRoles = json_decode(json_encode($roles), True);
        return $misRoles; 
    }


    public function validarEventos(){
     $eventos = $this->db->selectAllEventosOrdenados($this->table);
$todosEventos = json_decode(json_encode($eventos), True);
  foreach ($todosEventos as $indice => $datos) {
            foreach ($datos as $key => $value) {
      
                if ($key == 'fechaFin') {
            
                    $fechaActual=date("Y-m-d");
                      $fecha=date("Y-m-d",strtotime($todosEventos[$indice]['fechaFin']));
                    // $array=($todosEventos[$indice]);
                    //var_dump($array);
                    if ($fecha < $fechaActual){
                        $this->db->deleteEventoValidar($this->table, $todosEventos[$indice]['idEvento']);
                    }
                }
            }
  }
    }

    
}
