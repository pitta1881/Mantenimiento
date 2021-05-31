<?php

namespace App\Models;

use App\Core\Model;

class PersonaModel extends Model
{
    public function getFichaOne($table, $where)
    {
        return $this->getFichaOneModel($table, $where, 'retornoUnoLogic');
    }

    public function getFichaAll($table)
    {
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
        return $this->getFichaAllModel($table, 'retornoUnoLogic', $comparaTablasIfUsado);
    }

    public function retornoUnoLogic( $datoUno)
    {
        $datoUno['estadoNombre']=$this->db->selectWhatWhere(tableEstadosPersona, 'nombre', array('id' => $datoUno['idEstadoPersona']))[0]['nombre'];
        return $datoUno;
    }
}
