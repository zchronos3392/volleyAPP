<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax
require ('Ciudad.php');
//echo($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$ciudad =(int) $_GET['idcity'];
		$ciudades = Ciudad::getById($ciudad);
	    //print_r($clubes); // viene un vector
	    if($ciudades)
	    {
	        //$datos["estado"] = 1;
	        //$datos["Ciudades"] = $ciudades;//es un array
	        print json_encode($ciudades);
	    }
	    else 
	    {
	    		print json_encode(array("id" => 2,"nombre" => "Sin ciudades aun"));
	    }
	}
?>
