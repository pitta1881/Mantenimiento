<?php

namespace App\Core\Database;

use PDO;
use Exception;

class QueryBuilder
{
    /**
     * The PDO instance.
     *
     * @var PDO
     */
    protected $pdo;

    /**
     * Create a new QueryBuilder instance.
     *
     * @param PDO $pdo
     */
    public function __construct($pdo, $logger = null)
    {
        $this->pdo = $pdo;
        $this->logger = ($logger) ? $logger : null;
    }

    /**
     * Limpia guiones - que puedan venir en los nombre de los parametros
     * ya que esto no funciona con PDO
     *
     * Ver: http://php.net/manual/en/pdo.prepared-statements.php#97162
     */

    private function cleanParameterName($parameters)
    {
        $cleaned_params = [];
        foreach ($parameters as $key => $value) {
            if (($key != 'fechaInicio') && ($key != 'fechaFin') && ($key != 'fecha')) {
                $cleaned_params[str_replace('-', '', $key)] = str_replace('-', '', $value) ;
            } else {
                $cleaned_params[$key] = $value;
            }
        }
        return $cleaned_params;
    }

    /**
     * Select all records from a database table.
     *
     * @param string $table
     */
    public function selectAll($table)
    {
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table}"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Insert a record into a table.
     *
     * @param  string $table
     * @param  array  $parameters
     */
    public function insert($table, $parameters)
    {
        $parameters = $this->cleanParameterName($parameters);
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );
        try {
            $statement = $this->pdo->prepare($sql);
            if ($statement->execute($parameters)) {
                return array("estado" => true,
                             "mensaje" => $this->pdo->lastInsertId());
            }
        } catch (Exception $e) {
            if ($e->errorInfo[1] == 1062) { //clave duplicada
                return array("estado" => false,
                            "mensaje" => "El nombre ya existe.. (clave duplicada)");
            } else {
                // an error other than duplicate entry occurred
            }
        }
    }

    public function buscarIfExists($table, $parameters)
    {
        $columnaCompara = array_key_first($parameters);
        $datoColumnaCompara = $parameters[$columnaCompara];
        $sql = sprintf(
            "select 1 from %s where %s='%s' limit 1",
            $table,
            $columnaCompara,
            $datoColumnaCompara
        );
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            if ($statement->fetchColumn()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $e->getCode();
        }
    }

    public function buscarIfExistsAnd($table, $parameters)
    {
        $columnaCompara = array_key_first($parameters);
        $datoColumnaCompara = $parameters[$columnaCompara];
        array_shift($parameters);
        $parameters = $this->cleanParameterName($parameters);
        $setPart = array();
        $bindings = array();

        foreach ($parameters as $key => $value) {
            $setPart[] = "{$key} = :{$key}";
            $bindings[":{$key}"] = $value;
        }
        try {
            $sql = "SELECT 1 FROM {$table} WHERE ".implode('AND ', $setPart)." LIMIT 1";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($bindings);
            if ($stmt->fetchColumn()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function update($table, $parameters)
    {
        $columnaCompara = array_key_first($parameters);
        $datoColumnaCompara = $parameters[$columnaCompara];
        array_shift($parameters);
        $parameters = $this->cleanParameterName($parameters);
        $setPart = array();
        $bindings = array();

        foreach ($parameters as $key => $value) {
            $setPart[] = "{$key} = :{$key}";
            $bindings[":{$key}"] = $value;
        }
        try {
            $sql = "UPDATE {$table} SET ".implode(', ', $setPart)." WHERE {$columnaCompara} ='{$datoColumnaCompara}'";
            $stmt = $this->pdo->prepare($sql);
            if ($stmt->execute($bindings)) {
                return array("estado" => true,
                            "mensaje" => $this->pdo->lastInsertId());
            }
        } catch (Exception $e) {
            if ($e->errorInfo[1] == 1062) { //clave duplicada
                return array("estado" => false,
                            "mensaje" => "El nombre ya existe.. (clave duplicada)");
            } else {
                // an error other than duplicate entry occurred
            }
        }
    }

    public function delete($table, $parameters)
    {
        $columnaCompara = array_key_first($parameters);
        $datoColumnaCompara = $parameters[$columnaCompara];
        $sql = sprintf(
            "delete from %s where %s='%s'",
            $table,
            $columnaCompara,
            $datoColumnaCompara
        );
        try {
            $statement = $this->pdo->prepare($sql);
            if ($statement->execute($parameters)) {
                return array("estado" => true,
                             "mensaje" => "Eliminado Correctamente");
            }
        } catch (Exception $e) {
            if ($e->errorInfo[1] == 1451) { //no puede eliminar (o updatear) una fila padre
                return array("estado" => false,
                            "mensaje" => "No se puede eliminar una fila padre (FK)");
            } else {
                // an error other than duplicate entry occurred
            }
        }
    }

    public function selectAllWhere($table, $parameters)
    {
        $columnaCompara = array_key_first($parameters);
        $datoColumnaCompara = $parameters[$columnaCompara];
        $sql = sprintf(
            "select * from %s where %s='%s'",
            $table,
            $columnaCompara,
            $datoColumnaCompara
        );
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }

    public function selectWhat($table, $what)
    {
        $sql = sprintf(
            "select %s from %s",
            $what,
            $table
        );
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }

    public function selectWhatWhere($table, $what, $parameters)
    {
        $columnaCompara = array_key_first($parameters);
        $datoColumnaCompara = $parameters[$columnaCompara];
        $sql = sprintf(
            "select %s from %s where %s='%s'",
            $what,
            $table,
            $columnaCompara,
            $datoColumnaCompara
        );
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return false;
        }
    }

    public function selectWhatWherePerm($table, $what, $parameters)
    {
        $columnaCompara = array_key_first($parameters);
        $datoColumnaCompara = $parameters[$columnaCompara];
        $sql = sprintf(
            "select %s from %s where %s='%s'",
            $what,
            $table,
            $columnaCompara,
            $datoColumnaCompara
        );
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
            return $statement->fetchAll(PDO::FETCH_COLUMN);
        } catch (Exception $e) {
            return false;
        }
    }

    public function countWhatFromWhere($table, $what, $parameters)
    {
        $columnaCompara = array_key_first($parameters);
        $datoColumnaCompara = $parameters[$columnaCompara];
        $sql = sprintf(
            "SELECT COUNT(%s) from %s where %s='%s'",
            $what,
            $table,
            $columnaCompara,
            $datoColumnaCompara
        );
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
            return $statement->fetchAll(PDO::FETCH_COLUMN);
        } catch (Exception $e) {
            return false;
        }
    }
  
    public function comparaInsumos($table, $nombreInsumo, $descripcion)
    {
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table}
            WHERE nombreInsumo='{$nombreInsumo}' AND descripcion='{$descripcion}'"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
    
    public function comparaEventos($table, $nombreEvento)
    {
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table}
            WHERE nombreEvento='{$nombreEvento}'"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
    
    public function getActivos($table, $columna)
    {
        $statement = $this->pdo->prepare(
            "SELECT COUNT($columna) FROM $table WHERE estado = 'Iniciado'"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function getAgentesDisponibles($table)
    {
        $statement = $this->pdo->prepare(
            "SELECT COUNT(disponible) FROM $table WHERE disponible = 1"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_NUM);
    }

    
    private function sendToLog(Exception $e)
    {
        if ($this->logger) {
            $this->logger->error('Error', ["Error" => $e]);
        }
    }

    public function selectTareasSinAsignar($tableTarea)
    {
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tableTarea WHERE estado='Iniciado' ORDER BY idPedido ASC"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function newOT($tableOT)
    {
        $hoy = date("Y-m-d");
        $statement = $this->pdo->prepare(
            "INSERT INTO $tableOT(fechaInicio,estado) VALUES ('$hoy','Iniciado')"
        );
        $statement->execute();
    }

    public function getIdUltimoOT($tableOT)
    {
        $statement = $this->pdo->prepare(
            "SELECT MAX(idOT) FROM $tableOT"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_NUM);
    }

   
    public function getCantTareasOT($tableItem, $idOT)
    { //table = itemOT
        $statement = $this->pdo->prepare(
            "SELECT COUNT(idTarea) FROM $tableItem
        WHERE idOT = $idOT"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_NUM);
    }


    public function getIdFromNombreEspecializacion($tableEsp, $nombre)
    {
        $statement = $this->pdo->prepare(
            "SELECT (idEspecializacion) FROM $tableEsp WHERE nombre='$nombre'"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function getNombreFromIdEspecializacion($tableEsp, $idEsp)
    {
        $statement = $this->pdo->prepare(
            "SELECT (nombre) FROM $tableEsp WHERE idEspecializacion=$idEsp"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_NUM);
    }


    public function selectAgentesDisponibles($tableAgente, $urgencia)
    {
        if ($urgencia) {
            $statement = $this->pdo->prepare(
                "SELECT * FROM $tableAgente T1 INNER JOIN personas T2 ON T1.idAgente=T2.id WHERE T2.estado='Activo'"
            );
        } else {
            $statement = $this->pdo->prepare(
                "SELECT * FROM $tableAgente WHERE disponible=1"
            );
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function updateEstadoAgente($tableAgente, $nAgente, $estado)
    {
        $statement = $this->pdo->prepare(
            "UPDATE $tableAgente SET disponible=$estado WHERE idAgente=$nAgente"
        );
        $statement->execute();
    }

    public function getAgentesAsignadosPorIdId($tableItemAgente, $idPedido, $idTarea)
    {
        $statement = $this->pdo->prepare(
            "SELECT COUNT(idAgente) FROM $tableItemAgente WHERE idTarea=$idTarea AND idPedido=$idPedido"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function getInsumosAsignadosPorIdId($tableItemInsumos, $idPedido, $idTarea)
    {
        $statement = $this->pdo->prepare(
            "SELECT COUNT(idInsumo) FROM $tableItemInsumos WHERE idTarea=$idTarea AND idPedido=$idPedido"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function selectAgentesPorNPedidoNTarea($tableAgente, $tableItem, $nPedido, $nTarea)
    {
        $statement = $this->pdo->prepare(
            "SELECT T1.idAgente,idEspecializacion FROM $tableItem T1 INNER JOIN $tableAgente T2 ON T1.idAgente=T2.idAgente WHERE idPedido=$nPedido AND idTarea=$nTarea"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function desasignarAgente($tableItemAgentes, $idPedido, $idTarea, $idAgente)
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM $tableItemAgentes  WHERE idPedido = $idPedido AND idTarea = $idTarea AND idAgente=$idAgente"
        );
        $statement->execute();
    }


    public function deleteEvento($table, $idEvento)
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM $table  WHERE idEvento = $idEvento"
        );
        $statement->execute();
    }
    public function selectEventoById($table, $nEvento)
    {
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} 
            WHERE idEvento={$nEvento}"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function getEventos($table)
    { //table = sectores
        $statement = $this->pdo->prepare(
            "SELECT nombreEvento FROM $table"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }



    public function updateEvento($table, $parameters, $idEvento)
    {
        $parameters = $this->cleanParameterName($parameters);
        $sql = "UPDATE $table SET fechaInicio=:fechaInicio, fechaFin=:fechaFin, descripcion=:descripcion, nombreEvento=:nombreEvento WHERE idEvento=$idEvento"; //recontra HARDCODEADO
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
        } catch (Exception $e) {
            $this->sendToLog($e);
        }
    }



    public function selectAllEventosOrdenados($table)
    {
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} ORDER BY fechaInicio ASC "
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }


    public function selectOTById($table, $nOT)
    { //table = ot
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} 
            WHERE idOT={$nOT}"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectTareasPorNOT($tableTarea, $tableItem, $nOT)
    {
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tableTarea T1 INNER JOIN $tableItem T2 ON T1.idPedido=T2.idPedido AND T1.idTarea=T2.idTarea WHERE idOT=$nOT"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function getNombreSectorPorIdPedido($tablePedido, $tableSector, $nPedido)
    {
        $statement = $this->pdo->prepare(
            "SELECT nombreSector FROM $tablePedido T1 INNER JOIN $tableSector T2 ON T1.idSector=T2.idSector WHERE T1.id=$nPedido"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_NUM);
    }

    
    public function selectOTPorNPedidoNTarea($tableOT, $tableItemOT, $nPedido, $nTarea)
    {
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tableOT T1 INNER JOIN $tableItemOT T2 ON T1.idOT=T2.idOT WHERE idPedido=$nPedido AND idTarea=$nTarea"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function updateEstadoTarea($tableTarea, $nPedido, $nTarea, $estado)
    {
        $statement = $this->pdo->prepare(
            "UPDATE $tableTarea SET estado='$estado' WHERE idPedido=$nPedido AND idTarea=$nTarea"
        );
        $statement->execute();
    }

    public function updateEstadoOT($tableOT, $nOT, $estado)
    {
        $statement = $this->pdo->prepare(
            "UPDATE $tableOT SET estado='$estado' WHERE idOT=$nOT"
        );
        $statement->execute();
    }

    public function updateFechaFinOT($tableOT, $nOT, $fechaFin)
    {
        $statement = $this->pdo->prepare(
            "UPDATE $tableOT SET fechaFin='$fechaFin' WHERE idOT=$nOT"
        );
        $statement->execute();
    }

    public function deleteEventoValidar($table, $idEvento)
    {
        $statement = $this->pdo->prepare(
            "DELETE FROM $table  WHERE idEvento = $idEvento"
        );
        $statement->execute();
    }

    
    public function dameSectores($tablaPedidos, $tablaSectores, $fechaDesde, $fechafin)
    {
        $statement = $this->pdo->prepare("SELECT $tablaSectores.idSector,$tablaSectores.nombreSector, COUNT(*) as suma FROM $tablaPedidos INNER JOIN $tablaSectores where $tablaPedidos.idSector=$tablaSectores.idSector  AND $tablaPedidos.fechaInicio>=$fechaDesde GROUP BY $tablaSectores.nombreSector  ");
        $statement->execute();
        //var_dump($statement);
       
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    


    public function dameinformeEspe($tablaTarea, $tablaEspecializacion, $tablaPedido, $fechaDesde, $fechaHasta)
    {
        $statement = $this->pdo->prepare("
SELECT $tablaEspecializacion.idEspecializacion,$tablaEspecializacion.nombre, COUNT(*) as suma FROM $tablaTarea INNER JOIN $tablaEspecializacion where $tablaEspecializacion.idEspecializacion=$tablaTarea.idEspecializacion GROUP BY $tablaEspecializacion.nombre");
        $statement->execute();
   
       
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
     
    public function dameinformeEstado($tablaPedido, $fechaDesde, $fechaHasta)
    {
        $statement = $this->pdo->prepare("
SELECT estado ,COUNT(*) as suma FROM $tablaPedido WHERE fechaInicio>=$fechaDesde  GROUP BY estado ");
        $statement->execute();
    
       
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
}
