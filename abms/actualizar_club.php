<?php
/**
 * Actualiza una Club especificada por su identificador
 */

require 'Club.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
    $body = json_decode(file_get_contents("php://input"), true);

    // Actualizar meta
    $retorno = Club::update(
        $body['idClub'],
        $body['nombre']);

    if ($retorno) {
        // C�digo de �xito
        print json_encode(
            array(
                'estado' => '1',
                'mensaje' => 'Actualizaci�n exitosa')
        );
    } else {
        // C�digo de falla
        print json_encode(
            array(
                'estado' => '2',
                'mensaje' => 'Actualizaci�n fallida')
        );
    }
}
?>