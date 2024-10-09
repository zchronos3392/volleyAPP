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
require_once('Categoria.php');

//echo($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar peticion GET
   	$partido =	$_GET["idpartido"];
	$fecha	 =	"'".$_GET["fechapartido"]."'";
	$iclub	 =	$_GET["iclubescab"];
	$icate 	 =	$_GET["icatcab"];
	$ianio 	 =	$_GET["ianio"];
	$categoriaPartido = $_GET["categoriaPartido"];
	//echo "partjugCab::getJugListaInicial($partido,$fecha,$iclub,$icate,$ianio)";
    	$jugadores = partjugCab::getJugListaInicial($partido,$fecha,$iclub,$icate,$ianio,$categoriaPartido);
		//print_r($jugadores);
		for($indice = 0; $indice < count($jugadores);$indice++)
		{
			// REPARAR JUGADORES DADOS DE BAJA SELECCIONADOS..
				// [3] => Array ( [numero] => 17 [nombre] => Franco [categoria] => 19 
				// 			   [idjugador] => 220 [FechaEgreso] => [idclub] => 83 [jugador] => 220 [posicion] => 7 [puestoxcat] => 6 )
				// [4] => Array ( [numero] => 12 [nombre] => Tomi [categoria] => 19 
				// 			  [idjugador] => 221 [FechaEgreso] => 2024-01-01 [idclub] => 83 [jugador] => 221 [posicion] => 7 [puestoxcat] => )
			$idjugador = $jugadores[$indice]['idjugador'];	
			$FechaEgreso = $jugadores[$indice]['FechaEgreso'];	
				if($FechaEgreso != ''){
					$nombre = $jugadores[$indice]['nombre'];
						//echo "elimino de la cabecera a $nombre";
					$retorno = partjugCab::delete($partido,$fecha,$iclub,$icate,$idjugador);
				}	
		}
		// VUELVO A TRAER LA LISTA SIN LOS DADOS DE BAJA POR ERRORES
		$jugadores = partjugCab::getJugListaInicial($partido,$fecha,$iclub,$icate,$ianio,$categoriaPartido);
				//print_r($jugadores);
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
        }
	else
	{
		$datos["estado"] = 10;
		$categoriaLLego = Categoria::getById($icate);
		$nombreCategoriaPartido = '';
		if($categoriaLLego)
		  	$nombreCategoriaPartido = $categoriaLLego['descripcion'];
		$datos["Jugadores"] = "A&uacute;n no hay jugadores cargados para $ianio y categoria: ($icate) $nombreCategoriaPartido";//es un array
		echo json_encode($datos);

	}	
}        
?>