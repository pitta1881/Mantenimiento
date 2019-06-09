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
     * Select all records from a database table.
     *
     * @param string $table
     */
    public function selectAll($table){
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table}"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

        /*
    Selecciono un registro especifico cuyo PK viene por parametro 
    PARA PEDIDO
    */
    public function selectNumeroPedido($table, $numero){
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} 
            WHERE id={$numero}"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
    
    public function selectTareasPorNPedido($table, $numero){ //table = tarea
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} 
            WHERE idPedido={$numero}"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    
    public function validarLogin($table, $usuario ,$password){
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} 
            WHERE nombre='{$usuario}' AND password='{$password}' "
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
public function comparaUsuario($table, $usuario ){  $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} 
            WHERE nombre='{$usuario}'  "
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
    /**
     * Insert a record into a table.
     *
     * @param  string $table
     * @param  array  $parameters
     */
    public function insert($table, $parameters){
        $parameters = $this->cleanParameterName($parameters);
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
        } catch (Exception $e) {
            $this->sendToLog($e);
        }
        
    }
    
    
    public function buscar($table,$filter,$value){
            $statement = $this->pdo->prepare(
               "SELECT * FROM {$table} 
            WHERE {$filter} = '{$value}' ORDER BY '{$filter}'"
   
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function getActivos(){
            $statement = $this->pdo->prepare(
               "SELECT COUNT('id') FROM pedido 
            WHERE estado = 'Iniciado'"
   
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    
    /**
     * update a record .
     *
     * @param  string $table
     * @param  array  $parameters
     */
    public function updatePedido($table, $parameters, $id){
        $parameters = $this->cleanParameterName($parameters);
        $sql = "UPDATE $table SET fechaInicio=:fechaInicio, estado=:estado, descripcion=:descripcion, sector=:sector, prioridad=:prioridad WHERE id=$id"; //recontra HARDCODEADO
            try {
                $statement = $this->pdo->prepare($sql);
                $statement->execute($parameters);
            } catch (Exception $e) {
                $this->sendToLog($e);
            }   
    }

    private function sendToLog(Exception $e)
    {
        if ($this->logger) {
            $this->logger->error('Error', ["Error" => $e]);
        }
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
        foreach ($parameters as $name => $value) {
            $cleaned_params[str_replace('-', '', $name)] = $value ;
        }
        return $cleaned_params;
    }

    public function idTareaSiguiente($table,$idPedido){
        $statement = $this->pdo->prepare(
           "SELECT MAX(idTarea) FROM $table
        WHERE idPedido = $idPedido"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function countTareasAsignadas($table,$idPedido){ //table = tarea
        $statement = $this->pdo->prepare(
           "SELECT COUNT(idTarea) FROM $table
        WHERE idPedido = $idPedido"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_NUM);
    }
    

    
    public function deleteTarea($table,$idPedido,$idTarea){ //table = tarea
        $statement = $this->pdo->prepare(
           "DELETE FROM $table  WHERE idPedido = $idPedido AND idTarea = $idTarea"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function selectAllRoles($tableRol){
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tableRol"
       
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
   }

    public function selectTareaByIdId($table, $nPedido, $nTarea){ //table = tarea
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} 
            WHERE idPedido={$nPedido} AND idTarea={$nTarea}"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function updateTarea($table, $parameters, $nTarea, $nPedido){
        $parameters = $this->cleanParameterName($parameters);
        $sql = "UPDATE $table SET estado=:estado, descripcion=:descripcion, prioridad=:prioridad, especializacion=:especializacion
        WHERE idTarea=$nTarea AND idPedido=$nPedido"; //recontra HARDCODEADO
            try {
                $statement = $this->pdo->prepare($sql);
                $statement->execute($parameters);
            } catch (Exception $e) {
                $this->sendToLog($e);
            }   
    }

    public function getIdUltimoPedidoDB($table){
        $statement = $this->pdo->prepare(
           "SELECT MAX(id) FROM $table"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function selectAllOT($tableOT){
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$tableOT}"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectTareasSinAsignar($tableTarea){
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tableTarea WHERE estado='Iniciado'"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
   }

    public function newOT($tableOT){
        $hoy = date("Y-m-d");
        $statement = $this->pdo->prepare(
        "INSERT INTO $tableOT(fechaInicio,estado) VALUES ('$hoy','Iniciado')"
    );
        $statement->execute();
    }

    public function getIdUltimoOT($tableOT){
        $statement = $this->pdo->prepare(
            "SELECT MAX(idOT) FROM $tableOT"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_NUM);
    }
}
