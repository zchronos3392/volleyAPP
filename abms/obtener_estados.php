<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
require ('Estado.php');
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petici�n GET
    $registros = Estado::contar();
    // ESTA VOLVIENDO UN VECTOR DE VECTORES
    	//print_r ($registros["0"]["count(*)"]);
    if($registros["0"]["count(*)"] > "0")
     {
		$estados = Estado::getAll();
	    
	    if ($estados) {
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["Estados"] = $estados;//es un array
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	    else {
	    		print json_encode(array("id" => 2,"nombre" => "Sin estados aun"));
	    }
	}
	else
			print json_encode(array("id" => 3,"nombre" => "Tabla vacia, conteo 0"));
}

?>
