<?php
/**
 * Obtiene el detalle de una Club especificada por
 * su identificador "idClub"
 */

require 'Club.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['idClub'])) {

        // Obtener parámetro idClub
        $parametro = $_GET['idClub'];

        // Tratar retorno
        $retorno = Club::getById($parametro);


        if ($retorno) {

            $club["estado"] = "1";
            $club["club"] = $retorno;
            // Enviar objeto json de la Club
            return json_encode($club);
        } else {
            // Enviar respuesta de error general
            return json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }

    } else {
        // Enviar respuesta de error
        return json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador'
            )
        );
    }
}
?>