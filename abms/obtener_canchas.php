<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
require ('Cancha.php');
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petici�n GET
    $registros = Cancha::contar();
    // ESTA VOLVIENDO UN VECTOR DE VECTORES
    	//print_r ($registros["0"]["count(*)"]);
    if($registros["0"]["count(*)"] > "0")
     {
		$canchas = Cancha::getAll();
	    //print_r($clubes); // viene un vector
	    if ($canchas) {
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["Canchas"] = $canchas;//es un array
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	    else {
	    		print json_encode(array("id" => 2,"nombre" => "Sin categorias aun"));
	    }
	}
	else
			print json_encode(array("id" => 3,"nombre" => "Tabla vacia, conteo 0"));
}

?>
