<?php


require_once('database.php');

class Rotaciones
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
    public static function getLastRotacion($idpartido,$fecha,$setnumero)
    {
    		
        $consulta = "SELECT * FROM vapprotaciones 
        			where idpartido=$idpartido and fecha=$fecha and setnumero=$setnumero 
        			  order by secuenciaSet desc limit 1";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
			// no se estaba devolviendl el resultado en formato JSON
			$comando->execute(array($idpartido,$fecha,$setnumero));	
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }
	
    public static function getRotacionSetX($idpartido,$fecha,$setnumero,$secuenciaSet)
    {
    		
        $consulta = "SELECT * FROM vapprotaciones 
        			where idpartido=$idpartido and fecha=$fecha and setnumero=$setnumero 
        			  and secuenciaSet=$secuenciaSet ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
			$comando->execute(array($idpartido,$fecha,$setnumero,$secuenciaSet));			
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }	
	

    /**
     * Insertar una nueva rotacion
     *
     */
    public static function insert($idpartido,$fecha,$setnumero,$secuenciaSet,$a1,$a2,$a3,$a4,$a5,$a6,$b1,$b2,$b3,$b4,$b5,$b6,$mensaje,$clubRota){
        // Sentencia INSERT
        $comando = "INSERT INTO vapprotaciones 
        		( idpartido,fecha,setnumero,secuenciaSet,1A,2A,3A,4A,5A,6A,1B,2B,3B,4B,5B,6B,mensaje,clubrota) 
        		VALUES($idpartido,$fecha,$setnumero,$secuenciaSet,$a1,$a2,$a3,$a4,$a5,$a6,$b1,$b2,$b3,$b4,$b5,$b6,$mensaje,$clubRota)";
		//echo "<br>$comando<br>";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array($idpartido,$fecha,$setnumero,$secuenciaSet,$a1,$a2,$a3,$a4,$a5,$a6,$b1,$b2,$b3,$b4,$b5,$b6,$mensaje,$clubRota));
    }

/**
* UPDATE CLUB ROTA: LLAMADO CICLICAMENTE PARA ACTUALIZAR EL CAMPO NUEVO, ES UN COOKER
* @param $idpartido
* @param $fecha
* @param $setnumero
* @param $secuenciaSet
* @param $clubRota
* 
* @return
*/
    public static function updateclubrota($idpartido,$fecha,$setnumero,$secuenciaSet,$clubRota){
        // Sentencia INSERT
        $comando = "update vapprotaciones 
        			set clubrota= $clubRota 
        		where idpartido=$idpartido and fecha=$fecha and setnumero=$setnumero
        		and secuenciaSet=$secuenciaSet ";
		echo "<br>$comando<br>";

        $cmd = Database::getInstance()->getDb()->prepare($comando);
        $cmd->execute(array($idpartido,$fecha,$setnumero,$secuenciaSet,$clubRota));
        return json_encode($cmd);
    }


    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idclub identificador de la club
     * @return bool Respuesta de la eliminaci�n
     */
    public static function delete($idpartido,$fecha,$setnumero,$secuenciaSet)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vapprotaciones
        				WHERE idpartido=$idpartido and fecha=$fecha and setnumero=$setnumero 
        			  		AND secuenciaSet=$secuenciaSet ";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idpartido,$fecha,$setnumero,$secuenciaSet));
    }
   public static function delete2($idpartido,$setnumero,$fecha)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vapprotaciones
        				WHERE idpartido=$idpartido and fecha='$fecha' and setnumero=$setnumero ";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idpartido,$setnumero,$fecha));
    } 
    
   public static function deleteAll($idpartido,$fecha)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vapprotaciones
        				WHERE idpartido=$idpartido and fecha=$fecha ";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idpartido,$fecha));
    }        
}

?>
