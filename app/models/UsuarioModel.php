<?php

namespace App\Models;

use App\Core\Model;

class UsuarioModel extends Model
{
    public function getFichaOne($table, $where)
    {
        return $this->getFichaOneModel($table, $where, 'retornoUnoLogic');
    }

    public function getFichaAll($table)
    {
        $comparaTablasIfUsado = array(
            array(  "tabla" => tablePedidos,
                    "comparaKeyOrig" => "id",
                    "comparaKeyDest" => "idUsuario",
                ),
            array(  "tabla" => tableTareas,
                    "comparaKeyOrig" => "id",
                    "comparaKeyDest" => "idUsuario"
                ),
            array(  "tabla" => tableOC,
                    "comparaKeyOrig" => "id",
                    "comparaKeyDest" => "idUsuario"
                )
        );
        return $this->getFichaAllModel($table, 'retornoUnoLogic', $comparaTablasIfUsado);
    }

    public function retornoUnoLogic( $datoUno)
    {
        $persona = $this->db->selectWhatWhere(tablePersonas, 'nombre,apellido', array('id' => $datoUno['idPersona']))[0];
        $datoUno['nombreApe'] = $persona['nombre'].' '.$persona['apellido'];
        $datoUno['listaRoles'] = $this->db->selectWhatWhere(tableRxU, 'idRol', array('idUsuario' => $datoUno['id']));
        foreach ($datoUno['listaRoles'] as &$rol) {
            $returnRol = $this->db->selectWhatWhere(tableRoles, 'id, nombre', array('id' => $rol['idRol']))[0];
            $rol['id'] =  $returnRol['id'];
            $rol['nombre'] =  $returnRol['nombre'];
        }
        return $datoUno;
    }
}
