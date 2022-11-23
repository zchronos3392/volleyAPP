<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require 'Jugador.php';
require 'JugadorPuestos.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
	// Decodificando <	
	$iclubescab = $_POST["iclubescab"]; //iclubescab: 1
	$icatcab = $_POST["icatcab"]; //icatcab: 2
		// nuevo agregado 2019:
	$ianio = 0;
		$ianio   = $_POST["ianio"];
			
	// se cargan tres vectores con el mismo indice !!!
	
	$numero = 999;
	//if(isset($_POST["NumeroEnClub"])) $numero = $_POST["NumeroEnClub"];
	
	$nombre = "'".$_POST["nombreJugador"]."'";
	$edad = $_POST["edadJugador"]; 

	$ingresoClub = date_create()->format('Y-m-d');// fecha corecta de ahora
	$ingresoClub = "'".$ingresoClub."'";

	$retorno = jugador::insert($iclubescab,$ianio,$numero,$nombre,$edad,$ingresoClub,$icatcab,$icatcab);
	print_r($retorno);	

	$idjugador =0;
    $retorno = jugador::getId($iclubescab,$ianio,$ingresoClub);
    //print_r($retorno);
			if($retorno["0"]["idjugador"] > 0) $idjugador = $retorno["0"]["idjugador"];
	
	//echo"id del nuevo jugador : $idjugador";

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

		 	$retornoPos = puestojugador::insert($idjugador,$indice,$actualizaClub,$remeraNum,$icate,$puestoCate,$ianio,$iclubescab);
		 	
};



	
	
}

?>
