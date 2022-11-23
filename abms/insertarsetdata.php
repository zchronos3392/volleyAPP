<?php

require ('Set.php');

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/Funciones.php');


require_once ('Partido.php');
require_once ('Rotaciones.php');


// uso: fx::rotar() y otras funciones...
// aca se deberia usar $mensaje con cada novedad posible...
if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$idpartido = (int) $_POST['idpartido'];
	$setnumero =  (int) $_POST['idset'];
	$fecha = "'".$_POST['fechas']."'";
	$secuenciaarray =  Sett::ultSecuencia($idpartido,$setnumero,$fecha);
	$secuencia = 0;
	//agregado 17 10 2019..popr saque erroneo de un equipo que no genera rotacion en el contrario pero si punto..
	//$HayRotacion = $_POST['debeRotar'];
	$HayRotacion="N";
	//doc 2021: aviso de ROTACION INVERSA UNICAMENTE, SIN PUNTAJE
		$retrocesoRotacion = "";
		if(isset($_POST['antirotacion'])) $retrocesoRotacion =   $_POST['antirotacion'];		$quienAntiRota =0;
		if(isset($_POST['quienAntiRota']))
			$quienAntiRota = (int) $_POST['quienAntiRota']; // idclub
		$sentidoAntirotacion="";
		if(isset($_POST['sentido']))
		$sentidoAntirotacion = $_POST['sentido']; //       : FF o BW  


	//doc 2021: aviso de ROTACION INVERSA UNICAMENTE, SIN PUNTAJE
	
	if( !empty($secuenciaarray) ) $secuencia = (int) $secuenciaarray[0]["secuencia"];
	if($secuencia != 0 && $idpartido!= 0 && $setnumero!= 0)
			$setData = Sett::getById($idpartido,$setnumero,$secuencia,$fecha);//traigo lo ultimo
	$A1 = $A2 = $A3 = $A4 = $A5 = $A6 = 0;
	$B1 = $B2 = $B3 = $B4 = $B5 = $B6 = 0;
	// a partir de la llamada a esta pagina, el siguiente estado del set sera 4, y 
	// asi en adelante, hasta que lo cerremos con el estado 2
	$estado = 4; //	SI LO LLAMA ESTA PAGINA, EL ESTADO ES EN CURSO, O ACTIVO O EN JUEGO..
	// este estado deberia cambiarse en PARTIDO TAMBIEN ACA, QUE ES CUANDO COMENZAMOS A 
	// SUMAR PUNTOS..
	$fecha = "'".$_POST['fechas']."'";
		Partido::UpdSts($idpartido,$fecha,$estado);
	$puntoa = 0;
	$puntoa =  (int) $_POST['resa'];
	
	$puntob	 = 0;
	$puntob	 =  (int) $_POST['resb'];
	
	$mensaje = "''";
	$saque = 0;
	// neccesito tenerlo antes de decidir, sino no puedo cambiarlo.
	$saque = (int)$setData["saque"];
	//print_r($setData);
	//17 09 2019
	$contadorpausasA = (int)$setData["CantPausaA"];	
	$contadorpausasB = (int)$setData["CantPausaB"];	
	$clubRota = 0;
//	"resa"      : resa,
//	"resb"      : resb,
	$rotar ="";
//	"rotacion" : rotar, viene N cuando es 
	if(isset($_POST['rotacion'])) $rotar	 =  $_POST['rotacion'];
	$mensajeAlta = "";
