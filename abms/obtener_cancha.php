<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
require ('Cancha.php');
if($_SERVER['REQUEST_METHOD'] == 'GET') {
	$idcancha = (int) $_GET['idcancha'];
	$idclub   = (int) $_GET['idclub'];
	$idsede   = (int) $_GET['idsede'];
	$canchas = Cancha::getById($idcancha,$idclub,$idsede);
	    if ($canchas)
		{
	        $datos["estado"] = 1;
	        $datos["Canchas"] = $canchas;//es un array
	        print json_encode($datos);
	    }
	    else 
		{
	    		print json_encode(array("id" => 2,"nombre" => "Sin categorias aun"));
	    }
}

?>
