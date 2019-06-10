<?php

namespace App\Models;

use App\Core\Model;

class Pages extends Model
{
    protected $table = 'tarea';

    public function getActivos($tabla,$columna){
        $cantidad = $this->db->getActivos($tabla,$columna);
        return $cantidad[0][0];
    }

}
