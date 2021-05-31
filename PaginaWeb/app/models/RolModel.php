<?php

namespace App\Models;

use App\Core\Model;

class RolModel extends Model
{
    public function getFichaOne($table, $where)
    {
        return $this->getFichaOneModel($table, $where, 'retornoUnoLogic');
    }

    public function getFichaAll($table)
    {
        $comparaTablasIfUsado = array(
        array(  "tabla" => tableRxU,
                "comparaKeyOrig" => "id",
                "comparaKeyDest" => "idRol"
            )
        );
        return $this->getFichaAllModel($table, 'retornoUnoLogic', $comparaTablasIfUsado);
    }

    public function retornoUnoLogic( $datoUno)
    {
        $datoUno['misPermisos'] = $this->getPermisos($datoUno['id']);
        return $datoUno;
    }
}
