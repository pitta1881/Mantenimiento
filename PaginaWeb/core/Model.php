<?php

namespace App\Core;

use App\Core\App;
use Exception;

define("tableRxP", "roles_x_permisos");
define("tableRxU", "roles_x_usuarios");
define("tableExA", "especializaciones_x_agentes");
define("tableAxT", "agentes_x_tareas");
define("tableIxT", "insumos_x_tareas");
define("tableIxOC", "insumos_x_OC");
define("tableRoles", "roles");
define("tableAgentes", "agentes");
define("tableUsuarios", "usuarios");
define("tableEspecializaciones", "especializaciones");
define("tablePersonas", "personas");
define("tableSectores", "sectores");
define("tableEstadosPersona", "estadospersona");
define("tablePedidos", "pedidos");
define("tableEstados", "estados");
define("tablePrioridades", "prioridades");
define("tableTareas", "tareas");
define("tableTiposSector", "tipossector");
define("tableHistorialInsumo", "historialinsumo");
define("tableHistorialPedido", "historialpedido");
define("tableHistorialTarea", "historialtarea");
define("tableInsumos", "insumos");
define("tableMedidas", "medidas");
define("tableOC", "ordenesdecompra");
define("tableTiposOC", "tiposordenesdecompra");
define("tableEstadosOC", "estadosordenesdecompra");
define("tableEventos", "eventos");
define("tableOT", "ordenesdetrabajo");

/**
 * Clase abstracta para manejar los modelos
 */
abstract class Model
{
    protected $db = null;

    public function __construct()
    {
        $this->db = App::get('database');
        date_default_timezone_set("America/Argentina/Buenos_Aires");
    }

    public function startTransaction()
    {
        $this->db->startTransaction();
    }

    public function commit()
    {
        return $this->db->commit();
    }

    public function rollback()
    {
        $this->db->rollback();
    }

    public function getPermisos($rolEntrada = null)
    {
        if (!is_null($rolEntrada)) {
            $rol['idRol'] = $rolEntrada;
        } else {
            $rol['idRol'] = $_SESSION['rolActual']['id'];
        }
        return $this->db->selectWhatWherePerm(tableRxP, 'idPermiso', $rol);
    }

    public function getFichaOneModel($table, array $where, $callback  = null)
    {
        $retornoUno = $this->db->selectAllWhere($table, $where)[0];
        $retornoUno = $this->verificarFechasyVacios($retornoUno);
        if (!is_null($callback)) {
            $retornoUno = call_user_func(array($this, $callback), $retornoUno);
        }
        return $retornoUno;
    }


    //1er param = tabla en donde buscar
    public function getFichaAllModel($table, $callback = null, $arrayTablaComparaIfUsado = null)
    {
        $retornoTodos = $this->db->selectAll($table);
        $retornoTodos = $this->ordenar($table, $retornoTodos);
        foreach ($retornoTodos as &$retornoUno) {
            $retornoUno = $this->verificarFechasyVacios($retornoUno);
            if (!is_null($callback)) {
                $retornoUno = call_user_func(array($this, $callback), $retornoUno);
            }
            if (!is_null($arrayTablaComparaIfUsado)) {
                $retornoUno = $this->compareIfUsado($retornoUno, $arrayTablaComparaIfUsado);
            }
        }
        return $retornoTodos;
    }

    protected function compareIfUsado($datoUno, $arrayTablaComparaIfUsado)
    {
        if (!is_null($arrayTablaComparaIfUsado)) {
            $datoUno['usado'] = false;
            foreach ($arrayTablaComparaIfUsado as $tablaComparaIfUsado) {
                if ($this->db->buscarIfExists($tablaComparaIfUsado["tabla"], array($tablaComparaIfUsado["comparaKeyDest"] => $datoUno[$tablaComparaIfUsado["comparaKeyOrig"]]))) {
                    $datoUno['usado'] = true;
                }
            }
        }
        return $datoUno;
    }

    protected function verificarFechasyVacios($datoUno)
    {
        foreach ($datoUno as $key => $value) {
            if (is_null($value) || $value == '') {
                $datoUno[$key] = '-';
            } elseif ($key == 'fechaNacimiento') {
                $datoUno[$key] = date("d/m/Y", strtotime($datoUno[$key]));
            } elseif ($key == 'fechaInicio' || $key == 'fechaFin' || $key == 'fecha') {
                $datoUno[$key] = date("d/m/Y H:i", strtotime($datoUno[$key]));
            }
        }
        return $datoUno;
    }
    //1er param = tabla en donde insertar
    //2do param = datos a insertar (1er de estos actua como pk para ver si ya existe)
    //3er param = nombre del lugar, solo para completar array final
    public function insert($table, array $datos, $tipo)
    {
        $retorno = array(   "tipo" => $tipo,
                            "operacion" => "insert");
        $datos = $this->db->insert($table, $datos);
        if(!is_array($datos)){
            throw new Exception($datos->getMessage(), 1);
        } else {
            $retorno = array_merge($retorno, array(
                "estado" => $datos["estado"],
                "mensaje" => $datos["mensaje"]
            ));
        }
        return $retorno;
    }

    public function update($table, array $datos, array $where, $tipo)
    {
        $retorno = array(
                "tipo" => $tipo,
                "operacion" => "update");
        if (!($this->db->buscarIfExists($table, $where))) {
            $retorno = array_merge($retorno, array(
                "estado" => false,
                "mensaje" => "El item no existe"
            ));
        } else {
            $datos = $this->db->update($table, $datos, $where);
            if(!is_array($datos)){
                throw new Exception($datos->getMessage(), 1);
            } else {
                $retorno = array_merge($retorno, array(
                    "estado" => $datos["estado"],
                    "mensaje" => $datos["mensaje"]
                ));
            }
        }
        return $retorno;
    }

    public function delete($table, array $where, $tipo)
    {
        $retorno = array(
            "tipo" => $tipo,
            "operacion" => "delete");
        if (!($this->db->buscarIfExists($table, $where))) {
            $retorno = array_merge($retorno, array(
                "estado" => false,
                "mensaje" => "El item no existe"
            ));
        } else {
            $datos = $this->db->delete($table, $where);
            if(!is_array($datos)){
                throw new Exception($datos->getMessage(), 1);
            } else {
                $retorno = array_merge($retorno, array(
                    "estado" => $datos["estado"],
                    "mensaje" => $datos["mensaje"]
                ));
            }
        }
        return $retorno;
    }

    public function buscarRoles_x_Usuario($usuario)
    {
        $listaRoles = $this->db->selectWhatWhere(tableRxU, 'idRol', $usuario);
        foreach ($listaRoles as $key => $value) {
            $comparaColumna['id']=$value['idRol'];
            $rolesRetorno[$key] = $this->db->selectWhatWhere(tableRoles, 'id, nombre', $comparaColumna)[0];
        }
        return $rolesRetorno;
    }

    protected function ordenar($table, $datos)
    {
        switch ($table) {
            case 'sectores':
            case 'personas':
            case 'tableTiposSector':
                usort($datos, function ($item1, $item2) {
                    return $item1['nombre'] <=> $item2['nombre'];
                });
                break;
            case 'prioridades':
                usort($datos, function ($item1, $item2) {
                    return $item1['id'] <=> $item2['id'];
                });
                break;
            default:
                # code...
                break;
        }
        return $datos;
    }
}
