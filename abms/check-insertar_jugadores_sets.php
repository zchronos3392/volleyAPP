<?php

require ('Set.php');
require_once('JugadorPartido.php');
require_once('JugadorPartidoCab.php');
require_once('Partido.php');

if($_SERVER['REQUEST_METHOD'] == 'GET') {

	$idpartido = (int) $_GET['idpartido'];
	$setnumero =  (int) $_GET['setdata'];
	$anioEq = 0 ;
	$anioEq =  (int) $_GET['ianio'];
	$clublocal = (int) $_GET['iclub'];
	$fecha2 = "'".$_GET['fechapartido']."'";
	$icategoriaPartido = (int) $_GET['categoriapartido'];
	
	// TRAIGO LA LISTA DE JUGADORES ORIGINAL, CON EL VALOR 99  EN EL CAMPO ENTRASALE=99
	//$jugsA = partjug::getJugadoresListaInicial($idpartido,$fecha2,$clublocalA,$setnumero);
	// no envio la categoria, porque necesito a todos los que se agregaron de otra categoria tambien.
	// agrego / creo una funcion nueva 
	$jugsA = partjugCab::getJugListaInicio($idpartido,$fecha2,$clublocal,$anioEq,$icategoriaPartido);
	// Convierto el resultado a STRING...	
			//$separado_por_comas = implode(",", $jugsA);
	$contadorErrores =0;		
	$error="";
	//print_r($jugsA);
			foreach ($jugsA as $clave => $valor)
			{
						//echo "Clave $clave ";
						//print_r($valor);
						//echo "<br> ";	
							foreach ($valor as $clave2 => $nuevoValor){
			    					if( is_null($nuevoValor) )
			    					{
			    							$contadorErrores++;
			    							//$error +=  
											$error .= "El campo $clave2 es nulo para ".$valor['nombre']."<br>";
									} 
								
							}
				
			}

//			$clave = array_search('null', $jugsA); 
//			echo "Tiene errores: ".$clave;
			$datos["autoriza"] = $contadorErrores;
			if(!is_null($error))	$datos["error"] = $error;
			else $datos["error"] = "no hay errores"; //es un array
	        echo json_encode($datos);	        	
	        	
	        	
	// SIESTA TODO EN ORDEN, DEVUELVO 1, SINO 0...	
	
   };
   
?>
