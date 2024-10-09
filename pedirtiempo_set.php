<?php

require ('./abms/Set.php');
require_once('./abms/JugadorPartido.php');
require_once('./abms/Partido.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	//CLAVE DEL SET: 
	$idpartido = (int) $_POST['idpartido'];
	$setnumero =  (int) $_POST['idset'];
	// 29-08-2018
	$fecha =  "'".$_POST['fechas']."'";
	// traigo el ultimo registro..
	$clubPIDE = '';
	$clubPIDE =  $_POST['clubpide'];
	$idclubVino   =  (int) $_POST['idclub'];
	$secuencia=0;
	$secuenciaarray =  Sett::ultSecuencia($idpartido,$setnumero,$fecha);
		if( !empty($secuenciaarray) ) $secuencia = (int) $secuenciaarray[0]["secuencia"];
	//$sets = Sett::getSetData($idpartido,$fecha);
	//echo($secuencia);
		$sets = Sett::getById($idpartido,$setnumero,$secuencia,$fecha );	
	//partido.ClubA,partido.ClubB, 1A as pa_1, 2A as pa_2, 3A as pa_3, 4A as pa_4, 5A as pa_5, 6A as pa_6,
	//1B as pb_1, 2B  as pb_2, 3B as pb_3, 4B as pb_4, 5B as pb_5, 6B as pb_6, 
	//vappset.estado,sts.descripcion, saque,puntoa,puntob,mensaje,CantPausaA,CantPausaB 
		
	//CLAVE DEL SET: partido, fecha,setnumero, secuencia
		//print_r($sets);
	$clubA = (int)$sets["ClubA"];
	$clubB = (int)$sets["ClubB"];
	//echo("partido identificador: ".$idpartido);
	//echo("set identificador: ".$setnumero);
	//echo("club identificador: ".$idclub);	
	//echo("club nombre: ".$clubPIDE);
	$contadorPausasA = (int)$sets["CantPausaA"];
	$contadorPausasB = (int)$sets["CantPausaB"];
	if($idclubVino == $clubA)$contadorPausasA -= 1;
	if($idclubVino == $clubB)$contadorPausasB -= 1;
//	echo("contador de pausas leido club a: ".$contadorPausasA);
//	echo("contador de pausas leido club b: ".$contadorPausasB);
//	echo("contador de pausas leido club b: ".$contadorPausasB);
	$retorno =0;
	//COMO PEGO LOS DATOS DEL PARTIDO HASTA EL MOMENTO PARA DICHO equipo
	//Y LO PEGO EN EL NOMBRE, CUANDO MANDO EL DATO DE PEDIR TIEMPO
	// PARA NO BUSCAR EL NOMBRE DE NUEVO DEL EQUIPO, GRABO EL QUE TENGO
	//DETECTADO EN NOVEDADES_SET30 PEEERO, COMO TIENE INCLUIDO EL 
	//DATO DEL ESTADO DEL PARTIDO SE GRABA ESO EN EL MENSAJE QUE LUEGO
	//SE MUESTRA EN EL TABLERO !!!
	// ejemplo: Pide tiempo : HACOAJ  (2)L:22V:25L:20V:25 <-- solo queria el nombre !!!
	$mensaje = "'Pide tiempo : ".$clubPIDE." '";
		// aca hay qye actualizar ultimo registro NO INSERTAR !!
		$retorno = Sett::updateMensajeSecuencia($idpartido,$fecha, $setnumero,$secuencia,$contadorPausasA,$contadorPausasB, $mensaje);
    //echo($retorno);
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
