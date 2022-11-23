<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require_once('JugadorPuestos.php');


if ($_SERVER['REQUEST_METHOD'] == 'GET') 
{
    // Decodificando formato Json
	// Decodificando <	
	
	$anioEq =	$_GET["ianio"];
	$clubid	 =	$_GET["club"];
	$puestoid	 =	$_GET["puesto"];
	$jugadorid = $_GET["jugadorid"];
	

	$retorno=0;
   	$puestoEliminacion = puestojugador::deletePuestoCat($jugadorid,$puestoid,$clubid,$anioEq);
   	

	
	if($puestoEliminacion)
	{
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["mensaje"] = "Puesto eliminado Ok";
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	}
	else {print json_encode($puestoEliminacion);}
} // recorriendo jugadoress
// cierre del GET 

?>
