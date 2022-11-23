<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
require ('Sede.php');
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petici�n GET
    $registros = sede::contar();
    // ESTA VOLVIENDO UN VECTOR DE VECTORES
    	//print_r ($registros["0"]["count(*)"]);
    if($registros["0"]["count(*)"] > "0")
     {
		$sedes = sede::getAll();
	    //print_r($clubes); // viene un vector
	    if ($sedes) {
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["Sedes"] = $sedes;//es un array
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	    else {
	    		print json_encode(array("id" => 2,"nombre" => "Sin sedes aun"));
	    }
	}
	else
			print json_encode(array("id" => 3,"nombre" => "Tabla vacia, conteo 0"));
}
else
{
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		//CARGO POR ID Y DEVUELVO VARIOS RESULTADOS SEGUN ID DE CLUB..
		$club = (int) $_POST['idclub'];//llega texto, convertir o usar ''
		$sedes = sede::getSedexClub($club);
		//$sedes = Array ( "idclub" => "1", "direccion" => "LLEGA POR POST");
 
		if($sedes) {
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["SedesXClub"] = $sedes;//es un array
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	
	}
}

?>
