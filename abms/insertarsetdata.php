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
	$setnumero =  (int) $_POST['idset'];
	$fecha = "'".$_POST['fechas']."'";
	// obteniendo la ultima secuencia grabada.
	//ultima novedad del set 

	$secuenciaarray =  Sett::ultSecuencia($idpartido,$setnumero,$fecha);
	$secuencia = 0;
	//agregado 17 10 2019..popr saque erroneo de un equipo que no genera rotacion en el contrario
	//pero si punto..
	//$HayRotacion = $_POST['debeRotar'];
	$HayRotacion="N";
	//doc 2021: aviso de ROTACION INVERSA UNICAMENTE, SIN PUNTAJE
		$retrocesoRotacion = "";
		if(isset($_POST['antirotacion'])) $retrocesoRotacion =   $_POST['antirotacion'];
		$quienAntiRota =0;
		if(isset($_POST['quienAntiRota']))
			$quienAntiRota = (int) $_POST['quienAntiRota']; // idclub
		$sentidoAntirotacion="";
		if(isset($_POST['sentido']))
		$sentidoAntirotacion = $_POST['sentido']; //       : FF o BW  
	//doc 2021: aviso de ROTACION INVERSA UNICAMENTE, SIN PUNTAJE

	if( !empty($secuenciaarray) ) $secuencia = (int) $secuenciaarray[0]["secuencia"];
	//si hay algo cargado para los parametros que llegaron,
	// traigo lo ultimo que tengo activo del Set.
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
	$fecha2 = $_POST['fechas'];	

	// Mantengo prendido el partido.
		Partido::UpdSts($idpartido,$fecha,$estado);
	//llegan popr parametro los resultados actuales visibles en pantalla.
	$puntoa = 0;
	$puntoa =  (int) $_POST['resa'];
	
	$puntob	 = 0;
	$puntob	 =  (int) $_POST['resb'];
	//llegan popr parametro los resultados actuales visibles en pantalla.

	$mensaje = "''";	//las funciones mandan mensajea a esta api para que tome decisiones.
	$saque = 0;
	// neccesito tener el dato de quien viene teniendo el Saque
	//  antes de decidir, sino no puedo cambiarlo.
		$saque = (int)$setData["saque"];
	//print_r($setData);
	//17 09 2019: Cada equipo tiene una X cantidad de pausas disponibles por Set
	$contadorpausasA = (int)$setData["CantPausaA"];	
	$contadorpausasB = (int)$setData["CantPausaB"];	
	//17 09 2019: Cada equipo tiene una X cantidad de pausas disponibles por Set

	$clubRota = 0;
//	"resa"      : resa,
//	"resb"      : resb,
	$rotar ="";
//	"rotacion" : rotar, viene N cuando es 
	if(isset($_POST['rotacion'])) $rotar	 =  $_POST['rotacion'];
	$mensajeAlta = "";
//  CUANDO SE REANUDA EL PARTIDO: "mensajeAlta" : 'Novedades30::REANUDAR'
	if(isset($_POST['mensajeAlta'])) $mensajeAlta = $_POST['mensajeAlta'];
	//02 DIC.2022::ENVIO LA ESTRATEGIA CON RESPECTO A LOS LIBEROS
		//PARA QUE SABER QUÉ HACER AUTOMATICAMENTE EN SUS CAMBIOS..
			$estrategiaA = "''";
			if(isset($_POST['estrategiaLA'])) $estrategiaA = "'".$_POST['estrategiaLA']."'";
			$estrategiaB = "''";
			if(isset($_POST['estrategiaLB'])) $estrategiaB = "'".$_POST['estrategiaLB']."'";

		//PARA QUE SABER QUÉ HACER AUTOMATICAMENTE EN SUS CAMBIOS..
	//02 DIC.2022::ENVIO LA ESTRATEGIA CON RESPECTO A LOS LIBEROS
	

