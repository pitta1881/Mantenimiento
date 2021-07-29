<?php

namespace App\Models;

use App\Core\Model;

class InsumoModel extends Model
{
    public function getFichaOne($table, $where)
    {
        return $this->getFichaOneModel($table, $where, 'retornoUnoLogic');
    }

    public function getFichaAll($table)
    {
        $comparaTablasIfUsado = array(
            array(  "tabla" => tableIxT,
                    "comparaKeyOrig" => "id",
                    "comparaKeyDest" => "idInsumo",
            ),
            array(  "tabla" => tableIxOC,
                        "comparaKeyOrig" => "id",
                        "comparaKeyDest" => "idInsumo",
                )
        );
        return $this->getFichaAllModel($table, 'retornoUnoLogic', $comparaTablasIfUsado);
    }

    public function retornoUnoLogic($datoUno)
    {
        $datoUno['medidaNombre']=$this->db->selectWhatWhere(tableMedidas, 'nombre', array('id' => $datoUno['idMedida']))[0]['nombre'];
        $datoUno['historial'] = $this->db->selectAllWhere(tableHistorialInsumo, array('idInsumo' => $datoUno['id']));
        $datoUno['listaTareas'] = $this->db->selectAllWhere(tableIxT, array('idInsumo' => $datoUno['id']));
        foreach ($datoUno['historial'] as &$rowHistorial) {
            $rowHistorial['nickUsuario'] = $this->db->selectWhatWhere(tableUsuarios, 'nick', array('id' => $rowHistorial['idUsuario']))[0]['nick'];
        }
        return $datoUno;
    }
}
