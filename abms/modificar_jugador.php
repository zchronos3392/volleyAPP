<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require 'Jugador.php';
require 'JugadorPuestos.php';
require_once 'JugadorPartidoCab.php';



if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Decodificando formato Json
	// Decodificando <	
	$idjugador  = $_GET["unJugador"];
	$iclubescab = $_GET["iclubescab"]; //iclubescab: 1
	$icatcab = $_GET["icatcab"]; //icatcab: 2
	$ianio = 0;
		$ianio   = $_GET["unanio"];
	$nombre = $_GET["nombre"];

//CLAVE DE LA TABLA: 		
//	ianio = 2021
//	idjugador = 97
//	iclubescab = 83
    //	nombreJugador = Leo //   	nombre='$nombre',
    //	icatcab = 15    //	categoria=$categoria ".
    //	edadJugador = 1000 //    edad=$edad,
    //  numero=$numero, lo traigo igual aunque no cambie mas...
	$retorno = jugador::updateSimple($nombre,$ianio,$iclubescab,$idjugador );

	if($retorno)
	    {
	        $datos["estado"] = 1;
	        $datos["Mensaje"] = "Nombre modificado";//es un array
	            echo json_encode($datos);
        }
	else
	{
        $datos["estado"] = 0;
        $datos["Mensaje"] = "Nombre *NO* modificado";
            echo json_encode($datos);

	}	
    

}

?>
