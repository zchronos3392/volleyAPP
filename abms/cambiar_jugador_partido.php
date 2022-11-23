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
    // Decodificando formato Json
	// Decodificando <	
	$partido = (int)$_POST["idpartido"];
	$fecha	 =	"'".$_POST["fechapartido"]."'";
	$fecha2	 =	$_POST["fechapartido"];
	$iclub	 = (int)$_POST["iclubescab"];
	$icate 	 = (int)$_POST["icatcab"];
	$set =	(int)$_POST["setnumero"];

	//para actualizar bien las posiciones: 
		$anioEq = (int) $_POST["ianio"];
	
		$jugadorEntra =	(int)$_POST["idjugadorEntra"];
		$jugadorSale  =	(int)$_POST["idjugadorSale"];
		$posicion = $_POST["posicion"]; 	
	$posicionEnSet = $_POST["posenset"]; //	A5	//posicion que tenia el que sale...esto es para actualizar set
//	idpartido=1&iclubescab=83&icatcab=3&fechapartido=2019-09-25&idjugadorEntra=50&idjugadorSale=59&posenset=A5&setnumero=1	

// LOG DE LA ACTIVIDAD PARA DETECTAR ERRORES..
$tipo="'AVISO'";
//$fecha_hora,
$scriptPrograma="'cambiar_jugador_partido'";
$funcion="'partjug::updateSale'";

$parametro[0]=" idpartido: ".$partido;
$parametro[1]=" fecha2: ".$fecha2;
$parametro[2]=" iclub: ".$iclub;
$parametro[3]=" icate: ".$icate;
$parametro[4]=" set: ".$set;
$parametro[5]=" anioEq: ".$anioEq;
$parametro[6]=" jugadorEntra: ".$jugadorEntra;
$parametro[7]=" jugadorSale: ".$jugadorSale;
$parametro[8]=" posicion: ".$posicion;
$parametro[9]=" posicionEnSet: ".$posicionEnSet;

$parametros= "'".implode(";",$parametro)."'";
	$ret = errorGrabado::insert($tipo,$scriptPrograma,$funcion,$parametros);

// LOG DE LA ACTIVIDAD PARA DETECTAR ERRORES..

		$retorno = partjug::updateSale($partido,$fecha,$iclub,$icate,$jugadorSale,$set);

	// actualizo SET, ULTIMA SECUENCIA, que seria lo mismo que :
	// actualizar quien se encuentra en la cancha en un momento dado.
	$secuenciaarray =  Sett::ultSecuencia($partido,$set,$fecha);
	$secuencia = 0;
	if( !empty($secuenciaarray) ) $secuencia = (int) $secuenciaarray[0]["secuencia"];
 	// incorporar CONTINUAR PARTIDO 17 09 2019
	$setData = Sett::getByIdUltimoRegistro($partido,$set,$secuencia,$fecha);
    if($secuencia == 0) $secuencia = 1;
    else $secuencia++;

//arreglamos las posiciones en un momento dado para que los suplentes esten bien y los que 
// esten en cancha tambien	
	$ListaInicialJugadores = partjugCab::getJugListaInicio($partido,$fecha,$iclub,$anioEq,$icate);
	//print_r($ListaInicialJugadores);:
