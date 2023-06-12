<?php

/**
 * Representa el la estructura de las categorias
 * almacenadas en la base de datos
 */
require_once 'database.php';
/*
CREATE TABLE `c0990415_voleyap`.`vappsesiones` ( `sesid` INT NOT NULL AUTO_INCREMENT , `sesusuario` VARCHAR(40) NOT NULL , `seshoraInicio` INT NOT NULL , PRIMARY KEY (`sesid`)) ENGINE = MyISAM;

ALTER TABLE `vappsesiones` CHANGE `seshoraInicio` `seshoraInicio` TIMESTAMP(6) NULL
DEFAULT CURRENT_TIMESTAMP(6);
*/



class SesionTabla
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'vappCategoria'
     *
	 * @param $usuario Identificador del registro
     * @return array Datos del registro
     */
    public static function getsession($valor)
    {
    		
        $consulta = "SELECT sesid FROM vappsesiones where sesorigen=$valor";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
			//print_r($comando->fetch(PDO::FETCH_ASSOC));
            return $comando->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }
   
    public static function getsessionX($valor)
    {
    		
        $consulta = "SELECT sesorigen FROM vappsesiones where sesusuario=$valor";
		//echo "$consulta"; 
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
			//print_r($comando->fetch(PDO::FETCH_ASSOC));
            return $comando->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }    
    
	public static function getusuariocon($ipconeccion)
	{

		$consulta = "SELECT sesusuario FROM vappsesiones where sesorigen=$ipconeccion";
		try {
			// Preparar sentencia
			$comando = Database::getInstance()->getDb()->prepare($consulta);
			// Ejecutar sentencia preparada
			$comando->execute();
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
			//print_r($comando->fetch(PDO::FETCH_ASSOC));
			return $comando->fetch(PDO::FETCH_ASSOC);

		} catch (PDOException $e) {
			return ($e->getMessage());
		}
	}
	    

    /**
     * Obtiene los campos de una categoria con un identificador
     * determinado
     *
     * @param $idcategoria Identificador de la categoria
     * @return mixed
     */
    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $idcategoria      identificador
     * @param $nombre      nuevo titulo
     * 
     */

    /**
     * Insertar un nuevo categoria
     *
     * @param $idcategoria      titulo del nuevo registro
     * @param $nombre descripción del nuevo registro
     * @return PDOStatement
     */
	 public static function setsession($clave, $valor)
	 {
        // Sentencia INSERT
		$graboSesion = SesionTabla::getsession($valor);
		if (! isset($graboSesion["sesid"]) ){
				$comando = "INSERT INTO vappsesiones ( sesusuario,sesorigen ) VALUES( $clave,$valor) ";
		//12/07/2020 ALTER TABLE `vappsesiones` ADD `sesorigen` VARCHAR(16) NOT NULL AFTER `sesusuario`;        // Preparar la sentencia
        		$sentencia = Database::getInstance()->getDb()->prepare($comando);
        			return $sentencia->execute(array($clave, $valor));
		}        			
    }
    
	 public static function setsessionfiltros($clave, $valor)
	 {
        // Sentencia INSERT
		$comando = "INSERT INTO vappsesiones ( sesusuario,sesorigen ) VALUES( $clave,$valor) ";
		//12/07/2020 ALTER TABLE `vappsesiones` ADD `sesorigen` VARCHAR(16) NOT NULL AFTER `sesusuario`;        // Preparar la sentencia
        		$sentencia = Database::getInstance()->getDb()->prepare($comando);
        			return $sentencia->execute(array($clave, $valor));
    }    
    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idcategoria identificador de la categoria
     * @return bool Respuesta de la eliminación
     */
    public static function deletesession($ipconeccion)
    {
        // Sentencia DELETE
		$comando = "DELETE FROM vappsesiones WHERE sesorigen=$ipconeccion";
//		echo($comando);
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

		return $sentencia->execute(array($ipconeccion));
    }
    
    public static function deletesessionfiltros($ipconeccion)
    {
        // Sentencia DELETE
		$comando = "DELETE FROM vappsesiones WHERE sesusuario=$ipconeccion";
//		echo($comando);
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

		return $sentencia->execute(array($ipconeccion));
    }

    
}

?>