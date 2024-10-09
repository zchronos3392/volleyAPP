<?php

/**
 * Representa el la estructura de las clubs
 * almacenadas en la base de datos
 */
require_once('database.php');

class Club
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
    public static function getAll()
    {
    		
        //$consulta = "SELECT * FROM vappclub order by clubabr";
        $consulta = "SELECT club.idclub,idciudad,club.nombre,clubabr,escudo,
                    count(vs.idsede) as 'SedesRegistradas' , count(vc.idcancha) as 'CanchasRegistradas'
                    FROM vappclub club
                        left JOIN  vappsede vs
                            ON club.idclub = vs.idclub
                        left JOIN  vappcancha vc
                            ON club.idclub = vc.idclub AND vc.idsede = vs.idsede
                    GROUP BY  club.idclub
                    order by clubabr";        
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
    
    /* GET ALL CON FILTRO */
    public static function getAllconFiltro($filtro)
    {
        $filtroQuery = '';
        if($filtro != '') $filtroQuery = ' where vappclub.nombre like "%'.$filtro.'%" ';    
        
        $consulta = "SELECT vappclub.idclub, vappclub.idciudad,vappclub.nombre,vappclub.clubabr,
        			vappclub.escudo,city.Nombre as 'ciudadnombre' FROM vappclub 
					left join vappciudad city
			      	on city.idCiudad = vappclub.idciudad
						$filtroQuery order by clubabr";
        //echo $consulta;
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
    /* GET ALL CON FILTRO */

    public static function getclubessinescudo()
    {
    		
        $consulta = "SELECT * FROM vappclub where escudo='' order by clubabr";
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
	
    public static function getAllConJugadoresComp($ianio,$icompetencia){
    		
        // $consulta = "(SELECT equipo.anioEquipo,club.idclub,club.idciudad,club.nombre,club.clubabr 
        //                     FROM vappclub club
        //                     INNER JOIN vappequipo equipo
        //                         on 	club.idclub =  equipo.idclub 
        //                     INNER JOIN vapppartido partidos
        //                         on 	(partidos.ClubA = equipo.idclub or
        //                             partidos.ClubB = equipo.idclub) 
        //                             and partidos.competencia = $icompetencia
        //                     WHERE equipo.anioEquipo = $ianio
        //                     GROUP by club.idclub,club.nombre,club.clubabr
        //                 )
        //                 UNION
        //                 (SELECT equipo.anioEquipo,club.idclub,club.idciudad,club.nombre,club.clubabr 
        //                         FROM vappclub club
        //                         INNER JOIN vappequipo equipo
        //                             on 	club.idclub =  equipo.idclub 
        //                         INNER JOIN vapppartido partidos
        //                             on 	(partidos.ClubA = equipo.idclub or
        //                                 partidos.ClubB = equipo.idclub) 
        //                                 and partidos.competencia = $icompetencia
        //                         WHERE equipo.anioEquipo < ($ianio-1)
        //                         AND NOT equipo.idclub IN
        //                          (SELECT club.idclub FROM vappclub club
        //                                 INNER JOIN vappequipo equipo
        //                                     on 	club.idclub =  equipo.idclub 
        //                                 INNER JOIN vapppartido partidos
        //                                     on 	(partidos.ClubA = equipo.idclub or
        //                                         partidos.ClubB = equipo.idclub) 
        //                                         and partidos.competencia = $icompetencia
        //                                 WHERE equipo.anioEquipo = $ianio
        //                                 GROUP by club.idclub,club.nombre,club.clubabr)
        //                 GROUP by club.idclub,club.nombre,club.clubabr);";
        $consulta = "SELECT equipo.anioEquipo,club.idclub,club.idciudad,club.nombre,club.clubabr 
                        FROM vappclub club
                        INNER JOIN vappequipo equipo
                                on 	club.idclub =  equipo.idclub 
                        INNER JOIN vappanioequipo equipanio
                                on equipanio.icompetencia = $icompetencia
                                    AND equipanio.ianio = $ianio
                                AND equipanio.idclub = equipo.idclub 
                        WHERE equipo.anioEquipo = $ianio or (equipo.anioEquipo = ($ianio-1))
                        GROUP by club.idclub,club.nombre,club.clubabr;";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
			// $comando->execute(array($ianio));			
            $comando->execute();			
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }



    }
    public static function getAllConJugadores($ianio)
    {
    		
        $consulta = "SELECT club.idclub,club.idciudad,club.nombre,club.clubabr FROM vappclub club
						INNER JOIN vappequipo equipo
							on 	club.idclub =  equipo.idclub 
									where equipo.anioEquipo = $ianio
						GROUP by club.idclub,club.nombre,club.clubabr ";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
			// $comando->execute(array($ianio));			
            $comando->execute();			
			// no se estaba devolviendl el resultado en formato JSON
			// con esta linea se logro...
			// usar en vez de return echo, aunque no se si funcionara con ANDROID
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }	

    public static function getAllConJugadoresFiltro($ianio,$filtro)
    {
        $filtroQuery = '';
        if($filtro != '') $filtroQuery = ' and nombre like "%'.$filtro.'%" ';    
    		
        $consulta = "SELECT club.idclub,club.nombre,club.clubabr FROM vappclub club
						INNER JOIN vappequipo equipo
							on 	club.idclub =  equipo.idclub 
									where equipo.anioEquipo = $ianio $filtroQuery 
						GROUP by club.idclub,club.nombre,club.clubabr ";

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
	
   public static function contar()
    {
    		
        $consulta = "SELECT count(*) FROM vappclub";
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
     * Obtiene los campos de una club con un identificador
     * determinado
     *
     * @param $idclub Identificador de la club
     * @return mixed
     */
    public static function getById($idClub)
    {
        // Consulta de la club
        $consulta = "SELECT idclub,
        					idciudad,
                            nombre,
                            clubabr,
                            escudo
                             FROM vappclub
                             WHERE idclub = $idClub";

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

    /**
     * Obtiene los campos de una club con un identificador
     * determinado
     *
     * @param $idclub Identificador de la club
     * @return mixed
     */
    public static function getByIdStatsClub($idClub)
    {
        // Consulta de la club
        $consulta = "SELECT idclub,
        					idciudad,
                            nombre,
                            clubabr,
                            escudo
                             FROM vappclub
                             WHERE idclub = $idClub";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return (array($row));
            //echo json_encode($row);

        } catch (PDOException $e) {
            // Aqu� puedes clasificar el error dependiendo de la excepci�n
            // para presentarlo en la respuesta Json
            return -1;
        }
    }
    

    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $idclub      identificador
     * @param $nombre      nuevo titulo
     * 
     */
    public static function ActualizaClub($icluba,$iciudad,$nombre,$clubabr,$escudo)
    {
        // Creando consulta UPDATE
			$consulta = "UPDATE vappclub SET nombre='$nombre' , clubabr='$clubabr',escudo='$escudo' ,
						idciudad=$iciudad 
			WHERE idclub=$icluba";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute();

        return json_encode($cmd);
		

    }

    /**
     * Insertar un nuevo club
     *
     * @param $idclub      titulo del nuevo registro
     * @param $nombre descripci�n del nuevo registro
     * @return PDOStatement
     */
    public static function insert($nombre,$clubabr,$escudo,$iciudad){
        // Sentencia INSERT
        $comando = "INSERT INTO vappclub ( nombre, clubabr,escudo,idciudad) VALUES( '$nombre','$clubabr','$escudo',$iciudad)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idclub identificador de la club
     * @return bool Respuesta de la eliminaci�n
     */
    public static function delete($idclub)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappclub WHERE idclub=$idclub";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();
    }
}

?>
