<?php

require './abms/Set.php';
require './abms/Rotaciones.php';
 
 $setRotacionesData = Sett::setRotacionesData();
// print_r($setRotacionesData['0']);
  for($contador=0; $contador < count($setRotacionesData);$contador++ )
	     { // recorro vector de jugadores del equipo A
	     	$idpartido 		=  $setRotacionesData[$contador]['idpartido'];
	     	$fecha     		=  "'".$setRotacionesData[$contador]['fecha']."'";
	     	$setnumero 		=  $setRotacionesData[$contador]['setnumero'];
	     	$secuenciaSet 	=  $setRotacionesData[$contador]['secuencia'];
	     	$clubRota   	=  $setRotacionesData[$contador]['saque'];
			
				$resultado= Rotaciones::updateclubrota($idpartido,$fecha,$setnumero,$secuenciaSet,$clubRota);
		  }

?>