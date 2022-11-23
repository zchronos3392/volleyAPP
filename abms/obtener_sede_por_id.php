<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
require ('Sede.php');
if($_SERVER['REQUEST_METHOD'] == 'GET') {
		$idsede =(int) $_GET['idsede'];
		$idclub = (int) $_GET['idclub'];
		$sede = sede::getById($idclub,$idsede);
	    if ($sede)
	    {
	        print json_encode($sede);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	    else
	    {
	    		print json_encode(array("id" => 2,"nombre" => "Sin sedes aun"));
	    }
}

?>
