<?php

/**
 * Representa el la estructura de las equipos
 * almacenadas en la base de datos
 */
require_once 'Database.php';

class equipo
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
    		
        $consulta = "SELECT * FROM vappequipo";
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
    		
        $consulta = "SELECT count(*) FROM vappequipo";
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
     * Obtiene los campos de una equipo con un identificador
     * determinado
     *
     * @param $idequipo Identificador de la equipo
     * @return mixed
     */
    public static function getById($idclub,$idjugador)
    {
        // Consulta de la tabla equipo IDCLUB Y JUGADOR
        $consulta = "SELECT numero,
                            nombre,
                            edad,
                            ingresoClub,
                            categoria,
                            categoriaInicio
                             FROM vappequipo
                             WHERE idclub = $idclub and idjugador=$idjugador";

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
     * @param $idequipo      identificador
     * @param $nombre      nuevo titulo
     * 
     */
    public static function update($numero,$nombre,$edad,$ingrClu,$cate,$cateIini,$idclub,$idjugador)
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE vappequipo" .
            " SET numero=$numero, nombre=$nombre ,edad=$edad,ingresoClub=$ingrClu,categoria=$cate, categoriaInicio=$cateIini WHERE idclub=$idclub and idjugador=$idjugador";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute();

        //return $cmd;
		echo json_encode($cmd);

    }

    /**
     * Insertar un nuevo equipo
     *
     * @param $idequipo      titulo del nuevo registro
     * @param $nombre descripci�n del nuevo registro
     * @return PDOStatement
     */
    public static function insert($numero,$nombre,$edad,$ingrClu,$cate,$cateIini,$idclub){
        // Sentencia INSERT
        $comando = "INSERT INTO vappequipo ( numero, nombre ,edad,ingresoClub,categoria, categoriaInicio,idclub) VALUES($numero,$nombre,$edad,$ingrClu,$cate,$cateIini,$idclub)";

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
    public static function delete($idclub,$idjugador)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappequipo WHERE idclub=$idclub and idjugador=$idjugador";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();
    }
}

?>