//	DIC 2022.en mensajeAlta ahora puede venir:
//	CUANDO INDICO CAMBIO DE LIBERO POR CENTRAL DE POSICION TRASERA, VENDRA: 'Novedades::INISAQUE'
	//Trabajo con lo que tengo en tabla primero
	//:: INICIO DE TRABAJAR CON LA DATA DEL SET	
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
			// cuando hay punto, pero si lo que vino es otra cosa, ambos seguirán iguales.
			$puntoDB_a	= (int)$setData["puntoa"];
			$puntoDB_b	= (int)$setData["puntob"];
			
			
			$strategiaLocalAnalisis  = $setData["codigoStratA"];
			$strategiaVisitaAnalisis = $setData["codigoStratB"];
			
			$strategiaLocalAnalisis  = str_replace(' ', '', $strategiaLocalAnalisis);
			$strategiaVisitaAnalisis = str_replace(' ', '', $strategiaVisitaAnalisis);
			


			 $ordenLiberoLocal  = $setData["ordenA"];
			 $ordenLiberoVisita = $setData["ordenB"];

			// Si cambio el saque, guardo el otro club..
			//necesito conocer los id de cada club que juega
			//el A siempre es el Local, y el B visitante.
			$equipoA = (int)$setData["ClubA"];
			$equipoB = (int)$setData["ClubB"];
			$saquiEN = (int)$setData["saque"];
		// Para entender la ROTACION AUTOMATICA:
				// ¿Quien "tenia" el saque?..., lo comparo
			// 		contra el equipo que hizo el punto (A/B)
			// Si cambio el saque, guardo el otro club..			
			//tenia saque el equipo A, pero vino punto de B, significa que HAY QUE ROTAR
	//	"rotacion" : rotar, viene N cuando es 

			$fecha = "'".$fecha2."'";
			$anioEqActivos  = (int)substr($fecha,1,4);
			$JugActivosLocal  = partjug::getListaActivos($idpartido,$fecha,$equipoA,$anioEqActivos,$setnumero);
			$EnCanchadosLocal  = array();
			$EnCanchadosVisita = array();


			$JugActivosVisita = partjug::getListaActivos($idpartido,$fecha,$equipoB,$anioEqActivos,$setnumero);
	//   ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::	
    //:: INICIO ANALISIS DE ROTACION ::
	if($rotar == "" || $rotar != "N")
	{
				//CASO UNO: VISITANTE HIZO PUNTO O ANTIROTA/ROTACION ANTINATURAL
				// ROTACIONES FORZADAS PARA ARREGLAR LAS POSICIONES
				// si al rotar, el libero queda en 2,3,4 lo saco y pongo a un central...
				// CUAL CENTRAL ELIJO?
				// QUE CAMPOS ME QUEDAN LIBRES EN JUGPARTIDO?
				if($retrocesoRotacion == "S" && ($equipoA == $quienAntiRota)  )
				{
						// ACCION:::ROTACION FORZADA DEL LOCAL..
							//no toco los libetos ni los centrales
							//esta rotacion es para arreglar.
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
				// ROTACION::"NATURAL" 
				// aca podria cambiar al libero por el CENTRAL
				//viene distinto de Cero el que hizo el tanto.
				// Aca la pregunta sería: ¿Hizo punto Visita y estaba sacando Local?
				// Rta: perdió el saque el Local.Rota Visitante
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

							//cambiamos el libero del que tenga la estrategia de cambio
							// pero necesito saber en que posicion se encuentra...
							$EnCanchadosLocal  = array(array("A1",$A1),array("A2",$A2),array("A3",$A3),array("A4",$A4),array("A5",$A5),array("A6",$A6));
							$datosIngresaLocal = elegirLibero($JugActivosLocal,$EnCanchadosLocal,$strategiaLocalAnalisis,$ordenLiberoLocal,$idpartido,$fecha,$equipoA,$setnumero);

							if($strategiaLocalAnalisis != 'UNLIBERO')
							{
								echo "<br> datosIngresaLocal <br>";
								print_r($datosIngresaLocal);
								echo "<br>  <br>";

								$A1 = (int) $datosIngresaLocal[0][1];
								$A2 = (int) $datosIngresaLocal[1][1];
								$A3 = (int) $datosIngresaLocal[2][1];
								$A4 = (int) $datosIngresaLocal[3][1];
								$A5 = (int) $datosIngresaLocal[4][1];
								$A6 = (int) $datosIngresaLocal[5][1];
									
							}


							$EnCanchadosVisita = array(array("B1",$B1),array("B2",$B2),array("B3",$B3),array("B4",$B4),array("B5",$B5),array("B6",$B6));
							$datosIngresaVisita = elegirLibero($JugActivosVisita,$EnCanchadosVisita,$strategiaVisitaAnalisis,$ordenLiberoVisita,$idpartido,$fecha,$equipoB,$setnumero);

							if($strategiaVisitaAnalisis != 'UNLIBERO')
							{

							echo "<br> datosIngresaVisita <br>";
							print_r($datosIngresaVisita);
							echo "<br>  <br>";

							$B1 = (int) $datosIngresaVisita[0][1];
							$B2 = (int) $datosIngresaVisita[1][1];
							$B3 = (int) $datosIngresaVisita[2][1];
							$B4 = (int) $datosIngresaVisita[3][1];
							$B5 = (int) $datosIngresaVisita[4][1];
							$B6 = (int) $datosIngresaVisita[5][1];

							}
							// NECESITO SABER LA LISTA DE PERSONAS EN CANCHA, PARA VER CUAL ES EL LIBERO !!!

							// ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
							//	DICIEMBRE 2022.CAMBIO AUTOMATICO DEL LIBERO X CENTRALES
							$B4auxiliar=$B4;
							// Estos tres parametros hacen a la funcion generica.
							// en este caso, si llego un libero a la posicion 4, poongo un central de la lista 
							// de activos..
							$puestoAnalisis   = 2; // LIBERO
							$puestoCambia     = 6; // CENTRAL 
							$posicionAnalisis = 4; // POSICION 4 EN CANCHA.
							//$ordenB=0; //no importa en este cambio...
							// Estos tres parametros hacen a la funcion generica.
							$B4 = analizarCambioAutomatico($idpartido,$fecha2,$setnumero,
									 $secuencia,$B4auxiliar,$equipoB,
									 $posicionAnalisis,$puestoAnalisis,$puestoCambia);
							//2.2 CHEQUEO SI EN EL EQUIPO QUE PERDIÓ EL SAQUE,
							// HAY UN CENTRAL EN LA POSICION 1, entonces LO CAMBIO 
							//AUTOMATICAMENTE POR EL LIBERO ACTIVO SUPLENTE DE SU EQUIPO,
							//SI EL CENTRAL DEL EQUIPO QUE PERDIO EL SAQUE ESTABA EN 
							//LA POSICION 1, LO CAMBIO POR EL LIBERO(ACTIVO) de ese Equipo)
							$A1auxiliar=$A1;
							// Estos tres parametros hacen a la funcion generica.
							$puestoAnalisis   = 6; // CENTRAL
							$puestoCambia     = 2; // LIBERO 
							$posicionAnalisis = 1; // POSICION 1 EN CANCHA.
							// Estos tres parametros hacen a la funcion generica.
							// traigo el orden desde el SET !!!
							//$ordenA=$setData["ordenA"];
							$A1 = analizarCambioAutomatico($idpartido,$fecha2,$setnumero,
									 $secuencia,$A1auxiliar,$equipoA,
									 $posicionAnalisis,$puestoAnalisis,$puestoCambia);
							//	DICIEMBRE 2022.CAMBIO AUTOMATICO DEL LIBERO X CENTRALES
							// ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::							
						}
			    }	
			    //CASO DOS: LOCAL HIZO PUNTO O ANTIROTA/ROTACION ANTINATURAL
			    //tenia saque el equipo B, pero vino punto de A
				//print("puntoa: ".$puntoa."<br>");
				// ROTACIONES FORZADAS PARA ARREGLAR LAS POSICIONES
				// si al rotar, el libero queda en 2,3,4 lo saco y pongo a un central...
				// CUAL CENTRAL ELIJO?
				// QUE CAMPOS ME QUEDAN LIBRES EN JUGPARTIDO?
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
				// ROTACIONES "NATURAL" 
				// aca podria cambiar al libero por el CENTRAL
				//viene distinto de Cero el que hizo el tanto.
				// Aca la pregunta sería: ¿Hizo punto Visita y estaba sacando Local?
				// Rta: perdió el saque el Local.Rota Visitante
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
							// ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
							//	DICIEMBRE 2022.CAMBIO AUTOMATICO DEL LIBERO X CENTRALES
							$A4auxiliar = $A4;
							// Estos tres parametros hacen a la funcion generica.
							$puestoAnalisis   = 2; // LIBERO
							$puestoCambia     = 6; // CENTRAL 
							$posicionAnalisis = 4; // POSICION 4 EN CANCHA.

							$EnCanchadosLocal  = array(array("A1",$A1),array("A2",$A2),array("A3",$A3),array("A4",$A4),array("A5",$A5),array("A6",$A6));
							$datosIngresaLocal = elegirLibero($JugActivosLocal,$EnCanchadosLocal,$strategiaLocalAnalisis,$ordenLiberoLocal,$idpartido,$fecha,$equipoA,$setnumero);

							if($strategiaLocalAnalisis != 'UNLIBERO')
							{

							echo "<br> datosIngresaLocal <br>";
							print_r($datosIngresaLocal);
							echo "<br>  <br>";
							
								$A1 = (int) $datosIngresaLocal[0][1];
								$A2 = (int) $datosIngresaLocal[1][1];
								$A3 = (int) $datosIngresaLocal[2][1];
								$A4 = (int) $datosIngresaLocal[3][1];
								$A5 = (int) $datosIngresaLocal[4][1];
								$A6 = (int) $datosIngresaLocal[5][1];
							}			

							$EnCanchadosVisita = array(array("B1",$B1),array("B2",$B2),array("B3",$B3),array("B4",$B4),array("B5",$B5),array("B6",$B6));
							$datosIngresaVisita = elegirLibero($JugActivosVisita,$EnCanchadosVisita,$strategiaVisitaAnalisis,$ordenLiberoVisita,$idpartido,$fecha,$equipoB,$setnumero);

							if($strategiaVisitaAnalisis != 'UNLIBERO')
							{
								echo "<br> datosIngresaVisita <br>";
								print_r($datosIngresaVisita);
								echo "<br>  <br>";

									$B1 = (int) $datosIngresaVisita[0][1];
									$B2 = (int) $datosIngresaVisita[1][1];
									$B3 = (int) $datosIngresaVisita[2][1];
									$B4 = (int) $datosIngresaVisita[3][1];
									$B5 = (int) $datosIngresaVisita[4][1];
									$B6 = (int) $datosIngresaVisita[5][1];
							}	

							// NECESITO SABER LA LISTA DE PERSONAS EN CANCHA, PARA VER CUAL ES EL LIBERO !!!
							// Estos tres parametros hacen a la funcion generica.
							$A4 = analizarCambioAutomatico($idpartido,$fecha2,$setnumero,
					  				 $secuencia,$A4auxiliar,$equipoA,
									 $posicionAnalisis,$puestoAnalisis,$puestoCambia);

							//2.2 CHEQUEO SI EN EL EQUIPO QUE PERDIÓ EL SAQUE,
							// HAY UN CENTRAL EN LA POSICION 1, entonces LO CAMBIO 
							//AUTOMATICAMENTE POR EL LIBERO ACTIVO SUPLENTE DE SU EQUIPO,
							//SI EL CENTRAL DEL EQUIPO QUE PERDIO EL SAQUE ESTABA EN 
							//LA POSICION 1, LO CAMBIO POR EL LIBERO(ACTIVO) de ese Equipo)
							$B1auxiliar=$B1;
							// Estos tres parametros hacen a la funcion generica.
							$puestoAnalisis   = 6; // CENTRAL
							$puestoCambia     = 2; // LIBERO 
							$posicionAnalisis = 1; // POSICION 1 EN CANCHA.
							//$ordenB=$setData["ordenB"];
							// Estos tres parametros hacen a la funcion generica.
							$B1 = analizarCambioAutomatico($idpartido,$fecha2,$setnumero,
									 $secuencia,$B1auxiliar,$equipoB,
									 $posicionAnalisis,$puestoAnalisis,$puestoCambia);
							//	DICIEMBRE 2022.CAMBIO AUTOMATICO DEL LIBERO X CENTRALES
							// ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::							
						}
			    }	
   	}	
   	  //:: FIN ANALISIS DE ROTACION :: natural y antinatural
	//   ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	// aca hay un error logico, porque que uno venga en 0 se usa como FLAG !!
	//PERO PARA GRABARLO EN BASE, NECESITO A LOS DOS
	// ENTONCES GRABO EL VIEJO VALOR PARA EL EQUIPO QUE NO MANDO SU PUNTAJE
	//EL QUE MANDA PUNTAJE ES EL QUE HIZO EL TANTO.

		// Como solo mando el resultado que cambió,como una especie de FLAG,
		//    si viene con valor, significa que es el que hizo punto
		// Para guardar en la base, luego de analizar quien rotó
		// 	cargo el que vino en 0
			if($puntoa == 0) $puntoa = $puntoDB_a;// hay que hacerlo aca al final, sino no lo puedo usar como flag
			if($puntob == 0) $puntob = $puntoDB_b;	

			//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::	
			//ANALIZO EL ORDEN:si la estrategia, segun el equipo, es ALTERNAR, guardo para la siguiente ronda, al otro.. 
				// ORDEN PARA LOCAL..
				if($strategiaLocalAnalisis == 'UNLIBERO')
				{
					$ordenLiberoLocal=1; //se mantiene el primero..
				}
				else
				{
					$ordenLiberoLocal++;
					//va alternando entre los valores 0,1,2
						if($ordenLiberoLocal == 3) $ordenLiberoLocal=1;
				}

				// ORDEN PARA VISITA, EN CASO DE TENER..
				if($strategiaVisitaAnalisis == 'UNLIBERO')
				{
					$ordenLiberoVisita=1; //se mantiene el primero..
				}
				else
				{
					$ordenLiberoVisita++;
					//va alternando entre los valores 0,1,2
						if($ordenLiberoVisita == 3) $ordenLiberoVisita=1;
				}			
			//ANALIZO EL ORDEN:si la estrategia, segun el equipo, es ALTERNAR, guardo para la siguiente ronda, al otro.. 
			//::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::	
			
	};
	//:: FIN DE TRABAJAR CON LA DATA DEL SET	

