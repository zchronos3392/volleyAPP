<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
include('../sesioner.php'); 
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax

require ('Numeros.php');
//echo($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$tabla = "'".$_GET['TEXTOCLAVE']."'";
//		print($tabla);
	    $resultade = Numeros::getById($tabla);
	    print_r($resultade); // viene un vector
	    if($resultade)
	    {
			 $_SESSION['INGRESO'] = 'SI' ; 
	        //$datos["estado"] = 1;
	        //$datos["ultnumero"] = $resultade;//es un array
	        print json_encode($resultade);
	    }
	    else 
	    {
	    		//print json_encode(array("id" => 2,"nombre" => "Sin codigo de acceso aun"));
	    }
	    
	}
?>
