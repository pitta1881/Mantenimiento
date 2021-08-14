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

    public function retornoUnoLogic($datoUno)
    {
        $datoUno['estadoNombre']=$this->db->selectWhatWhere(tableEstadosPersona, 'nombre', array('id' => $datoUno['idEstadoPersona']))[0]['nombre'];
        $direccion = $this->db->selectAllWhere(tableDirecciones, array('id' => $datoUno['idDireccion']))[0];
        $datoUno['direccion']['idCiudad'] = $direccion['idCiudad'];
        $datoUno['direccion']['calle'] = $direccion['calle'];
        $datoUno['direccion']['numero'] = $direccion['numero'];
        $ciudad = $this->db->selectWhatWhere(tableCiudades, 'nombre, idProvincia', array('id' => $direccion['idCiudad']))[0];
        $datoUno['direccion']['ciudadNombre'] = $ciudad['nombre'];
        $datoUno['direccion']['idProvincia'] = $ciudad['idProvincia'];
        $datoUno['direccion']['provinciaNombre'] = $this->db->selectWhatWhere(tableProvincias, 'nombre', array('id' => $ciudad['idProvincia']))[0]['nombre'];
        return $datoUno;
    }
}
