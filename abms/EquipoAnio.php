<?php

/**
 * Representa el la estructura de las clubs
 * almacenadas en la base de datos
 */
require_once('database.php');

class EquipoAnio
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
    /* GET ALL CON FILTRO */
    public static function getAll($ianio,$idclub,$icompetencia)
    {
        $filtroQuery   = '';
        $filtroFecha   = '';
        $conteoFiltros = 0;
        if($ianio != 0){ 
                $filtroQuery = " where vappanioequipo.ianio= $ianio ";
                $filtroFecha   = "  where fecha >= '$ianio-01-01'    ";
                $conteoFiltros++;
        }

        // if($idclub != 0)
        // {
        //     if($conteoFiltros == 0)
        //      $filtroQuery = "  where  idclub = $idclub ";
        //     else 
        //      $filtroQuery .= " and  idclub = $idclub ";
        //      $conteoFiltros++;
        // }
        if($icompetencia != 9999)
        {
            if($conteoFiltros == 0)
                $filtroFecha = "  where  competencia = $icompetencia ";
            else
                $filtroFecha .= "  and  competencia = $icompetencia ";
            $conteoFiltros++;

        }

        switch($icompetencia)
        {
            case 9999: //no viene competencia
                    $consulta = "SELECT idequipoanio, vappanioequipo.idclub,vappclub.nombre,vappclub.clubabr, vappanioequipo.ianio, vappclub.escudo FROM vappanioequipo
                                    inner join vappclub
                                        on vappclub.idclub = vappanioequipo.idclub
                                        $filtroQuery;";
                    break;
            default : //vino cargada una competencia
                    $consulta = "SELECT  vappanioequipo.idequipoanio, iclub as 'idclub', clubLocal.nombre,clubLocal.clubabr,vappanioequipo.ianio,clubLocal.escudo
                    FROM (
                        SELECT DISTINCT  cluba as 'iclub'
                        FROM `vapppartido` epartido
                            $filtroFecha
                        ) AS subconsulta1
                    JOIN vappclub clubLocal ON clubLocal.idclub = iclub
                    JOIN  vappanioequipo ON clubLocal.idclub =  vappanioequipo.idclub 
                        $filtroQuery
                    UNION
                    SELECT vappanioequipo.idequipoanio, iclub as 'idclub',clubVisita.nombre,clubVisita.clubabr,vappanioequipo.ianio,clubVisita.escudo
                    FROM (
                        SELECT DISTINCT  ClubB as 'iclub'
                        FROM `vapppartido` epartido
                            $filtroFecha    
                    ) AS subconsulta2
                    JOIN vappclub clubVisita ON clubVisita.idclub = iclub
                    JOIN  vappanioequipo ON clubVisita.idclub =  vappanioequipo.idclub 
                        $filtroQuery
                    ORDER BY iDclub;";        

                     break;  
               
         }           
    //    echo "<br> $consulta <br>";
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

    /**
     * Insertar un nuevo club / ianio
     *
     * @param $idclub      equipo cargado para el año
     * @param $ianio        anio de juego
     * @return PDOStatement
     */
    public static function insert( $idclub, $ianio){
        // Sentencia INSERT
        //SELECT idequipoanio, idclub, ianio FROM vappanioequipo
        $comando = "INSERT INTO vappanioequipo ( idclub, ianio) VALUES( $idclub, $ianio)";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(
            array( $idclub, $ianio));

    }

    /**
     * Eliminar el registro con el identificador especificado
     *
     * @param $idclub identificador de la club
     * @return bool Respuesta de la eliminaci�n
     */
    public static function delete($idequipoanio)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappanioequipo WHERE idequipoanio=$idequipoanio";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute(array($idequipoanio));
    }
}

?>
