<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax

require_once('Jugador.php');

//echo($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar peticion GET
   	$partido =	$_GET["idpartido"];
	$fecha	 =	"'".$_GET["fechapartido"]."'";
	$iclub	 =	$_GET["iclubescab"];
	$icate 	 =	$_GET["icatcab"];
	$ianio 	 =	$_GET["ianio"];
	$ianio 	 =	$_GET["ianio"];
	//$setnumero = $_GET["isetnro"];
//	if($setnumero==1)    
	// hay que cambiarlo para que lo traiga desde la cabecera...
    	$jugadores = jugador::getJugadorPartidoInsert($partido,$fecha,$iclub,$icate,$ianio); 
//	else
//  		$jugadores = jugador::getJugadorPartidoInsert2($partido,$fecha,$iclub,$icate,$ianio,$setnumero); 
	
	//$jugadores = jugador::getJugadorPartido($partido,$fecha,$iclub,$icate,$ianio); 
	if ($jugadores)
	    {
    	
	        $datos["estado"] = 1;
	        $datos["Jugadores"] = $jugadores;//es un array
	        echo json_encode($datos);
        };
}        
?>