//  CUANDO SE REANUDA EL PARTIDO: "mensajeAlta" : 'Novedades30::REANUDAR'
	if(isset($_POST['mensajeAlta'])) $mensajeAlta = $_POST['mensajeAlta'];

	//17 09 2019
	if($setData){
// recorrer el array A de jugadores id y sus posiciones
			//saque,puntoa,puntob 
			$secuencia++;
			$A1 = (int)$setData["pa_1"];
			$A2 = (int)$setData["pa_2"];
			$A3 = (int)$setData["pa_3"];
			$A4 = (int)$setData["pa_4"];
			$A5 = (int)$setData["pa_5"];
			$A6 = (int)$setData["pa_6"];
			
			$B1 = (int)$setData["pb_1"];
			$B2 = (int)$setData["pb_2"];
			$B3 = (int)$setData["pb_3"];
			$B4 = (int)$setData["pb_4"];
			$B5 = (int)$setData["pb_5"];
			$B6 = (int)$setData["pb_6"];
			
			// esto lo traigo para cambiarlo si lo necesito..
						//	$estado	= (int)$setData["estado"];
			
			// uno de los dos se mantiene, el otro cambia...
			$puntoDB_a	= (int)$setData["puntoa"];
			$puntoDB_b	= (int)$setData["puntob"];
			
			// Si cambio el saque, guardo el otro club..
				$equipoA = (int)$setData["ClubA"];
				$equipoB = (int)$setData["ClubB"];
				$saquiEN = (int)$setData["saque"]; // quien tenia el saque..., lo comparo
				// contra el equipo que hizo el punto (A/B)
			// Si cambio el saque, guardo el otro club..			
				//tenia saque el equipo A, pero vino punto de B, significa que HAY QUE ROTAR
//	"rotacion" : rotar, viene N cuando es 
	if($rotar == "" || $rotar != "N"){
		
				if($retrocesoRotacion == "S" && ($equipoA == $quienAntiRota)  )
				{
						if($sentidoAntirotacion == "FF")  
						$posrotadas = fx::rotar($A1,$A2,$A3,$A4,$A5,$A6);
						else
						$posrotadas = fx::antirotar($A1,$A2,$A3,$A4,$A5,$A6);

						if($posrotadas)
						{
							//  vector('I' => $posii,'II' => $posiii,'III' => $posiv,'IV' => $posv,'V' => $posvi,'VI' => $posi);							
							$A1 = (int) $posrotadas["I"];
							$A2 = (int) $posrotadas["II"];
							$A3 = (int) $posrotadas["III"];
							$A4 = (int) $posrotadas["IV"];
							$A5 = (int) $posrotadas["V"];
							$A6 = (int) $posrotadas["VI"];
							$partidodata = Partido::getById($idpartido,$fecha);
							//$mensaje = "'rotación en  " + $partidodata["ClubB"] + "'"; 
							$mensaje = "'ajuste de rotacion en  ".$partidodata['ClubA']."'";
						}
				}
				else 
				if($puntob != 0 && ($equipoA == $saquiEN) )
				{
						$saque = $equipoB;
						//if($HayRotacion=='S')  
						$posrotadas = fx::rotar($B1,$B2,$B3,$B4,$B5,$B6);
						$HayRotacion="S";//para grabarlo en la tabla rotaciones
						if($posrotadas)
						{
							//  vector('I' => $posii,'II' => $posiii,'III' => $posiv,'IV' => $posv,'V' => $posvi,'VI' => $posi);							
							$B1 = (int) $posrotadas["I"];
							$B2 = (int) $posrotadas["II"];
							$B3 = (int) $posrotadas["III"];
							$B4 = (int) $posrotadas["IV"];
							$B5 = (int) $posrotadas["V"];
							$B6 = (int) $posrotadas["VI"];
							$partidodata = Partido::getById($idpartido,$fecha);
							//$mensaje = "'rotación en  " + $partidodata["ClubB"] + "'"; 
							$mensaje = "'Rotacion en  ".$partidodata['ClubB']."'";
							$clubRota = $saque;
						}
			    }	
			    
			    //tenia saque el equipo B, pero vino punto de A
				//print("puntoa: ".$puntoa."<br>");
				if($retrocesoRotacion == "S" && ($equipoB == $quienAntiRota)  )
				{
						if($sentidoAntirotacion == "FF")  
							$posrotadas = fx::rotar($B1,$B2,$B3,$B4,$B5,$B6);
						else
							$posrotadas = fx::antirotar($B1,$B2,$B3,$B4,$B5,$B6);

					
						if($posrotadas)
						{
							//  vector('I' => $posii,'II' => $posiii,'III' => $posiv,'IV' => $posv,'V' => $posvi,'VI' => $posi);							
							$B1 = (int) $posrotadas["I"];
							$B2 = (int) $posrotadas["II"];
							$B3 = (int) $posrotadas["III"];
							$B4 = (int) $posrotadas["IV"];
							$B5 = (int) $posrotadas["V"];
							$B6 = (int) $posrotadas["VI"];
							$partidodata = Partido::getById($idpartido,$fecha);
							//$mensaje = "'rotación en  " + $partidodata["ClubB"] + "'"; 
							$mensaje = "'ajuste de rotacion en  ".$partidodata['ClubB']."'";
						}
				}
				else
				if($puntoa != 0 && ($equipoB == $saquiEN) )
				{
						$saque = $equipoA;//cambio el saque
						//if($HayRotacion=='S')
						  $posrotadas = fx::rotar($A1,$A2,$A3,$A4,$A5,$A6);
						  $HayRotacion="S";//para grabarlo en la tabla rotaciones
						if($posrotadas){
//  vector('I' => $posii,'II' => $posiii,'III' => $posiv,'IV' => $posv,'V' => $posvi,'VI' => $posi);							
							$A1 = (int) $posrotadas["I"];
							$A2 = (int) $posrotadas["II"];
							$A3 = (int) $posrotadas["III"];
							$A4 = (int) $posrotadas["IV"];
							$A5 = (int) $posrotadas["V"];
							$A6 = (int) $posrotadas["VI"];
							$partidodata = Partido::getById($idpartido,$fecha);
//							$mensaje = "'rotación en  " + $partidodata["ClubA"] + "'";
							$mensaje = "'Rotacion en  ".$partidodata['ClubA']."'";
							$clubRota = $saque;
						}
			    }	
   	  }	
		// aca hay un error logico, porque que uno venga en 0 se usa como FLAG !!
		if($puntoa == 0) $puntoa = $puntoDB_a;// hay que hacerlo aca al final, sino no lo puedo usar como flag
		if($puntob == 0) $puntob = $puntoDB_b;		
	};
	