/*
	[0] => Array
        (
            [numero] => 1
            [nombre] => Leandro
            [categoria] => 19
            [idjugador] => 146
            [idclub] => 83
            [jugador] => 146
            [posicion] => 7
            [puestoxcat] => 4
        )
*/
	$horaset = $_POST["horas"];
	$s = $fecha2." ".$horaset;
	$horaset = "'".$s."'"; // correcto !!!
	$posicion=0;
	// El cambio llega de a 1 jugador a la vez, no ocurren varios cambios al mismo
	// tiempo. Asi que uso la misma variable. Actualizo las variables de posicion en Cancha
	// de todos los jugadores, y ademas la del que entra
	if($posicionEnSet=='A1') {$A1 = $jugadorEntra;$posicion=1;}
		else $A1 = $setData['1A'];
	if($posicionEnSet=='A2') {$A2 = $jugadorEntra;$posicion=2;}
		else $A2 = $setData['2A'];
	if($posicionEnSet=='A3') {$A3 = $jugadorEntra;$posicion=3;}
		else $A3 = $setData['3A'];
	if($posicionEnSet=='A4') {$A4 = $jugadorEntra;$posicion=4;}
		else $A4 = $setData['4A'];
	if($posicionEnSet=='A5') {$A5 = $jugadorEntra;$posicion=5;}
		else $A5 = $setData['5A'];
	if($posicionEnSet=='A6') {$A6 = $jugadorEntra;$posicion=6;}
		else $A6 = $setData['6A'];
	if($posicionEnSet=='B1') {$B1 = $jugadorEntra;$posicion=1;}
		else $B1 = $setData['1B'];
	if($posicionEnSet=='B2') {$B2 = $jugadorEntra;$posicion=2;}
		else $B2 = $setData['2B'];
	if($posicionEnSet=='B3') {$B3 = $jugadorEntra;$posicion=3;}
		else $B3 = $setData['3B'];
	if($posicionEnSet=='B4') {$B4 = $jugadorEntra;$posicion=4;}
		else $B4 = $setData['4B'];
	if($posicionEnSet=='B5') {$B5 = $jugadorEntra;$posicion=5;}
		else $B5 = $setData['5B'];
	if($posicionEnSet=='B6') {$B6 = $jugadorEntra;$posicion=6;}
		else $B6 = $setData['6B'];

		//ACTUALIZO LA POSICION EN DONDE SE ENCUENTRARA EL JUGADOR QUE VA A ENTRAR..
		$retorno = partjug::updateEntra($partido,$fecha,$iclub,$icate,$set,$jugadorEntra,$posicion);
	
	$estado = $setData['estado'];
	$puntoa = $setData['puntoa'];
	$puntob = $setData['puntob'];
	$saque = $setData['saque'];
	$contadorpausasA = $setData['CantPausaA'];
	$contadorpausasB = $setData['CantPausaB'];

	$retorno =0;
	$mensaje = "'por cambio jugador...'";
	//reubico los jugadores de la cancha segun quien entro y quien salió..
	$retorno = Sett::insert( $partido, $secuencia, $set, $fecha,$horaset,$A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6,$estado,$puntoa, $puntob,$saque,$mensaje,$contadorpausasA,$contadorpausasB);

	$retornoRotaciones = 0;
	$mensaje = "'por cambio en jugador en posicion.$posicionEnSet'";
	//actualizo Rotaciones para poder verlo mas tarde o para recuperar posiciones viejas..
	$retornoRotaciones = Rotaciones::insert($partido,$fecha,$set,$secuencia,$A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6,$mensaje,$iclub);

//actualizo las posiciones a partir de lo que cambié en base en SET
	$secuenciaarray =  Sett::ultSecuencia($partido,$set,$fecha);
	$secuencia = 0;
	if( !empty($secuenciaarray) ) $secuencia = (int) $secuenciaarray[0]["secuencia"];
 	// incorporar CONTINUAR PARTIDO 17 09 2019
	//echo "<br> numero de secuencia nueva encontrada: $secuencia <br>";
	$setData = Sett::getByIdUltimoRegistro($partido,$set,$secuencia,$fecha);

	guardarPosicionesActuales($ListaInicialJugadores,$jugadorEntra,$jugadorSale,
							$partido,$fecha,$iclub,$set,$setData);


	if($retorno)
	{
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["mensaje"] = "cambio realizado";
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	};
} 


function guardarPosicionesActuales($listaInicial,$jugEntra,$jugSale,
								   $partidox,$fechax,$xiclub,$xset,$xsetData){

	if( !empty($listaInicial) && is_array($listaInicial) )
		{
		 for($contador=0; $contador < count($listaInicial);$contador++ )
	     { // recorro vector de jugadores del equipo A
				    $icate 	 =	$listaInicial[$contador]['categoria'];
				    $jugador =	$listaInicial[$contador]["idjugador"];
					 foreach($xsetData as $indice => $valor)
					{
						//$indice : 1A (posicion) , $valor: 146 (id jugador)
						if ($indice == '1A' ||$indice == '2A' || $indice == '3A' || 
							$indice == '4A' || $indice == '5A' || $indice == '6A' ||
							$indice == '1B' || $indice == '2B' || $indice == '3B' ||
							$indice == '4B' || $indice == '5B' || $indice == '6B'  )
							if($valor == $jugador)
							{
							// Encontré a un jugador, necesito su posicion..
							$claveIndice = "'".$indice."'";
							//echo "buscando pos jugador : $jugador , posicion : ". (int)substr($claveIndice,1,1)." con indice: $claveIndice<br>";
							$xposicion = (int)substr($claveIndice,1,1);

							if($jugador != $jugEntra && $jugador != $jugSale)	
								{
									//echo "<br> actualizo: ".$listaInicial[$contador]['nombre']."<br>";
							 		//echo "<br> updatePosiciones: $partidox,$fechax,$xiclub,$icate,
							 		//		 					 $xset,$jugador,$xposicion<br>";
						$retorno = partjug::updateEntra($partidox,$fechax,$xiclub,$icate,
														$xset,$jugador,$xposicion);	
								}
							else
							{
							 // echo "<br> NO SE ACTUALIZA JUGADOR :". $listaInicial[$contador]['nombre']."<br>";				
							}	

							}
					}    

		 }// for 
   		};// if no empty	
	
}

?>
