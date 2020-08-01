<?php

namespace App\Core;

use App\Core\App;

/**
 * Clase abstracta para manejar los modelos
 */
abstract class Model
{
    protected $db = null;
    protected $tableRP = 'rolesxpermisos';
    protected $tableEspecializacion = 'especializacion';

    public function __construct()
    {
        $this->db = App::get('database');
    }

    public function getPermisos($rolEntrada = null){
        if(!is_null($rolEntrada)){
            $rol['idRol'] = $rolEntrada;
        } else {
            $rol['idRol'] = $_SESSION['rol'];
        }
        return $this->db->selectWhatWherePerm($this->tableRP,'idPermiso',$rol);
    }

    //1er param = tabla en donde buscar
    //2do param = array con tablas en donde comparar si existe PK para ver si 'usado' y se puede borrar o no
    public function get($table,$arrayTablaComparaIfUsado = null){
        $retornoTodos = $this->db->selectAll($table);
        foreach ($retornoTodos as &$retornoUno) {
            foreach ($retornoUno as $key => $value) {
                if (is_null($value) || $value == '') {
                    $retornoUno[$key] = '-';
                }
            }
            if(!is_null($arrayTablaComparaIfUsado)){
                $retornoUno['usado'] = false;
                foreach($arrayTablaComparaIfUsado as $tablaComparaIfUsado){
                    $comparaColumna[array_key_first($retornoUno)]=$retornoUno[array_key_first($retornoUno)];
                    if($this->db->buscarIfExists($tablaComparaIfUsado,$comparaColumna)){
                        $retornoUno['usado'] = true;
                    }
                }
            }
        }
        return $retornoTodos;
    }

    //1er param = tabla en donde insertar
    //2do param = datos a insertar (1er de estos actua como pk para ver si ya existe)
    //3er param = true si inserto un pedido, ya que no tengo q compararlo con nada
    public function insert($table, array $datos, $isPedido = false){
        if($isPedido){
            return $this->db->insert($table, $datos);
        } else {
            if(!($this->db->buscarIfExists($table, $datos))){
                return $this->db->insert($table, $datos);
                } else {
                return false;
            }       
        }
    }   

    public function update($table, array $datos){
        if(!($this->db->buscarIfExists($table,$datos))){
            return false;
        } else {
            return $this->db->update($table, $datos);
        }
    }

    public function delete($table, array $datos){
        if(!($this->db->buscarIfExists($table,$datos))){
            return false;
        } else {
            return $this->db->delete($table, $datos);
        }
    }

    public function getFicha($table,array $where){
        $retornoUno = $this->db->selectAllWhere($table,$where)[0];
        foreach ($retornoUno as $key => $value) {
            if (is_null($value) || $value == '') {
                $retornoUno[$key] = '-';
            }
            if ($key == 'fecha_nacimiento') {
                $retornoUno[$key] = date("d/m/Y", strtotime($retornoUno[$key]));
            }
        }
        return $retornoUno;
    }
}
