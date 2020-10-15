<?php

namespace App\Core;

use App\Core\App;

/**
 * Clase abstracta para manejar los modelos
 */
abstract class Model
{
    protected $db = null;
    protected $tableRxP = 'roles_x_permisos';
    protected $tableRxU = 'roles_x_usuarios';
    protected $tableExA = 'especializaciones_x_agentes';
    protected $tableRoles = 'roles';
    protected $tableEspecializaciones = 'especializaciones';
    protected $tablePersonas = 'personas';
    protected $tableItemAgentes='itemAgente';
    protected $tableSectores='sectores';
    protected $tableEstadosPersona = 'estadospersona';

    public function __construct()
    {
        $this->db = App::get('database');
    }

    public function getPermisos($rolEntrada = null){
        if(!is_null($rolEntrada)){
            $rol['idRol'] = $rolEntrada;
        } else {
            $rol['idRol'] = $_SESSION['rolActual']['id'];
        }
        return $this->db->selectWhatWherePerm($this->tableRxP,'idPermiso',$rol);
    }

    public function getPrioridades() {
        return array("Baja","Media","Alta","Urgente");
    }

    public function getEstados() {
        return array("Iniciado","En Curso","Pendiente","Finalizado");
    }

    //1er param = tabla en donde buscar
    //2do param = array con tablas en donde comparar si existe PK para ver si 'usado' y se puede borrar o no
    public function get($table,$arrayTablaComparaIfUsado = null){
        $retornoTodos = $this->db->selectAll($table);
        foreach ($retornoTodos as &$retornoUno) {
            if($table == 'usuarios'){
                $persona = $this->db->selectWhatWhere($this->tablePersonas,'nombre,apellido', array('id' => $retornoUno['idPersona']))[0];
                $retornoUno['nombreApe'] = $persona['nombre'].' '.$persona['apellido'];
                $idUsuario['idUsuario'] = $retornoUno['id'];
                $roles = $this->db->selectWhatWhere($this->tableRxU,'idRol',$idUsuario);
                $retornoRoles = null;
                foreach ($roles as $key => $value) {
                    $comparaColumna['id']=$value['idRol'];
                    $retornoRoles[$key] = $this->db->selectWhatWhere($this->tableRoles,'id, nombre',$comparaColumna)[0];
                }
                $retornoUno['listaRoles'] = $retornoRoles;
            } else if ($table == 'agentes'){
                $persona = $this->db->selectWhatWhere($this->tablePersonas,'nombre,apellido',array('id' => $retornoUno['idPersona']))[0];
                $retornoUno['nombre']=$persona['nombre'];
                $retornoUno['apellido']=$persona['apellido'];
                if($retornoUno['isDisponible'] == 1){
                    $retornoUno['isDisponible'] = "DISPONIBLE";
                } else {
                    $retornoUno['isDisponible'] = "OCUPADO";
                }
                $idAgente['idAgente'] = $retornoUno['id'];
                $especializaciones = $this->db->selectWhatWhere($this->tableExA,'idEspecializacion',$idAgente);
                $retornoEspecializaciones = null;
                foreach ($especializaciones as $key => $value) {
                    $comparaColumna['id']=$value['idEspecializacion'];
                    $retornoEspecializaciones[$key] = $this->db->selectWhatWhere($this->tableEspecializaciones,'id, nombre',$comparaColumna)[0];
                }
                $retornoUno['listaEspecializaciones'] = $retornoEspecializaciones;
            } else if ($table == 'personas'){
                $retornoUno['estadoNombre']=$this->db->selectWhatWhere($this->tableEstadosPersona,'nombre',array('id' => $retornoUno['idEstadoPersona']))[0]['nombre'];
            }
            if(!is_null($arrayTablaComparaIfUsado)){
                $retornoUno['usado'] = false;
                foreach($arrayTablaComparaIfUsado as $tablaComparaIfUsado){
                    $keyTablaCompara = $tablaComparaIfUsado["comparaKeyDest"];
                    $comparaColumna[$keyTablaCompara]=$retornoUno[$tablaComparaIfUsado["comparaKeyOrig"]];
                    if($this->db->buscarIfExists($tablaComparaIfUsado["tabla"],$comparaColumna)){
                        $retornoUno['usado'] = true;
                    }
                }
            }
        }
        return $retornoTodos;
    }

    //1er param = tabla en donde insertar
    //2do param = datos a insertar (1er de estos actua como pk para ver si ya existe)
    //retorna id de la ultima fila insertada, o false si no pudo
    public function insert($table, array $datos){
        return $this->db->insert($table, $datos);
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

    public function buscarRoles_x_Usuario($usuario){
        $listaRoles = $this->db->selectWhatWhere($this->tableRxU,'idRol',$usuario);
        foreach ($listaRoles as $key => $value) {
            $comparaColumna['id']=$value['idRol'];
            $rolesRetorno[$key] = $this->db->selectWhatWhere($this->tableRoles,'id, nombre',$comparaColumna)[0];
        }
        return $rolesRetorno;
    }

    public function getFicha($table,array $where){
        $retornoUno = $this->db->selectAllWhere($table,$where)[0];
        foreach ($retornoUno as $key => $value) {
            if (is_null($value) || $value == '') {
                $retornoUno[$key] = '-';
            }
            if ($key == 'fechaNacimiento') {
                $retornoUno[$key] = date("d/m/Y", strtotime($retornoUno[$key]));
            }
        }
        return $retornoUno;
    }

}
