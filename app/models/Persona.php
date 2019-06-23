<?php

namespace App\Models;

use App\Core\Model;

class Persona extends Model{
    protected $table = 'personas';
    protected $tableRol='roles';
    protected $tablePermisos='permisos';
    protected $tableAgentes='agentes';
    protected $size_pagina=8;

    public function get()
    {
        $personas = $this->db->selectAll($this->table);
        $misPersonas = json_decode(json_encode($personas), True);
        foreach ($misPersonas as $indice => $datos) {
            $yaEstaUsado = [];
            $yaEstaUsado = $this->db->getFromAgenteConIdPersona($this->tableAgentes,$misPersonas[$indice]['dni']);
            if(empty($yaEstaUsado)){
                $misPersonas[$indice]['usado'] = false;
            } else{
                $misPersonas[$indice]['usado'] = true;
            }
            foreach ($datos as $key => $value) {
                if (is_null($value) || $value == '') {
                    $misPersonas[$indice][$key] = '-';
                }
                if ($key == 'fecha_nacimiento') {
                    if ($value == '0000-00-00') {
                        $misPersonas[$indice]['fecha_nacimiento'] = '-';
                    } else{
                        $misPersonas[$indice]['fecha_nacimiento'] = date("d/m/Y", strtotime($misPersonas[$indice]['fecha_nacimiento']));
                    }
                }
            }
        }
        return $misPersonas;
    }   
   
    public function insert(array $persona){
        $this->db->insert($this->table, $persona);
    }

    public function update (array $personaModificado,$dni){
        $this->db->updatePersona($this->table, $personaModificado,$dni);
    }

    public function buscarPersona($dni){
       return $this->db->comparaPersona($this->table,$dni);
    }

    public function getByIdPersona($dni){
        $persona = $this->db->selectPersonaByDNI($this->table,$dni);
        $miPersona = json_decode(json_encode($persona[0]), True);  
        foreach ($miPersona as $key => $value) {
            if (is_null($value) || $value == '') {
                $miPersona[$key] = '-';
            }
            if ($key == 'fecha_nacimiento') {
                if ($value == '0000-00-00') {
                    $miPersona[$key] = '-';
                } else{
                    $miPersona[$key] = date("d/m/Y", strtotime($miPersona[$key]));
                    var_dump($miPersona[$key]);
                }
            }
        }
        return $miPersona;
    }

    public function delete($nPersona){        
        $this->db->deletePersona($this->table,$nPersona);
    } 

    public function getSize(){
        $num_filas= $this->db->getSize($this->table);
        $total_paginas= ceil($num_filas/$this->size_pagina);
        return $total_paginas;
    }    

    public function getPaginacion($page){
        $pagina=$page;
        $empezar_desde=($pagina-1)*$this->size_pagina;
        $num_filas= $this->getSize();
        $total_paginas= ceil($num_filas/$this->size_pagina);
        $personas = $this->db->getAllLimit($this->table,$empezar_desde,$this->size_pagina);
        $misPersonas = json_decode(json_encode($personas), True);
        foreach ($misPersonas as $indice => $datos) {
            $yaEstaUsado = [];
            $yaEstaUsado = $this->db->getFromAgenteConIdPersona($this->tableAgentes,$misPersonas[$indice]['dni']);
            if(empty($yaEstaUsado)){
                $misPersonas[$indice]['usado'] = false;
            } else{
                $misPersonas[$indice]['usado'] = true;
            }
            foreach ($datos as $key => $value) {
                if (is_null($value) || $value == '') {
                    $misPersonas[$indice][$key] = '-';
                }
                if ($key == 'fecha_nacimiento') {
                    if ($value == '0000-00-00') {
                        $misPersonas[$indice]['fecha_nacimiento'] = '-';
                    } else{
                        $misPersonas[$indice]['fecha_nacimiento'] = date("d/m/Y", strtotime($misPersonas[$indice]['fecha_nacimiento']));
                    }
                }
            }
        }
        return $misPersonas;
    }


}