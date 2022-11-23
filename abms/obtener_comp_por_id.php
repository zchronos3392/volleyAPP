<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
require ('Competencia.php');

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petici�n GET
    $idcomp = (int) $_GET['idcomp'];
    $competencia = Competencia::getById($idcomp);
	    if ($competencia) {
	        print json_encode($competencia);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	    else {
	    		print json_encode(array("id" => 2,"nombre" => "Sin competencias aun"));
	    }
}

?>
