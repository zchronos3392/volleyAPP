<?php

/**
 * Representa el la estructura de las categorias
 * almacenadas en la base de datos
 */
require_once 'database.php';

class Categoria
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
    public static function getAll($activas)
    {
    	$filtro="";
    	if($activas == 1) $filtro= " where categoriaActiva=1";	
        $consulta = "SELECT * FROM vappcategoria $filtro  order by idcategoria desc";
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
    // OBTIENE UNA LISTA DE LAS ULTIMAS CATEGORIAS CARGADAS CERCANAS AL AÑO QUE LLEGA POR 
    // PARAMETRO Y PARA EL CLUB DADO
    public static function getLastCategoriasConJugadores($ianio,$idclub)
    {

    /*no es necesario porqe el a�o cargado significa qur tienen jugadores : and a.idclub = $iclub*/
          $consulta = "SELECT *
                        FROM (
                            SELECT  
                                a.anioEquipo AS anio,
                                a.idclub,
                                ROW_NUMBER() OVER (PARTITION BY a.idclub ORDER BY a.anioEquipo DESC) AS RowNum
                            FROM 
                                vappequipo a,
                                vappcategoria b,
                                vappclub c
                            WHERE  
                                a.categoria = b.idcategoria
                                AND c.idclub = a.idclub
                                AND c.idclub = $idclub
                                AND a.anioEquipo < $ianio  -- Aseguramos que el año del equipo sea menor o igual al año actual
                                AND EXISTS (
                                    SELECT 1 
                                    FROM vappequipo 
                                    WHERE anioEquipo < a.anioEquipo 
                                    AND anioEquipo >= (
                                                        SELECT MIN(anioEquipo) 
                                                        FROM vappequipo 
                                                        WHERE anioEquipo < $ianio))
                            GROUP BY  
                                b.idcategoria, a.anioEquipo, a.idclub, c.nombre, b.descripcion, b.EdadInicio, b.EdadFin
                            HAVING 
                                COUNT(a.idjugador) > 0
                        ) AS RankedResults
                        WHERE RowNum = 1;";
            
            //echo "$consulta";
            try {
                // Preparar sentencia
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                // Ejecutar sentencia preparada
                $comando->execute();
                // no se estaba devolviendl el resultado en formato JSON
                // con esta linea se logro...
                // usar en vez de return echo, aunque no se si funcionara con ANDROID
                return $comando->fetch(PDO::FETCH_ASSOC);
    
            } catch (PDOException $e) {
                return ($e->getMessage());
            }
    }
        // OBTIENE UNA LISTA DE LAS ULTIMAS CATEGORIAS CARGADAS CERCANAS AL AÑO QUE LLEGA POR 
    // PARAMETRO Y PARA EL CLUB DADO

    public static function getAllConJugadores($ianio,$iclub){

	$filtro = "";
	if($iclub != 0)
		$filtro = " and a.idclub = $iclub ";
/*no es necesario porqe el a�o cargado significa qur tienen jugadores : and a.idclub = $iclub*/
        $consulta = "select  a.anioEquipo as anio ,b.idcategoria as CategoriaId , c.nombre,  b.descripcion,b.EdadInicio,b.EdadFin, count(a.idjugador) as 'ConJugadores' 
						from vappequipo a , vappcategoria b, vappclub c
							where  a.categoria = b.idcategoria
							    and c.idclub = a.idclub
								and a.anioEquipo = $ianio $filtro
							      GROUP BY  b.idcategoria, a.anioEquipo , a.idclub
                    				HAVING count(a.idjugador) > 0	
                    				order by b.idcategoria desc";
        
        //echo "$consulta";
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
    		
        $consulta = "SELECT count(*) FROM vappcategoria";
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

 public static function getcate($idcate)
    {
    		
        $consulta = "SELECT setMax FROM vappcategoria where idcategoria = ?";
        try {
            // Preparar sentencia
            $comando = Database::getInstance()->getDb()->prepare($consulta);
            // Ejecutar sentencia preparada
            $comando->execute();

            return $comando->fetch(PDO::FETCH_ASSOC);
            echo json_encode($row);

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
    public static function getById($idcategoria)
    {
        // Consulta de la categoria
        $consulta = "SELECT descripcion,
                            EdadInicio,
                            EdadFin,setMax,categoriaActiva
                             FROM vappcategoria
                             WHERE idcategoria = $idcategoria";

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
    public static function update( $categoria, $descripcion,$edadini,$edadfin,$setM,$activar)
    {
        // Creando consulta UPDATE
        $consulta = "UPDATE vappcategoria" .
            " SET descripcion=$descripcion , EdadInicio=$edadini , EdadFin=$edadfin, setMax=$setM, categoriaActiva=$activar WHERE idcategoria=$categoria";
		//echo "$consulta";
        // Preparar la sentencia
        $cmd = Database::getInstance()->getDb()->prepare($consulta);
        // Relacionar y ejecutar la sentencia
        $cmd->execute();

        return $cmd;
		//echo json_encode($cmd);

    }

    /**
     * Insertar un nuevo categoria
     *
     * @param $idcategoria      titulo del nuevo registro
     * @param $nombre descripci�n del nuevo registro
     * @return PDOStatement
     */
    public static function insert($descripcion,$edadini,$edadfin,$setM,$activar){
        // Sentencia INSERT
        $comando = "INSERT INTO vappcategoria ( descripcion, EdadInicio,EdadFin,setMax,categoriaActiva) VALUES( '$descripcion',$edadini,$edadfin,$setM,$activar)";

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
    public static function delete($idcategoria)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappcategoria WHERE idcategoria=$idcategoria";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();
    }
}

?>