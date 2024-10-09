<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require 'JugadorPartido.php';
require 'Set.php';
require 'Rotaciones.php';
require_once('JugadorPartidoCab.php');
require_once('Errores.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
//parametros de llamada
	$partido = 0;
		$partido = (int)$_POST["idpartido"];
	$fecha='';
		$fecha	 =	"'".$_POST["fechapartido"]."'";
	$iclub =0;
		$iclub	 = (int)$_POST["iclub"];
	$icate 	 =0;
		$icate 	 = (int)$_POST["icategoria"];
	$set = 0;
		$set =	(int)$_POST["setnumero"];
	$anioEq =0;
		$anioEq = (int) $_POST["ianio"];
	$jugador = 0;
		$jugador =	(int)$_POST["idjugador"];
// ya viene procesado el orden...
        // $accion ='';
	// 	$accion    = $_POST["accion"];
//parametros de llamada
	// $accionValor =0;
	// if($accion == 'SUBIR')
	//    $accionValor =1;

       $ordenCaptado =0;
        If(isset($_POST["ordenCaptado"])) $ordenCaptado    = $_POST["ordenCaptado"];


	$retorno = partjug::updateOrden($partido,$fecha,$iclub,$icate,$jugador,$set,$ordenCaptado);

	if($retorno)
	{
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["mensaje"] = "Orden actualizado";
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	}
	else
	{
		$datos["estado"] = 0;
		$datos["mensaje"] = "ERROR";
		print json_encode($datos);


	};

} 

?>
