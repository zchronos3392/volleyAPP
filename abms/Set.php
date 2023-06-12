<?php

/**
 * Representa el la estructura de las sedes
 * almacenadas en la base de datos
 */
require_once 'database.php';

class Sett
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
    public static function getSetData($idpartido,$fecha,$setnum)
    {
 	// armar join a tablas descriptoras
	// 29-08-2018, ver si aun funciona...
	//22.10.21 agrego mnumero de set:$setnum
	$filtro ="";
	if($setnum!=0) $filtro ="and vappset.setnumero=$setnum ";
    $consulta =  "SELECT vappset.idpartido,vappset.setnumero,secuencia,vestado.descripcion as DescEstado,
    			  comp.cnombre,puntoa,puntob,mensaje ,ClubA,clubAtbl.clubabr as NombreClubA , 
				clubBtbl.clubabr as NombreClubB, ClubB, vappset.CantPausaA,vappset.CantPausaB
    			  FROM vappset 
 				  	inner join vappestado vestado   on vestado.idestado = estado 
				  	inner join vapppartido partdata 
				  		on partdata.idpartido = vappset.idpartido
				  		and partdata.Fecha = vappset.fecha  							
 				  	inner join vappcomp comp on comp.idcomp = partdata.competencia		
					INNER JOIN (SELECT setnumero,max(secuencia) AS SEQ FROM vappset WHERE vappset.idpartido=$idpartido and vappset.fecha=$fecha GROUP BY setnumero) as SETCABE
     				ON vappset.setnumero =	SETCABE.setnumero 
        			AND vappset.secuencia = SETCABE.SEQ
					inner join vappclub clubAtbl on clubAtbl.idclub = partdata.ClubA
					inner join vappclub clubBtbl on clubBtbl.idclub = partdata.ClubB
				WHERE vappset.idpartido=$idpartido	and vappset.estado in (2,4)	and vappset.fecha=$fecha  $filtro
				order by vappset.setnumero";
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

    public static function getHoraInicioHoraFin($idpartido,$fecha,$setnumero)
    {
 	// armar join a tablas descriptoras
	// 29-08-2018, ver si aun funciona...
    $consulta =  "SELECT setnumero,min(secuencia) AS primseq,max(secuencia)AS ultmseq  
                  FROM vappset 
                  WHERE vappset.idpartido=$idpartido 
                  and vappset.fecha=$fecha 
                  and vappset.setnumero=$setnumero    
                  and (mensaje ='Confirmando posiciones en planilla...' or  mensaje = 'Fin del set' or mensaje = '' or mensaje <> '')
                  GROUP BY setnumero";
        
  //       echo "<br> getHoraInicioHoraFin :  <br>$consulta <br>";       
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


    public static function getSetDataInicial($idpartido,$fecha)
    {
 	// armar join a tablas descriptoras
	// 29-08-2018, ver si aun funciona...
    $consulta =  "SELECT vappset.idpartido,vappset.setnumero,secuencia,vestado.descripcion as DescEstado,
    			  comp.cnombre,puntoa,puntob,mensaje ,ClubA, ClubB, vappset.CantPausaA,vappset.CantPausaB,
				clubAtbl.clubabr as NombreClubA ,clubBtbl.clubabr as NombreClubB,partdata.categoria
    			  FROM vappset 
 				  	inner join vappestado vestado   on vestado.idestado = estado 
				  	inner join vapppartido partdata 
				  		on partdata.idpartido = vappset.idpartido
				  		and partdata.Fecha = vappset.fecha  							
 				  	inner join vappcomp comp on comp.idcomp = partdata.competencia		
					INNER JOIN (SELECT setnumero,max(secuencia) AS SEQ FROM vappset WHERE vappset.idpartido=$idpartido and vappset.fecha=$fecha GROUP BY setnumero) as SETCABE
     				ON vappset.setnumero =	SETCABE.setnumero 
        			AND vappset.secuencia = SETCABE.SEQ
					inner join vappclub clubAtbl on clubAtbl.idclub = partdata.ClubA
					inner join vappclub clubBtbl on clubBtbl.idclub = partdata.ClubB					
				WHERE vappset.idpartido=$idpartido	and vappset.estado in (5,2,4)	and vappset.fecha=$fecha
				order by vappset.setnumero";
         //echo "<br> getSetDataInicial :  <br>$consulta <br>";       
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
* @param {int} $idpartido
* @param {int} $set
* @param {date} $fecha
* 
* @return VECTOR CON EL PRIMER REGISTRO GRABADO CUANDO SETEAMOS POSICION INICIAL
*/	
	public static function getSetPosInicialesGrabadas($idpartido,$set,$fecha){
		
		$consulta = "SELECT * FROM vappset 
					where idpartido=$idpartido
					  and setnumero=$set 
					  and fecha=$fecha
					  and mensaje like '%Confirmando posiciones en planilla%' 
					  and saque <> 0 
					order by secuencia LIMIT 1";

//ECHO "$consulta";
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
	
	
    public static function ultSecuencia($idpartido,$set,$fecha)
    {
    		// armar join a tablas descriptoras
     // 29-08-2018, ver si aun funciona...			
	//$consulta = "SELECT top 1 secuencia FROM vappset where idpartido=? and setnumero=? order by secuencia desc ";  
	$consulta = "SELECT secuencia FROM vappset where idpartido=$idpartido and setnumero=$set and fecha=$fecha order by secuencia desc LIMIT 1";  
//		echo "<br>$consulta <br>";
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

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
public static function  TiempoTranscurrido($idpartido,$fecha)
    {
    		// armar join a tablas descriptoras
			// 29-08-2018, ver si aun funciona...
/*
			$consulta = "SELECT d.idpartido, (select t.hora from vappset t where t.fecha=$fecha and 
						t.idpartido=$idpartido order by t.idpartido and t.hora desc Limit 1) as HoraInicial, 
						d.hora as HoraFinal,TIMEDIFF (d.hora , (select t.hora from vappset t where 
						t.idpartido=$idpartido and t.fecha=$fecha order by t.idpartido and t.hora desc Limit 1) )
						as transcurrido
							FROM vappset d where d.fecha=$fecha and d.idpartido=$idpartido order by d.hora desc 
							limit 1";		
*/
// NUEVA CONSUKLTA QUE TRAE EL TIEMPO TRANSCURRIDO EN HH:MM:SS							

//select min(t.hora) from vappset t where t.fecha='2021-10-08' and t.idpartido=2
			
			$consulta = "SELECT d.idpartido, (select min(t.hora) from vappset t where t.fecha=$fecha and 
						 t.idpartido=$idpartido 
						 and mensaje='Confirmando posiciones en planilla...'
						 ORDER by setnumero,secuencia
						 ) as HoraInicial, max(d.hora) as HoraFinal,
						 
						 TIME_FORMAT(TIMEDIFF (max(d.hora),  (select min(t.hora) from vappset t where t.fecha=$fecha and 
						 t.idpartido=$idpartido 
						 and mensaje='Confirmando posiciones en planilla...'
						 ORDER by setnumero,secuencia
						 )), '%Hhs:%imin') as transcurrido 
						    FROM vappset d where d.fecha=$fecha and d.idpartido=$idpartido 
                            and mensaje ='Fin del set'
						    order by d.hora desc limit 1";							
		        //echo "TiempoTranscurrido <br> $consulta <br>";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $comando->fetch(PDO::FETCH_ASSOC);

        }
        catch (PDOException $e)
        {
            return ("MENSAJE DEL SQL : ".$e->getMessage());
        }
    }    
   
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++        
    public static function ultSetNum($idpartido,$fecha)
    {
    		// armar join a tablas descriptoras
			// 29-08-2018, ver si aun funciona...
			$consulta = "SELECT setnumero FROM vappset WHERE idpartido=$idpartido and fecha=$fecha ORDER BY secuencia,setnumero DESC LIMIT 1 ";  
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $comando->fetch(PDO::FETCH_ASSOC);

        }
        catch (PDOException $e)
        {
            return ("MENSAJE DEL SQL : ".$e->getMessage());
        }
    }    
        
    
   public static function contar()
    {
    		
        $consulta = "SELECT count(*) FROM vappset";
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



   public static function setRotacionesData()
    {
    		
        $consulta = "SELECT * FROM vappset
        		     where mensaje like '%Rotacion en%'
		";
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
    public static function getById($idpartido,$setnum,$sec,$fecha )
    {
    	
        // Consulta de la sede
        // 29-08-2018, ver si aun funciona...
		$consulta = "SELECT partido.ClubA,partido.ClubB,partido.categoria, 1A as pa_1, 2A as pa_2, 3A as pa_3, 4A as pa_4, 5A as pa_5, 6A as pa_6,
		1B as pb_1, 2B  as pb_2, 3B as pb_3, 4B as pb_4, 5B as pb_5, 6B as pb_6, vappset.estado,sts.descripcion, saque,puntoa,puntob,mensaje,CantPausaA,CantPausaB,codigoStratA,codigoStratB, 
        ordenA,ordenB
		FROM vappset 
		       inner JOIN vapppartido partido
			       on partido.idPartido = vappset.idpartido
			        AND partido.Fecha = vappset.fecha
			   inner join vappestado sts on sts.idestado = vappset.estado  
		WHERE vappset.idpartido= $idpartido and setnumero=$setnum and secuencia=$sec and vappset.fecha=$fecha ";
        //echo($consulta);                
        
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idpartido,$setnum,$sec,$fecha ));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return ($row);
            //echo json_encode($row);

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Obtiene los campos de una sede con un identificador
     * determinado
     *
     * @param $idsede Identificador de la sede
     * @return mixed
     */
    public static function getByIdUltimoRegistro($idpartido,$setnum,$sec,$fecha )
    {
    	
        // Consulta de la sede
        // 29-08-2018, ver si aun funciona...
		$consulta = "SELECT * FROM vappset 
							WHERE vappset.idpartido= $idpartido and setnumero=$setnum and secuencia=$sec and vappset.fecha=$fecha ";
      //  echo "$consulta";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idpartido,$setnum,$sec,$fecha ));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return ($row);
            //echo json_encode($row);

        } catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

/**
 * 
 * 
 */
    public static function updateHoraByIdRegistro($idpartido,$setnum,$sec,$fecha,$horamod )
    {
    	
        // Consulta de la sede
        // 29-08-2018, ver si aun funciona...
		$consulta = "UPDATE  vappset 
                        SET hora=$horamod
							WHERE vappset.idpartido= $idpartido and setnumero=$setnum and secuencia=$sec and vappset.fecha=$fecha ";
     //ECHO "<BR> $consulta <BR>";   
    // Preparar la sentencia
    $cmd = Database::getInstance()->getDb()->prepare($consulta);

    // Relacionar y ejecutar la sentencia
    $cmd->execute(array($idpartido,$setnum,$sec,$fecha,$horamod ));

    //return $cmd;
    //echo json_encode($cmd);

    }

    public static function getResumenPartido($idpartido,$fecha )
    {
        // Consulta de la sede
        // 29-08-2018, ver si aun funciona...
		$consulta = "Select setnumero, puntoa, puntob  FROM  vappset
				       WHERE idpartido= $idpartido and fecha=$fecha 
				           group by setnumero,puntoa,puntob ";
        //echo($consulta);                
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idpartido,$fecha ));
            // Capturar primera fila del resultado
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
            return ($row);
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
    public static function update($jugadorid,$equipoid,$descripcion,$numeroA,$numeroB,$estado,$idPartido,$setnum,$secuencia,$mensaje)
    { 
        // Creando consulta UPDATE
        $consulta = "UPDATE vappset SET jugadorid=?,equipoid=?,descripcion=?,numeroA=?,numeroB=?,estado=?,mensaje=$mensaje ". 
        "WHERE idpartido=? and setnumero=? and secuencia=?";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($jugadorid,$equipoid,$descripcion,$numeroA,$numeroB,$estado,$idPartido,$setnum,$secuencia,$mensaje ));

        //return $cmd;
		echo json_encode($cmd);

    }


    /**
     * Actualiza un registro de set, de un partido especifico en la secuencia dada..
     *
     * 
     */
    public static function updateMensajeSecuencia($idPartido,$fecha,$setnum,$secuencia,$conteoA,$conteoB,$mensaje)
    { 
        // Creando consulta UPDATE
        $consulta = "UPDATE vappset SET mensaje=$mensaje, CantPausaA=$conteoA,CantPausaB=$conteoB ". 
        "WHERE idpartido=$idPartido and fecha=$fecha and setnumero=$setnum and secuencia=$secuencia";

		//echo $consulta ;
        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($idPartido,$fecha,$setnum,$secuencia,$conteoA,$conteoB,$mensaje ));

        //return $cmd;
		echo json_encode($cmd);

    }
    public static function updateZonasxSecuencia($idPartido,$fecha,$setnum,$secuencia,$A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6)
    { 
        // Creando consulta UPDATE
        $consulta = "UPDATE vappset SET 1A=$A1,2A=$A2,3A=$A3,4A=$A4,5A=$A5,6A=$A6,1B=$B1,2B=$B2,3B=$B3,4B=$B4,5B=$B5,6B=$B6 ". 
        "WHERE idpartido=$idPartido and fecha=$fecha and setnumero=$setnum and secuencia=$secuencia";

		//echo $consulta ;
        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($idPartido,$fecha,$setnum,$secuencia,$A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6));

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
    public static function insert( $idpartido, $secuencia, $setnumero, $fecha,$hora,
    							   $A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6,
    							   $estado,$puntoa, $puntob,$saque,$estrategiaA,$estrategiaB,
                                   $ordenLocal,$ordenVisita,
    							   $mensaje,$contadorpausasA,$contadorpausasB)
    {

        $comando = "INSERT INTO vappset (idpartido, secuencia, setnumero, fecha, hora, 1A, 2A, 3A, 4A, 5A, 6A, 
    1B, 2B, 3B, 4B, 5B, 6B, estado, puntoa, puntob,saque,codigoStratA,codigoStratB,ordenA,ordenB,mensaje,CantPausaA,CantPausaB) ".
		" VALUES (  $idpartido, $secuencia, $setnumero, $fecha,$hora,$A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6,$estado,$puntoa, $puntob,$saque,$estrategiaA,$estrategiaB,$ordenLocal,$ordenVisita,$mensaje,$contadorpausasA,$contadorpausasB ) " ;    	
		
		//echo("<br>$comando <br>");
		
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array( $idpartido, $secuencia, $setnumero, $fecha,$hora,$A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6,$estado,$puntoa, $puntob,$saque,$estrategiaA,$estrategiaB,$ordenLocal,$ordenVisita,$mensaje,$contadorpausasA,$contadorpausasB));
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idsede identificador de la sede
     * @return bool Respuesta de la eliminación
     */
    public static function delete($idpartido,$setNum,$secuencia,$fecha)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappset WHERE idpartido=? and setnumero=? and secuencia=? and fecha=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idpartido,$setNum,$secuencia,$fecha));
    }
    
    public static function deleteAllSet($idpartido,$setNum,$fecha)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappset WHERE idpartido=? and setnumero=? and fecha=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idpartido,$setNum,$fecha));
    }
    
    public static function deleteAll($idpartido,$fecha)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappset WHERE idpartido=$idpartido  and fecha=$fecha";
		//echo $comando ;
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idpartido,$fecha));
    }        
}

?>