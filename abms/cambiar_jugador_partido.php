<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require_once('JugadorPartido.php');
require_once('Set.php');
require_once('Rotaciones.php');
require_once('JugadorPartidoCab.php');
require_once('Errores.php');
require_once('Partido.php');
require_once('Jugador.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    // Decodificando formato Json
	// Decodificando <
// // // // // INICIO SECTOR RECEPCION DE PARAMETROS
	$partido = 0;
	if(isset($_POST["idpartido"]))
		$partido = (int)$_POST["idpartido"];

	$fecha	 =	"";
	if(isset($_POST["fechapartido"]))
			$fecha	 =	"'".$_POST["fechapartido"]."'";

	$fecha2	 =	"";
	if(isset($_POST["fechapartido"]))
		$fecha2	 =	$_POST["fechapartido"];

	$iclub	 = 0;
	if(isset($_POST["iclubescab"]))
		$iclub	 = (int)$_POST["iclubescab"];

	$icate 	 = 0;
	if(isset($_POST["icatcab"]))
		$icate 	 = (int)$_POST["icatcab"];

	$set = 0;
	if(isset($_POST["setnumero"]))
		$set =	(int)$_POST["setnumero"];

	//para actualizar bien las posiciones:
	$anioEq = 0;
	if(isset($_POST["ianio"]))
		$anioEq = (int) $_POST["ianio"];

	$jugadorEntra =0; // ID JUGADOR QUE INGRESA A LA CANCHA
	if(isset($_POST["idjugadorEntra"]))
		$jugadorEntra =	(int)$_POST["idjugadorEntra"];

	$jugadorSale  =	0; // ID JUGADOR QUE EGRESA DE LA CANCHA
	if(isset($_POST["idjugadorSale"]))
		$jugadorSale  =	(int)$_POST["idjugadorSale"];

	$posicion = 0;
	if(isset($_POST["posicion"]))
		$posicion = $_POST["posicion"]; //POSICION EN FORMA DE NUMERO: {1,2,3,4,5,6}
		//indistintamente si es LOCAL O VISITANTE)

	$posicionEnSet = "";
	if(isset($_POST["posenset"]))
		$posicionEnSet = $_POST["posenset"]; //	A5	//posicion que tenia el que sale...esto es para actualizar set
//	idpartido=1&iclubescab=83&icatcab=3&fechapartido=2019-09-25&idjugadorEntra=50&idjugadorSale=59&posenset=A5&setnumero=1
	$horaset = "";
	if(isset($_POST["horas"]))
		$horaset = $_POST["horas"];
	//DIC.2022.REALIZO LOS CAMBIOS DE LIBEROS POR CENTRALES EN EL INICIO DEL SET
	// DESDE ESTA FUNCION, YA QUE ES LO MISMO.
	$modo="";
		if(isset($_POST["MODO"]))  $modo=$_POST["MODO"];
// // // // // FIN SECTOR RECEPCION DE PARAMETROS
// ----------------------------------------------
// LOG DE LA ACTIVIDAD PARA DETECTAR ERRORES..
// ----------------------------------------------
// echo "modo : $modo";
if($modo == "")
{
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

	// ----------------------------------------------
	// LOG DE LA ACTIVIDAD PARA DETECTAR ERRORES..
	// ----------------------------------------------
	// ACTUALIZO POSICIONES...
	//    NOVEDAD, NECESITO LA CATEGORIA DE CADA UNO..
	$categoriaSale  = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$set,
						$jugadorSale);

	$categoriaEntra = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$set,
						$jugadorEntra);

	$retorno = realizaCambio($modo,$partido,$fecha,$iclub,$icate,$set,$anioEq,
							 $jugadorSale ,(int)$categoriaSale['0']['categoria'] ,$posicion,
							 $jugadorEntra,(int)$categoriaEntra['0']['categoria'],$posicionEnSet);

	//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
    $datos["estado"] = 1;
    $datos["mensaje"] = "cambio realizado";
   // print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
 } // CIERRE $modo == ""
