<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax

require_once('JugadorPartidoCab.php');
require_once('JugadorPuestos.php');

//echo($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar peticion GET
   	$partido =	$_GET["idpartido"];
	$fecha	 =	"'".$_GET["fechapartido"]."'";
	$iclub	 =	$_GET["iclubescab"];
	$icate 	 =	$_GET["icatcab"];
	$ianio 	 =	$_GET["ianio"];
	$categoriaPartido = $_GET["categoriaPartido"];
//	echo "partjugCab::getJugListaInicial($partido,$fecha,$iclub,$icate,$ianio)";
    	$jugadores = partjugCab::getJugListaInicial($partido,$fecha,$iclub,$icate,$ianio,$categoriaPartido);

		
		for($indice = 0; $indice < count($jugadores);$indice++)
		{
//			echo($jugadores[$indice]['idjugador']."<br>");
			$idjugador = $jugadores[$indice]['idjugador'];
			// agregamos la categoria extraña.
			$puestosj = puestojugador::getRemeraCategoria($idjugador,$ianio,$iclub,$categoriaPartido);
	    	
	    			//print_r($puestosj);

	
	    		if(isset($puestosj['0']))
		    	//	echo($puestosj['0']['nombreJug']."  - ".$puestosj['0']['remeraNum']."<br>");
		    		if(isset($jugadores[$indice]['jugador']))
		    				$jugadores[$indice]['remeraEnCatPartido'] = $puestosj['0']['remeraNum'];

			// agregamos la remera de su propioa categoria.
			$puestosj = puestojugador::getRemeraCategoria($idjugador,$ianio,$iclub,$icate);
	    		if(isset($puestosj['0']))
		    	//	echo($puestosj['0']['nombreJug']."  - ".$puestosj['0']['remeraNum']."<br>");
		    		//if(isset($jugadores[$indice]['jugador']))
		    				$jugadores[$indice]['numero'] = $puestosj['0']['remeraNum'];
		    				
	    };  
	
		//,ptosRemCat.remeraNum
	
	//$jugadores = jugador::getJugadorPartido($partido,$fecha,$iclub,$icate,$ianio); 
	if ($jugadores)
	    {
    	
	        $datos["estado"] = 1;
	        $datos["Jugadores"] = $jugadores;//es un array
	        echo json_encode($datos);
        };
}        
?>