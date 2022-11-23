<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax
require ('Partido.php');
require_once('Set.php'); 
require_once('Jugador.php');

//echo($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petici�n GET
    $registros = Partido::contar();
    // ESTA VOLVIENDO UN VECTOR DE VECTORES
    	//print_r ($registros["0"]["count(*)"]);
	
	$partidoid = 0;
	if(isset($_GET["id"])) $partidoid = (int) $_GET["id"];
	// 29-08-2018
	$fecpartido="''";// sera string 
	if(isset($_GET["fechapart"])) $fecpartido = "'".$_GET["fechapart"]."'";
	

		// 29-08-2018		
		$partidoRow = Partido::getById($partidoid,$fecpartido);
	    //print_r($partidoRow);
	    if($partidoRow)
	    {
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["Partido"] = $partidoRow;//es un array
/*
	        $datos["ClubA"]  = $setData["ClubA"];
	        $datos["ClubB"]  = $setData["ClubB"]; 
	        $datos["estado"] = $setData["estado"];
	        $datos["puntoa"] = $setData["puntoa"];
	        $datos["puntob"] = $setData["puntob"];
	        $datos["saque"]  = $setData["saque"];
	        $datos["estadoSet"]  = $setData["descripcion"];
	        $datos["mensajeSet"]  = $setData["mensaje"];
	        $datos["transcurrido"]  = $cosaHorrorosaoQUE["transcurrido"];
	        $datos["tiempoPedidoA"]  = $setData["CantPausaA"];
	        $datos["tiempoPedidoB"]  = $setData["CantPausaB"];
*/	        
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	    else 
	    {
	    		print json_encode(array("id" => 4,"nombre" => "Error leyendo partido"));
	    }
		    		
	}

?>