else
 {
   if($modo == "PRESAQUEINICIAL")
   {
   	//PARA LOS DOS EQUIPOS
   	//NECESITO LA LISTA DE LOS LIBEROS Y CENTRALES ACTIVOS EN EL SET, PARTIDO
	    $partidoRow = Partido::getById($partido,$fecha);

		//echo "llego por presaque";
		$aclub =$bclub =0;
		$aclub = $partidoRow['idcluba'];
		$bclub = $partidoRow['idclubb'];
		$categoriaPartido = $partidoRow['idcat'];
			// listado de centrales y liberos locales y visitantes:
				$JugActivosLocal  = partjug::getListaActivos($partido,$fecha,$aclub,$anioEq,$set);
				$JugActivosVisita = partjug::getListaActivos($partido,$fecha,$bclub,$anioEq,$set);
			// print_r($JugActivosLocal);
			// print_r($JugActivosVisita);
			/*
				[0] => Array LIBERO/S
						[categoria] => 19
						[idjugador] => 148
						[idclub] => 83
						[posicion] => 4
						[puestoxcat] => 2
						[puesto] => 2

				[1] => Array CENTRAL/ES
						[categoria] => 19
						[idjugador] => 149
						[idclub] => 83
						[posicion] => 7
						[puestoxcat] => 6
						[puesto] => 6
			*/
			//AHORA QUE TENGO LOS ACTIVOS, NECESITO AL CENTRAL DE LA POSICION 1 Y O 6
			// 	agregado MAYO 2023:tamien podria haber un central en la posicion 5 !!!
			//OBTENGO LAS POSICIONES INICIALES que fueron cargadas en la CANCHA, porque aun no comenzó el set
			// entonces, las posiciones actuales coinciden con las iniciales.
			// en esta parte del programa, siempre ingresa luego de CONFIRMAR LAS POSICIONES INICIALES
				$InicialJugLocal =  Sett::getSetPosInicialesGrabadas($partido,$set,$fecha);
			//	$InicialJugLocal =
			/*		Array ( [idpartido] => 2 ,[secuencia] => 2,[setnumero] => 3,[fecha] => 2022-12-03,
							[hora] => 13:28:03,
							[1A] => 0 [2A] => 0 [3A] => 0 [4A] => 0 [5A] => 0 [6A] => 0
							[1B] => 163 [2B] => 159 [3B] => 166 [4B] => 146 [5B] => 160 [6B] => 177
							[estado] => 5,[puntoa] => 0,[puntob] => 0,[CantPausaA] => 2,
							[CantPausaB] => 2,[saque] => 83
			*/
				$jugador5Local=$jugador5Visita= ""; //MAYO 2023
				$jugador6Visita=$jugador6Local= "";
				$jugador1Local=$jugador1Visita= "";

				// LOCALES
					// OBTENER DATA DEL JUGADOR EN POSICION 1
					$jugador1Local  = partjug::getJugSetVer($partido,$fecha,$aclub,$anioEq,$set,
										(int)$InicialJugLocal['0']['1A']);
					// OBTENER DATA DEL JUGADOR EN POSICION 6
					$jugador6Local  = partjug::getJugSetVer($partido,$fecha,$aclub,$anioEq,$set,
										(int)$InicialJugLocal['0']['6A']);
					// OBTENER DATA DEL JUGADOR EN POSICION 5
					$jugador5Local  = partjug::getJugSetVer($partido,$fecha,$aclub,$anioEq,$set,
										(int)$InicialJugLocal['0']['5A']);

				// echo "<br>UNO local <br>";
				// print_r($jugador1Local);
				// echo "<br>SEIS local <br>";
				// print_r($jugador6Local);
				// echo "<br>CINCO local <br>";
				// print_r($jugador5Local);
				// ANALIZAMOS LOCALES:
				// tener en cuenta que el jugador en alguna de estas posiciones, podria no tener
				// un puesto asignado....como por ejemplo en categorias como sub16..

				// INICIO ANALIZANDO CENTRALES  LOCALES
				if(count($jugador1Local)>0 && count($jugador6Local)>0 && count($jugador5Local)>0)
				{
					//   se cargaron las posiciones en esos lugares...
					$PuestoPostajugadorUNOLocal = (int)$jugador1Local['0']['puestoxcat'];
					if($jugador1Local['0']['puesto'] != $jugador1Local['0']['puestoxcat'])
							$PuestoPostajugadorUNOLocal = (int)$jugador1Local['0']['puesto'];
					$Cat1Local = $jugador1Local['0']['categoria'];

					$PuestoPostajugadorSEISLocal = (int)$jugador6Local['0']['puestoxcat'];
					if($jugador6Local['0']['puesto'] != $jugador6Local['0']['puestoxcat'])
							$PuestoPostajugadorSEISLocal = (int)$jugador6Local['0']['puesto'];
					$Cat6Local = $jugador6Local['0']['categoria'];

					// AGREGO DATA DEL JUGADOR EN POSICION V.MAYO 2023
						$PuestoPostajugadorCINCOLocal = (int)$jugador5Local['0']['puestoxcat'];
						if($jugador5Local['0']['puesto'] != $jugador5Local['0']['puestoxcat'])
								$PuestoPostajugadorCINCOLocal = (int)$jugador5Local['0']['puesto'];
						$Cat5Local = $jugador5Local['0']['categoria'];
					// AGREGO DATA DEL JUGADOR EN POSICION V.MAYO 2023

					// LUEGO EN LAS VARIABLES: $PuestoPostajugador[ZONA / UBICACION JUGADOR] tendre la funcion
					// que ocupa el jugador en esa zona	, para poder analizar si es un CENTRAL...

					//  datos del libero activo
						$idLiberoActivoLocal = retornaLibero($JugActivosLocal);
						$CatLiberoActivoLocal = retornaCategoria($JugActivosLocal,2);
					//  datos del libero activo

					//CASOS:
					//PUESTO == 6 : CENTRALES.
					//UBICACION EN CANCHA: SI EN 1 Y EN 6 HAY UN CENTRAL. LO REEMPLAZO EN 1
					//AGREGAR QUE VERIFIQUE LA POSICION 5 TAMBIEN, MAYO 2023
					//ver reglamento...
					// PUESTO == 6 ES CENTRAL
					// estrategias de cambio automatico:
					// V   VI   I =  SALE
					// C    C   C =   I
					// X    C   C =   I
					// X    X   C =   I
					// X    C   X =   VI
					// C    C   X =   VI
					// C    X   X =   V
					$elegido =	elegirJugadorCentral($PuestoPostajugadorUNOLocal, $PuestoPostajugadorSEISLocal, $PuestoPostajugadorCINCOLocal); // return '1' o '5' o '6';
					// echo "<br> elegido local...".$elegido."<br>";
					switch($elegido)
						{
							case '1':
									//CAMBIO AL QUE ESTA EN EL 1 POR EL LIBERO ACTIVO.
									//como hacer el cambio:
									//$jugadorSale ID JUGADOR QUE SALE (CENTRAL)
									//$posicion // EN QUE POSICION NUMERICA SE HALLABA (1,2,3,4,5,6)
									//$jugadorEntra, ID DEL JUGADOR QUE VA A INGRESAR, (LIBERO)
									//$posicionEnSet // NOMBRE DE LA POSICION : LOCAL(A)/VISITANTE(B)+## POSICION:
									$jugadorSale = (int)$jugador1Local['0']['idjugador'];
									$posicion = 1;
									$jugadorEntra = $idLiberoActivoLocal;
									$posicionEnSet = 'A1';
									realizaCambio($modo,$partido,$fecha,$aclub,$categoriaPartido,$set,$anioEq,
													$jugadorSale,$Cat1Local,$posicion,
													$jugadorEntra,$CatLiberoActivoLocal,$posicionEnSet);
										break;
							case '5':
									//CAMBIO AL QUE ESTA EN LA POSICION 5
									$jugadorSale = (int)$jugador5Local['0']['idjugador'];
									$posicion = 5;
									$jugadorEntra = $idLiberoActivoLocal;
									$posicionEnSet = 'A5';

									realizaCambio($modo,$partido,$fecha,$aclub,$categoriaPartido,$set,$anioEq,
												$jugadorSale,$Cat5Local,$posicion,
												$jugadorEntra,$CatLiberoActivoLocal,$posicionEnSet);
									break;
							case '6':
									//CAMBIO AL QUE ESTA EN LA POSICION 6
									$jugadorSale = (int)$jugador6Local['0']['idjugador'];
									$posicion = 6;
									$jugadorEntra = $idLiberoActivoLocal;
									$posicionEnSet = 'A6';

									realizaCambio($modo,$partido,$fecha,$aclub,$categoriaPartido,$set,$anioEq,
												$jugadorSale,$Cat6Local,$posicion,
												$jugadorEntra,$CatLiberoActivoLocal,$posicionEnSet);
									break;
						}
				}
				// FIN ANALIZANDO CENTRALES  LOCALES
				// INICIO ANALIZANDO CENTRALES  VISITANTES
				$jugador1Visita = partjug::getJugSetVer($partido,$fecha,$bclub,$anioEq,$set,
									(int)$InicialJugLocal['0']['1B']);
				$jugador6Visita = partjug::getJugSetVer($partido,$fecha,$bclub,$anioEq,$set,
									(int)$InicialJugLocal['0']['6B']);
				$jugador5Visita = partjug::getJugSetVer($partido,$fecha,$bclub,$anioEq,$set,
									(int)$InicialJugLocal['0']['5B']);

									// echo "<br>UNO visita <br>";
									// print_r($jugador1Visita);
									// echo "<br>SEIS visita <br>";
									// print_r($jugador6Visita);
									// echo "<br>CINCO visita <br>";
									// print_r($jugador5Visita);

				if(count($jugador1Visita)>0 && count($jugador6Visita)>0 && count($jugador5Visita)>0)
				{
					$PuestoPostajugadorUNOVisita = (int)$jugador1Visita['0']['puestoxcat'];
					if($jugador1Visita['0']['puesto'] != $jugador1Visita['0']['puestoxcat'])
							$PuestoPostajugadorUNOVisita = (int)$jugador1Visita['0']['puesto'];
					$Cat1Visita = $jugador1Visita['0']['categoria'];

					$PuestoPostajugadorSEISVisita = (int)$jugador6Visita['0']['puestoxcat'];
					if($jugador6Visita['0']['puesto'] != $jugador6Visita['0']['puestoxcat'])
							$PuestoPostajugadorSEISVisita = (int)$jugador6Visita['0']['puesto'];
					$Cat6Visita = $jugador6Visita['0']['categoria'];

					// mayo 2023, se agrega para el analisis la posicion v
						$PuestoPostajugadorCINCOVisita = (int)$jugador5Visita['0']['puestoxcat'];
						if($jugador5Visita['0']['puesto'] != $jugador5Visita['0']['puestoxcat'])
								$PuestoPostajugadorCINCOVisita = (int)$jugador5Visita['0']['puesto'];
						$Cat5Visita = $jugador5Visita['0']['categoria'];
					// mayo 2023, se agrega para el analisis la posicion v

					$idLiberoActivoVisita  = retornaLibero($JugActivosVisita);
					$CatLiberoActivoVisita = retornaCategoria($JugActivosVisita,2);

					$elegido =	elegirJugadorCentral($PuestoPostajugadorUNOVisita, $PuestoPostajugadorSEISVisita, $PuestoPostajugadorCINCOVisita); // return '1' o '5' o '6';
					// echo "elegido visitante...: ".$elegido."<br>";
					switch($elegido)
					{
						case '1':
								//CAMBIO AL QUE ESTA EN EL 1 POR EL LIBERO ACTIVO.
								//como hacer el cambio:
								//$jugadorSale ID JUGADOR QUE SALE (CENTRAL)
								//$posicion // EN QUE POSICION NUMERICA SE HALLABA (1,2,3,4,5,6)
								//$jugadorEntra, ID DEL JUGADOR QUE VA A INGRESAR, (LIBERO)
								//$posicionEnSet // NOMBRE DE LA POSICION : LOCAL(A)/VISITANTE(B)+## POSICION:
								$jugadorSale = (int)$jugador1Visita['0']['idjugador'];
								$posicion = 1;
								$jugadorEntra = $idLiberoActivoVisita;
								$posicionEnSet = 'B1';
								realizaCambio($modo,$partido,$fecha,$bclub,$categoriaPartido,$set,$anioEq,
												$jugadorSale,$Cat1Visita,$posicion,
												$jugadorEntra,$CatLiberoActivoVisita,$posicionEnSet);
									break;
						case '5':
								//CAMBIO AL QUE ESTA EN LA POSICION 5
								$jugadorSale = (int)$jugador5Visita['0']['idjugador'];
								$posicion = 5;
								$jugadorEntra = $idLiberoActivoVisita;
								$posicionEnSet = 'B5';
								realizaCambio($modo,$partido,$fecha,$bclub,$categoriaPartido,$set,$anioEq,
												$jugadorSale,$Cat5Visita,$posicion,
												$jugadorEntra,$CatLiberoActivoVisita,$posicionEnSet);
								break;
						case '6':
								//CAMBIO AL QUE ESTA EN LA POSICION 6
								$jugadorSale = (int)$jugador6Visita['0']['idjugador'];
								$posicion = 6;
								$jugadorEntra = $idLiberoActivoVisita;
								$posicionEnSet = 'B6';
								realizaCambio($modo,$partido,$fecha,$bclub,$categoriaPartido,$set,$anioEq,
												$jugadorSale,$Cat6Visita,$posicion,
												$jugadorEntra,$CatLiberoActivoVisita,$posicionEnSet);
								break;
					}

										// // // // // // // // //CASOS:
										// // // // // // // // //EN 1 Y EN 6 HAY UN CENTRAL. LO REEMPLAZO EN 1
										// // // // // // // // if($PuestoPostajugadorUNOVisita == 6 && $PuestoPostajugadorSEISVisita == 6)
										// // // // // // // // {
										// // // // // // // // 	//CAMBIO AL QUE ESTA EN EL 6 POR EL LIBERO ACTIVO.
										// // // // // // // // 	//como hacer el cambio:
										// // // // // // // // 	//$jugadorSale ID JUGADOR QUE SALE (CENTRAL)
										// // // // // // // // 	//$posicion // EN QUE POSICION NUMERICA SE HALLABA (1,2,3,4,5,6)
										// // // // // // // // 	//$jugadorEntra, ID DEL JUGADOR QUE VA A INGRESAR, (LIBERO)
										// // // // // // // // 	//$posicionEnSet // NOMBRE DE LA POSICION : LOCAL(A)/VISITANTE(B)+## POSICION:
										// // // // // // // // 		//b5 (visita, pos 5)
										// // // // // // // // 		$jugadorSale = (int)$jugador1Visita['0']['idjugador'];
										// // // // // // // // 		$posicion = 1;
										// // // // // // // // 		$jugadorEntra = $idLiberoActivoVisita;
										// // // // // // // // 		$posicionEnSet = 'B1';

										// // // // // // // // 	realizaCambio($modo,$partido,$fecha,$bclub,$categoriaPartido,$set,$anioEq,
										// // // // // // // // 				$jugadorSale,$Cat1Visita,$posicion,
										// // // // // // // // 				$jugadorEntra,$CatLiberoActivoVisita,$posicionEnSet);

										// // // // // // // // }
										// // // // // // // // else if($PuestoPostajugadorUNOVisita == 6)
										// // // // // // // // 		{
										// // // // // // // // 		//CAMBIO AL QUE ESTA EN LA POSICION 1
										// // // // // // // // 			//echo("Hay un central abajo en 1. Elijo reemplazar al 1");

										// // // // // // // // 		$jugadorSale = (int)$jugador1Visita['0']['idjugador'];
										// // // // // // // // 		$posicion = 1;
										// // // // // // // // 		$jugadorEntra = $idLiberoActivoVisita;
										// // // // // // // // 		$posicionEnSet = 'B1';

										// // // // // // // // 		realizaCambio($modo,$partido,$fecha,$bclub,$categoriaPartido,$set,$anioEq,
										// // // // // // // // 					$jugadorSale,$Cat1Visita,$posicion,
										// // // // // // // // 					$jugadorEntra,$CatLiberoActivoVisita,$posicionEnSet);

										// // // // // // // // 		}
										// // // // // // // // 		else
										// // // // // // // // 		{
										// // // // // // // // 			//CAMBIO AL QUE ESTA EN LA POSICION 6
										// // // // // // // // 		$jugadorSale = (int)$jugador6Visita['0']['idjugador'];
										// // // // // // // // 		$posicion = 6;
										// // // // // // // // 		$jugadorEntra = $idLiberoActivoVisita;
										// // // // // // // // 		$posicionEnSet = 'B6';

										// // // // // // // // 			//echo("Hay un central abajo en 6. Elijo reemplazar al 6");
										// // // // // // // // 		realizaCambio($modo,$partido,$fecha,$bclub,$categoriaPartido,$set,$anioEq,
										// // // // // // // // 						$jugadorSale,$Cat6Visita,$posicion,
										// // // // // // // // 						$jugadorEntra,$CatLiberoActivoVisita,$posicionEnSet);

										// // // // // // // // 		}
				}
				// FIN ANALIZANDO CENTRALES  VISITANTES
 }  // CLAVE POR CAMBI9O AUTOMATICO INICIAL...
   else
   {
   	if($modo == "CAMBIOAUTOMLIBCEN")
	{
   		//por rotacion, modo AUTOMATICO DURANTE EL PARTIDO...
    }
   }
 }

	print(json_encode(array('estado' => '1','mensaje' => 'Cambio exitoso')));

} //cierre POST


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

