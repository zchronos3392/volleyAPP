<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
require ('Cancha.php');
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$idcancha = (int) $_POST['idcancha'];
	$idclub   = (int) $_POST['idclub'];
	$idsede   = (int) $_POST['idsede'];
		$nombre 		= $_POST['ncancha'];
		$direccion   	= $_POST['direccion'];
		$dimensiones   	= $_POST['dimensiones'];
	
	$retorno = Cancha::ActualizaCancha($idcancha,$idclub,$idsede,$nombre,$direccion,$dimensiones);
	    if ($retorno)
		{
	        $datos["estado"] = 1;
	        $datos["resultado"] = $retorno;//es un array
	        print json_encode($datos);
	    }
	    else 
		{
	    		print json_encode(array("id" => 2,"resultado" => "error en actualizacion de cancha"));
	    }
}

?>
