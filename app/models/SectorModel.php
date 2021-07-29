<?php

namespace App\Models;

use App\Core\Model;

class SectorModel extends Model
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
                    "comparaKeyDest" => "idSector",
                )
        );
        return $this->getFichaAllModel($table, 'retornoUnoLogic', $comparaTablasIfUsado);
    }

    public function retornoUnoLogic( $datoUno)
    {
        $datoUno['tipoSectorNombre'] = $this->db->selectWhatWhere(tableTiposSector, 'nombre', array('id' => $datoUno['idTipoSector']))[0]['nombre'];
        return $datoUno;
    }
}