function realizaCambio($modo,$partido,$fecha,$iclub,$categoriaPartido,$set,$anioEq,
					   $jugadorSale,$categoriaSale,$posicion,
					   $jugadorEntra,$categoriaEntra,$posicionEnSet)
{
	//  echo "parametros de LA funcion: ";
	//  echo "";
	//  echo "realizaCambio($modo,$partido,$fecha,$iclub,$categoriaPartido,$set,$anioEq,
	//  				   $jugadorSale,$categoriaSale,$posicion,
	//  				   $jugadorEntra,$categoriaEntra,$posicionEnSet)";

 	//ACTUALIZO AL QUE SALE, LO PONGO EN MODO SUPLENTE.
	$retorno = partjug::updateSale($partido,$fecha,$iclub,
								   $categoriaSale,$jugadorSale,$set);
	//echo "Retorno Sale:  ";
	//print_r($retorno);
	//ACTUALIZO AL QUE ENTRA, LO PONGO EN EL LUGAR DONDE LLEGO POR PARAMETRO.
	$retorno = partjug::updateEntra($partido,$fecha,$iclub,
									$categoriaEntra,$set,$jugadorEntra,$posicion);
	//echo "Retorno Entra: ";
	//print_r($retorno);
	//LUEGO, NECESITO EL ULTIMO REGISTRO DEL set
	//PARA OBTENER QUIENES ESTAN EN CANCHA, Y REEMPLAZAR AL QUE SE ENCUENTRA EN ESE MOMENTO POR EL QUE SALIO.
	$secuenciaarray =  Sett::ultSecuencia($partido,$set,$fecha);
	$secuencia = 0;
	if( !empty($secuenciaarray) ) $secuencia = (int) $secuenciaarray[0]["secuencia"];

	//OBTENGO LO QUE ESTA HASTA AHORA
	$setData = Sett::getByIdUltimoRegistro($partido,$set,$secuencia,$fecha);
    //print_r($setData);

	//PREPARAO PARA INSERTAR UN NUEVO REGISTRO DEL SET:
	if($secuencia == 0) $secuencia = 1;
    else $secuencia++;

	//	Arreglamos las posiciones en un momento dado para que los suplentes esten bien y los que
	//  esten en cancha tambien
	$ListaInicialJugadores = partjugCab::getJugListaInicio($partido,$fecha,$iclub,
														   $anioEq,$categoriaPartido);


	$fecha2	 =	"";
	if(isset($_POST["fechapartido"]))
		$fecha2	 =	$_POST["fechapartido"];

	$horaset = "";
	if(isset($_POST["horas"]))
		$horaset = $_POST["horas"];



	$s = $fecha2." ".$horaset;
	$horaset = "'".$s."'"; // correcto !!!
	$posicion=0;
	// Actualizo las variables de posicion en Cancha
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

	// SE MANTIENE LO MISMO QUE TENIA EL ULTIMO REGISTRO DEL SET
	$estado = $setData['estado'];
	$puntoa = $setData['puntoa'];
	$puntob = $setData['puntob'];
	$saque = $setData['saque'];

	$estrategiaA = "''";
	$estrategiaA = "'".$setData['codigoStratA']."'";
	$estrategiaB = "''";
	$estrategiaB = "'".$setData['codigoStratB']."'";

	$ordenA =1;
		$ordenA = (int)$setData['ordenA'];
	$ordenB =1;
		$ordenB = (int)$setData['ordenB'];


	$contadorpausasA = $setData['CantPausaA'];
	$contadorpausasB = $setData['CantPausaB'];

	$retorno =0;
	if($modo == "PRESAQUEINICIAL")
			$mensaje = "'cambio de Liberos por Centrales (INICIO)...'";
		else
		  if($modo == "CAMBIOAUTOMLIBCEN")
		  			$mensaje = "'cambio de Liberos por Centrales (ROTACION)...'";
		  	else
		  			$mensaje = "'cambio de jugadores...'";

	//reubico los jugadores de la cancha segun quien entro y quien salió..
	$retorno = Sett::insert( $partido, $secuencia, $set, $fecha,$horaset,
							 $A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6,
							 $estado,$puntoa, $puntob,$saque,$estrategiaA,$estrategiaB,
							 $ordenA,$ordenB,
							 $mensaje,$contadorpausasA,$contadorpausasB);

	$retornoRotaciones = 0;
	$mensaje = "'cambio de Liberos por Centrales en posicion.$posicionEnSet'";
	// Actualizo Rotaciones para poder verlo mas tarde o para recuperar posiciones viejas..
		$retornoRotaciones = Rotaciones::insert($partido,$fecha,$set,$secuencia,$A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6,$mensaje,$iclub);

	//actualizo las posiciones a partir de lo que cambié en base en SET
	$secuenciaarray =  Sett::ultSecuencia($partido,$set,$fecha);
	$secuencia = 0;
	if( !empty($secuenciaarray) ) $secuencia = (int) $secuenciaarray[0]["secuencia"];
	$setData = Sett::getByIdUltimoRegistro($partido,$set,$secuencia,$fecha);

	guardarPosicionesActuales($ListaInicialJugadores,$jugadorEntra,$jugadorSale,
							$partido,$fecha,$iclub,$set,$setData);

}

