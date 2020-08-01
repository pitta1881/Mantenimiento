<?php

namespace App\Models;

use App\Core\Model;

class PersonaModel extends Model{
   
    public function getEstadosPersona() {
        return array("Activo","Inactivo","Vacaciones");
    }
}