//  CUANDO SE REANUDA EL PARTIDO: "mensajeAlta" : 'Novedades30::REANUDAR'
//	if(isset($_POST['mensajeAlta'])) $mensajeAlta = $_POST['mensajeAlta'];

// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// CARGAMOS TODO LO QUE NO CAMBIÓ, PARA INSERTAR NUEVO REGISTRO
	$fecha =  $_POST['fechas'];
	$hora =  $_POST['horas'];
		$s = $fecha." ".$hora;
		$horaset = "'".$s."'"; // ARMADO DE HORA correcto PARA LA BASE!!!
  $fecha2 = "'".$_POST['fechas']."'";
	// revisar cual vino en cero, y traerlo de la base con la ultima secuencia...
	// $saque = 0; ver quine saca, en caso de haber cambiado..
    // Insertar Set
	$retorno =0;
	if($mensajeAlta == 'Novedades30::REANUDAR')
			$mensaje = '"Se reanuda el partido"';
	if($mensajeAlta == 'Novedades30::ESTRATEGIA')
	{
			if($estrategiaA != $strategiaLocalAnalisis) {
				$mensaje = '"Cambios en la estrategia del líbero Local."';			
				$strategiaLocalAnalisis = $estrategiaA;
			}
			else
				$strategiaLocalAnalisis = "'".$strategiaLocalAnalisis."'";
			
			if($estrategiaB != $strategiaVisitaAnalisis)
			{
				$mensaje = '"Cambios en la estrategia del líbero Visitante."';			
				$strategiaVisitaAnalisis = $estrategiaB; 
			}
			else
				$strategiaVisitaAnalisis = "'".$strategiaVisitaAnalisis."'";
			
	}

	if($mensajeAlta == 'Novedades::INISAQUE')
			$mensaje = '"Ingresa el Libero por Central.Posiciones Iniciales."';

	if($strategiaLocalAnalisis[0] != "'")
		$strategiaLocalAnalisis = "'".$strategiaLocalAnalisis."'";
	if($strategiaVisitaAnalisis[0] != "'")
		$strategiaVisitaAnalisis = "'".$strategiaVisitaAnalisis."'";
	
		//INGRESO REGISTRO DEL SET con sus actualizaciones.		
	$retorno = Sett::insert( $idpartido, $secuencia, $setnumero, $fecha2,$horaset,
							 $A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6,
							 $estado,$puntoa, $puntob,$saque,$strategiaLocalAnalisis,$strategiaVisitaAnalisis,
							 $ordenLiberoLocal,$ordenLiberoVisita,
							 $mensaje,$contadorpausasA,$contadorpausasB);
	
	$retornoRotaciones = 0;
	if($secuencia == 1) $mensaje = "'por pitada inicial del partido...'";
	else if($HayRotacion=='S')	$mensaje = "'por rotacion durante el partido...'";

	//NO SE GUARDAN LAS ANTIROTACIONES
	if($HayRotacion=='S')
		$retornoRotaciones = Rotaciones::insert($idpartido,$fecha2,$setnumero,$secuencia,$A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6,$mensaje,$saque);
