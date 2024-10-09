<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require 'Jugador.php';
require 'JugadorPuestos.php';
require_once 'JugadorPartidoCab.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
	// Decodificando <	
	$idjugador  = $_POST["idjugador"];
	$iclubescab = $_POST["iclubescab"]; //iclubescab: 1
	$icatcab = $_POST["icatcab"]; //icatcab: 2
	$icatcabini = $_POST["icatcabini"]; //icatcab: 2
		// nuevo agregado 2019:
	//echo " llego como categoria inicio : $icatcabini";
	$ianio = 0;
		$ianio   = $_POST["ianio"];
	// Se cargan tres vectores con el mismo indice !!!
	$numero = $_POST["NumeroEnClub"];// lo traigo igual, porque esta oculto, no se va a cambiar...
	$nombre = $_POST["nombreJugador"];
	$edad = $_POST["edadJugador"]; 
	$ingresoClub = $_POST["inicioEnclub"]; 
// agregamos la baja Logica del jugador...
	$egresoClub = '';
	if(isset($_POST["egresoEnclub"]))
		$egresoClub = "'".$_POST["egresoEnclub"]."'"; 	

//	foreach($_POST as $campo => $valor){echo "<br>". $campo ." = ". $valor;}
/*	
ianio = 2021
idjugador = 97
NumeroEnClub = 6
nombreJugador = Leo
icatcab = 15
edadJugador = 1000
inicioEnclub = 2018-10-01
iclubescab = 9999
*/		

//CLAVE DE LA TABLA: 		
//	ianio = 2021
//	idjugador = 97
//	iclubescab = 83
//	nombreJugador = Leo //   	nombre='$nombre',
//	icatcab = 15    //	categoria=$categoria ".
//	edadJugador = 1000 //    edad=$edad,
//   	numero=$numero, lo traigo igual aunque no cambie mas...
	$retorno = jugador::updateABM($iclubescab,$ianio,$idjugador,$numero,$nombre,$edad,$ingresoClub,$icatcab,$icatcabini,$egresoClub);
	
	if(!$egresoClub == "''") 
		$retornoBaja = partjugCab::deleteJugadorBajaPartidos($egresoClub,$iclubescab,$icatcab,$idjugador);

	//Ahora actualizamos jugadorPosiciones:
	$regMax=0;
	if(isset($_POST["ultimoRegPuestos"]))
		$regMax  = $_POST["ultimoRegPuestos"];
	$actualizaClub = date_create()->format('Y-m-d H:i:s');// fecha corecta de ahora
	$actualizaClub = "'".$actualizaClub."'";
/*
ianio = 2021
idjugador = 97
NumeroEnClub = 6
nombreJugador = Leo
icatcab = 15
edadJugador = 1000
inicioEnclub = 2018-10-01
iclubescab = 9999

ultimoRegPuestos = 4
 	sdesccat_1 = 15,remenum_1 = 16,sjugadorp_1 = 3,fechalta_1 = 2021-02-06
	sdesccat_2 = 16,remenum_2 = 16,sjugadorp_2 = 3,fechalta_2 = 2021-04-08
	sdesccat_3 = 9 ,remenum_3 = 18,sjugadorp_3 = 6,fechalta_3 = 2021-04-08
	sdesccat_4 = 10,remenum_4 = 18,sjugadorp_4 = 2,fechalta_4 = 2021-04-08
*/		

$puestoscargados = array();//nuevo array de jugadores
for($indice = 1;$indice<=$regMax;$indice++){
foreach($_POST as $campo => $valor){
 		 switch($campo){
		 	case "sdesccat_".$indice:	
		 								$puestoscargados[$indice]["categoria"]= $valor;	
		 								break;
		 	case "remenum_".$indice:	
		 								$puestoscargados[$indice]["remenum"]= $valor;	
		 								break;
		 	case "sjugadorp_".$indice:	
		 								$puestoscargados[$indice]["puestos"]= $valor;	
		 								break;
		 	case "fechalta_".$indice:	
		 								$puestoscargados[$indice]["fechaingreso"]= $valor;	
		 								break;
		 };
	
 }
}

//	print_r($puestoscargados);
for($indice = 1;$indice<=$regMax;$indice++)
{
		 $icate = $puestoscargados[$indice]["categoria"];
		 $remeraNum = $puestoscargados[$indice]["remenum"];
		 $puestoCate = $puestoscargados[$indice]["puestos"];
		 //$fechaUpdate = //$puestoscargados[$indice]["fechaingreso"];	

			$existe = puestojugador::existePuesto($idjugador,$ianio,$iclubescab,$indice);
			//echo "<br>existe renglon ?<br>";
//			print_r($existe);
			if($existe["1"] == "1"){
			//	echo "existia <br>";
			$retornoPos = puestojugador::update($idjugador,$indice,$remeraNum,$icate,$puestoCate,$ianio,$iclubescab,$actualizaClub);
			}

		 	else{
		 	//	echo "<br>era nuevo <br>";
		 		$retornoPos = puestojugador::insert($idjugador,$indice,$actualizaClub,$remeraNum,$icate,$puestoCate,$ianio,$iclubescab);
							
			}
		 	
}
		 
}

?>