function retornaLibero($VectorLiberos)
{
$IDLIBERO=0;
for($contador=0; $contador < count($VectorLiberos);$contador++ )
{ // recorro vector de jugadores del equipo A
    //[idjugador] => 148,[puestoxcat] => 2,[puesto] => 2
$XPUESTO = $zPUESTO = 0;
$XPUESTO     = $VectorLiberos[$contador]['puestoxcat'];
if($VectorLiberos[$contador]['puestoxcat'] != $VectorLiberos[$contador]['puesto'])
	$XPUESTO  = $VectorLiberos[$contador]['puesto'];

if($XPUESTO == 2) //LIBERO
		$IDLIBERO 	 =	$VectorLiberos[$contador]['idjugador'];
}
return $IDLIBERO;
}

function retornaCategoria($VectorActivos,$ipuesto)
{
$CategReturn=0;
for($contador=0; $contador < count($VectorActivos);$contador++ )
{ // recorro vector de jugadores del equipo A
    //[idjugador] => 148,[puestoxcat] => 2,[puesto] => 2
$XPUESTO = $zPUESTO = 0;
$XPUESTO     = $VectorActivos[$contador]['puestoxcat'];
if($VectorActivos[$contador]['puestoxcat'] != $VectorActivos[$contador]['puesto'])
	$XPUESTO  = $VectorActivos[$contador]['puesto'];

if($XPUESTO == $ipuesto) //LIBERO
		$CategReturn 	 =	$VectorActivos[$contador]['categoria'];
}
return $CategReturn;
}

