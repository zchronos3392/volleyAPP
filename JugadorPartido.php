<?php

/**
 * Representa el la estructura de las sedes
 * almacenadas en la base de datos
 */
require_once 'database.php';

class partjug
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'vapppartido'
     *
     * @param $idsede Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
 	// armar join a tablas descriptoras
	$consulta = "SELECT * FROM vappjugpartido  " ;
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
// jugadores por club, todos    
    public static function getJugadorxPartido($idpartido,$fecha)
    {
	$consulta = "SELECT * FROM vappjugpartido where idpartido = $idpartido and Fecha=$fecha " ;
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idpartido,$fecha));
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			//echo json_encode($row);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }
	
// jugadores por club, todos    
    public static function getlastset($idpartido,$fecha,$iclub)
    {
	$consulta = "SELECT * FROM vappjugpartido where idpartido = $idpartido and Fecha=$fecha and idclub=$iclub and posicionIni <> 0 LIMIT 1" ;
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idpartido,$fecha,$iclub));
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			//echo json_encode($row);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }	
	
    public static function getJugadorPosIni($partido,$fecha,$iclub,$icate,$jugador)
    {
	$consulta = "SELECT posicionini FROM vappjugpartido where 
					idpartido = $partido 
				and Fecha=$fecha 
				and idclub=$iclub
				and idcategoria=$icate
				and jugador=$jugador" ;
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($partido,$fecha,$iclub,$icate,$jugador));
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			//echo json_encode($row);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }
    
    public static function getJugadorEnSet($partido,$fecha,$iclub,$icate,$jugador,$setnumero)
    {
	$consulta = "SELECT secuencia FROM vappjugpartido where 
					idpartido = $partido 
				and Fecha=$fecha 
				and idclub=$iclub
				and idcategoria=$icate
				and jugador=$jugador
				and setnumero=$setnumero" ;
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($partido,$fecha,$iclub,$icate,$jugador,$setnumero));
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			//echo json_encode($row);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }    	
	
public static function getJugadoresLoad($partido,$fecha,$iclub)
    {
        				
	$consulta = "SELECT eq.numero,eq.nombre,eq.categoria,eq.idjugador,vappjugpartido.idclub,vappjugpartido.posicion
				 FROM vappjugpartido
               inner join vappequipo eq
               on eq.idclub = vappjugpartido.idclub
                  and eq.idjugador = vappjugpartido.jugador    
                WHERE vappjugpartido.idpartido=$partido	and vappjugpartido.Fecha=$fecha and vappjugpartido.idclub=$iclub ";  
     
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($partido,$fecha,$iclub));
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			//echo json_encode($row);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }	
	
public static function getJugSetLoad($partido,$fecha,$iclub,$ianioe,$set)
    {
        				
	$consulta = "SELECT eq.numero,eq.nombre,eq.categoria,eq.idjugador,vappjugpartido.idclub,vappjugpartido.posicion
				 FROM vappjugpartido
               inner join vappequipo eq
               on eq.idclub = vappjugpartido.idclub
                  and eq.idjugador = vappjugpartido.jugador    
                WHERE vappjugpartido.idpartido=$partido	and eq.anioEquipo=$ianioe and vappjugpartido.Fecha=$fecha and vappjugpartido.idclub=$iclub and (vappjugpartido.setnumero=$set or vappjugpartido.setnumero=0 ) ";  
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($partido,$fecha,$ianioe,$set));
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			//echo json_encode($row);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }	
	
	
// jugadores por club y categoria, todos    
//contar registros	
   public static function contar()
    {
    		
        $consulta = "SELECT count(*) FROM vappjugpartido";
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
    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * 
     */
     
/*    public static function update($nombre,$categoria,$jugadorid )
    { 
        // Creando consulta UPDATE
        $consulta = "UPDATE vappequipo SET nombre=?,categoria=? ". 
        "WHERE idjugador=? ";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($nombre,$categoria,$jugadorid ));

        //return $cmd;
		echo json_encode($cmd);

    }
*/
    /**
     * Insertar un nuevo gede
     *
     * @param $idsede      titulo del nuevo registro
     * @param $nombre descripción del nuevo registro
     * @return PDOStatement
     */
    public static function insert($partido,$fecha,$iclub,$icate,$jugador)
    {
    	//idjugador es autonumerico..
    	$comando = "INSERT INTO vappjugpartido (idpartido,Fecha,idclub,idcategoria,jugador ) ".
		" VALUES ( $partido,$fecha,$iclub,$icate,$jugador ) " ;    	

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($partido,$fecha,$iclub,$icate,$jugador) );
    }
	
    public static function insertSet($partido,$fecha,$iclub,$icate,$jugador,$setnumero)
    {
    	//idjugador es autonumerico..
    	$comando = "INSERT INTO vappjugpartido (idpartido,Fecha,idclub,idcategoria,jugador,setnumero ) ".
		" VALUES ( $partido,$fecha,$iclub,$icate,$jugador,$setnumero ) " ;    	

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($partido,$fecha,$iclub,$icate,$jugador,$setnumero) );
    }	
		

    public static function setPos($partido,$fecha,$iclub,$icate,$jugador,$posicioninicial,$posicionact,$hora,$setnumero)
    {
    	//idjugador es autonumerico..
    	$comando = "UPDATE vappjugpartido 
	    			set posicionini=$posicioninicial,posicion=$posicionact,hora=$hora,
	    				setnumero=$setnumero
 					WHERE   jugador=$jugador 
	        				and idpartido = $partido
	        				and Fecha=$fecha
	        				and idclub = $iclub
	        				and idcategoria = $icate";	
		//echo($comando);

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($partido,$fecha,$iclub,$icate,$jugador,$posicioninicial,$posicionact,$hora,$setnumero) );
    }
  
  
    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idsede identificador de la sede
     * @return bool Respuesta de la eliminación
     */
    public static function delete($partido,$fecha,$iclub,$icate,$jugador)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappjugpartido WHERE 
        				
        				jugador=$jugador 
        				and idpartido = $partido
        				and Fecha=$fecha
        				and idclub = $iclub
        				and idcategoria = $icate";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($partido,$fecha,$iclub,$icate,$jugador));
    }
}

?>