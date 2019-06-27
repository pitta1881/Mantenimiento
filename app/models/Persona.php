<?php

namespace App\Models;

use App\Core\Model;

class Persona extends Model{
    protected $table = 'personas';
    protected $tableRol='roles';
    protected $tablePermisos='permisos';
    protected $tableAgentes='agentes';


    
    public function getPermisos($idRol){
        $roles = $this->db->selectPermisosByRol($idRol);
        $misRoles = json_decode(json_encode($roles), True);
        return $misRoles; 
    }

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

    
    public function getEstadosPersona() {
        return array("Activo","Inactivo","Vacaciones");
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
                }
            }
        }
        return $miPersona;
    }

    public function delete($nPersona){        
        $this->db->deletePersona($this->table,$nPersona);
    } 
}