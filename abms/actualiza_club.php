<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
require ('Club.php');
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$icluba     = (int) $_POST['idClub'];
	$iciudad    = (int) $_POST['ciudad'];
	$nombre     = $_POST['nombre'];
	$clubabr    = $_POST['clubabr'];
    $escudo = "";
    if(isset($_POST['escudo'])) $escudo = $_POST['escudo'];	
	
	$retorno = Club::ActualizaClub($icluba,$iciudad,$nombre,$clubabr,$escudo);
	    if ($retorno)
		{
	        $datos["estado"] = 1;
	        $datos["resultado"] = $retorno;//es un array
	        print json_encode($datos);
	    }
	    else 
		{
	    		print json_encode(array("id" => 2,"resultado" => "error al actualizar club"));
	    }
}

?>
