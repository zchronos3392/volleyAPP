<?php

/**
 * Representa el la estructura de las sedes
 * almacenadas en la base de datos
 */
require_once 'database.php';

class puestojugador
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
    public static function getAll($idjugador,$ianio,$iclub)
    {
 	// armar join a tablas descriptoras
//idjugador	idpuestoJug	FechaPuestoAlta	FechaPuestoMod	remeraNum	puesjugcategoria	puestoxcat 	
	$consulta = "SELECT a.idpuestoJug,a.FechaPuestoAlta,a.remeraNum,b.descripcion as descCat,c.nombre as Posnombre,d.nombre as nombreJug,
				  a.pjcategoria,a.puestoxcat
				 FROM vapppuestojugador a,vappcategoria b,vappposicion c,vappequipo d  					
				      WHERE b.idcategoria = a.pjcategoria									
				    	and c.idPosicion = a.puestoxcat
				    	and d.idjugador  = a.idjugador
				    	and a.idjugador=$idjugador
				    	and d.anioEquipo=$ianio
				    	and d.idClub = $iclub
				    	  and (a.anioEquipo=$ianio and a.idclub=$iclub)" ;
			//echo "$consulta <br>";	    	
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
* @param int $iclub
* @param int $ianioe
* @param int $icategoriaPartido
* 
* @return Lista de Los puestos asignados al jugador de un club y una categoria dados del año analizado
*/	
public static function getControlJugPuestos($iclub,$ianioe,$icategoriaPartido)
    {
    	// traigo todos los que se cargaron como equipo inicial DEL PARTIDO, no solo de la 
    	//categoria por eso no la uso como filtro.
	$consulta = "SELECT eq.numero,eq.nombre,eq.categoria,eq.idjugador,
					ptos.puestoxcat
					FROM vapppuestojugador ptos 
				    	INNER JOIN vappequipo eq 
				        	 on eq.idjugador = ptos.idjugador  
				            and eq.idclub = ptos.idclub 
				            and eq.anioEquipo = ptos.anioEquipo
							and eq.categoria = ptos.pjcategoria            
				WHERE ptos.idclub=$iclub 
				  and ptos.anioEquipo=$ianioe 
				  and ptos.pjcategoria = $icategoriaPartido";
     //echo("<br>$consulta<br>");
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($iclub,$ianioe,$icategoriaPartido));
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $row = $comando->fetchAll(PDO::FETCH_ASSOC);
			//echo json_encode($row);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }	
    

    public static function getRemeraCategoria($idjugador,$ianio,$iclub,$categoria)
    {
 	// armar join a tablas descriptoras
//idjugador	idpuestoJug	FechaPuestoAlta	FechaPuestoMod	remeraNum	puesjugcategoria	puestoxcat 	
	$consulta = "SELECT a.idpuestoJug,a.FechaPuestoAlta,a.remeraNum,b.descripcion as descCat,c.nombre as Posnombre,d.nombre as nombreJug,
				  a.pjcategoria,a.puestoxcat
				 FROM vapppuestojugador a,vappcategoria b,vappposicion c,vappequipo d  					
				      WHERE a.idjugador=$idjugador
				    	and a.pjcategoria = $categoria
				    	and a.idclub=$iclub and a.anioEquipo=$ianio	
				    	and b.idcategoria = a.pjcategoria									
				    	and c.idPosicion = a.puestoxcat
				    	and d.idjugador  = a.idjugador
				    	  " ;
//			echo "$consulta <br>";	    	
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

public static function existePuesto($idjugador,$ianio,$iclubescab,$indice)
{
 	// armar join a tablas descriptoras
//idjugador	idpuestoJug	FechaPuestoAlta	FechaPuestoMod	remeraNum	puesjugcategoria	puestoxcat 	
	$consulta = "SELECT 1 FROM vapppuestojugador where idjugador=$idjugador and idpuestoJug=$indice and anioEquipo=$ianio and idclub=$iclubescab" ;
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
              return  $comando->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }

	
}
	
	
	
//contar registros	
   public static function contar($idjugador)
    {
    		
        $consulta = "SELECT count(*) FROM vapppuestojugador where idjugador=$idjugador";
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


    public static function insert($idjugador,$indice,$fecha,$remeraNum,$icate,$puestoCate,$ianio,$iclubescab)
    {							 
    	//idjugador	idpuestoJug	FechaPuestoAlta	FechaPuestoMod	remeraNum	pjcategoria,puestoxcat
    	
    	//idjugador es autonumerico..
    	$comando = "INSERT INTO vapppuestojugador (idjugador,idpuestoJug,anioEquipo,idclub,FechaPuestoAlta,FechaPuestoMod,remeraNum,pjcategoria,puestoxcat) ".
		" VALUES ( $idjugador,$indice,$ianio,$iclubescab,$fecha,$fecha,$remeraNum,$icate,$puestoCate ) " ;    	
		//echo "----> $comando <br>";
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($idjugador,$indice,$fecha,$remeraNum,$icate,$puestoCate,$ianio,$iclubescab) );
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idsede identificador de la sede
     * @return bool Respuesta de la eliminación
     */
    public static function delete($idjugador,$idpuestoJug)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vapppuestojugador WHERE 
        				idjugador=$idjugador and idpuestoJug = $idpuestoJug";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($idjugador,$idpuestoJug));
    }
    
    public static function deletePuestoCat($idjugador,$idpuestoJug,$idclub,$ianio)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vapppuestojugador WHERE 
        				idjugador=$idjugador and idpuestoJug = $idpuestoJug
        				and idclub=$idclub and anioEquipo=$ianio";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($idjugador,$idpuestoJug,$idclub,$ianio));
    }    

    public static function update($idjugador,$idpuestoJug,$remeraNum,$icate,$puestoCate,$ianio,$iclubescab,$actualizaClub)
    {
        // Sentencia UPDATE
        $comando = "UPDATE vapppuestojugador 
        					SET remeraNum=$remeraNum ,pjcategoria=$icate,puestoxcat =$puestoCate, FechaPuestoMod=$actualizaClub
        					WHERE idjugador=$idjugador and idpuestoJug = $idpuestoJug
        					      AND anioEquipo=$ianio AND idclub=$iclubescab";

        //echo("<br> $comando");
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);
        return $sentencia->execute(array($idjugador,$idpuestoJug,$remeraNum,$icate,$puestoCate,$ianio,$iclubescab,$actualizaClub));
    }


    
}

?>