<?php

/**
 * Representa el la estructura de las ciudads
 * almacenadas en la base de datos
 */
require_once 'database.php';

class Ciudad
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'vappciudad'
     *
     * @param $idciudad Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
    		
        $consulta = "SELECT * FROM vappciudad order by Nombre";
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
* 
* @param {texto} $filtro
* 
* @return LISTA DE CIUDADDES COINCIDENTES CON EL NOMBRE INGRESADO
*/    
    public static function getAllFiltro($filtro)
    {
    		
        $consulta = "SELECT * FROM vappciudad WHERE nombre like '%$filtro%' order by Nombre";
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
    		
        $consulta = "SELECT count(*) FROM vappciudad";
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

   public static function getPorNombre($nombre,$provincia)
    {
    									  
        $consulta = "SELECT count(*) FROM vappciudad where Nombre = '$nombre' AND provincia = '$provincia' ";
// /*
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return $e;
        }
//        */
    }


    /**
     * Obtiene los campos de una ciudad con un identificador
     * determinado
     *
     * @param $idciudad Identificador de la ciudad
     * @return mixed
     */
    public static function getById($idciudad)
    {
        // Consulta de la ciudad
        $consulta = "SELECT nombre,
                            provincia
                             FROM vappciudad
                             WHERE idciudad = $idciudad";

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
     * @param $idciudad      identificador
     * @param $nombre      nuevo titulo
     * 
     */
    public static function ActualizaCiudad($idcity,$citynom,$cityprov)
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE vappciudad SET nombre='$citynom' , provincia='$cityprov' WHERE idciudad=$idcity";
		//echo($consulta);
        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute();

        return json_encode($cmd);

    }

    /**
     * Insertar un nuevo ciudad
     *
     * @param $idciudad      titulo del nuevo registro
     * @param $nombre descripci�n del nuevo registro
     * @return PDOStatement
     */
public static function insert($nombre,$provincia)
{
// chequeo que no existe previamente    	
// ESTA VOLVIENDO UN VECTOR DE VECTORES
	$registros = Ciudad::getPorNombre($nombre,$provincia);
//	if(empty($registros))
    if($registros["0"]["count(*)"] == "0")
     {
		
        // Sentencia INSERT
        $comando = "INSERT INTO vappciudad ( nombre, provincia) VALUES( '$nombre','$provincia')";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();
	  }
}

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idciudad identificador de la ciudad
     * @return bool Respuesta de la eliminaci�n
     */
    public static function delete($idciudad)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappciudad WHERE idciudad=$idciudad";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();
    }
}

?>