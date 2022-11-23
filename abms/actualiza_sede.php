<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
require ('Sede.php');
if($_SERVER['REQUEST_METHOD'] == 'POST') {

	 $idsede = (int) $_POST['idsede'];
	 $idclub = (int) $_POST['idclub'];
	 $nombresede =  $_POST['snom'];
	 $direccion =  $_POST['direccion'];
	
	$retorno = sede::ActualizaSede($idclub,$idsede,$nombresede,$direccion);
	    if ($retorno)
		{
	        $datos["estado"] = 1;
	        $datos["resultado"] = $retorno;//es un array
	        print json_encode($datos);
	    }
	    else 
		{
	    		print json_encode(array("id" => 2,"resultado" => "error al actualizar sede"));
	    }
}

?>
