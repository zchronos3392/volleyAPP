<?php

require ('Set.php');
require_once('JugadorPartido.php');
require_once('Partido.php');
require_once('Rotaciones.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$idpartido = (int) $_POST['idpartido'];
	$setnumero =  (int) $_POST['idset'];
	// 29-08-2018
	$fecha2 =  $_POST['fechas'];
	$retorno = Sett::deleteAllSet( $idpartido, $setnumero, $fecha2);
    //echo($retorno);
    //ahora necesito borrar: jugpartido 
		$retornoJugPartido = partjug::delete2($idpartido,$setnumero,$fecha2);	
		$retornoJugPartido = partjug::delete2($idpartido,0,$fecha2);	


	// y rotacion:
    	$retornoRotaciones = Rotaciones::delete2($idpartido,$setnumero,$fecha2);

    if($retorno) {
        // Codigo de �xito
        print(json_encode(array('estado' => '1','mensaje' => 'Creacion exitosa')));
    } else 
    {
        // Codigo de falla
		print(json_encode(array('estado' => '2','mensaje' => 'Creacion NO exitosa')));
    }
   }
?>
