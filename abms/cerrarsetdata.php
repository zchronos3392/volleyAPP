<?php

require ('Set.php');

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/Funciones.php');


require_once ('Partido.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	//aca necesito solo grabar un registro igual al anterior pero con otro estado
	$idpartido = (int) $_POST['idpartido'];
	$setnumero =  (int) $_POST['idset'];
	// 29-08-2018
	$fecpartido="''";// sera string 
	if(isset($_POST["fechas"])) $fecpartido = "'".$_POST["fechas"]."'";

	//02 DIC.2022::ENVIO LA ESTRATEGIA CON RESPECTO A LOS LIBEROS
		//PARA QUE SABER QUÉ HACER AUTOMATICAMENTE EN SUS CAMBIOS..
			$estrategiaA = "''";
			if(isset($_POST['estrategiaLA'])) $estrategiaA = "'".$_POST['estrategiaLA']."'";
			$estrategiaB = "''";
			if(isset($_POST['estrategiaLB'])) $estrategiaB = "'".$_POST['estrategiaLB']."'";


		//PARA QUE SABER QUÉ HACER AUTOMATICAMENTE EN SUS CAMBIOS..
	//02 DIC.2022::ENVIO LA ESTRATEGIA CON RESPECTO A LOS LIBEROS	
	$secuenciaarray =  Sett::ultSecuencia($idpartido,$setnumero,$fecpartido);
	$secuencia = 0;
	if( !empty($secuenciaarray) ) $secuencia = (int) $secuenciaarray[0]["secuencia"];
	if($secuencia != 0 && $idpartido!= 0 && $setnumero!= 0)
			$setData = Sett::getById($idpartido,$setnumero,$secuencia,$fecpartido);
	$A1 = $A2 = $A3 = $A4 = $A5 = $A6 = 0;
	$B1 = $B2 = $B3 = $B4 = $B5 = $B6 = 0;
	$estado = 2; //	FINALIZADO
	$puntoa = 0;
	$puntob	 = 0;
	$fecha =  "'".$_POST['fechas']."'"; // es parte de la clave del partido
	$saque = 0;
	if($setData){
// recorrer el array A de jugadores id y sus posiciones
			//las ultimas posiciones de los jugadores en el set
			$secuencia++; //porque voy a grabar otro registro
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
			
			
			$contadorpausasA=0;
			$contadorpausasB=0;

			$contadorpausasA = (int)$setData["CantPausaA"];
			$contadorpausasB = (int)$setData["CantPausaB"];

			$ordenA =1;
				$ordenA = (int)$setData['ordenA'];
			$ordenB =1;
				$ordenB = (int)$setData['ordenB'];

			
			// uno de los dos se mantiene, el otro cambia...
			$puntoa	= (int)$setData["puntoa"];
			$puntob	= (int)$setData["puntob"];
			// cabecera de partido:
				$equipoA = (int)$setData["ClubA"];
				$equipoB = (int)$setData["ClubB"];
// CONOCIENDO QUIEN FUE EL ULTIMO QUE TUVO EL SAQUE AL CERRAR EL SET, 
// PUEDO SABER A QUIEN SUMARLE UN PUNTO EN EL CONTADOR GENERAL DE SETS GANADOSS			
			$saque = (int)$setData["saque"]; // quien tenia el saque..., lo comparo
			$ResultadosEquipo = Partido::getResultados($idpartido,$fecha);
			//print_r($ResultadosEquipo);
			$clubares = (int) $ResultadosEquipo["0"]["ClubARes"];
			$clubbres = (int) $ResultadosEquipo["0"]["ClubBRes"];
			if($equipoA == $saque )
				{
				  $clubares++;	
				  Partido::UpdResultados($idpartido,$fecha,$clubares,0);	
			    }	
			    //tenia saque el equipo B, pero vino punto de A
			if($equipoB == $saque )
				{
				$clubbres++;	
				  Partido::UpdResultados($idpartido,$fecha,0,$clubbres);	
			    }	
	};
	// el problema esta aca, se recarga la fecha y no se ponen comillas, 
	// o el formato de la datetime esta mal...
	$fecha =  $_POST['fechas'];
	$hora =  $_POST['horas'];
		$s = $fecha." ".$hora;
		$horaset = "'".$s."'"; // correcto !!!
			$fecha2 = "'".$_POST['fechas']."'";
	// el problema esta aca, se recarga la fecha y no se ponen comillas, 
	// o el formato de la datetime esta mal...
	$mensaje = "'Fin del set'";
	$retorno =0;
//	print "cierre del set ".$estado;
//	print "secuencia nueva del set: ".$secuencia;
	
	
	$retorno = Sett::insert( $idpartido, $secuencia, $setnumero, $fecha2,$horaset,
							 $A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6,
							 $estado,$puntoa, $puntob,$saque,$estrategiaA,$estrategiaB,
							 $ordenA,$ordenB,
							 $mensaje,$contadorpausasA,$contadorpausasB);
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
