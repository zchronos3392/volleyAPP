<?php

/**
 * Representa el la estructura de las sedes
 * almacenadas en la base de datos
 */
require_once 'database.php';

class fotos
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'vappequipo '
     *
     * @param no tiene
     * @return array Datos del registro
     */
    public static function getAll()
    {
 	// armar join a tablas descriptoras
	$consulta = "SELECT * FROM vappfotos  " ;
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
    
  

    public static function getById($partido,$fecha,$idfoto )
    {
        // Consulta de la sede
//        $consulta = "SELECT CONCAT(nombre,'(',numero,')') as jugx,idjugador FROM vappequipo WHERE idclub=$idclub and idjugador = $idjugador ";
        $consulta = "SELECT *
					FROM vappfotos 
						WHERE idpartido=$partido and fecha=$fecha and idfoto=$idfoto " ;    	

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($partido,$fecha,$idfoto));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
            //echo json_encode($row);

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    public static function getByPartido($partido,$fecha)
    {
        // Consulta de la sede
//        $consulta = "SELECT CONCAT(nombre,'(',numero,')') as jugx,idjugador FROM vappequipo WHERE idclub=$idclub and idjugador = $idjugador ";
        $consulta = "SELECT *
					FROM vappfotos 
						WHERE idpartido=$partido and fecha=$fecha " ;    	

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($partido,$fecha));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
            //echo json_encode($row);

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }


    public static function getLast($idpartido,$fecha)
    {
        // Consulta de la ULTIMA FOTO DEL PARTIDO
        $consulta = "SELECT idfoto
					FROM vappfotos 
						WHERE idpartido=$idpartido and fecha=$fecha order by idfoto DESC limit 1" ;    	
//		echo "<br> $consulta <br>";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idpartido,$fecha));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
            //echo json_encode($row);

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * 
     */
    public static function update($partido,$fecha,$idfoto,$activa )
    { 
        // Creando consulta UPDATE
        $consulta = "UPDATE vappfotos SET activa=$activa ". 
        "WHERE idpartido=$partido and fecha=$fecha and idfoto=$idfoto ";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($partido,$fecha,$idfoto,$activa ));

        //return $cmd;
		echo json_encode($cmd);

    }

    /**
     * Insertar un nuevo sede
     *
     * @param $idsede      titulo del nuevo registro
     * @param $nombre descripción del nuevo registro
     * @return PDOStatement
     */
    public static function insert($idpartido,$fecha,$nombre,$extension,$carpeta)
    {
    	$actualizada = date_create()->format('Y-m-d H:i:s');// fecha corecta de ahora
		$actualizada = "'".$actualizada."'";
		$idfoto =0;
		$fotosPartido = fotos::getLast($idpartido,$fecha);
		//print_r($fotosPartido);Array ( [idfoto] => 1 )
		if($fotosPartido != "") $idfoto = (int)$fotosPartido['idfoto'];
		if($idfoto == 0)
		{
				$idfoto = 1;
			    //echo("<br> ULTIMO ID, NO HAY... ".$idfoto."<br>");
		}
		else
			{
			    //echo("<br> ULTIMO ID,  ".$idfoto."<br>");				
				$idfoto++;	
			}
							
    	//idjugador es autonumerico..
    	$comando = "INSERT INTO vappfotos (idpartido,fecha,idfoto,fechaSubida,activa,nombre,extension,carpeta) ".
		" VALUES (  $idpartido,$fecha,$idfoto,$actualizada ,1,$nombre,$extension,$carpeta) " ;    	
		
		//echo("<br>".$comando."<br>");
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($idpartido,$fecha,$nombre,$extension,$carpeta) );
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idsede identificador de la sede
     * @return bool Respuesta de la eliminación
     */
    public static function delete($idpartido,$fecha,$idfoto)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappfotos WHERE idpartido=$idpartido and fecha =$fecha and idfoto=$idfoto ";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idpartido,$fecha,$idfoto));
    }


    

}

?>