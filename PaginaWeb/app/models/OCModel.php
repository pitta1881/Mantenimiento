<?php

namespace App\Models;

use App\Core\Model;

class OCModel extends Model
{
    public function getFichaOne($table, $where)
    {
        return $this->getFichaOneModel($table, $where, 'retornoUnoLogic');
    }

    public function getFichaAll($table, $start = null, $end = null)
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
        return $this->getFichaAllModel($table, 'retornoUnoLogic', $comparaTablasIfUsado, $start, $end);
    }

    public function retornoUnoLogic($datoUno)
    {
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
        return $datoUno;
    }
}
