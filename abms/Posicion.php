<?php

/**
 * Representa el la estructura de las posicions
 * almacenadas en la base de datos
 */
require_once 'database.php';

class Posicion
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
    		
        $consulta = "SELECT * FROM vappposicion";
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
    		
        $consulta = "SELECT count(*) FROM vappposicion";
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
    public static function getById($idposicion)
    {
        // Consulta de la posicion
        $consulta = "SELECT idposicion,codigo,nombre,color
                             FROM vappposicion
                             WHERE idposicion = $idposicion";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idposicion));
            // Capturar primera fila del resultado
            return $comando->fetchAll(PDO::FETCH_ASSOC);
            //echo json_encode($row);

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
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
							     
    public static function update($idposicion,$posicion,$codigo,$color)
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE vappposicion set nombre='$posicion',color='$color', codigo='$codigo' WHERE idposicion=$idposicion";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($idposicion,$posicion,$codigo,$color));
        //return $cmd;
		echo json_encode($cmd);
    }

    /**
     * Insertar un nuevo posicion
     *
     * @param $idposicion      titulo del nuevo registro
     * @param $nombre descripción del nuevo registro
     * @return PDOStatement
     */
    public static function insert($nombre,$codigo,$color){
        // Sentencia INSERT
        $comando = "INSERT INTO vappposicion ( nombre, codigo,color) VALUES( '$nombre','$codigo','$color')";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array($nombre,$codigo,$color));

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idposicion identificador de la posicion
     * @return bool Respuesta de la eliminación
     */
    public static function delete($idposicion)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappposicion WHERE idposicion=$idposicion";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idposicion));
    }
}

?>