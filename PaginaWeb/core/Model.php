<?php

namespace App\Core;

use App\Core\App;

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
    public function getFichaAll($table)
    {
        switch ($table) {
            case 'usuario':
                $comparaTablasIfUsado = array(
                    array(  "tabla" => tablePedidos,
                            "comparaKeyOrig" => "id",
                            "comparaKeyDest" => "idUsuario",
                        ),
                    array(  "tabla" => tableMovimientos,
                            "comparaKeyOrig" => "id",
                            "comparaKeyDest" => "idUsuario"
                        )
                );
                break;
            case 'sectores':
                $comparaTablasIfUsado = array(
                    array(  "tabla" => tablePedidos,
                        "comparaKeyOrig" => "id",
                        "comparaKeyDest" => "idSector"
                )
            );
            break;
            case 'roles':
                $comparaTablasIfUsado = array(
                    array(  "tabla" => tableRxU,
                            "comparaKeyOrig" => "id",
                            "comparaKeyDest" => "idRol"
                    )
                );
                break;
            case 'permisos':
                $comparaTablasIfUsado = array(
                    array(  "tabla" => tableRxP,
                            "comparaKeyOrig" => "id",
                            "comparaKeyDest" => "idPermiso"
                        )
                );
                break;
            case 'personas':
                $comparaTablasIfUsado = array(
                    array(  "tabla" => tableAgentes,
                            "comparaKeyOrig" => "id",
                            "comparaKeyDest" => "idPersona"
                    ),
                        array(  "tabla" => tableUsuarios,
                                "comparaKeyOrig" => "id",
                                "comparaKeyDest" => "idPersona"
                            )
                    );
                break;
            case 'agentes':
                $comparaTablasIfUsado = array(
                    array(  "tabla" => tableAxT,
                            "comparaKeyOrig" => "id",
                            "comparaKeyDest" => "idAgente"
                    )
                );
                break;
            case 'especializaciones':
                $comparaTablasIfUsado = array(
                    array(  "tabla" => tableTareas,
                            "comparaKeyOrig" => "id",
                            "comparaKeyDest" => "idEspecializacion"
                        ),
                    array(  "tabla" => tableExA,
                            "comparaKeyOrig" => "id",
                            "comparaKeyDest" => "idEspecializacion"
                        )
                );
                break;
            case 'insumos':
                $comparaTablasIfUsado = array(
                    array(  "tabla" => tableIxT,
                            "comparaKeyOrig" => 'id',
                            "comparaKeyDest" => "idInsumo"
                    ),
                    array(  "tabla" => tableIxOC,
                                "comparaKeyOrig" => 'id',
                                "comparaKeyDest" => "idInsumo"
                        )
                    );
                break;
            default:
                $comparaTablasIfUsado = null;
                break;
        }
        $retornoTodos = $this->db->selectAll($table);
        $retornoTodos = $this->ordenar($table, $retornoTodos);
        foreach ($retornoTodos as &$retornoUno) {
            $retornoUno = $this->retornoUnoLogic($table, $retornoUno, $comparaTablasIfUsado);
        }
        return $retornoTodos;
    }

    private function retornoUnoLogic($table, $datoUno, $arrayTablaComparaIfUsado = null)
    {
        $datoUno = $this->verificarFechasyVacios($datoUno);
        switch ($table) {
            case 'usuarios':
                $persona = $this->db->selectWhatWhere(tablePersonas, 'nombre,apellido', array('id' => $datoUno['idPersona']))[0];
                $datoUno['nombreApe'] = $persona['nombre'].' '.$persona['apellido'];
                $datoUno['listaRoles'] = $this->db->selectWhatWhere(tableRxU, 'idRol', array('idUsuario' => $datoUno['id']));
                foreach ($datoUno['listaRoles'] as &$rol) {
                    $returnRol = $this->db->selectWhatWhere(tableRoles, 'id, nombre', array('id' => $rol['idRol']))[0];
                    $rol['id'] =  $returnRol['id'];
                    $rol['nombre'] =  $returnRol['nombre'];
                }
                break;
            case 'agentes':
                $persona = $this->db->selectWhatWhere(tablePersonas, 'nombre,apellido', array('id' => $datoUno['idPersona']))[0];
                $datoUno['nombre']=$persona['nombre'];
                $datoUno['apellido']=$persona['apellido'];
                ($datoUno['isDisponible'] == 1 ? $datoUno['isDisponible'] = "DISPONIBLE" : $datoUno['isDisponible'] = "OCUPADO");
                $datoUno['listaEspecializaciones'] = $this->db->selectWhatWhere(tableExA, 'idEspecializacion', array('idAgente' => $datoUno['id']));
                foreach ($datoUno['listaEspecializaciones'] as &$especializacion) {
                    $returnEspecializacion = $this->db->selectWhatWhere(tableEspecializaciones, 'id, nombre', array('id' => $especializacion['idEspecializacion']))[0];
                    $especializacion['id'] =  $returnEspecializacion['id'];
                    $especializacion['nombre'] =  $returnEspecializacion['nombre'];
                }
                break;
            case 'roles':
                $datoUno['misPermisos'] = $this->getPermisos($datoUno['id']);
                break;
            case 'sectores':
                $datoUno['tipoSectorNombre'] = $this->db->selectWhatWhere(tableTiposSector, 'nombre', array('id' => $datoUno['idTipoSector']))[0]['nombre'];
                break;
            case 'personas':
                $datoUno['estadoNombre']=$this->db->selectWhatWhere(tableEstadosPersona, 'nombre', array('id' => $datoUno['idEstadoPersona']))[0]['nombre'];
                break;
            case 'insumos':
                $datoUno['medidaNombre']=$this->db->selectWhatWhere(tableMedidas, 'nombre', array('id' => $datoUno['idMedida']))[0]['nombre'];
                $datoUno['historial'] = $this->db->selectAllWhere(tableHistorialInsumo, array('idInsumo' => $datoUno['id']));
                foreach ($datoUno['historial'] as &$rowHistorial) {
                    $rowHistorial['nickUsuario'] = $this->db->selectWhatWhere(tableUsuarios, 'nick', array('id' => $rowHistorial['idUsuario']))[0]['nick'];
                }
                break;
            case 'ordenesdecompra':
                $datoUno['estadoNombre']=$this->db->selectWhatWhere(tableEstadosOC, 'nombre', array('id' => $datoUno['idEstadoOC']))[0]['nombre'];
                $datoUno['tipoNombre']=$this->db->selectWhatWhere(tableTiposOC, 'nombre', array('id' => $datoUno['idTipoOrdenDeCompra']))[0]['nombre'];
                $datoUno['nickUsuario'] = $this->db->selectWhatWhere(tableUsuarios, 'nick', array('id' => $datoUno['idUsuario']))[0]['nick'];
                $datoUno['cantidadInsumos'] = $this->db->countWhatFromWhere(tableIxOC, 'idInsumo', array('idOC' => $datoUno['id']))[0];
                $datoUno['insumos'] = $this->db->selectAllWhere(tableIxOC, array('idOC' => $datoUno['id']));
                foreach ($datoUno['insumos'] as &$insumo) {
                    $returnInsumo = $this->db->selectWhatWhere(tableInsumos, 'nombre, descripcion', array('id' => $insumo['idInsumo']))[0];
                    $insumo['nombre'] = $returnInsumo['nombre'];
                    $insumo['descripcion'] = $returnInsumo['descripcion'];
                    $insumo['estadoNombre'] = $this->db->selectWhatWhere(tableEstadosOC, 'nombre', array('id' => $insumo['idEstado']))[0]['nombre'];
                }
                break;
            case 'pedidos':
                $datoUno['tareasAsignadas'] = $this->db->countWhatFromWhere(tableTareas, 'id', array('idPedido' => $datoUno['id']))[0];
                $datoUno['sectorNombre'] = $this->db->selectWhatWhere(tableSectores, 'nombre', array('id' => $datoUno['idSector']))[0]['nombre'];
                $datoUno['prioridadNombre'] = $this->db->selectWhatWhere(tablePrioridades, 'nombre', array('id' => $datoUno['idPrioridad']))[0]['nombre'];
                $datoUno['nickUsuario'] = $this->db->selectWhatWhere(tableUsuarios, 'nick', array('id' => $datoUno['idUsuario']))[0]['nick'];
                $datoUno['estadoNombre'] = $this->db->selectWhatWhere(tableEstados, 'nombre', array('id' => $datoUno['idEstado']))[0]['nombre'];
                $datoUno['historial'] = $this->db->selectAllWhere(tableHistorialPedido, array('idPedido' => $datoUno['id']));
                foreach ($datoUno['historial'] as &$rowHistorial) {
                    $rowHistorial['nickUsuario'] = $this->db->selectWhatWhere(tableUsuarios, 'nick', array('id' => $rowHistorial['idUsuario']))[0]['nick'];
                    $rowHistorial['estadoNombre'] = $this->db->selectWhatWhere(tableEstados, 'nombre', array('id' => $rowHistorial['idEstado']))[0]['nombre'];
                }
                $datoUno['tareas'] = $this->db->selectAllWhere(tableTareas, array('idPedido' => $datoUno['id']));
                foreach ($datoUno['tareas'] as &$tarea) {
                    $tarea = $this->verificarFechasyVacios($tarea);
                    $tarea['nickUsuario'] = $this->db->selectWhatWhere(tableUsuarios, 'nick', array('id' => $tarea['idUsuario']))[0]['nick'];
                    $tarea['estadoNombre'] = $this->db->selectWhatWhere(tableEstados, 'nombre', array('id' => $tarea['idEstado']))[0]['nombre'];
                    $tarea['especializacionNombre'] = $this->db->selectWhatWhere(tableEspecializaciones, 'nombre', array('id' => $tarea['idEspecializacion']))[0]['nombre'];
                    $tarea['prioridadNombre'] = $this->db->selectWhatWhere(tablePrioridades, 'nombre', array('id' => $tarea['idPrioridad']))[0]['nombre'];
                    $tarea['agentes'] = $this->db->selectWhatWhere(tableAxT, 'idAgente', array('idTarea' => $tarea['id'],'idPedido'=>$tarea['idPedido']));
                    foreach ($tarea['agentes'] as &$agente) {
                        $agente['idPersona'] = $this->db->selectWhatWhere(tableAgentes, 'idPersona', array('id' => $agente['idAgente']))[0]['idPersona'];
                        $returnPersona = $this->db->selectWhatWhere(tablePersonas, 'nombre, apellido', array('id' => $agente['idPersona']))[0];
                        $agente['nombre'] = $returnPersona['nombre'];
                        $agente['apellido'] = $returnPersona['apellido'];
                    }
                    $tarea['insumos'] = $this->db->selectWhatWhere(tableIxT, 'idInsumo', array('idTarea' => $tarea['id'],'idPedido'=>$tarea['idPedido']));
                    foreach ($tarea['insumos'] as &$insumo) {
                        $returnInsumo = $this->db->selectWhatWhere(tableInsumos, 'nombre, descripcion', array('id' => $insumo['idInsumo']))[0];
                        $insumo['nombre'] = $returnInsumo['nombre'];
                        $insumo['descripcion'] = $returnInsumo['descripcion'];
                    }
                }
                break;
            case 'tareas':
                $datoUno['estadoNombre'] = $this->db->selectWhatWhere(tableEstados, 'nombre', array('id' => $datoUno['idEstado']))[0]['nombre'];
                $datoUno['especializacionNombre'] = $this->db->selectWhatWhere(tableEspecializaciones, 'nombre', array('id' => $datoUno['idEspecializacion']))[0]['nombre'];
                $datoUno['prioridadNombre'] = $this->db->selectWhatWhere(tablePrioridades, 'nombre', array('id' => $datoUno['idPrioridad']))[0]['nombre'];
                $datoUno['historial'] = $this->db->selectAllWhere(tableHistorialTarea, array('idTarea' => $datoUno['id'], 'idPedido' => $datoUno['idPedido']));
                foreach ($datoUno['historial'] as &$rowHistorial) {
                    $rowHistorial['nickUsuario'] = $this->db->selectWhatWhere(tableUsuarios, 'nick', array('id' => $rowHistorial['idUsuario']))[0]['nick'];
                    $rowHistorial['estadoNombre'] = $this->db->selectWhatWhere(tableEstados, 'nombre', array('id' => $rowHistorial['idEstado']))[0]['nombre'];
                }
                $datoUno['agentes'] = $this->db->selectWhatWhere(tableAxT, 'idAgente', array('idTarea' => $datoUno['id'],'idPedido'=>$datoUno['idPedido']));
                foreach ($datoUno['agentes'] as &$agente) {
                    $agente['idPersona'] = $this->db->selectWhatWhere(tableAgentes, 'idPersona', array('id' => $agente['idAgente']))[0]['idPersona'];
                    $agente['idEstadoPersona'] = $this->db->selectWhatWhere(tablePersonas, 'idEstadoPersona', array('id' => $agente['idPersona']))[0]['idEstadoPersona'];
                }
                $datoUno['insumos'] = $this->db->selectWhatWhere(tableIxT, 'idInsumo, cantidad', array('idTarea' => $datoUno['id'],'idPedido'=>$datoUno['idPedido']));
                break;
            case 'eventos':
                $datoUno['estadoNombre'] = $this->db->selectWhatWhere(tableEstados, 'nombre', array('id' => $datoUno['idEstado']))[0]['nombre'];
                break;
            default:
                # code...
                break;
        }
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

    private function verificarFechasyVacios($datoUno)
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
        $retorno = array_merge($retorno, array(
            "estado" => $datos["estado"],
            "mensaje" => $datos["mensaje"]
        ));
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
            $retorno = array_merge($retorno, array(
                "estado" => $datos["estado"],
                "mensaje" => $datos["mensaje"]
            ));
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
