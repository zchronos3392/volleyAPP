<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax
require_once('SesionTabla.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

		$clave = "'".$_GET['TEXTOCLAVE']."'";
		$leerFiltros = "";
		$leerFiltros = SesionTabla::getsessionX($clave) ;
			//print_r($leerFiltros);		
		$parametrosGuardados = array();
	
		if($leerFiltros <> "")
		{
		$vectorX = explode(" ",$leerFiltros['sesorigen']);
		
//			print_r($vectorX);
	//Date string
		$parametrosGuardados = array("icomp" => $vectorX['0'],
							  "icate" => $vectorX['1'],
							  "iclub" => $vectorX['2'],
							  "ietats" => $vectorX['3'],
							  "icity2" => $vectorX['4'],
							  "fecDde" => convertirFechaBrowsr($vectorX['5']),
							  "fecHta" => convertirFechaBrowsr($vectorX['6']));
//		$parametrosGuardados=[["icomp" => $vectorX['0'],
//							  "icate" => $vectorX['1'],
//							  "iclub" => $vectorX['2'],
//							  "ietats" => $vectorX['3'],
//							  "icity2" => $vectorX['4'],
//							  "fecDde" => convertirFechaBrowsr($vectorX['5']),
//							  "fecHta" => convertirFechaBrowsr($vectorX['6'])];

		}
	    
	    $datos["estado"] = 1;
	    $datos["Filtros"] = $parametrosGuardados;//es un array
	        print json_encode($datos);
	
}

function convertirFechaBrowsr($date_string)
{
	   //Creating a DateTime object
	   $date_time_Obj = date_create($date_string);
	   //formatting the date to print it
	   $format = date_format($date_time_Obj, "Y-m-d");
	   return $format;
}


?>
