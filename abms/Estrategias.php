<?php

/**
 * Representa el la estructura de las posicions
 * almacenadas en la base de datos
 */
require_once 'database.php';

class Strats1
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'vappposicion'
     *
     * @param $idposicion Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
    		
        $consulta = "SELECT * FROM vappstrats";
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
    		
        $consulta = "SELECT count(*) FROM vappstrats";
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
     * Obtiene los campos de una posicion con un identificador
     * determinado
     *
     * @param $idposicion Identificador de la posicion
     * @return mixed
     */
    public static function getById($idstratCod)
    {
        // Consulta de la posicion
        $consulta = "SELECT codigo,nombre
                             FROM vappstrats
                             WHERE codigo = '$idstratCod'";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
            // Capturar primera fila del resultado
            return $comando->fetchAll(PDO::FETCH_ASSOC);
            //echo json_encode($row);

        } catch (PDOException $e) {
            // Aqu� puedes clasificar el error dependiendo de la excepci�n
            // para presentarlo en la respuesta Json
            return ($e->getMessage());
        }
    }


    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $idposicion      identificador
     * @param $nombre      nuevo titulo
     * 
     */
							     
    public static function update($codigo,$descripcion)
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE vappstrats set nombre='$descripcion' WHERE codigo='$codigo'";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute();
        //return $cmd;
		echo json_encode($cmd);
    }

    /**
     * Insertar un nuevo posicion
     *
     * @param $idposicion      titulo del nuevo registro
     * @param $nombre descripci�n del nuevo registro
     * @return PDOStatement
     */
    public static function insert($codigo,$nombre){
        // Sentencia INSERT
        $comando = "INSERT INTO vappstrats ( nombre, codigo) VALUES( '$nombre','$codigo')";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idposicion identificador de la posicion
     * @return bool Respuesta de la eliminaci�n
     */
    public static function delete($idCodigoStrat)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappstrats WHERE codigo='$idCodigoStrat'";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();
    }
}

?>