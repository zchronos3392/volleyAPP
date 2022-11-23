<?php

/**
 * Representa el la estructura de las clubs
 * almacenadas en la base de datos
 */
require_once 'database.php';

class Cancha
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
    		
        //$consulta = "SELECT * FROM vappcancha";
        
        $consulta  = "SELECT vappclub.clubabr, vappsede.extras 
        			,vappcancha. * FROM vappcancha inner join vappclub 
        			on vappclub.idclub = vappcancha.idclub inner join
        			vappsede on vappsede.idclub = vappcancha.idclub 
        	and vappsede.idsede = vappcancha.idsede 
        	  order by vappclub.clubabr ";
        
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
    
    

    public static function getAllFiltro($filtro)
    {
    		
        //$consulta = "SELECT * FROM vappcancha";
//        			   WHERE vappcancha.idclub = $filtro

        $consulta  = "SELECT vappclub.clubabr,vappclub.idciudad, vappsede.extras ,vappcancha.* 
        			  FROM vappcancha 
        			  inner join vappclub 
        				on vappclub.idclub = vappcancha.idclub 
        			  inner join vappsede 
        			    on vappsede.idclub = vappcancha.idclub 
        			   and vappsede.idsede = vappcancha.idsede 
        			   order by vappclub.clubabr ";
        
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
	// para updates
    public static function getBySede($idclub,$idsede)
    {
    		
        $consulta  = "SELECT `vappclub`.`clubabr`, `vappsede`.`extras` 
        			,`vappcancha`. * FROM `vappcancha` inner join `vappclub` 
        			on `vappclub`.`idclub` = `vappcancha`.`idclub` inner join
        			`vappsede` on `vappsede`.`idclub` = `vappcancha`.`idclub` 
        	and `vappsede`.`idsede` = `vappcancha`.`idsede` 
			where `vappcancha`.`idclub`=$idclub and `vappcancha`.`idsede`=$idsede
			order by vappclub.clubabr  ";
     //   echo($consulta);
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idclub,$idsede));
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    }
	// para updates	
	
   public static function contar()
    {
    		
        $consulta = "SELECT count(*) FROM vappcancha";
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
     * Obtiene los campos de una cancha con un identificador
     * determinado
     *
     * @param $idcancha Identificador de la cancha
     * @return mixed
     */
    public static function getById($idcancha,$idclub,$idsede)
    {
        // Consulta de la cancha
        $consulta = "SELECT nombre,
                            ubicacion,
                            dimensiones
                             FROM vappcancha
                             WHERE idclub = $idclub AND idsede=$idsede AND idcancha=$idcancha";

        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute(array($idcancha,$idclub,$idsede));
            // Capturar primera fila del resultado
            $row = $comando->fetch(PDO::FETCH_ASSOC);
            return $row;
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
    public static function ActualizaCancha($idcancha,$idclub,$idsede,$nombre,$direccion,$dimensiones)
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE vappcancha" .
            " SET nombre='$nombre' , ubicacion='$direccion',dimensiones='$dimensiones' WHERE idclub=$idclub AND idsede=$idsede AND idcancha=$idcancha";

        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute(array($idcancha,$idclub,$idsede,$nombre,$direccion,$dimensiones));

        return json_encode($cmd);

    }

   public static function ultID()
    {
	$consulta = "SELECT idcancha FROM vappcancha order by idcancha desc LIMIT 1";  

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
     * Insertar un nuevo club
     *
     * @param $idclub      titulo del nuevo registro
     * @param $nombre descripci�n del nuevo registro
     * @return PDOStatement
     */
    public static function insert($club,$sede,$canchaid,$nombre,$foto,$ubicacion,$dimensiones){
        // Sentencia INSERT
        $comando = "INSERT INTO vappcancha ( idclub, idsede,idcancha, nombre, foto,ubicacion,dimensiones) VALUES(?,?,?,?,?,?,?)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($club,$sede,$canchaid,$nombre,$foto,$ubicacion,$dimensiones));
    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idclub identificador de la club
     * @return bool Respuesta de la eliminaci�n
     */
    public static function delete($club,$sede,$cancha)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappcancha WHERE idclub=? and idsede=? and idcancha=?";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($club,$sede,$cancha));
    }
}

?>
