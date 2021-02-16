<?php

namespace App\Core;

use App\Core\App;

define("tableRxP", "roles_x_permisos");
define("tableRxU", "roles_x_usuarios");
define("tableExA", "especializaciones_x_agentes");
define("tableTxA", "tareas_x_agentes");
define("tableMovimientos", "movimientos");
define("tableRoles", "roles");
define("tableAgentes", "agentes");
define("tableUsuarios", "usuarios");
define("tableEspecializaciones", "especializaciones");
define("tablePersonas", "personas");
define("tableItemAgentes", "itemAgente");
define("tableSectores", "sectores");
define("tableEstadosPersona", "estadospersona");
define("tablePedidos", "pedido");
define("tableEstados", "estados");
define("tablePrioridades", "prioridades");
define("tableTareas", "tareas");
define("tableTiposSector", "tipossector");
define("tableHistorialPedido", "historialpedido");
define("tableHistorialTarea", "historialtarea");

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

    public function getPermisos($rolEntrada = null)
    {
        if (!is_null($rolEntrada)) {
            $rol['idRol'] = $rolEntrada;
        } else {
            $rol['idRol'] = $_SESSION['rolActual']['id'];
        }
        return $this->db->selectWhatWherePerm(tableRxP, 'idPermiso', $rol);
    }

    public function getFichaOne($table, array $where)
    {
        $retornoUno = $this->db->selectAllWhere($table, $where)[0];
        return $this->retornoUnoLogic($table, $retornoUno);
    }


    //1er param = tabla en donde buscar
    //2do param = array con tablas en donde comparar si existe PK para ver si 'usado' y se puede borrar o no
    public function getFichaAll($table, $arrayTablaComparaIfUsado = null)
    {
        $retornoTodos = $this->db->selectAll($table);
        $retornoTodos = $this->ordenar($table, $retornoTodos);
        foreach ($retornoTodos as &$retornoUno) {
            $retornoUno = $this->retornoUnoLogic($table, $retornoUno, $arrayTablaComparaIfUsado);
        }
        return $retornoTodos;
    }

    private function retornoUnoLogic($table, $datoUno, $arrayTablaComparaIfUsado = null)
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
        switch ($table) {
            case 'usuarios':
                $persona = $this->db->selectWhatWhere(tablePersonas, 'nombre,apellido', array('id' => $datoUno['idPersona']))[0];
                $datoUno['nombreApe'] = $persona['nombre'].' '.$persona['apellido'];
                $idUsuario['idUsuario'] = $datoUno['id'];
                $roles = $this->db->selectWhatWhere(tableRxU, 'idRol', $idUsuario);
                $retornoRoles = null;
                foreach ($roles as $key => $value) {
                    $comparaColumna['id']=$value['idRol'];
                    $retornoRoles[$key] = $this->db->selectWhatWhere(tableRoles, 'id, nombre', $comparaColumna)[0];
                }
                $datoUno['listaRoles'] = $retornoRoles;
                break;
            case 'agentes':
                $persona = $this->db->selectWhatWhere(tablePersonas, 'nombre,apellido', array('id' => $datoUno['idPersona']))[0];
                $datoUno['nombre']=$persona['nombre'];
                $datoUno['apellido']=$persona['apellido'];
                if ($datoUno['isDisponible'] == 1) {
                    $datoUno['isDisponible'] = "DISPONIBLE";
                } else {
                    $datoUno['isDisponible'] = "OCUPADO";
                }
                $idAgente['idAgente'] = $datoUno['id'];
                $especializaciones = $this->db->selectWhatWhere(tableExA, 'idEspecializacion', $idAgente);
                $retornoEspecializaciones = null;
                foreach ($especializaciones as $key => $value) {
                    $comparaColumna['id']=$value['idEspecializacion'];
                    $retornoEspecializaciones[$key] = $this->db->selectWhatWhere(tableEspecializaciones, 'id, nombre', $comparaColumna)[0];
                }
                $datoUno['listaEspecializaciones'] = $retornoEspecializaciones;
                break;
            case 'roles':
                $datoUno['misPermisos'] = $this->getPermisos($datoUno['id']);
                break;
            case 'sectores':
                $tipoSector = $this->db->selectWhatWhere(tableTiposSector, 'nombre', array('id' => $datoUno['idTipoSector']))[0];
                $datoUno['tipoSectorNombre'] = $tipoSector['nombre'];
                break;
            case 'personas':
                $datoUno['estadoNombre']=$this->db->selectWhatWhere(tableEstadosPersona, 'nombre', array('id' => $datoUno['idEstadoPersona']))[0]['nombre'];
                break;
            case 'pedidos':
                $datoUno['tareasAsignadas'] = $this->db->countTareasAsignadas($datoUno['id'])[0];
                $sector = $this->db->selectWhatWhere(tableSectores, 'nombre', array('id' => $datoUno['idSector']))[0];
                $datoUno['sectorNombre'] = $sector['nombre'];
                $prioridad = $this->db->selectWhatWhere(tablePrioridades, 'nombre', array('id' => $datoUno['idPrioridad']))[0];
                $datoUno['prioridadNombre'] = $prioridad['nombre'];
                $usuario = $this->db->selectWhatWhere(tableUsuarios, 'nick', array('id' => $datoUno['idUsuario']))[0];
                $datoUno['usuarioNick'] = $usuario['nick'];
                $estado = $this->db->selectWhatWhere(tableEstados, 'nombre', array('id' => $datoUno['idEstado']))[0];
                $datoUno['estadoNombre'] = $estado['nombre'];
                $datoUno['historial'] = $this->db->selectAllWhere(tableHistorialPedido, array('idPedido' => $datoUno['id']));
                foreach ($datoUno['historial'] as $indice => $datos) {
                    $datoUno['historial'][$indice]['nickUsuario'] = $this->db->selectWhatWhere(tableUsuarios, 'nick', array('id' => $datos['idUsuario']))[0]['nick'];
                    $datoUno['historial'][$indice]['estadoNombre'] = $this->db->selectWhatWhere(tableEstados, 'nombre', array('id' => $datos['idEstado']))[0]['nombre'];
                }
                break;
            default:
                # code...
                break;
        }
        if (!is_null($arrayTablaComparaIfUsado)) {
            $datoUno['usado'] = false;
            foreach ($arrayTablaComparaIfUsado as $tablaComparaIfUsado) {
                $keyTablaCompara = $tablaComparaIfUsado["comparaKeyDest"];
                $comparaColumna[$keyTablaCompara]=$datoUno[$tablaComparaIfUsado["comparaKeyOrig"]];
                if ($this->db->buscarIfExists($tablaComparaIfUsado["tabla"], $comparaColumna)) {
                    $datoUno['usado'] = true;
                }
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
        $retorno = array_merge($retorno, array(
            "estado" => $datos["estado"],
            "mensaje" => $datos["mensaje"]
        ));
        return $retorno;
    }

    public function update($table, array $datos, $tipo)
    {
        $retorno = array(
                "tipo" => $tipo,
                "operacion" => "update");
        if (!($this->db->buscarIfExists($table, $datos))) {
            $retorno = array_merge($retorno, array(
                "estado" => false,
                "mensaje" => "El item no existe"
            ));
        } else {
            $datos = $this->db->update($table, $datos);
            $retorno = array_merge($retorno, array(
                "estado" => $datos["estado"],
                "mensaje" => $datos["mensaje"]
            ));
        }
        return $retorno;
    }

    public function delete($table, array $datos, $tipo)
    {
        $retorno = array(
            "tipo" => $tipo,
            "operacion" => "delete");
        if (!($this->db->buscarIfExists($table, $datos))) {
            $retorno = array_merge($retorno, array(
                "estado" => false,
                "mensaje" => "El item no existe"
            ));
        } else {
            $datos = $this->db->delete($table, $datos);
            $retorno = array_merge($retorno, array(
                "estado" => $datos["estado"],
                "mensaje" => $datos["mensaje"]
            ));
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

    private function ordenar($table, $datos)
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
