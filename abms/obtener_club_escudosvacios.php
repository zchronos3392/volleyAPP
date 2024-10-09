<?php
/**
 * Obtiene el detalle de una Club especificada por
 * su identificador "idClub"
 */

require 'Club.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        // Tratar retorno
        $retorno = Club::getclubessinescudo();
		//print_r($retorno);
            $club["estado"] = "1";
            $club["clubes"] = $retorno;
            // Enviar objeto json de la Club
            echo json_encode($club);

}
?>