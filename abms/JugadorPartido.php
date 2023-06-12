<?php

/**
 * Representa el la estructura de las sedes
 * almacenadas en la base de datos
 */
require_once 'database.php';
require_once 'Partido.php';
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
    public static function getJugadorEnPos($partido,$fecha,$iclub,$icate,$posicionX)
    {
	$consulta = "SELECT ptos.remeraNum as numero,eq.nombre,eq.categoria,eq.idjugador,
					    vappjugpartido.posicionini,vappjugpartido.idclub,
       					vappjugpartido.posicion,vappjugpartido.activoSN,
       					ptos.puestoxcat,posCatColor.color as ColorPuestoCat,
       					vappjugpartido.puesto,posicionCanchaColor.color as ColorPuestoCancha,
       					vappjugpartido.secuencia,eq.FechaEgreso
				 FROM vappjugpartido
	               inner join vappequipo eq
	               on eq.idclub = vappjugpartido.idclub
	                  and eq.idjugador = vappjugpartido.jugador    
	                left JOIN vapppuestojugador ptos
	                   on ptos.idjugador = eq.idjugador
	                   and ptos.pjcategoria = vappjugpartido.idcategoria
	                    and ptos.idclub = eq.idclub
	                    and ptos.anioEquipo = eq.anioEquipo                   
					LEFT JOIN vappposicion posCatColor
					      on posCatColor.idPosicion = ptos.puestoxcat
					LEFT JOIN vappposicion posicionCanchaColor
					      on posicionCanchaColor.idPosicion = vappjugpartido.puesto
				where vappjugpartido.idpartido = $partido 
				  and vappjugpartido.Fecha=$fecha 
				  and vappjugpartido.idclub=$iclub
				  and vappjugpartido.idcategoria=$icate
				  and vappjugpartido.posicion=$posicionX" ;
	
	//echo "$consulta";			
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($partido,$fecha,$iclub,$icate,$posicionX));
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
	$consulta = "SELECT ptos.remeraNum as numero,eq.nombre,eq.categoria,eq.idjugador,
					    vappjugpartido.posicionini,vappjugpartido.idclub,
       					vappjugpartido.posicion,vappjugpartido.activoSN,
       					ptos.puestoxcat,posCatColor.color as ColorPuestoCat,
       					vappjugpartido.puesto,posicionCanchaColor.color as ColorPuestoCancha,
       					vappjugpartido.secuencia,eq.FechaEgreso
				 FROM vappjugpartido
	               inner join vappequipo eq
	               on eq.idclub = vappjugpartido.idclub
	                  and eq.idjugador = vappjugpartido.jugador    
	                left JOIN vapppuestojugador ptos
	                   on ptos.idjugador = eq.idjugador
	                   and ptos.pjcategoria = vappjugpartido.idcategoria
	                    and ptos.idclub = eq.idclub
	                    and ptos.anioEquipo = eq.anioEquipo                   
					LEFT JOIN vappposicion posCatColor
					      on posCatColor.idPosicion = ptos.puestoxcat
					LEFT JOIN vappposicion posicionCanchaColor
					      on posicionCanchaColor.idPosicion = vappjugpartido.puesto
				where vappjugpartido.idpartido = $partido 
				  and vappjugpartido.Fecha=$fecha 
				  and vappjugpartido.idclub=$iclub
				  and vappjugpartido.idcategoria=$icate
				  and vappjugpartido.jugador=$jugador" ;
	
	//echo "$consulta";			
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
	
	
public static function getListaActivos($partido,$fecha,$iclub,$ianioe,$set)
    {
    //hay qye sacar la secuencia como autonumerico, anda mal !!!    				
	$consulta = "SELECT ptos.remeraNum as numero,eq.nombre,eq.categoria,eq.idjugador,vappjugpartido.posicionini,vappjugpartido.idclub,vappjugpartido.posicion,vappjugpartido.activoSN,
					ptos.puestoxcat,posCatColor.color as ColorPuestoCat,
					vappjugpartido.puesto,posicionCanchaColor.color as ColorPuestoCancha,
					vappjugpartido.secuencia,eq.FechaEgreso,vappjugpartido.Orden
				 FROM vappjugpartido
               inner join vappequipo eq
               on eq.idclub = vappjugpartido.idclub
                  and eq.idjugador = vappjugpartido.jugador    
                left JOIN vapppuestojugador ptos
                   on ptos.idjugador = eq.idjugador
                   and ptos.pjcategoria = vappjugpartido.idcategoria
                    and ptos.idclub = eq.idclub
                    and ptos.anioEquipo = eq.anioEquipo                   
				LEFT JOIN vappposicion posCatColor
				      on posCatColor.idPosicion = ptos.puestoxcat
				LEFT JOIN vappposicion posicionCanchaColor
				      on posicionCanchaColor.idPosicion = vappjugpartido.puesto
                WHERE vappjugpartido.idpartido=$partido	and eq.anioEquipo=$ianioe and vappjugpartido.Fecha=$fecha and vappjugpartido.idclub=$iclub and (vappjugpartido.setnumero=$set)
					and entraSale <> 99
					and FechaEgreso IS NULL
					and activoSN = 1 ";
        //echo "<br> getListaActivos: <br>$consulta<br>";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($partido,$fecha,$iclub,$ianioe,$set));
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			//echo json_encode($row);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }	
	
//$jugsA = partjug::getJugadoresListaInicial($idpartido,$fecha2,$clublocalA);//	
public static function getJugadoresListaInicial($partido,$fecha,$iclub,$setnumero)
    {
        				
	$consulta = "SELECT eq.numero,eq.nombre,eq.categoria,eq.idjugador,vappjugpartido.idclub,vappjugpartido.posicion, ptos.puestoxcat
				 FROM vappjugpartido
               inner join vappequipo eq
               on eq.idclub = vappjugpartido.idclub
                  and eq.idjugador = vappjugpartido.jugador
                left JOIN vapppuestojugador ptos
                   on ptos.idjugador = eq.idjugador
                   and ptos.pjcategoria = eq.categoria
                    and ptos.idclub = eq.idclub
                    and ptos.anioEquipo = eq.anioEquipo                   
                WHERE vappjugpartido.idpartido=$partido	and vappjugpartido.Fecha=$fecha and vappjugpartido.idclub=$iclub 
				and entraSale=99 and setnumero = $setnumero";  
     
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($partido,$fecha,$iclub,$setnumero));
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			//echo json_encode($row);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }	
	


public static function getJugSetLoad($partido,$fecha,$iclub,$ianioe,$set,$categoriaPartido)
    {
    //hay qye sacar la secuencia como autonumerico, anda mal !!!    				
	$consulta = "SELECT ptos.remeraNum as numero,eq.nombre,eq.categoria,eq.idjugador,vappjugpartido.posicionini,vappjugpartido.idclub,vappjugpartido.posicion,vappjugpartido.activoSN,
					ptos.puestoxcat,posCatColor.color as ColorPuestoCat,
					vappjugpartido.puesto,posicionCanchaColor.color as ColorPuestoCancha,
					vappjugpartido.secuencia,eq.FechaEgreso,vappjugpartido.Orden
				 FROM vappjugpartido
               inner join vappequipo eq
               on eq.idclub = vappjugpartido.idclub
                  and eq.idjugador = vappjugpartido.jugador    
                left JOIN vapppuestojugador ptos
                   on ptos.idjugador = eq.idjugador
                   and ptos.pjcategoria = $categoriaPartido
                    and ptos.idclub = eq.idclub
                    and ptos.anioEquipo = eq.anioEquipo                   
				LEFT JOIN vappposicion posCatColor
				      on posCatColor.idPosicion = ptos.puestoxcat
				LEFT JOIN vappposicion posicionCanchaColor
				      on posicionCanchaColor.idPosicion = vappjugpartido.puesto
                WHERE vappjugpartido.idpartido=$partido	and eq.anioEquipo=$ianioe and vappjugpartido.Fecha=$fecha and vappjugpartido.idclub=$iclub and (vappjugpartido.setnumero=$set)
					and entraSale <> 99
					and FechaEgreso IS NULL
                    ORDER BY eq.nombre ASC";
        //echo "<br> getJugSetLoad: <br>$consulta<br>";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($partido,$fecha,$iclub,$ianioe,$set,$categoriaPartido));
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			//echo json_encode($row);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }	
	


public static function getJugXSetVer($partido,$fecha,$iclub,$ianioe,$set)
    {
    	//esto trae bien las rotaciones
    $partidoRow = Partido::getById($partido,$fecha);
	//print_r($partidoRow);
    	
    $filtroLocales ="";
    if($partidoRow['idcluba'] == $iclub)	
	    $filtroLocales = " and (vapprotaciones.1a <> 0 and vapprotaciones.2a <> 0 and vapprotaciones.3a <> 0 and vapprotaciones.4a <> 0 and vapprotaciones.5a <> 0 and vapprotaciones.6a <> 0 )"; 	
	
	$filtroVisitante ="";
    if($partidoRow['idclubb'] == $iclub)	
		$filtroVisitante ="	 and (vapprotaciones.1b <> 0 and vapprotaciones.2b <> 0 and vapprotaciones.3b <> 0 and vapprotaciones.4b <> 0 and vapprotaciones.5b <> 0 and vapprotaciones.6b <> 0 ) ";
	 
	$consulta = "SELECT vapprotaciones.*,vset.puntoa,vset.puntob FROM vapprotaciones 
				RIGHT join vappset vset
			      on vset.idpartido = vapprotaciones.idpartido
			        and vset.fecha  = vapprotaciones.fecha
			        and vset.setnumero  = vapprotaciones.setnumero
			        and vset.secuencia  = vapprotaciones.secuenciaSet
					WHERE vapprotaciones.idpartido=$partido 
					  and vapprotaciones.Fecha=$fecha 
					  and vapprotaciones.setnumero=$set 
					  and vapprotaciones.clubrota=$iclub 
					  $filtroLocales  
					$filtroVisitante
					  ORDER BY vapprotaciones.setnumero	";
				//limit 1 QUITE ESTO EL 22 10 2021 PARA TRAER TODAS !!!
       // echo "<br> getJugXSetVer: <br>$consulta<br>";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($partido,$fecha,$iclub,$ianioe,$set));
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			//echo json_encode($row);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }	

public static function getJugSetVer($partido,$fecha,$iclub,$ianioe,$set,$jugadorX)
    {
//agregue esto el 21 10 21, porque en VISUALIZAR JUGADORES, NO ESTABA TRAYENDO 
// LA INFO UNICAMENTE DEL SET..
//and vappjugpartido.secuencia=1 no necesariamente es 1        				
	$consulta = "SELECT eq.numero,eq.nombre,eq.categoria,eq.idjugador,vappjugpartido.idclub,vappjugpartido.puesto,vappjugpartido.posicion,vappjugpartido.activoSN ,ptos.puestoxcat,ptos.remeraNum,
				 posCat.color as ColorPuestoCat,posCancha.color as ColorPuestoCancha
					FROM vappjugpartido 
			   inner join vappequipo eq 
			       on eq.idclub = vappjugpartido.idclub and eq.idjugador = vappjugpartido.jugador 
			   left JOIN vapppuestojugador ptos on ptos.idjugador = eq.idjugador and ptos.pjcategoria = eq.categoria 
			         and ptos.idclub = eq.idclub and ptos.anioEquipo = eq.anioEquipo 
			    left join vappposicion posCat
       				on posCat.idPosicion = ptos.puestoxcat
			    left join vappposicion posCancha
       				on posCancha.idPosicion = vappjugpartido.puesto       				
         		WHERE vappjugpartido.idpartido=$partido and eq.anioEquipo=$ianioe and vappjugpartido.Fecha=$fecha
					and vappjugpartido.idclub=$iclub
					and vappjugpartido.jugador = $jugadorX
					and vappjugpartido.setnumero = $set 
				ORDER BY  vappjugpartido.setnumero";
       // echo "<br>getJugSetVer <br>$consulta<br>";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($partido,$fecha,$iclub,$ianioe,$set,$jugadorX));
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			echo json_encode($row);
			
        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }	



	
public static function getCantJugSetLoad($partido,$fecha,$iclub,$ianioe,$set)
    {
	$consulta = "select (a.total - b.total) as 'setjugok'
						from
				(SELECT count(eq.idjugador) as 'total'
				 FROM vappjugpartido
               inner join vappequipo eq
               on eq.idclub = vappjugpartido.idclub
                  and eq.idjugador = vappjugpartido.jugador    
                WHERE vappjugpartido.idpartido=$partido	and eq.anioEquipo=$ianioe and vappjugpartido.Fecha=$fecha and vappjugpartido.idclub=$iclub and (vappjugpartido.setnumero=$set)
					and entraSale <> 99 )a ,
			   (SELECT count(eq.idjugador) as 'total'
				 FROM vappjugpartidocab
               inner join vappequipo eq
               on eq.idclub = vappjugpartidocab.idclub
                  and eq.idjugador = vappjugpartidocab.jugador    
                WHERE vappjugpartidocab.idpartido=$partido	and eq.anioEquipo=$ianioe and vappjugpartidocab.Fecha=$fecha and vappjugpartidocab.idclub=$iclub and entraSale = 99) b";
                //   
			//echo "<br>$consulta<br>";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($partido,$fecha,$iclub,$ianioe,$set));
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
     * @param $nombre descripci�n del nuevo registro
     * @return PDOStatement
     */

    public static function insert($partido,$fecha,$iclub,$icate,$jugador,$puesto,$setnumero,$mensajeAlta)
    {
    	//idjugador es autonumerico..
    	$comando = "INSERT INTO vappjugpartido (idpartido,Fecha,idclub,idcategoria,jugador,puesto,setnumero,mensajealta ) ".
		" VALUES ( $partido,$fecha,$iclub,$icate,$jugador,'$puesto',$setnumero,$mensajeAlta ) " ;    	
		
		//echo "<br >$comando <br>";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($partido,$fecha,$iclub,$icate,$jugador,$puesto,$setnumero,$mensajeAlta) );
    }

/*
    public static function insert($partido,$fecha,$iclub,$icate,$jugador)
    {
    	//idjugador es autonumerico..
    	$comando = "INSERT INTO vappjugpartido (idpartido,Fecha,idclub,idcategoria,jugador ) ".
		" VALUES ( $partido,$fecha,$iclub,$icate,$jugador ) " ;    	

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($partido,$fecha,$iclub,$icate,$jugador) );
    }
*/	
    public static function insertSet($partido,$fecha,$iclub,$icate,$jugador,$setnumero,$puesto,$orden,$mensajeAlta)
    {
    	//idjugador es autonumerico..
    	$comando = "INSERT INTO vappjugpartido (idpartido,Fecha,idclub,idcategoria,jugador,setnumero,entraSale,puesto,Orden,mensajeAlta ) ".
		" VALUES ( $partido,$fecha,$iclub,$icate,$jugador,$setnumero,0,$puesto,$orden,$mensajeAlta ) " ;    	

		//echo "<br>$comando<br>";
		//echo "<br>$comando<br>";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($partido,$fecha,$iclub,$icate,$jugador,$setnumero,$puesto,$orden,$mensajeAlta) );
    }	
		

    public static function setPos($partido,$fecha,$iclub,$icate,$jugador,$posicioninicial,$posicionact,$puestoAct,$hora,$setnumero)
    {
    	//idjugador es autonumerico..
   	$comando = "UPDATE vappjugpartido 
	    			set posicionini=$posicioninicial,posicion=$posicionact,puesto=$puestoAct,hora=$hora
	    			
 					WHERE   jugador=$jugador 
	        				and idpartido = $partido
	        				and Fecha=$fecha
	        				and idclub = $iclub
	        				and idcategoria = $icate
	        				and entraSale <> 99
	        				and setnumero = $setnumero";	
		//echo($comando);

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($partido,$fecha,$iclub,$icate,$jugador,$posicioninicial,$posicionact,$hora,$setnumero) );
    }
  
  
    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idsede identificador de la sede
     * @return bool Respuesta de la eliminaci�n
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
    
    public static function deletePosiciones($partido,$fecha,$iclub,$setnumero)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappjugpartido WHERE 
        				idpartido = $partido
        				 and Fecha=$fecha
        				  and idclub = $iclub
        				    and setnumero = $setnumero
        				   and entraSale <> 99";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($partido,$fecha,$iclub,$setnumero));
    }
        
    public static function delete2($partido,$setnumero,$fecha)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappjugpartido WHERE 
        				Fecha='$fecha'
        				and idpartido = $partido
        				and setnumero=$setnumero";

		//echo $comando;
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($partido,$setnumero,$fecha));
    }
    public static function deleteAll($partido,$fecha)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappjugpartido WHERE 
        				Fecha=$fecha
        				and idpartido = $partido";

		//echo $comando;
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($partido,$fecha));
    }
    
	public static function 	updateOrden($idpartido,$fecha,$iclub,$icate,$jugador,$set,$orden)
    {
        $consulta = "update vappjugpartido set Orden=$orden  
                        where idpartido = $idpartido and Fecha=$fecha 
                        and idclub=$iclub and idcategoria=$icate and jugador=$jugador
                        and setnumero=$set" ;
        try {
        // Preparar sentencia
        $comando = Database::getInstance()->getDb()->prepare($consulta);
        // Ejecutar sentencia preparada
        $comando->execute(array($idpartido,$fecha,$iclub,$icate,$jugador,$set,$orden));
        return $row = $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e)
         {
            return ($e->getMessage());
            }
    }

	public static function 	updateActivaSN($idpartido,$fecha,$iclub,$icate,$jugador,$set,
										   $accionValor)
    {
	$consulta = "update vappjugpartido set activoSN=$accionValor  
				where idpartido = $idpartido and Fecha=$fecha 
					and idclub=$iclub and idcategoria=$icate and jugador=$jugador
					and setnumero=$set" ;
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idpartido,$fecha,$iclub,$icate,$jugador,$set,
									$accionValor));
            return $row = $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }
    
    public static function updateSale($idpartido,$fecha,$iclub,$icate,$jugadorSale,$set)
    {
	$consulta = "update vappjugpartido set posicion=7  
				where idpartido = $idpartido and Fecha=$fecha 
					and idclub=$iclub and idcategoria=$icate and jugador=$jugadorSale
					and setnumero=$set
				" ;
	//echo "sale:".$consulta;			
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idpartido,$fecha,$iclub,$icate,$jugadorSale,$set));
            return $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			//echo json_encode($row);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }

    public static function updateEntra($partido,$fecha,$iclub,$icate,$set,$jugadorEntra,$posicionEnSet)
    {
	$consulta = "update vappjugpartido set posicion=$posicionEnSet 
				where idpartido = $partido and Fecha=$fecha 
					and idclub=$iclub and idcategoria=$icate and jugador=$jugadorEntra
					and setnumero=$set
				" ;
	//	echo "entra: ".$consulta;			
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($partido,$fecha,$iclub,$icate,$set,$jugadorEntra,$posicionEnSet));

            return $row = $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }


    
}

?>