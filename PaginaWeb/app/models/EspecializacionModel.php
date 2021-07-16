<?php

namespace App\Models;

use App\Core\Model;

class EspecializacionModel extends Model
{
    public function getFichaOne($table, $where)
    {
        return $this->getFichaOneModel($table, $where);
    }

    public function getFichaAll($table)
    {
        $comparaTablasIfUsado = array(
            array(  "tabla" => tableTareas,
                    "comparaKeyOrig" => "id",
                    "comparaKeyDest" => "idEspecializacion",
            ),
            array(  "tabla" => tableExA,
                    "comparaKeyOrig" => "id",
                    "comparaKeyDest" => "idEspecializacion",
                )
        );
        return $this->getFichaAllModel($table, null, $comparaTablasIfUsado);
    }
}