//  CUANDO SE REANUDA EL PARTIDO: "mensajeAlta" : 'Novedades30::REANUDAR'
//	if(isset($_POST['mensajeAlta'])) $mensajeAlta = $_POST['mensajeAlta'];

	$fecha =  $_POST['fechas'];
	$hora =  $_POST['horas'];
		$s = $fecha." ".$hora;
		$horaset = "'".$s."'"; // correcto !!!
  $fecha2 = "'".$_POST['fechas']."'";
	// revisar cual vino en cero, y traerlo de la base con la ultima secuencia...
	// $saque = 0; ver quine saca, en caso de haber cambiado..
    // Insertar Set
	$retorno =0;
	if($mensajeAlta == 'Novedades30::REANUDAR')
			$mensaje = '"Se reanuda el partido"';
	$retorno = Sett::insert( $idpartido, $secuencia, $setnumero, $fecha2,$horaset,$A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6,$estado,$puntoa, $puntob,$saque,$mensaje,$contadorpausasA,$contadorpausasB);
	$retornoRotaciones = 0;
	if($secuencia == 1) $mensaje = "'por pitada inicial del partido...'";
	else if($HayRotacion=='S')	$mensaje = "'por rotacion durante el partido...'";

	if($HayRotacion=='S')
		$retornoRotaciones = Rotaciones::insert($idpartido,$fecha2,$setnumero,$secuencia,$A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6,$mensaje,$saque);
    
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
