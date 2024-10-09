<?php

/**
 * Representa el la estructura de las clubs
 * almacenadas en la base de datos
 */
require_once ('database.php');

class Numeros
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'vappclub'
     *
     * @param $idclub Identificador del registro
     * @return array Datos del registro
     */

    public static function getById($tabla)
    {
        // Consulta de la club
        $consulta = "SELECT ultnumero
                             FROM vappnumeros
                             WHERE TABLA = $tabla";
//		echo "$consulta <br>";	
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            //return $row;
            echo json_encode($row);

        } catch (PDOException $e) {
            // Aqu� puedes clasificar el error dependiendo de la excepci�n
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    public static function getPaginas($tabla)
    {
        // Consulta de la club
        $consulta = "SELECT ultnumero
                             FROM vappnumeros
                             WHERE TABLA = $tabla";
//		echo "$consulta <br>";	
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
			// $comando->execute(array($tabla));
            // Capturar primera fila del resultado
            return $row = $comando->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            // Aqu� puedes clasificar el error dependiendo de la excepci�n
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

/*******************************************************************************************/
	public static function getAll($filtro)
	{
		$consulta = "SELECT *
						FROM vappnumeros
						WHERE TABLA like '%".$filtro."%'";
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
/*******************************************************************************************/
public static function setnumeros($tabla,$numero)
{
	// Consulta de la club
	$consulta = "INSERT INTO vappnumeros(ultnumero,TABLA) values($numero,$tabla)";

	try {
		// Preparar sentencia
		$comando = Database::getInstance()->getDb()->prepare($consulta);
		// Ejecutar sentencia preparada
		$comando->execute();
		// Capturar primera fila del resultado
		$row = $comando->fetch(PDO::FETCH_ASSOC);
		//return $row;
		echo json_encode($row);

	} catch (PDOException $e) {
		// Aqu� puedes clasificar el error dependiendo de la excepci�n
		// para presentarlo en la respuesta Json
		return -1;
	}
}
/*******************************************************************************************/
/*******************************************************************************************/
public static function updnumeros($tabla,$numero)
{
	// Consulta de la club
	$consulta = "UPDATE vappnumeros SET ultnumero=$numero WHERE  TABLA=$tabla ";

	try {
		// Preparar sentencia
		$comando = Database::getInstance()->getDb()->prepare($consulta);
		// Ejecutar sentencia preparada
		$comando->execute();
		// Capturar primera fila del resultado
		$row = $comando->fetch(PDO::FETCH_ASSOC);
		//return $row;
		echo json_encode($row);

	} catch (PDOException $e) {
		// Aqu� puedes clasificar el error dependiendo de la excepci�n
		// para presentarlo en la respuesta Json
		return -1;
	}
}



}

?>