// CARGAMOS TODO LO QUE NO CAMBIÓ, PARA INSERTAR NUEVO REGISTRO
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    if($retorno)
    {
        // Codigo de �xito
        print(json_encode(array('estado' => '1','mensaje' => 'Creacion exitosa')));
    } else 
    {
        // Codigo de falla
		print(json_encode(array('estado' => '2','mensaje' => 'Creacion NO exitosa')));
    }
}

//	DICIEMBRE 2022.CAMBIO AUTOMATICO DEL LIBERO X CENTRALES
function analizarCambioAutomatico($idpartido, $FechaFormatoOk,$setnumero,$secuencia,
												$jugPosAnalisis,$equipo,
												$posicionAnalisis,$puestoSale,$puestoIngresa)
{
//echo("parametroas de la funcion : analizar Cambio Automatico ");
//echo("($idpartido, $FechaFormatoOk,$setnumero,$secuencia,$jugPosAnalisis,$equipo,
//		$posicionAnalisis,$puestoSale,$puestoIngresa)");

$jugPosAnalizada = 	$jugPosAnalisis;
// podria venir en 0 porque no cargue al equipo..con ningun puestoo..etc
if($jugPosAnalisis != 0){

//analizo la posicion ($posicionAnalisis) (si es LIBERO, LO CAMBIO POR EL CENTRAl Activo Suplente)
  $fecha = "'".$FechaFormatoOk."'";
  $anioEq  = (int)substr($fecha,1,4);
  //echo "anio de juego captado:  $anioEq ";
  //va a llegar un jugador ($jugPosAnalisis)
  // para analis en la posicion ($posicionAnalisis)
  $jugadorLlegaPosX  = partjug::getJugSetVer($idpartido,$fecha,$equipo,$anioEq,$setnumero,
  											 $jugPosAnalisis);
  //echo("datos del jugador que llego a la posicion X ($posicionAnalisis) ");
  //print_r($jugadorLlegaPosX);

  // necesito conocer el puesto en el que esta jugando ahora en cancha dicho jugador:
	$puestoPosta = $jugadorLlegaPosX['0']['puestoxcat'];
	$puestoCancha =  $jugadorLlegaPosX['0']['puesto'];
	if($puestoPosta != $puestoCancha)
				$puestoPosta  = $puestoCancha;
   // necesito conocer el puesto en el que esta jugando ahora en cancha dicho jugador:

   //lo comparo con el puesto que tiene que SALIR.($puestoSale)
   	if($puestoPosta  == $puestoSale)//es un LIBERO o CENTRAL DEL EQUIPO QUE PERDIO EL SAQUE
   	{
   		$categoriaSale = $jugadorLlegaPosX['0']['categoria'];
		//REALIZO EL CAMBIO POR EL ($puestoIngresa) ACTIVO (que deberia estar SUPLENTE)
		//traigo la lista de ($puestoIngresa) activos.

		$JugActivosClub  = partjug::getListaActivos($idpartido,$fecha,$equipo,$anioEq,$setnumero);
//		echo("lista activos: ");
//		print_r($JugActivosClub);
/*
    [X] => Array LIBERO/CENTRAL/E/S
            [categoria] => 19
            [idjugador] => 149
            [idclub] => 83
            [posicion] => 7
            [puestoxcat] => 6
            [puesto] => 6
			[Orden] => 0 o 1 o 2 o 3...etc
*/
		// Busco al ($puestoIngresa):Solo recibo informacion del puesto que deberia
		// INGRESAR, pero no se quien puede ser, por eso lo busco. 
		$IDIngresa=$CatIngresa=0;	

 
		//JUNIO 2023:  aca tendria que enviar el orden por parametro, para obtener ese segun estrategia	
		for($contador=0; $contador < count($JugActivosClub);$contador++ )
		{ // recorro vector de jugadores del equipo A
		    //[idjugador] => 148,[puestoxcat] => 2,[puesto] => 2,[Orden] => 0,1,2,3...etc
			$XPUESTO = $zPUESTO = 0;
			$XPUESTO     = $JugActivosClub[$contador]['puestoxcat'];
			if($JugActivosClub[$contador]['puestoxcat'] != $JugActivosClub[$contador]['puesto'])
				$XPUESTO  = $JugActivosClub[$contador]['puesto'];

			$posicionIngresa = $JugActivosClub[$contador]['posicion'];
			//UN SUPLENTE QUE CUMPLE LAS CONDCIONES
			if($XPUESTO == $puestoIngresa && $posicionIngresa == 7) //Central ENTRA/LIBERO entra
			{
			//   SI ES UN LIBERO , OSEA PUESTOINGRESA == 2	
			  $IDIngresa     =	$JugActivosClub[$contador]['idjugador'];
			  $CatIngresa    =	$JugActivosClub[$contador]['categoria'];
			  //echo("ingresa: ".$IDIngresa);
			}
		}		
		// Luego de obtener al jugador que ($puestoIngresa),
		// PONGO EN SUPLENETE AL QUE ESTOY ANALIZANDO PARA SALIR..
		$retorno = partjug::updateSale($idpartido,$fecha,$equipo,
								   $categoriaSale,$jugPosAnalisis,$setnumero);

		// lo saco de suplente (asumo que estaba suplente) al que
		// quiero que ingrese.
		$retorno = partjug::updateEntra($idpartido,$fecha,$equipo,
									$CatIngresa,$setnumero,$IDIngresa,$posicionAnalisis);
		//y reemplazo su id con el del ($posicionAnalisis) al que pongo en 
		//modo suplente..
		$jugPosAnalizada = 	$IDIngresa;
	} 	
}	
return $jugPosAnalizada;

//	$jugadorLlegaPos4['0']
//	['numero'],['nombre'],['categoria'],['idjugador'],['idclub'],
//  ['puesto'],['posicion'],['activoSN'],['puestoxcat'],['remeraNum'],
//  ['ColorPuestoCat'],['ColorPuestoCancha']	

}												

