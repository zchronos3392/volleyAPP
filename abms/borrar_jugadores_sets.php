<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require 'JugadorPartido.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    // Decodificando formato Json
	// Decodificando <	
	$partido =	$_POST["idpartido"];
	$fecha	 =	"'".$_POST["fechapartido"]."'";
	$iclub	 =	$_POST["iclub"];
	$setnumero = $_POST["setdata"];	
	$retorno = partjug::deletePosiciones($partido,$fecha,$iclub,$setnumero);
	if($retorno)
	{
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["mensaje"] = "BAJA POS OK";
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	}
	else {print json_encode($retorno);}
} // recorriendo jugadoress
// GET
else // GET para probar
{

}// cierre del GET 

?>
