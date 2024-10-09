<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
include('../sesioner.php'); 

require ('Numeros.php');
//echo($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	    $resultade = Numeros::getAll('');
	    if($resultade)
	    {
	        $datos["estado"] = 1;
	        $datos["Numeros"] = $resultade;//es un array
	        print json_encode($datos);
	    }
	    else 
	    {
	    		print json_encode(array("id" => 2,"nombre" => "Sin codigo de acceso aun"));
	    }
	    
	}
?>
