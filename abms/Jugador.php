<?php

/**
 * Representa el la estructura de las sedes
 * almacenadas en la base de datos
 */
require_once 'database.php';

class jugador
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
	$consulta = "SELECT * FROM vappequipo  " ;
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
    
    public static function getJugadorxNombreAll()
    {
 	// armar join a tablas descriptoras
	//$consulta = "SELECT  nombre, count(nombre)as apariciones FROM vappequipo group by nombre order by nombre" ;
    $consulta = "SELECT   CONCAT(veqq.nombre,'-',vpc.clubabr,'-',veqq.anioEquipo ) as 'nombreComp', count(veqq.nombre)as apariciones ,veqq.nombre
                    FROM vappequipo veqq
                        left JOIN vappclub vpc on vpc.idclub =  veqq.idclub
                            group by veqq.nombre,vpc.clubabr,veqq.anioEquipo 
                        order by veqq.nombre";
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
    
    public static function getId($iclubescab,$ianio,$ingresoClub)
    {
 	// armar join a tablas descriptoras
	$consulta = "SELECT idjugador FROM vappequipo 
					where idclub=$iclubescab and anioEquipo=$ianio 
							order by idjugador desc LIMIT 1";  
      //and ingresoClub=$ingresoClub  
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
    public static function getJugadorxClub($club,$anio)
    {
	$consulta = "SELECT a.idclub,a.idjugador,a.anioEquipo,a.nombre,a.edad,a.ingresoClub,a.categoria,a.categoriaInicio,a.FechaActualiza,a.Baja, b.puestoxcat,b.remeraNum as numero FROM vappequipo a 
				   left join vapppuestojugador b 
	 				on (b.idjugador = a.idjugador and b.pjcategoria = a.categoria
	 				    and b.idclub = a.idclub and b.anioEquipo = a.anioEquipo)
    					where  a.idclub = ? and a.anioEquipo= ?" ;
       //echo "$consulta"; 
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
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
    public static function getJugadorxClubCate($club,$categoria,$anio,$inicio,$TAMANO_PAGINA,$xnombre)
    {
	$cuenta=0;
	$filtro = "";
	
	if($anio != 9999 ){ $filtro = " where a.anioEquipo = $anio ";$cuenta = 1;}
	if($club != 9999){ 
			if($cuenta != 0){ $filtro .= " and  a.idclub = $club ";$cuenta = 2;}
			else { $filtro = " where   a.idclub = $club ";$cuenta = 1;}
	}		
	if($categoria != 9999){ 
			if($cuenta != 0){ $filtro .= " and a.categoria = $categoria ";$cuenta = 1;}
			else { $filtro = " where  a.categoria = $categoria ";$cuenta = 1;}

		}

    if($xnombre != 9999){	$filtro = "where a.nombre like '%$xnombre%' ";$cuenta=1;}

//		echo "<br> Conteo de filtros: $cuenta <br>";
//		echo "<br> Filtros: $filtro <br>";
	if($cuenta >= 1){
		
	$consulta = "SELECT a.idclub,a.idjugador,a.anioEquipo,a.nombre,a.edad,a.ingresoClub,a.categoria,a.categoriaInicio,a.FechaActualiza,a.Baja,a.FechaEgreso, d.puestoxcat,if(d.remeraNum <> 0, d.remeraNum,a.numero ) as numero , b.descripcion as CategoriaActual, c.descripcion as CategoriaInicio , h.nombre as ClubNombre FROM vappequipo a
					left join vapppuestojugador d 
	 				       on (d.idjugador = a.idjugador and d.pjcategoria = a.categoria
	 				       and d.idclub = a.idclub and d.anioEquipo = a.anioEquipo)
                     left join vappcategoria b 
                     		on (b.idcategoria = a.categoria)
                     left join vappclub h 
                     		on (h.idclub = a.idclub)                     		
                     left join  vappcategoria c
                     		on (c.idcategoria = a.categoriaInicio)	
							$filtro LIMIT " . $inicio . "," . $TAMANO_PAGINA;

	//echo $consulta;					
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
            // $comando->execute(array($club,$categoria,$anio,$inicio,$TAMANO_PAGINA,$xnombre));
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			//echo json_encode($row);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
       }	
    }	

    public static function getJugadorPartidoInsert($partido,$fecha,$club,$categoria,$anio,$jugador,$categoriaPartido)
    {
    $filtrojugador ="";	
    if($jugador != 0) $filtrojugador = " and vappequipo.idjugador =$jugador";	
    	
	$consulta = " 
                     SELECT vappequipo.idclub,vappequipo.categoria,numero,nombre,vappequipo.idjugador,jugp.jugador ,
					pj.puestoxcat puesto ,pj.remeraNum remera
					FROM vappequipo 
					left join vappjugpartido jugp on jugp.idclub = vappequipo.idclub 
												 and jugp.idcategoria = vappequipo.categoria 
												 and jugp.jugador = vappequipo.idjugador
												 and jugp.idpartido=$partido 
												 and jugp.Fecha=$fecha
				       left join vapppuestojugador pj 
				              on pj.idjugador = vappequipo.idjugador 
				             and (pj.pjcategoria = vappequipo.categoria ) 
		 				     and pj.idclub = vappequipo.idclub and pj.anioEquipo = vappequipo.anioEquipo				             
					where vappequipo.idclub = $club and 
					      vappequipo.categoria = $categoria and 
					      vappequipo.anioEquipo =$anio and 
					      vappequipo.FechaEgreso IS NULL 
					      $filtrojugador ";
    //    echo "<br> Lista de jugadores cargados en Equipo: <br>";
    //  echo "<br> $consulta <br>";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            					   
            // $comando->execute(array($partido,$fecha,$club,$categoria,$anio,$jugador,$categoriaPartido));
            $comando->execute();
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			return $row;

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }	
    
    public static function getJugadorPartidoInsert2($partido,$fecha,$club,$categoria,$anio,$setnum)
    {
    $Filtromay1="";	
	if($setnum > 1) $Filtromay1 = " and jugp.setnumero=$setnum";
	$consulta = "SELECT vappequipo.idclub,vappequipo.categoria,numero,nombre,vappequipo.idjugador,jugp.jugador ,pj.puestoxcat puesto 
					FROM  vappjugpartido jugp
					left join vappequipo  on   vappequipo.idclub = jugp.idclub  
												 and vappequipo.categoria = jugp.idcategoria  
												 and vappequipo.idjugador = jugp.jugador
				                                 and vappequipo.anioEquipo =$anio
                    left join vapppuestojugador pj 
				                on pj.idjugador = vappequipo.idjugador 
				                    and pj.pjcategoria = vappequipo.categoria 
				                    and pj.idclub = vappequipo.idclub and pj.anioEquipo = vappequipo.anioEquipo
					where 	jugp.idpartido=$partido 
			            and jugp.Fecha=$fecha
			            and vappequipo.categoria=$categoria
                        and jugp.idclub =$club
 					      and jugp.entraSale=99 $Filtromay1 ";
      // echo "<br> Lista de jugadores cargados en Equipo: SET NRO $setnum <br>";
      // echo "<br> $consulta <br>";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			return $row;

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }	
        
    public static function getJugadorPartido($partido,$fecha,$club,$categoria,$anio)
    {
	$consulta = " SELECT vappequipo.idclub,vappequipo.categoria,numero,nombre,vappequipo.idjugador,jugp.jugador , pj.puestoxcat puesto
				FROM vappequipo 
					left join vappjugpartido jugp on jugp.idclub = vappequipo.idclub 
												 and jugp.idcategoria = vappequipo.categoria 
												 and jugp.jugador = vappequipo.idjugador
												 and jugp.idpartido=$partido 
												 and jugp.Fecha=$fecha
 					left join vapppuestojugador pj on pj.idjugador = vappequipo.idjugador
                    								 and pj.pjcategoria = vappequipo.categoria
	 				    and pj.idclub = vappequipo.idclub and pj.anioEquipo = vappequipo.anioEquipo                    								  
				where vappequipo.idclub = $club and vappequipo.categoria = $categoria and vappequipo.anioEquipo = $anio 
					   and jugp.entraSale=99 ";
       //echo "<br> Lista de jugadores cargados en Equipo: <br>";
       //echo "<br> $consulta <br>";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			return $row;

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }	
        
    
    
//contar registros	
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


//contar registros	
   public static function contarConsulta($club,$categoria,$anio,$xnombre)
    {
    		
	$cuenta=0;
	$filtro = "";
	
	if($anio != 9999 ){ $filtro = " where a.anioEquipo = $anio ";$cuenta = 1;}
	if($club != 9999){ 
			if($cuenta != 0){ $filtro .= " and  a.idclub = $club ";$cuenta = 2;}
			else { $filtro = " where   a.idclub = $club ";$cuenta = 1;}
	}		
	if($categoria != 9999){ 
			if($cuenta != 0){ $filtro .= " and a.categoria = $categoria ";$cuenta = 1;}
			else { $filtro = " where  a.categoria = $categoria ";$cuenta = 1;}

		}

	if($xnombre != 9999)	$filtro = "where a.nombre like '%$xnombre%' ";

	$consulta = "SELECT count(*) FROM vappequipo a
					left join vapppuestojugador d 
	 				       on (d.idjugador = a.idjugador and d.pjcategoria = a.categoria
	 				       and d.idclub = a.idclub and d.anioEquipo = a.anioEquipo)
                     left join vappcategoria b 
                     		on (b.idcategoria = a.categoria)
                     left join vappclub h 
                     		on (h.idclub = a.idclub)                     		
                     left join  vappcategoria c
                     		on (c.idcategoria = a.categoriaInicio)	
							$filtro " ;
							
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
    public static function getByIdSimple($idclub,$idjugador,$ianio )
    {
        // Consulta de la sede
        $consulta = "SELECT *
					FROM vappequipo  eq
						WHERE eq.idclub=$idclub and eq.idjugador = $idjugador and eq.anioEquipo=$ianio" ;    	

		//echo "<br> consulta por jugador: $consulta <br>";
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
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    public static function getById($idclub,$idjugador,$idcategoria )
    {
        // Consulta de la sede
//        $consulta = "SELECT CONCAT(nombre,'(',numero,')') as jugx,idjugador FROM vappequipo WHERE idclub=$idclub and idjugador = $idjugador ";
        $consulta = "SELECT CONCAT(eq.nombre,'<br>(',ptos.remeraNum,')') as jugx,eq.idjugador 
					FROM vappequipo  eq
						left JOIN vapppuestojugador ptos
                             on ptos.idjugador = eq.idjugador
                            and ptos.pjcategoria = $idcategoria
                            and ptos.idclub = eq.idclub
                            and ptos.anioEquipo = eq.anioEquipo                   
						WHERE eq.idclub=$idclub and eq.idjugador = $idjugador " ;    	

		//echo "<br> consulta por jugador: $consulta <br>";
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
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    public static function getByIdABM2($anio,$unJugador,$club,$categoria )
    {
    // Consulta de la sede
        $consulta = "SELECT CONCAT(nombre,'(',numero,')') as jugx,idjugador FROM vappequipo WHERE anioEquipo=$anio and idjugador = $unJugador and idclub=$club and categoria=$categoria ";

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
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
    
    
    public static function getByIdABM($anio,$unJugador,$club,$categoria )
    {
    // Consulta de la sede
        $consulta = "SELECT * FROM vappequipo WHERE anioEquipo=$anio and idjugador = $unJugador and idclub=$club and categoria=$categoria ";
//        echo "$consulta <br>";


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
    public static function updateSimple($nombre,$ianio,$idclub,$jugadorid )
    { 
        // Creando consulta UPDATE
        $consulta = "UPDATE vappequipo SET nombre='$nombre' ". 
                    " WHERE idclub=$idclub and idjugador = $jugadorid and anioEquipo=$ianio" ;    	

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute();

        return $cmd;
		//echo json_encode($cmd);

    }

    public static function update($nombre,$categoria,$jugadorid )
    { 
        // Creando consulta UPDATE
        $consulta = "UPDATE vappequipo SET nombre=$nombre,categoria=$categoria ". 
        "WHERE idjugador=$jugadorid ";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute();

        //return $cmd;
		echo json_encode($cmd);

    }

    public static function updateABM($idclub,$anioEquipo,$idjugador,$numero,$nombre,$edad,$ingresoClub,$categoria,$categoriaInicio,$egresoClub)
    {
    	//Actualizo acá la Fecha de Egreso, si es que viene con valor...
    	//idjugador es autonumerico..
    	if($egresoClub == "''") $textoEgreso = ", FechaEgreso=NULL";
    	else $textoEgreso = ", FechaEgreso = $egresoClub";
    	
    	$comando = "UPDATE vappequipo 
    				set nombre='$nombre',edad=$edad,categoria=$categoria,
    					categoriaInicio=$categoriaInicio $textoEgreso
    				where idclub=$idclub and anioEquipo=$anioEquipo and idjugador=$idjugador " ;
    				
		//echo("<br>".$comando."<br>");
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute( );
    }


    /**
     * Insertar un nuevo sede
     *
     * @param $idsede      titulo del nuevo registro
     * @param $nombre descripción del nuevo registro
     * @return PDOStatement
     */
    public static function insert($idclub,$anioEquipo,$numero,$nombre,$edad,$ingresoClub,$categoria,$categoriaInicio)
    {
    	$actualizada = date_create()->format('Y-m-d');// fecha corecta de ahora
		$actualizada = "'".$actualizada."'";

//		Fecha de egreso, empieza en NULL
    	//idjugador es autonumerico..
    	$comando = "INSERT INTO vappequipo (idclub,anioEquipo,numero,nombre,edad,ingresoClub,categoria,categoriaInicio,FechaActualiza ) ".
		" VALUES (  $idclub,$anioEquipo,$numero,$nombre,$edad,$ingresoClub,$categoria,$categoriaInicio,$actualizada ) " ;    	
		
		//echo("<br>".$comando."<br>");
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute( );
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idsede identificador de la sede
     * @return bool Respuesta de la eliminación
     */
    public static function delete($idclub,$idjugador,$anioe,$categoria)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappequipo WHERE idjugador=$idjugador and idclub=$idclub and anioEquipo=$anioe and categoria=$categoria ";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();
    }

    public static function jugadoresEnClubCat($idclub,$anioe)
    {
        // Sentencia CONTEO DE JUGADORES POR CATEGORIA EN UN CLUB DADO..
          $comando =   "select cat.descripcion, count(eqi.idjugador) as 'CantJug'
							from vappequipo eqi,vappclub clb,vappcategoria cat
							where clb.idclub = eqi.idclub
								and   cat.idcategoria = eqi.categoria
								and (eqi.idclub = $idclub and eqi.anioEquipo=$anioe)
							group by eqi.idclub,eqi.categoria";
        // Preparar la sentencia
          try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($comando);
            // Ejecutar sentencia preparada
            $comando->execute();
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			return $row;

        	} catch (PDOException $e) {
            return ($e->getMessage());
        		}
 
    }
    

}

?>