<?php

namespace App\Models;

use App\Core\Model;

class UsuarioModel extends Model
{
    protected $tableRol='roles';
    protected $tablePersona='personas';
      
    public function get($table, $tabla = null){
        $usuarios=$this->db->selectAll($table);
        foreach ($usuarios as &$miUsuario){
            $persona = $this->db->selectWhatWhere($this->tablePersona,'nombre,apellido', array('dni' => $miUsuario['idPersona']))[0];
            $miUsuario['nombreApe'] = $persona['nombre'].' '.$persona['apellido'];
            $miUsuario['nombreRol'] = $this->db->selectWhatWhere($this->tableRol,'nombreRol', array('idRol' => $miUsuario['idRol']))[0]['nombreRol'];
        }
        return $usuarios;
    }

    public function getRoles(){
        return $this->db->selectAll($this->tableRol);
    }
   
    public function getPersonas(){
        return $this->db->selectAll($this->tablePersona);
    }
}
