<?php

namespace App\Models;

use App\Core\Model;

class LogInOutModel extends Model
{
    public $tableRxU = 'roles_x_usuarios';
    public $tableRoles = 'roles';

    public function buscarUsuario($table, array $datos)
    {
        if ($this->db->buscarIfExists($table, $datos)) {
            $usuario['idUsuario'] = $this->db->selectWhatWhere($table, 'id', $datos)[0]['id'];
            return $usuario;
        } else {
            return false;
        }
    }
}