//	DICIEMBRE 2022.CAMBIO ALTERNADO DEL LIBERO CUANDO CORRESPONDE
function elegirLibero($vectorJugadorX,$EnCanchados,$estrategia,$ordenActivo,
						$idpartido,$fecha,$equipo,$setnumero)
{

	echo("<br> ESTRATEGIA $estrategia");

	$idSeVa = $idIngresa = 0;
	$ordenSeva = $ordenIngresa = 0;
	$nombreSeVa = $nombreIngresa = "";
	$CategoriaSale = $CategoriaIngresa = 0;
	$posicionSale = $posicionIngresa = $posicionActualSale = 0;
	//	$EnCanchados  = array(["A1"=> $A1,"A2"=> $A2,"A3"=> $A3,"A4"=> $A4,"A5"=> $A5,"A6"=> $A6]);

	//    echo("<BR>Activos: ");
	//    print_r($vectorJugadorX);			   
	//    echo("<br>");

// echo("<br> Con la Strat: $estrategia, Libero a usar, deberia tener el orden  : $ordenActivo <br>");

if($estrategia == "ALTLIBACT")
{

	echo("<BR>EnCanchados (antes de cambiar/reconocer): ");
	print_r($EnCanchados);
	echo("<br>");

	// OBTENGO AL QUE SE VA
	for($contador=0; $contador < count($vectorJugadorX);$contador++ )
	{ // recorro vector de liberos del equipo X. 
			
			$XPUESTO = $zPUESTO = 0;
			$XPUESTO     = $vectorJugadorX[$contador]['puestoxcat'];
			if($vectorJugadorX[$contador]['puestoxcat'] != $vectorJugadorX[$contador]['puesto'])
				$XPUESTO  = $vectorJugadorX[$contador]['puesto'];
			// OBTENGO PRIMERO EL PUESTO REAL
				
			$posicionActual = $vectorJugadorX[$contador]['posicion'];
			//UN SUPLENTE QUE CUMPLE LAS CONDCIONES
			if($XPUESTO == 2 && $posicionActual != 7 ) // LIBERO QUE NO ES SUPLENTE.
			{
				$idSeVa = $vectorJugadorX[$contador]['idjugador'];
				$ordenSeva = $vectorJugadorX[$contador]['Orden'];
				$nombreSeVa = $vectorJugadorX[$contador]['nombre'];
				$CategoriaSale = $vectorJugadorX[$contador]['categoria'];
				$posicionSale = $posicionActual;
				ECHO"<br> LIBERO que sale:  $nombreSeVa (id $idSeVa) EN LA POSICION...$posicionActual y su orden es $ordenSeva <br>";
			}	
			if($XPUESTO == 2 && $posicionActual == 7 ) // LIBERO QUE ES SUPLENTE.
			{
				$idIngresa = $vectorJugadorX[$contador]['idjugador'];
				$ordenIngresa = $vectorJugadorX[$contador]['Orden'];
				$nombreIngresa = $vectorJugadorX[$contador]['nombre'];
				$CategoriaIngresa = $vectorJugadorX[$contador]['categoria'];
				$posicionIngresa = $posicionActual;
				ECHO"<br> LIBERO que ingresa: $nombreIngresa (id $idIngresa) esta EN LA POSICION...$posicionActual y su orden es $ordenIngresa <br>";
			}	

		
	}
	// OBTENGO AL QUE SE VA
}

// BUSCAR EN LOS ENCANCHADOS

//este vector tiene la posicion vieja del libero
//asi que tengo que cambiarla antes de analizar todo?
//SEGUN ESTRATEGIA:
switch ($estrategia) 
	{
		case "UNLIBERO":
			//echo "analiza UNLIBERO";
			//NO HAY CAMBIO. COMO ES EL MISMO devuelvo el mismo
			break;
		case "ALTLIBACT":
			// echo "strat ALTLIBACT cambiar liberos en cancha";
			for($contador2=0; $contador2 < count($EnCanchados);$contador2++ )
			{ // recorro vector de jugadores en cancha
				if($EnCanchados[$contador2][1] == $idSeVa)
				{
							// echo("<br>el libero a irse se encuentra en : ".$EnCanchados[$contador2][0]." con el id: ".$EnCanchados[$contador2][1]."<br>");
							// TENGO QUE OBTENER LA POSICION ACTUALIZADA DEL QUE SALE, PORQUE EN LA LISTA DE 
							// JUGADORES TOTAL, AUN NO FUE ROTADA SU POSICION, ENTONCES ESTA EN UNA ANTERIOR
							// EL DATO DE DONDE SE ENCUENTRA BIEN ESTA DENTRO DEL NOMBRE DE LA POSICION EN 
							// $EnCanchados[$contador2][0], ESPECIFICAMENTE EN EL SEGUNDO CARACTER, QUE INDICE EL 
							// NUMERO DE LA POSICION A DONDE TIENE QUE IR EL QE INGRESA
							$posicionActualSale = (int) $EnCanchados[$contador2][0][1];
							//   echo ("EL QUE INGRESA DEBE IR A LA POSICION $posicionActualSale <br>");
							$EnCanchados[$contador2][1] = $idIngresa;

							// PONGO DE SUPLENTE AL LIBERO QUE ESTABA EN CANCHA...Y EN LA LISTA DE POSICIONES ACTUALES	
							$retorno = partjug::updateSale($idpartido,$fecha,$equipo,$CategoriaSale,$idSeVa,$setnumero);

							// LO SACO DEL ESTADO "Suplente" (asumo que estaba suplente) al LIBERO que quiero que ingrese.
							$retorno = partjug::updateEntra($idpartido,$fecha,$equipo,$CategoriaIngresa,$setnumero,$idIngresa,$posicionActualSale);

							echo("<BR>EnCanchados (post de cambiar/reconocer): ");
							print_r($EnCanchados);
							echo("<br>");
						  
				}
			}	
			//CAMBIO AL LIBERO ACTIVO POR EL "OTRO"
			break;
	}			

return $EnCanchados;

}




?>
