<?php
/**
 * Obtiene todas las Sedes de la base de datos
 */
require ('Sede.php');
if($_SERVER['REQUEST_METHOD'] == 'POST') {
		//CARGO POR ID Y DEVUELVO VARIOS RESULTADOS SEGUN ID DE CLUB..
		$club = (int) $_POST['idclub'];//llega texto, convertir o usar ''
		$sedes = sede::getSedexClub($club);
		//$sedes = Array ( "idclub" => "1", "direccion" => "LLEGA POR POST");
 
		if($sedes) 
		{
	        $datos["estado"] = 1;
	        $datos["SedesXClub"] = $sedes;//es un array
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	    else {//siono encuentro nadam entonces debo devolver algo json
	        $datos["estado"] = 2;
	        $datos["SedesXClub"] = Array("idsede" => "0000", "direccion" => "NO EXISTEN SEDES");//es un array
	        print json_encode($datos);
				
		}
}
?>
