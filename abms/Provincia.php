<?php

/**
 * Representa el la estructura de las Provincias
 * almacenadas en la base de datos
 */
require_once 'database.php';

class Provincia
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'vappProvincia'
     *
     * @param $idProvincia Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
    		
        $consulta = "SELECT * FROM vappProvincia";
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
   public static function contar()
    {
    		
        $consulta = "SELECT count(*) FROM vappProvincia";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return $e;
        }
    }


    /**
     * Obtiene los campos de una Provincia con un identificador
     * determinado
     *
     * @param $idProvincia Identificador de la Provincia
     * @return mixed
     */
    public static function getById($idProvincia)
    {
        // Consulta de la Provincia
        $consulta = "SELECT idProvincia,
                            nombre,
                            Provinciaabr
                             FROM vappProvincia
                             WHERE idProvincia = ?";

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
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $idProvincia      identificador
     * @param $nombre      nuevo titulo
     * 
     */
    public static function update(
        $nombre,$idProvincia
    )
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE vappProvincia" .
            " SET nombre=? , Provinciaabr=? WHERE idProvincia=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute();

        //return $cmd;
		echo json_encode($cmd);

    }

    /**
     * Insertar un nuevo Provincia
     *
     * @param $idProvincia      titulo del nuevo registro
     * @param $nombre descripci�n del nuevo registro
     * @return PDOStatement
     */
    public static function insert($nombre,$Provinciaabr){
        // Sentencia INSERT
        $comando = "INSERT INTO vappProvincia ( nombre, Provinciaabr) VALUES( ?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idProvincia identificador de la Provincia
     * @return bool Respuesta de la eliminaci�n
     */
    public static function delete($idProvincia)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM Provincia WHERE idProvincia=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();
    }
}

?>