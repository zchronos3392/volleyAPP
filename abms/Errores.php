<?php

/**
 * Representa el la estructura de las equipos
 * almacenadas en la base de datos
 */
 
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/abms/database.php');
 

class errorGrabado
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'vappequipo'
     *
     * @param $idequipo Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
    		
        $consulta = "SELECT * FROM vapperrores";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }


    /**
     * Obtiene los campos de una equipo con un identificador
     * determinado
     *
     * @param $idequipo Identificador de la equipo
     * @return mixed
     */
    public static function getById($iderror)
    {
        // Consulta de la tabla equipo IDCLUB Y JUGADOR
        $consulta = "SELECT iderror, tipo, fecha_hora, scriptPrograma, funcion, parametros 
                       FROM vapperrores
                             WHERE iderror = $iderror ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
            //echo json_encode($row);

        } catch (PDOException $e) {
            // Aqu� puedes clasificar el error dependiendo de la excepci�n
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

  /**
     * Obtiene los campos de una equipo con un identificador
     * determinado
     *
     * @param $idequipo Identificador de la equipo
     * @return mixed
     */
    public static function getByTipo($tipo)
    {
        // Consulta de la tabla equipo IDCLUB Y JUGADOR
        $consulta = "SELECT iderror, tipo, fecha_hora, scriptPrograma, funcion, parametros 
                       FROM vapperrores
                             WHERE tipo = '$tipo' ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
            //echo json_encode($row);

        } catch (PDOException $e) {
            // Aqu� puedes clasificar el error dependiendo de la excepci�n
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
    
    /**
     * Insertar un nuevo error
     *
     * @param $idequipo      titulo del nuevo registro
     * @param $nombre descripci�n del nuevo registro
     * @return PDOStatement
     */
    public static function insert($tipo,$scriptPrograma,$funcion,$parametros){
        // Sentencia INSERT
        $comando = "INSERT INTO vapperrores ( tipo,scriptPrograma,funcion,parametros) VALUES($tipo,$scriptPrograma,$funcion,$parametros)";
			//echo "<br> $comando <br>";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idequipo identificador de la equipo
     * @return bool Respuesta de la eliminaci�n
     */
    public static function delete($iderror)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vapperrores WHERE iderror=$iderror ";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();
    }
}

?>