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
                // $filtroFecha   = "  where fecha >= '$ianio-01-01'    ";
                $conteoFiltros++;
        }


        if($icompetencia != 9999)
        {
            if($conteoFiltros == 0)
                $filtroQuery = "  where  icompetencia = $icompetencia ";
            else
                $filtroQuery .= "  and  icompetencia = $icompetencia ";
            $conteoFiltros++;

        }

        $consulta = "SELECT idequipoanio, vappanioequipo.idclub,vappclub.nombre,vappclub.clubabr, vappanioequipo.ianio,
                            vappclub.escudo,vappanioequipo.icompetencia
                            FROM vappanioequipo
                                inner join vappclub
                                    on vappclub.idclub = vappanioequipo.idclub
                                    $filtroQuery;";

               
//          }           
//        echo "<br> $consulta <br>";
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
    public static function insert($icompetencia, $idclub, $ianio){
        // Sentencia INSERT
        //SELECT idequipoanio, idclub, ianio FROM vappanioequipo
        $comando = "INSERT INTO vappanioequipo ( icompetencia,idclub, ianio) VALUES( $icompetencia,$idclub, $ianio)";

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
    public static function delete($idequipoanio)
    {
        // Sentencia DELETE
        $comando = "DELETE FROM vappanioequipo WHERE idequipoanio=$idequipoanio";

        // Preparar la sentencia
        $sentencia = Database::getInstance()->getDb()->prepare($comando);

        return $sentencia->execute();
    }
}

?>
