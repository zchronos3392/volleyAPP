<?php

/**
 * Representa el la estructura de las categorias
 * almacenadas en la base de datos
 */
require_once 'database.php';

class Competencia
{
    function __construct()
    {
    }

    /**
     * Retorna en la fila especificada de la tabla 'vappCategoria'
     *
     * @param $idCategoria Identificador del registro
     * @return array Datos del registro
     */
    public static function getAll()
    {
    		
        $consulta = "SELECT * FROM vappcomp order by idcomp DESC";
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
    	$filtroX = '"%'.$filtro.'%"';	
        $consulta = "SELECT * FROM vappcomp where cnombre like $filtroX order by idcomp DESC";
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
    		
        $consulta = "SELECT count(*) FROM vappcomp";
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

     public static function getsetcomp($idcomp)
    {
    		
      $consulta = "SELECT setnmax
                             FROM vappcomp
                             WHERE idcomp = $idcomp";
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
     * Obtiene los campos de una categoria con un identificador
     * determinado
     *
     * @param $idcategoria Identificador de la categoria
     * @return mixed
     */
    public static function getById($idcomp)
    {
        // Consulta de la categoria
        $consulta = "SELECT cnombre,setnmax,competenciaActiva,Logo
                             FROM vappcomp
                             WHERE idcomp = $idcomp";

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
            // Aqu� puedes clasificar el error dependiendo de la excepci�n
            // para presentarlo en la respuesta Json
            return -1;
        }
    }

    /**
     * Actualiza un registro de la bases de datos basado
     * en los nuevos valores relacionados con un identificador
     *
     * @param $idcategoria      identificador
     * @param $nombre      nuevo titulo
     * 
     */
    public static function ActualizaCompetencia($idcompetencia,$compnombre,$setsmaxnum,$competenciaActivar,$archivoLogo,$fechaIniciaComp,$fechaFinComp)
    {
        
        //ActualizaCompetencia('36', 'SFSF21 2024', '3', 1, '''')        
        // Creando consulta UPDATE
        $ActualizarLogo = "";
        if($archivoLogo != "''")
            $ActualizarLogo = ",Logo=$archivoLogo ";

        $consulta = "UPDATE vappcomp SET cnombre='$compnombre',setnmax=$setsmaxnum ,
        					competenciaActiva=$competenciaActivar $ActualizarLogo ,
                            FechaInicioComp = '$fechaIniciaComp',FechaFinComp = '$fechaFinComp'
                            WHERE idcomp=$idcompetencia";



        //echo $consulta;
        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);

        // Relacionar y ejecutar la sentencia
        $cmd->execute();

        return json_encode($cmd);

    }

    /**
     * Insertar un nuevo categoria
     *
     * @param $idcategoria      titulo del nuevo registro
     * @param $nombre descripci�n del nuevo registro
     * @return PDOStatement
     */
    public static function insert($nombre,$setnmax,$competenciaActivar,$archivoLogo,$fechaIniciaComp,$fechaFinComp){
        // Sentencia INSERT
        $comando = "INSERT INTO vappcomp ( cnombre, setnmax,competenciaActiva,Logo,FechaInicioComp,FechaFinComp) 
        				VALUES( $nombre,$setnmax,$competenciaActivar,$archivoLogo,'$fechaIniciaComp','$fechaFinComp' )";
        //echo "$comando";                                    
        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idcategoria identificador de la categoria
     * @return bool Respuesta de la eliminaci�n
     */
    public static function delete($idcomp)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappcomp WHERE idcomp=$idcomp";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();
    }
}

?>