<?php

namespace App\Models;

use App\Core\Model;

class PermisoModel extends Model
{
    public function getFichaOne($table, $where)
    {
        return $this->getFichaOneModel($table, $where);
    }

    public function getFichaAll($table)
    {
        $comparaTablasIfUsado = array(
            array(  "tabla" => tableRxP,
                    "comparaKeyOrig" => "id",
                    "comparaKeyDest" => "idPermiso",
                )
        );
        return $this->getFichaAllModel($table, null, $comparaTablasIfUsado);
    }
}
