<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax
require ('Jugador.php');


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

		$jugadores = jugador::getJugadorxNombreAll();

	    if ($jugadores)
	    {
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["JugadoresX"] = $jugadores;//es un array
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	    else  {	print json_encode(array("id" => 2,"nombre" => "Sin jugadores cargados"));  }

}

?>
