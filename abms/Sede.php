<?php

/**
 * Representa el la estructura de las sedes
 * almacenadas en la base de datos
 */
require_once 'database.php';

class sede
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'vappsede'
     *
     * @param $idsede Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
    		
        $consulta = "SELECT * FROM vappsede";
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
    
//GET SEDES BY Club , TODO LO QUE LLEGA DESDE POST, ES TEXTO !!!   
     public static function getSedexClub($idclub)
    {
        $consulta = "SELECT * FROM vappsede WHERE idclub=$idclub ";
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
// GET SEDES BY CLUB    
   public static function contar()
    {
    		
        $consulta = "SELECT count(*) FROM vappsede";
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
     * Obtiene los campos de una sede con un identificador
     * determinado
     *
     * @param $idsede Identificador de la sede
     * @return mixed
     */
    public static function getById($idclub,$idsede)
    {
        // Consulta de la sede
        $consulta = "SELECT idsede,
                            direccion,
                            extras
                             FROM vappsede
                             WHERE idsede=$idsede and idclub=$idclub";

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
     * @param $idsede      identificador
     * @param $nombre      nuevo titulo
     * 
     */
    public static function ActualizaSede($idclub,$idsede,$nombresede,$direccion)
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE vappsede SET direccion='$direccion' , extras='$nombresede' WHERE idsede=$idsede and idclub=$idclub";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute();

        return json_encode($cmd);

    }

    /**
     * Insertar un nuevo sede
     *
     * @param $idsede      titulo del nuevo registro
     * @param $nombre descripci�n del nuevo registro
     * @return PDOStatement
     */
    public static function insert($direccion,$idclub,$extras){
        // Sentencia INSERT
        $comando = "INSERT INTO vappsede ( direccion, idclub,extras) VALUES('$direccion',$idclub,'$extras')";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idsede identificador de la sede
     * @return bool Respuesta de la eliminaci�n
     */
    public static function delete($idsede)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappsede WHERE idsede=$idsede";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();
    }
}

?>