<?php


/**
 * Obtiene todas las Clubs de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax
require ('Partido.php');


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

	
	
	if($partidoid != 0)
	{
		// 29-08-2018	
		// este es el que usa el TABLERO !	
		$partidoRow = Partido::getById($partidoid,$fecpartido);

	}			
	
	//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
    $datos["estado"] = 1;
    $datos["Partido"] = $partidoRow;//es un array
// datos de las posiciones
    print json_encode($datos);
    //el print lo puedo usar para cuando lo llamo desde android
		    		
}


?>