function elegirJugadorCentral($PtoJdorUNO, $PtoJdorSEIS, $PtoJdorCinco)
 {
///	echo "<br>funcion: elegirJugadorCentral, parametros: $PtoJdorUNO, $PtoJdorSEIS, $PtoJdorCinco <br>";
	if ($PtoJdorUNO == 6 && $PtoJdorSEIS == 6 && $PtoJdorCinco == 6) {
	  return '1';
	} else if ($PtoJdorUNO == 6 && $PtoJdorSEIS != 6 && $PtoJdorCinco != 6) {
	  return '1';
	} else if ($PtoJdorUNO == 6 && $PtoJdorSEIS == 6 && $PtoJdorCinco != 6) {
	  return '1';
	} else if ($PtoJdorUNO != 6 && $PtoJdorSEIS == 6 && $PtoJdorCinco != 6) {
	  return '6';
	} else if ($PtoJdorUNO != 6 && $PtoJdorSEIS == 6 && $PtoJdorCinco == 6) {
	  return '6';
	} else if ($PtoJdorUNO != 6 && $PtoJdorSEIS != 6 && $PtoJdorCinco == 6) {
	  return '5';
	}
	// else {
	//   return 'No elijo ninguna zona';
	// }

			// // // // // // // // // if($PuestoPostajugadorUNOLocal == 6 && $PuestoPostajugadorSEISLocal == 6)
			// // // // // // // // // {
			// // // // // // // // // 		//CAMBIO AL QUE ESTA EN EL 1 POR EL LIBERO ACTIVO.
			// // // // // // // // // 		//como hacer el cambio:
			// // // // // // // // // 		//$jugadorSale ID JUGADOR QUE SALE (CENTRAL)
			// // // // // // // // // 		//$posicion // EN QUE POSICION NUMERICA SE HALLABA (1,2,3,4,5,6)
			// // // // // // // // // 		//$jugadorEntra, ID DEL JUGADOR QUE VA A INGRESAR, (LIBERO)
			// // // // // // // // // 		//$posicionEnSet // NOMBRE DE LA POSICION : LOCAL(A)/VISITANTE(B)+## POSICION:
			// // // // // // // // // 			//A5 (local, pos 5)
			// // // // // // // // // 			$jugadorSale = (int)$jugador1Local['0']['idjugador'];
			// // // // // // // // // 			$posicion = 1;
			// // // // // // // // // 			$jugadorEntra = $idLiberoActivoLocal;
			// // // // // // // // // 			$posicionEnSet = 'A1';

			// // // // // // // // // 			realizaCambio($modo,$partido,$fecha,$aclub,$categoriaPartido,$set,$anioEq,
			// // // // // // // // // 						$jugadorSale,$Cat1Local,$posicion,
			// // // // // // // // // 						$jugadorEntra,$CatLiberoActivoLocal,$posicionEnSet);
			// // // // // // // // // }
			// // // // // // // // // else if($PuestoPostajugadorUNOLocal == 6)
			// // // // // // // // // 			{
			// // // // // // // // // 			//CASO 2: SOLO HAY UN CENTRAL Y ESTA EN 1
			// // // // // // // // // 			//CAMBIO AL QUE ESTA EN LA POSICION 1
			// // // // // // // // // 				$jugadorSale = (int)$jugador1Local['0']['idjugador'];
			// // // // // // // // // 				$posicion = 1;
			// // // // // // // // // 				$jugadorEntra = $idLiberoActivoLocal;
			// // // // // // // // // 				$posicionEnSet = 'A1';

			// // // // // // // // // 				realizaCambio($modo,$partido,$fecha,$aclub,$categoriaPartido,$set,$anioEq,
			// // // // // // // // // 							$jugadorSale,$Cat1Local,$posicion,
			// // // // // // // // // 							$jugadorEntra,$CatLiberoActivoLocal,$posicionEnSet);
			// // // // // // // // // 			}
			// // // // // // // // // 			else
			// // // // // // // // // 			{
			// // // // // // // // // 				//CASI 3: SOLO HAY UN CENTRAL , Y ESTA EN 6
			// // // // // // // // // 				// chequeamos que sino hay un central en esta posi, lo busco en la zona 5 y si es central
			// // // // // // // // // 				// lo cambio sino nada
			// // // // // // // // // 				if( $PuestoPostajugadorSEISLocal == 6 )
			// // // // // // // // // 				{
			// // // // // // // // // 				$jugadorSale = (int)$jugador6Local['0']['idjugador'];
			// // // // // // // // // 				$posicion = 6;
			// // // // // // // // // 				$jugadorEntra = $idLiberoActivoLocal;
			// // // // // // // // // 				$posicionEnSet = 'A6';

			// // // // // // // // // 				//CAMBIO AL QUE ESTA EN LA POSICION 6
			// // // // // // // // // 				realizaCambio($modo,$partido,$fecha,$aclub,$categoriaPartido,$set,$anioEq,
			// // // // // // // // // 							$jugadorSale,$Cat6Local,$posicion,
			// // // // // // // // // 							$jugadorEntra,$CatLiberoActivoLocal,$posicionEnSet);
			// // // // // // // // // 				else if($PuestoPostajugadorCINCOLocal == 6)
			// // // // // // // // // 					 {
			// // // // // // // // // 						$jugadorSale = (int)$jugador5Local['0']['idjugador'];
			// // // // // // // // // 						$posicion = 5;
			// // // // // // // // // 						$jugadorEntra = $idLiberoActivoLocal;
			// // // // // // // // // 						$posicionEnSet = 'A5';

			// // // // // // // // // 						//CAMBIO AL QUE ESTA EN LA POSICION 6
			// // // // // // // // // 						realizaCambio($modo,$partido,$fecha,$aclub,$categoriaPartido,$set,$anioEq,
			// // // // // // // // // 									$jugadorSale,$Cat5Local,$posicion,
			// // // // // // // // // 									$jugadorEntra,$CatLiberoActivoLocal,$posicionEnSet);

			// // // // // // // // // 					 }
			// // // // // // // // // 					 else
			// // // // // // // // // 					  {
			// // // // // // // // // 						// NO HAY CAMBIO
			// // // // // // // // // 					  }

			// // // // // // // // // 				}
			// // // // // // // // // 			}

  }

?>
