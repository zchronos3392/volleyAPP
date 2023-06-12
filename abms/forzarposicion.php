<?php

require ('Set.php');
require_once('JugadorPartido.php');

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/Funciones.php');


require_once ('Partido.php');
require_once ('Rotaciones.php');


// uso: fx::rotar() y otras funciones...
// aca se deberia usar $mensaje con cada novedad posible...
if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$idpartido = (int) $_POST['idpartido'];
	$setnumero =  (int) $_POST['setdata'];
	$fecha = "'".$_POST['fechapartido']."'";
   // $club =  (int) $_POST['iclubescab'];
   // $categoriajugador =  (int) $_POST['icatcab'];
    $jugadorID = (int) $_POST['jugador']; 
   // $posicion = (int)  $_POST['posicion']; 
   // $puestoEnSet = (int)  $_POST['puestoSet']; 
    $posicionEnSet = $_POST['zona']; // A1-6 o B1-6
   // $horas = (int)  $_POST['horas']; 
   // $anioEq  = (int)substr($fecha,1,4);
  
    // obteniendo la ultima secuencia grabada.
	//ultima novedad del set 
	$secuenciaarray =  Sett::ultSecuencia($idpartido,$setnumero,$fecha);
	$secuencia = 0;
	if( !empty($secuenciaarray) ) $secuencia = (int) $secuenciaarray[0]["secuencia"];
	//si hay algo cargado para los parametros que llegaron,
	// traigo lo ultimo que tengo activo del Set.
	if($secuencia != 0 && $idpartido!= 0 && $setnumero!= 0)
			$setData = Sett::getById($idpartido,$setnumero,$secuencia,$fecha);//traigo lo ultimo
	if(count($setData) > 0 ){
	// Actualizo las variables de posicion en Cancha
	// de todos los jugadores, y ademas la del que entra
	if($posicionEnSet=='A1') {$setData['1A'] = $jugadorID;}
	if($posicionEnSet=='A2') {$setData['2A'] = $jugadorID;}
	if($posicionEnSet=='A3') {$setData['3A'] = $jugadorID;}
	if($posicionEnSet=='A4') {$setData['4A'] = $jugadorID;}
	if($posicionEnSet=='A5') {$setData['5A'] = $jugadorID;}
    if($posicionEnSet=='A6') {$setData['6A'] = $jugadorID;}
	if($posicionEnSet=='B1') {$setData['1B'] = $jugadorID;}
	if($posicionEnSet=='B2') {$setData['2B'] = $jugadorID;}
	if($posicionEnSet=='B3') {$setData['3B'] = $jugadorID;}
	if($posicionEnSet=='B4') {$setData['4B'] = $jugadorID;}
	if($posicionEnSet=='B5') {$setData['5B'] = $jugadorID;}
	if($posicionEnSet=='B6') {$setData['6B'] = $jugadorID;}

		$retornoSet = Sett::updateZonasxSecuencia($idpartido,$fecha,$setnumero,$secuencia,
									(int)$setData['1A'],(int)$setData['2A'],(int)$setData['3A'],(int)$setData['4A'],
									(int)$setData['5A'],(int)$setData['6A'],(int)$setData['1B'],(int)$setData['2B'],
									(int)$setData['3B'],(int)$setData['4B'],(int)$setData['5B'],(int)$setData['6B']);
	}	
} 
?>
