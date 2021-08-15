<?php

namespace App\Models;

use App\Core\Model;
use Firebase\JWT\JWT;

class LogInOutModel extends Model
{
    private $key = 'patokey123';

    public function buscarUsuario($table, array $datos)
    {
        if ($this->db->buscarIfExists($table, $datos)) {
            $usuario = $this->db->selectAllWhere($table, $datos)[0];
            return $usuario;
        } else {
            return false;
        }
    }

    public function setRememberme($usuario)
    {
        $time = time();
        $token = array(
            'iat' => $time, // Tiempo que inició el token
            'exp' => $time + (60*60*24*30), // Tiempo que expirará el token (+30 dias)
            'data' => $usuario
        );
        return JWT::encode($token, $this->key);
    }

    public function validarToken($token)
    {
        try {
            $data = JWT::decode($token, $this->key, array('HS256'))->data;
            if ($this->db->buscarIfExists(tableUsuarios, array('nick' => $data->nick, 'password' => $data->password))) {
                return array('login' => true);
            } else {
                return array('login' => false,'info' => 'Usuario o Contraseña invalidos');
            }
        } catch (\Throwable $th) {
            return array('login' => false,'info' => $th->getMessage());
        }
    }
}
