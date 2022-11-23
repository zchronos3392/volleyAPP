<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
require ('Ciudad.php');
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$idcity   = (int) $_POST['idciudad'];
	$citynom  = $_POST['ciudadnom'];
	$cityprov = $_POST['provnom'];
	$retorno = Ciudad::ActualizaCiudad($idcity,$citynom,$cityprov);
	    if ($retorno)
		{
	        $datos["estado"] = 1;
	        $datos["resultado"] = $retorno;//es un array
	        print json_encode($datos);
	    }
	    else 
		{
	    		print json_encode(array("id" => 2,"resultado" => "error al actualizar ciudad"));
	    }
}

?>
