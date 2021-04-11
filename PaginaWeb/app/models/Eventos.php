<?php

namespace App\Models;

use App\Core\Model;

class Eventos extends Model
{
    protected $table = 'eventos';

    /* public function getPermisos($idRol){
        echo "ENTROOOOOO";
         $roles = $this->db->selectPermisosByRol($idRol);
         $misRoles = json_decode(json_encode($roles), True);
         return $misRoles;
     }*/

    
    public function getEvento()
    {
        $eventos = $this->db->selectAll($this->table);
        $todosEventos = json_decode(json_encode($eventos), true);
        foreach ($todosEventos as $indice => $datos) {
            foreach ($datos as $key => $value) {
                if ($key == 'fechaInicio') {
                    $todosEventos[$indice]['fechaInicioSinFormato'] = $todosEventos[$indice]['fechaInicio'];
                    $todosEventos[$indice]['fechaInicio'] = date("d/m/Y", strtotime($todosEventos[$indice]['fechaInicio']));
                }
                if ($key == 'fechaFin') {
                    $todosEventos[$indice]['fechaFinSinFormato'] = $todosEventos[$indice]['fechaFin'];
                    $todosEventos[$indice]['fechaFin'] = date("d/m/Y", strtotime($todosEventos[$indice]['fechaFin']));
                }
            }
        }
        return $todosEventos;
    }

    public function buscarEvento($nombreEvento)
    {
        //comparo si existe el evento
        return $this->db->comparaEventos($this->table, $nombreEvento);
    }
}
