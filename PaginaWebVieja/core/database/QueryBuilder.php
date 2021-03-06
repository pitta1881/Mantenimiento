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

    public function borrarPermisosAsociados($idRol){
        $statement = $this->pdo->prepare(
            "DELETE FROM rolesxPermisos WHERE idRol=$idRol"
         );
         $statement->execute();
 
    }
    



    public function updateRol($table, $parameters, $id){
        $parameters = $this->cleanParameterName($parameters);
        $sql = "UPDATE $table SET  nombreRol=:nombreRol WHERE idRol=$id"; //recontra HARDCODEADO
            try {
                $statement = $this->pdo->prepare($sql);
                $statement->execute($parameters);
            } catch (Exception $e) {
                $this->sendToLog($e);
            }   
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
    
    public function comparaUsuario($table, $usuario ){  
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} 
            WHERE nombre='{$usuario}'  "
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
    

    public function comparaEspecializacion($table, $nombre){  
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} 
            WHERE nombre='{$nombre}'"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function comparaPermiso($table, $nombre){  
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} 
            WHERE nombrePermiso='{$nombre}'"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
    
    public function selectUsuarioPorPersonaPorRol($tableUsuario, $tablePersona, $tableRol){  
        $statement = $this->pdo->prepare(
            "SELECT t1.nombre, t2.nombre,t2.apellido,t2.dni,t3.nombreRol FROM $tableUsuario t1 inner JOIN $tablePersona t2 ON t1.nombre=t2.dni inner JOIN $tableRol t3 ON t1.idRol=t3.idRol"
        );
       try{
        $statement->execute();
       }catch(Exception $e){$this->sendToLog($e);}
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }



    
    public function comparaInsumos($table, $nombreInsumo, $descripcion) {
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table}
            WHERE nombreInsumo='{$nombreInsumo}' AND descripcion='{$descripcion}'"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
        
    }
    
    public function comparaSectores($table, $nombreSector) {
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table}
            WHERE nombreSector='{$nombreSector}'"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
        
    }
    
    public function comparaEventos($table, $nombreEvento) {
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table}
            WHERE nombreEvento='{$nombreEvento}'"
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

    public function getActivos($table,$columna){
            $statement = $this->pdo->prepare(
               "SELECT COUNT($columna) FROM $table WHERE estado = 'Iniciado'"   
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function getAgentesDisponibles($table){
        $statement = $this->pdo->prepare(
           "SELECT COUNT(disponible) FROM $table WHERE disponible = 1"   
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_NUM);
}

    
    /**
     * update a record .
     *
     * @param  string $table
     * @param  array  $parameters
     */
    public function updatePedido($table, $parameters, $id){
        $parameters = $this->cleanParameterName($parameters);
        $sql = "UPDATE $table SET fechaInicio=:fechaInicio, estado=:estado, descripcion=:descripcion, idSector=:idSector, prioridad=:prioridad WHERE id=$id"; //recontra HARDCODEADO
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
        $sql = "UPDATE $table SET descripcion=:descripcion, prioridad=:prioridad, idEspecializacion=:idEspecializacion
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

    public function selectTareasSinAsignar($tableTarea){
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tableTarea WHERE estado='Iniciado' ORDER BY idPedido ASC"
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

   
    public function getCantTareasOT($tableItem,$idOT){ //table = itemOT
        $statement = $this->pdo->prepare(
           "SELECT COUNT(idTarea) FROM $tableItem
        WHERE idOT = $idOT"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function selectInsumoById($table, $nInsumo){
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} 
            WHERE idInsumo={$nInsumo}"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function updateInsumo($table, $parameters, $nInsumo){
        $parameters = $this->cleanParameterName($parameters);
        $sql = "UPDATE $table SET nombreInsumo=:nombreInsumo, descripcion=:descripcion, stockMinimo=:stockMinimo WHERE idInsumo=$nInsumo";
            try {
                $statement = $this->pdo->prepare($sql);
                $statement->execute($parameters);
            } catch (Exception $e) {
                $this->sendToLog($e);
            }   
    }

    public function deleteInsumo($table,$idInsumo){ //table = insumos
        $statement = $this->pdo->prepare(
           "DELETE FROM $table  WHERE idInsumo = $idInsumo"
        );
        $statement->execute();
    }

    public function selectAgenteById($table, $nAgente){
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} 
            WHERE idAgente={$nAgente}"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectUsuarioByNombre($table, $nAgente){
        $statement = $this->pdo->prepare(
            "SELECT nombre,idRol,idPersona FROM {$table} 
            WHERE nombre='{$nAgente}'"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function updateAgente($table, $parameters, $nAgente){
        $parameters = $this->cleanParameterName($parameters);
        $sql = "UPDATE $table SET idEspecializacion=:idEspecializacion WHERE idAgente=$nAgente";
            try {
                $statement = $this->pdo->prepare($sql);
                $statement->execute($parameters);
            } catch (Exception $e) {
                $this->sendToLog($e);
            }   
    }

    public function deleteAgente($table,$idAgente){ //table = agentes
        $statement = $this->pdo->prepare(
           "DELETE FROM $table  WHERE idAgente = $idAgente"
        );
        $statement->execute();
    }

    public function selectEspecializacionById($table, $nEspecializacion){
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} 
            WHERE idEspecializacion={$nEspecializacion}"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function updateEspecializacion($table, $parameters, $nEspecializacion){
        $parameters = $this->cleanParameterName($parameters);
        $sql = "UPDATE $table SET nombre=:nombre WHERE idEspecializacion=$nEspecializacion";
            try {
                $statement = $this->pdo->prepare($sql);
                $statement->execute($parameters);
            } catch (Exception $e) {
                $this->sendToLog($e);
            }   
    }

    public function deleteEspecializacion($table,$idEspecializacion){ //table = agentes
        $statement = $this->pdo->prepare(
           "DELETE FROM $table  WHERE idEspecializacion = $idEspecializacion"
        );
        $statement->execute();
    }

    public function deletePermiso($table,$idEspecializacion){ //table = agentes
        $statement = $this->pdo->prepare(
           "DELETE FROM $table  WHERE idPermiso = $idEspecializacion"
        );
        $statement->execute();
    }


    public function getEspecializaciones($table){ //table = especializacion
        $statement = $this->pdo->prepare(
           "SELECT nombre FROM $table"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function getIdFromNombreEspecializacion($tableEsp,$nombre){
        $statement = $this->pdo->prepare(
           "SELECT (idEspecializacion) FROM $tableEsp WHERE nombre='$nombre'"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function getNombreFromIdEspecializacion($tableEsp,$idEsp){
        $statement = $this->pdo->prepare(
           "SELECT (nombre) FROM $tableEsp WHERE idEspecializacion=$idEsp"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function getNombreFromIdPermiso($tableEsp,$idEsp){
        $statement = $this->pdo->prepare(
           "SELECT idPermiso, nombrePermiso FROM $tableEsp WHERE idPermiso=$idEsp"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
    }


public function updateSector($table, $parameters, $nSector){
        $parameters = $this->cleanParameterName($parameters);
        $sql = "UPDATE $table SET nombreSector=:nombreSector, tipo=:tipo, responsable=:responsable, telefono=:telefono, email=:email WHERE idSector=$nSector";
            try {
                $statement = $this->pdo->prepare($sql);
                $statement->execute($parameters);
            } catch (Exception $e) {
                $this->sendToLog($e);
            }   
    }

    public function deleteSector($table,$idSector){ 
        $statement = $this->pdo->prepare(
           "DELETE FROM $table  WHERE idSector = $idSector"
        );
        $statement->execute();
    }
public function selectSectorById($table, $nSector){
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} 
            WHERE idSector={$nSector}"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function getSectores($table){ //table = sectores
        $statement = $this->pdo->prepare(
           "SELECT nombreSector FROM $table"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function getIdFromNombreSector($tableSector,$nombre){
        $statement = $this->pdo->prepare(
           "SELECT (idSector) FROM $tableSector WHERE nombreSector='$nombre'"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function getNombreFromIdSector($tableSector,$idSector){
        $statement = $this->pdo->prepare(
           "SELECT (nombreSector) FROM $tableSector WHERE idSector=$idSector"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function selectAgentesDisponibles($tableAgente, $urgencia){
        if ($urgencia) {
            $statement = $this->pdo->prepare(
                "SELECT * FROM $tableAgente T1 INNER JOIN personas T2 ON T1.idAgente=T2.dni WHERE T2.estado='Activo'"
            );
        } else {
            $statement = $this->pdo->prepare(
                "SELECT * FROM $tableAgente WHERE disponible=1"
            );
        }        
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
   }

   public function updateEstadoAgente($tableAgente, $nAgente, $estado){
    $statement = $this->pdo->prepare(
        "UPDATE $tableAgente SET disponible=$estado WHERE idAgente=$nAgente"
    );
    $statement->execute();
    }

    public function getAgentesAsignadosPorIdId($tableItemAgente,$idPedido,$idTarea){
        $statement = $this->pdo->prepare(
        "SELECT COUNT(idAgente) FROM $tableItemAgente WHERE idTarea=$idTarea AND idPedido=$idPedido"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function getInsumosAsignadosPorIdId($tableItemInsumos,$idPedido,$idTarea){
        $statement = $this->pdo->prepare(
        "SELECT COUNT(idInsumo) FROM $tableItemInsumos WHERE idTarea=$idTarea AND idPedido=$idPedido"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function selectAgentesPorNPedidoNTarea($tableAgente, $tableItem, $nPedido, $nTarea){ 
        $statement = $this->pdo->prepare(
            "SELECT T1.idAgente,idEspecializacion FROM $tableItem T1 INNER JOIN $tableAgente T2 ON T1.idAgente=T2.idAgente WHERE idPedido=$nPedido AND idTarea=$nTarea"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function desasignarAgente($tableItemAgentes,$idPedido,$idTarea,$idAgente){
        $statement = $this->pdo->prepare(
           "DELETE FROM $tableItemAgentes  WHERE idPedido = $idPedido AND idTarea = $idTarea AND idAgente=$idAgente"
        );
        $statement->execute();
    }


public function deleteEvento($table,$idEvento){ 
        $statement = $this->pdo->prepare(
           "DELETE FROM $table  WHERE idEvento = $idEvento"
        );
        $statement->execute();
    }
public function selectEventoById($table, $nEvento){
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} 
            WHERE idEvento={$nEvento}"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function getEventos($table){ //table = sectores
        $statement = $this->pdo->prepare(
           "SELECT nombreEvento FROM $table"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
    }



public function updateEvento($table, $parameters, $idEvento){
        $parameters = $this->cleanParameterName($parameters);
        $sql = "UPDATE $table SET fechaInicio=:fechaInicio, fechaFin=:fechaFin, descripcion=:descripcion, nombreEvento=:nombreEvento WHERE idEvento=$idEvento"; //recontra HARDCODEADO
            try {
                $statement = $this->pdo->prepare($sql);
                $statement->execute($parameters);
            } catch (Exception $e) {
                $this->sendToLog($e);
            }   
    }



 public function selectAllEventosOrdenados($table){
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} ORDER BY fechaInicio ASC "
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    
    public function getFromPedidoConIdSector($tablePedido,$nSector){ 
        $statement = $this->pdo->prepare(
           "SELECT id FROM $tablePedido WHERE idSector=$nSector"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function getFromItemAgenteConIdAgente($tableItemAgente,$nAgente){ 
        $statement = $this->pdo->prepare(
           "SELECT idPedido FROM $tableItemAgente WHERE idAgente=$nAgente"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function getFromAgenteConIdEspecializacion($tableAgente,$nEspecializacion){ 
        $statement = $this->pdo->prepare(
           "SELECT idAgente FROM $tableAgente WHERE idEspecializacion=$nEspecializacion"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function getFromTareaConIdEspecializacion($tableTarea,$nEspecializacion){ 
        $statement = $this->pdo->prepare(
           "SELECT idTarea FROM $tableTarea WHERE idEspecializacion=$nEspecializacion"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectOTById($table, $nOT){ //table = ot
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} 
            WHERE idOT={$nOT}"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectTareasPorNOT($tableTarea, $tableItem, $nOT){ 
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tableTarea T1 INNER JOIN $tableItem T2 ON T1.idPedido=T2.idPedido AND T1.idTarea=T2.idTarea WHERE idOT=$nOT"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function getNombreSectorPorIdPedido($tablePedido,$tableSector,$nPedido){ 
        $statement = $this->pdo->prepare(
           "SELECT nombreSector FROM $tablePedido T1 INNER JOIN $tableSector T2 ON T1.idSector=T2.idSector WHERE T1.id=$nPedido"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_NUM);
    }

    
    public function selectOTPorNPedidoNTarea($tableOT, $tableItemOT, $nPedido, $nTarea){ 
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tableOT T1 INNER JOIN $tableItemOT T2 ON T1.idOT=T2.idOT WHERE idPedido=$nPedido AND idTarea=$nTarea"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function updateEstadoPedido($tablePedido, $nPedido,$estado){
        $statement = $this->pdo->prepare(
            "UPDATE $tablePedido SET estado='$estado' WHERE id=$nPedido"
        );
        $statement->execute();
        }

    public function updateEstadoTarea($tableTarea, $nPedido, $nTarea, $estado){
        $statement = $this->pdo->prepare(
            "UPDATE $tableTarea SET estado='$estado' WHERE idPedido=$nPedido AND idTarea=$nTarea"
        );
        $statement->execute();
    }

    public function updateEstadoOT($tableOT, $nOT,$estado){
        $statement = $this->pdo->prepare(
            "UPDATE $tableOT SET estado='$estado' WHERE idOT=$nOT"
        );
        $statement->execute();
    }

    public function updateFechaFinPedido($tablePedido, $nPedido,$fechaFin){
        $statement = $this->pdo->prepare(
            "UPDATE $tablePedido SET fechaFin='$fechaFin' WHERE id=$nPedido"
        );
        $statement->execute();
    }

    public function updateFechaFinOT($tableOT, $nOT,$fechaFin){
        $statement = $this->pdo->prepare(
            "UPDATE $tableOT SET fechaFin='$fechaFin' WHERE idOT=$nOT"
        );
        $statement->execute();
    }

     public function deleteEventoValidar($table,$idEvento){ 
        $statement = $this->pdo->prepare(
            "DELETE FROM $table  WHERE idEvento = $idEvento"
        );
        $statement->execute();
    }

     public function selectAllPermisos($tablePermisos){
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$tablePermisos} ORDER BY nombrePermiso ASC "
       
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectAllPersonas($tablePersona){
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$tablePersona}"       
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectPersonasNoAgentes($tablePersona, $tableAgente){ 
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tablePersona T1 LEFT JOIN $tableAgente T2 ON T1.dni=T2.idAgente WHERE T2.idAgente IS NULL AND T1.dni<>0"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectPersonaByDNI($tablePersona, $dni){ 
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tablePersona WHERE dni=$dni"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
    

    public function selectRolById($tableRol, $idRol){ 
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tableRol WHERE idRol=$idRol"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }


    public function selectPermisosByRol( $idRol){ 
        $statement = $this->pdo->prepare(
            "SELECT idPermiso FROM rolesxpermisos WHERE idRol=$idRol"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }


    public function comparaPersona($tablePersona, $dni){  
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tablePersona WHERE dni=$dni"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
    
    public function getFromAgenteConIdPersona($tableAgente,$nAgente){ 
        $statement = $this->pdo->prepare(
           "SELECT idAgente FROM $tableAgente WHERE idAgente=$nAgente"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
    }
    
    public function updatePersona($tablePersona, $parameters, $dni){
        $parameters = $this->cleanParameterName($parameters);
        $sql = "UPDATE $tablePersona SET nombre=:nombre, apellido=:apellido, direccion=:direccion, email=:email, fecha_nacimiento=:fecha_nacimiento WHERE dni=$dni"; //recontra HARDCODEADO
            try {
                $statement = $this->pdo->prepare($sql);
                $statement->execute($parameters);
            } catch (Exception $e) {
                $this->sendToLog($e);
            }   
    }

    public function updateUsuario($tablePersona, $parameters, $nombre){
        $parameters = $this->cleanParameterName($parameters);
        $sql = "UPDATE $tablePersona SET password=:password WHERE nombre='$nombre'";
            try {
                $statement = $this->pdo->prepare($sql);
                $statement->execute($parameters);
            } catch (Exception $e) {
                $this->sendToLog($e);
            }   
    }


    public function updatePermiso($table, $parameters, $nEspecializacion){
        $parameters = $this->cleanParameterName($parameters);
        $sql = "UPDATE $table SET nombrePermiso=:nombrePermiso WHERE idPermiso=$nEspecializacion";
            try {
                $statement = $this->pdo->prepare($sql);
                $statement->execute($parameters);
            } catch (Exception $e) {
                $this->sendToLog($e);
            }   
    }

    public function deletePersona($table,$idPersona){ 
        $statement = $this->pdo->prepare(
           "DELETE FROM $table  WHERE dni = $idPersona"
        );
        $statement->execute();
    }

    public function selectPermisosNombre($nombreUser){
        
        $statement = $this->pdo->prepare(
            "SELECT P.nombrePermiso FROM rolesxpermisos RP 
            INNER JOIN permisos P ON RP.idPermiso= P.idPermiso WHERE RP.idRol=(SELECT idRol FROM usuarios 
            WHERE nombre ='$nombreUser')"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function getSize($tabla){
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tabla"
        );
        $statement->execute();
        $num_filas=$statement->rowCount();
        return $num_filas;
    }
    
 
    public function selectUsuarioPorPersonaPorRolLimit($tableUsuario, $tablePersona, $tableRol,$litinf,$litsup){        
        $statement = $this->pdo->prepare(
        "SELECT $tableUsuario.nombre,$tablePersona.nombre,$tablePersona .apellido,$tablePersona .dni,$tableRol.nombreRol 
            FROM $tableUsuario  inner JOIN $tablePersona  ON $tableUsuario.nombre=$tablePersona .idUsuario 
            inner JOIN $tableRol  ON $tableUsuario.idRol=$tableRol.idRol LIMIT $litinf, $litsup"
        );
       try{
        $statement->execute();
       }catch(Exception $e){$this->sendToLog($e);}
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function idHistoriaSiguiente($tableHistoria,$idPedido, $idTarea){
        $statement = $this->pdo->prepare(
           "SELECT MAX(idHistorial) FROM $tableHistoria
        WHERE idPedido = $idPedido AND idTarea = $idTarea"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function selectHistorias($tableHistoria,$idPedido,$idTarea){
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tableHistoria WHERE idPedido=$idPedido AND idTarea=$idTarea"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
   }
 public function getIdRol($tableRol,$nombreRol){ 
        $statement = $this->pdo->prepare(
           "SELECT (idRol) FROM $tableRol   WHERE nombreRol='$nombreRol'"
    );
    $statement->execute();
    
       return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function selectAllpermisosByIdRol($tableRolesxPermisos, $idRol){        
        $statement = $this->pdo->prepare(
            "SELECT P.nombrePermiso FROM $tableRolesxPermisos RP INNER JOIN permisos P ON RP.idPermiso=P.idPermiso WHERE RP.idRol=$idRol"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectCantidadInsumoItem($tableItemInsumo,$idInsumo){
        $statement = $this->pdo->prepare(
        "SELECT MAX(idInsumo) FROM $tableItemInsumo WHERE idInsumo=$idInsumo"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function selectInsumosDisponibles($tableInsumos){
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tableInsumos WHERE stock>0"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
   }

   public function restarInsumo($tableInsumo, $nInsumo, $cantidad){
    $statement = $this->pdo->prepare(
        "UPDATE $tableInsumo SET stock=stock-$cantidad WHERE idInsumo=$nInsumo"
    );
    $statement->execute();
    }
    public function sumarInsumo($tableInsumo, $nInsumo, $cantidad){
        $statement = $this->pdo->prepare(
            "UPDATE $tableInsumo SET stock=stock+$cantidad WHERE idInsumo=$nInsumo"
        );
        $statement->execute();
        }
   
    public function getStock($tableInsumo,$idInsumo){
        $statement = $this->pdo->prepare(
        "SELECT stock FROM $tableInsumo WHERE idInsumo=$idInsumo"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function selectInsumosPorNPedidoNTarea($tableInsumo, $tableItemInsumo, $nPedido, $nTarea){ 
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tableItemInsumo T1 INNER JOIN $tableInsumo T2 ON T1.idInsumo=T2.idInsumo WHERE idPedido=$nPedido AND idTarea=$nTarea"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectHistoriasInsumo($tableMovimiento,$idInsumo){
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tableMovimiento WHERE idInsumo=$idInsumo"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
   }
   
   public function getNombreInsumoFromId($tableInsumo,$idInsumo){
        $statement = $this->pdo->prepare(
        "SELECT nombreInsumo,descripcion FROM $tableInsumo WHERE idInsumo=$idInsumo"
    );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function selectInsumosUsados($tableItemInsumos, $tableInsumo, $idPedido, $idTarea){
        $statement = $this->pdo->prepare(
            "SELECT T1.idInsumo FROM $tableItemInsumos T1 INNER JOIN $tableInsumo T2 ON T1.idInsumo = T2.idInsumo WHERE idPedido=$idPedido AND idTarea=$idTarea"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
   }

   public function updateItemInsumo($table, $parameters, $tipoMovimiento){
    $parameters = $this->cleanParameterName($parameters);
    if ($tipoMovimiento == 1) {
        $sql = "UPDATE $table SET cantidad=cantidad+:cantidad WHERE idPedido=:idPedido AND idTarea=:idTarea AND idInsumo=:idInsumo";
    } else {
        $sql = "UPDATE $table SET cantidad=cantidad-:cantidad WHERE idPedido=:idPedido AND idTarea=:idTarea AND idInsumo=:idInsumo";
    }
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
        } catch (Exception $e) {
            $this->sendToLog($e);
        }   
    }

    public function deleteItemInsumo($tableItem,$idPedido,$idTarea,$idInsumo){ 
        $statement = $this->pdo->prepare(
           "DELETE FROM $tableItem  WHERE idPedido=$idPedido AND idTarea=$idTarea AND idInsumo = $idInsumo"
        );
        $statement->execute();
    }
    
    public function selectCantidadByIdIdId($tableItemInsumos, $idPedido, $idTarea,$idInsumo){
        $statement = $this->pdo->prepare(
            "SELECT cantidad FROM $tableItemInsumos WHERE idPedido=$idPedido AND idTarea=$idTarea AND idInsumo=$idInsumo"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_NUM);
   }

   public function selectHistoriasInsumoPorIdIdId($tableMovimiento,$idPedido,$idTarea,$idInsumo){
    $statement = $this->pdo->prepare(
        "SELECT * FROM $tableMovimiento WHERE idPedido=$idPedido AND idTarea=$idTarea AND idInsumo=$idInsumo"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}

public function selectUltimoItemAgente($tableItemAgente,$idAgente){
    $statement = $this->pdo->prepare(
        "SELECT * FROM $tableItemAgente WHERE idAgente=$idAgente ORDER BY idPedido DESC ,idTarea DESC LIMIT 1"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}

public function selectAnteUltimoItemAgente($tableItemAgente,$idAgente){
    $statement = $this->pdo->prepare(
        "SELECT * FROM $tableItemAgente WHERE idAgente=$idAgente ORDER BY idPedido DESC ,idTarea DESC LIMIT 1,1"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
}


    
     public function dameSectores($tablaPedidos,$tablaSectores,$fechaDesde,$fechafin){
 
        $statement = $this->pdo->prepare( "SELECT $tablaSectores.idSector,$tablaSectores.nombreSector, COUNT(*) as suma FROM $tablaPedidos INNER JOIN $tablaSectores where $tablaPedidos.idSector=$tablaSectores.idSector  AND $tablaPedidos.fechaInicio>=$fechaDesde GROUP BY $tablaSectores.nombreSector  " );  
  $statement->execute();
    //var_dump($statement);
       
        return $statement->fetchAll(PDO::FETCH_CLASS);
}

    public function getCantInsumosOC($tableItem,$idOC){
        $statement = $this->pdo->prepare(
        "SELECT COUNT(idInsumo) FROM $tableItem
        WHERE idOC = $idOC"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_NUM);
    }

    public function newOC($tableOC,$costo,$estado){
        $hoy = date("Y-m-d");
        $statement = $this->pdo->prepare(
        "INSERT INTO $tableOC(fecha,costoEstimado,estado) VALUES ('$hoy','$costo','$estado')"
    );
        $statement->execute();
    }

    public function getIdUltimoOC($tableOC){
        $statement = $this->pdo->prepare(
            "SELECT MAX(idOC) FROM $tableOC"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_NUM);
    }
    
    public function selectOCById($table, $nOC){ //table = oc
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} 
            WHERE idOC={$nOC}"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectInsumosPorNOC($tableInsumo, $tableItemOC, $nOC){ 
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tableInsumo T1 INNER JOIN $tableItemOC T2 ON T1.idInsumo=T2.idInsumo WHERE idOC=$nOC"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
    
    public function updateItemOC($table, $parameters){
        $parameters = $this->cleanParameterName($parameters);
        $sql = "UPDATE $table SET cantidadIngresada=cantidadIngresada+:cantidadIngresada WHERE idInsumo=:idInsumo AND idOC=:idOC";
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
        } catch (Exception $e) {
            $this->sendToLog($e);
        }   
    }

    public function selectItemOCPorNOC($tableItemOC, $nOC){ 
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tableItemOC WHERE idOC=$nOC"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function updateEstadoOC($tableOC, $nOC,$estado){
        $statement = $this->pdo->prepare(
            "UPDATE $tableOC SET estado='$estado' WHERE idOC=$nOC"
        );
        $statement->execute();
    }

    public function getEventoById($tableEvento,$idEvento){
        $statement = $this->pdo->prepare(
           "SELECT * FROM $tableEvento WHERE idEvento=$idEvento"
    );
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_CLASS);
    }
public function  dameinformeEspe($tablaTarea,$tablaEspecializacion,$tablaPedido,$fechaDesde,$fechaHasta){
     
       $statement = $this->pdo->prepare( "
SELECT $tablaEspecializacion.idEspecializacion,$tablaEspecializacion.nombre, COUNT(*) as suma FROM $tablaTarea INNER JOIN $tablaEspecializacion where $tablaEspecializacion.idEspecializacion=$tablaTarea.idEspecializacion GROUP BY $tablaEspecializacion.nombre" );  
  $statement->execute();
   
       
        return $statement->fetchAll(PDO::FETCH_CLASS);
}
     
    public function dameinformeEstado($tablaPedido,$fechaDesde,$fechaHasta){
    
        $statement = $this->pdo->prepare( "
SELECT estado ,COUNT(*) as suma FROM $tablaPedido WHERE fechaInicio>=$fechaDesde  GROUP BY estado " );  
  $statement->execute();
    
       
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }
    
    
    
}




