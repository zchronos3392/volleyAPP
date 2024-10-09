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

//   EJEMPLO DE PARAMETROS:
	//    idpartido: 1
	//    iclubescab: 83
	//    icatcab: 20
	//    fechapartido: 2023-06-16
	//    jugador: 183
	//    posicion: 3
	//    puestoSet: 6
	//    setdata: 1
	//    zona: A3
	//    horas: 22:06:58
//   EJEMPLO DE PARAMETROS:
    // obteniendo la ultima secuencia grabada.
	//ultima novedad del set 
	$secuenciaarray =  Sett::ultSecuencia($idpartido,$setnumero,$fecha);
	$secuencia = 0;
	if( !empty($secuenciaarray) ) $secuencia = (int) $secuenciaarray[0]["secuencia"];
	//si hay algo cargado para los parametros que llegaron,
	// traigo lo ultimo que tengo activo del Set.
	//echo " <br>getById($idpartido,$setnumero,$secuencia,$fecha) <br>";
	if($secuencia != 0 && $idpartido!= 0 && $setnumero!= 0)
			$setData = Sett::getById($idpartido,$setnumero,$secuencia,$fecha);//traigo lo ultimo

	// echo " SsetData pre modificacion <br>";
	// 	print_r($setData);
	// echo "<br>";

	if(count($setData) > 0 ){
	// Actualizo las variables de posicion en Cancha
	// de todos los jugadores, y ademas la del que entra
	if($posicionEnSet=='A1') {$setData['pa_1'] = $jugadorID;}
	if($posicionEnSet=='A2') {$setData['pa_2'] = $jugadorID;}
	if($posicionEnSet=='A3') {$setData['pa_3'] = $jugadorID;}
	if($posicionEnSet=='A4') {$setData['pa_4'] = $jugadorID;}
	if($posicionEnSet=='A5') {$setData['pa_5'] = $jugadorID;}
    if($posicionEnSet=='A6') {$setData['pa_6'] = $jugadorID;}
	if($posicionEnSet=='B1') {$setData['pb_1'] = $jugadorID;}
	if($posicionEnSet=='B2') {$setData['pb_2'] = $jugadorID;}
	if($posicionEnSet=='B3') {$setData['pb_3'] = $jugadorID;}
	if($posicionEnSet=='B4') {$setData['pb_4'] = $jugadorID;}
	if($posicionEnSet=='B5') {$setData['pb_5'] = $jugadorID;}
	if($posicionEnSet=='B6') {$setData['pb_6'] = $jugadorID;}
		
	// echo "<br>";
	// echo " SsetData post modificacion <br>";
	// print_r($setData);
	// echo "<br>";
		$retornoSet = Sett::updateZonasxSecuencia($idpartido,$fecha,$setnumero,$secuencia,
									(int)$setData['pa_1'],(int)$setData['pa_2'],(int)$setData['pa_3'],(int)$setData['pa_4'],
									(int)$setData['pa_5'],(int)$setData['pa_6'],(int)$setData['pb_1'],(int)$setData['pb_2'],
									(int)$setData['pb_3'],(int)$setData['pb_4'],(int)$setData['pb_5'],(int)$setData['pb_6']);
	}	
} 
?>
