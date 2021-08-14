<?php

namespace App\Models;

use App\Core\Model;

class LogInOutModel extends Model
{
    public function buscarUsuario($table, array $datos)
    {
        if ($this->db->buscarIfExists($table, $datos)) {
            $usuario = $this->db->selectAllWhere($table, $datos)[0];
            return $usuario;
        } else {
            return false;
        }
    }
}
