<?php

/**
 * Representa el la estructura de las sedes
 * almacenadas en la base de datos
 */
require_once 'database.php';

class partjugCab
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
	$consulta = "SELECT * FROM vappjugpartidocab  " ;
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
    public static function getJugPartidoCab($idpartido,$fecha)
    {
	$consulta = "SELECT * FROM vappjugpartidocab where idpartido = $idpartido and Fecha=$fecha " ;
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
  	
	
	
//$jugsA = partjug::getJugadoresListaInicial($idpartido,$fecha2,$clublocalA);//	
public static function getJugListaInicial($partido,$fecha,$iclub,$icate,$ianioe,$categoriaPartido)
    {
/*
esto responde la sgte informacion
            "numero": "1",
            "nombre": "Leandro",
            "categoria": "19",
            "idjugador": "146",
            "FechaEgreso": "2022-08-30",
            "idclub": null,
            "jugador": null,
            "posicion": null,
            "puestoxcat": "4"
LOS NULL SIGNIFICAN QUE NO SE DIÓ DE ALTA EN LA TABLA vappjugpartidocab
 * ya sea porque fue dado de baja
 	en este caso el query lo trae igual porque estamos consultando a todos los jugadores de la 
 	categoria, no solo los que estan en la nómina del partido
 * o porque no pertenece a la categoria..
		por la misma razon anterior, como no pertenecen a la categoria, se listan igual
		pero no se trae la data porque no fueron agregados automaticamente
por eso traigo la fecha de egreso, para poder mostrarlo como de baja en la lista..		
*/    	
	$consulta = "SELECT eq.numero,eq.nombre,eq.categoria,eq.idjugador,eq.FechaEgreso, 
					vappjugpartidocab.idclub,vappjugpartidocab.jugador,vappjugpartidocab.posicion, 
					ptos.puestoxcat 
				 FROM vappequipo eq
               	 left join	vappjugpartidocab
               			on vappjugpartidocab.idclub = eq.idclub 
                  			and vappjugpartidocab.jugador = eq.idjugador
                  			and vappjugpartidocab.idpartido=$partido	
                  			and vappjugpartidocab.Fecha=$fecha
                            and vappjugpartidocab.entraSale=99
                left JOIN vapppuestojugador ptos
                   	on ptos.idjugador = eq.idjugador
                    and ptos.pjcategoria = eq.categoria
                    and ptos.idclub = eq.idclub
                    and ptos.anioEquipo = eq.anioEquipo
                WHERE 
                eq.idclub=$iclub
				and eq.anioEquipo=$ianioe 
				and eq.categoria=$icate ";
				 
     //echo("$consulta<br>");
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($partido,$fecha,$iclub,$icate,$ianioe,$categoriaPartido));
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			//echo json_encode($row);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }	
	

	
public static function getJugListaInicio($partido,$fecha,$iclub,$ianioe,$icategoriaPartido)
    {
    	// traigo todos los que se cargaron como equipo inicial DEL PARTIDO, no solo de la 
    	//categoria por eso no la uso como filtro.
	$consulta = "SELECT eq.numero,eq.nombre,eq.categoria,eq.idjugador,
					vappjugpartidocab.idclub,vappjugpartidocab.jugador,vappjugpartidocab.posicion, 
					ptos.puestoxcat
				 FROM vappequipo eq
               	 right join	vappjugpartidocab
               			on vappjugpartidocab.idclub = eq.idclub 
                  			and vappjugpartidocab.jugador = eq.idjugador
                  			and vappjugpartidocab.idpartido=$partido	
                  			and vappjugpartidocab.Fecha=$fecha
                            and vappjugpartidocab.entraSale=99
                left JOIN vapppuestojugador ptos
                   	on ptos.idjugador = eq.idjugador
                    and ptos.pjcategoria = $icategoriaPartido
                    and ptos.idclub = eq.idclub
                    and ptos.anioEquipo = eq.anioEquipo                    
                WHERE 
                eq.idclub=$iclub
				and eq.anioEquipo=$ianioe  ";

     //echo("$consulta<br>");
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($partido,$fecha,$iclub,$ianioe,$icategoriaPartido));
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
    		
        $consulta = "SELECT count(*) FROM vappjugpartidocab";
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

    public static function insert($partido,$fecha,$iclub,$icate,$jugador,$puesto,$mensajeAlta)
    {
    	//idjugador es autonumerico..
    	$comando = "INSERT INTO vappjugpartidocab (idpartido,Fecha,idclub,idcategoria,jugador,puesto,mensajeAltaCab ) ".
		" VALUES ( $partido,$fecha,$iclub,$icate,$jugador,'$puesto',$mensajeAlta ) " ;    	
		
		//echo "<br >$comando <br>";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($partido,$fecha,$iclub,$icate,$jugador,$puesto,$mensajeAlta) );
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
        $comando = "DELETE FROM vappjugpartidocab WHERE 
        				jugador=$jugador 
        				and idpartido = $partido
        				and Fecha=$fecha
        				and idclub = $iclub
        				and idcategoria = $icate";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($partido,$fecha,$iclub,$icate,$jugador));
    }
    
public static function deleteJugadorBajaPartidos($egresoClub,$iclubescab,$icatcab,$idjugador)
{

        // Sentencia DELETE
        $comando = "DELETE FROM vappjugpartidocab WHERE 
        				jugador=$idjugador 
        				and Fecha >= $egresoClub
        				and idclub = $iclubescab
        				and idcategoria = $icatcab";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($egresoClub,$iclubescab,$icatcab,$idjugador));
	
}
    
    public static function deleteAllJPCab($partido,$fecha)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappjugpartidocab WHERE 
        				Fecha=$fecha
        				and idpartido = $partido";

		echo $comando;
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($partido,$fecha));
    }

    
}

?>