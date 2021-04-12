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
                return $e;
            }
        }
    }

    public function buscarIfExists($table, $where)
    {
        foreach ($where as $key => $value) {
            $setPart[] = "{$key} = :{$key}";
            $bindings[":{$key}"] = $value;
        }
        try {
            $sql = "SELECT 1 FROM {$table} WHERE ".implode(' AND ', $setPart)." LIMIT 1";
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

    public function update($table, $parameters, $where)
    {
        foreach ($parameters as $key => $value) {
            $setPartData[] = "{$key} = :{$key}";
            $bindingsData[":{$key}"] = $value;
        }
        foreach ($where as $key => $value) {
            $setPartWhere[] = "{$key} = :{$key}";
            $bindingsWhere[":{$key}"] = $value;
        }
        $arrayBindings = array_merge($bindingsData, $bindingsWhere);
        try {
            $sql = "UPDATE {$table} SET ".implode(', ', $setPartData)." WHERE ".implode(' AND ', $setPartWhere);
            $stmt = $this->pdo->prepare($sql);
            if ($stmt->execute($arrayBindings)) {
                return array("estado" => true,
                            "mensaje" => $this->pdo->lastInsertId());
            }
        } catch (Exception $e) {
            if ($e->errorInfo[1] == 1062) { //clave duplicada
                return array("estado" => false,
                            "mensaje" => "El nombre ya existe.. (clave duplicada)");
            } else {
                return $e;
            }
        }
    }

    public function delete($table, $where)
    {
        foreach ($where as $key => $value) {
            $setPartWhere[] = "{$key} = :{$key}";
            $bindingsWhere[":{$key}"] = $value;
        }
        try {
            $sql = "DELETE FROM {$table} WHERE ".implode(' AND ', $setPartWhere);
            $stmt = $this->pdo->prepare($sql);
            if ($stmt->execute($bindingsWhere)) {
                return array("estado" => true,
                             "mensaje" => "Eliminado Correctamente");
            }
        } catch (Exception $e) {
            if ($e->errorInfo[1] == 1451) { //no puede eliminar (o updatear) una fila padre
                return array("estado" => false,
                            "mensaje" => "No se puede eliminar una fila padre (FK)");
            } else {
                return $e;
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
    
    private function sendToLog(Exception $e)
    {
        if ($this->logger) {
            $this->logger->error('Error', ["Error" => $e]);
        }
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
