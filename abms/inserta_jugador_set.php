<?php

require ('Set.php');
require_once('JugadorPartido.php');
// SIEMPRE SE HACE UPDATE SOBRE LA CARGA INICIAL DE LA POSICION...PERO AUN NO DEL PUESTO...
if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$partido =	$_POST["idpartido"];
	$s = $_POST["fechapartido"];
	$fecha	 =	"'".$_POST["fechapartido"]."'";
	$hora = "'".$s." ".$_POST['horas']."'";
	$setnumero =  (int) $_POST['setdata'];


	$iclub	 =	$_POST["iclubescab"];
	$icate 	 =	$_POST["icatcab"];
	$jugador =	$_POST["jugador"];
	$posicial = $_POST["posicion"];
	$puestoUpd= $_POST["puestoSet"];
// tengo que actualizar jugpartido y vappset
	
	$secuenciaarray =  Sett::ultSecuencia($partido,$setnumero,$fecha);
	$secuencia = 0;
	if( !empty($secuenciaarray) ) $secuencia = (int) $secuenciaarray[0]["secuencia"];

//	los disntintos modos son para saber si me traigo la posicion inicial
//	o si la tengo que grabar
/// en jugpartido siempre se inserta desde esta pagina..
// en set se podria actualizar el primer registro...
// comko se hacia en novades...
// y agregar en setdata que inserte un registro por cada poscion nueva del jugador..
// aunque solo seteando el nuevo registro de posiciones iniciale
// y los cambios cuando ocurren con eso bastaria jugpartido, asi no se llena innecesariamente..
//y seguimos usando VAPPSET COMO SIEMPRE

$retorno2 = 0;
//echo "<br>Secuencia de insercion numero : $secuencia<br>";
    //if($secuencia == 0)
	if($secuencia == 1)		
    { 
    	$secuencia = 1;
    	$modo='INS';
		//echo("$modo='INS'");
    	//ES CARGA DE POSICION INICIAL
    	// es un update		
    	//												popsicion INICIAL  POSICION ACTUAL
    	// VERIFICAR PRIMERO QUE NO EXISTA EL JUGADOR CON OTRA SECUENCIA, PARA EL MISMO SET:
		$retorno2 = partjug::setPos($partido,$fecha,$iclub,$icate,$jugador,$posicial,$posicial,$puestoUpd,$hora,$setnumero);
		//echo($retorno2);	
	}
    else { 
    	$modo='UPD';
			//echo("$modo='UPD'");
    	// ES UN CAMBIO 
    	// LOS CAMBIOS SE REFLEJAN CAMBIANDO AL JUGADOR DEL EQUIPO CORRECTO
    	// EN LA POSICION EN LA QUE SE ENCONTRABA...
    	// NO NEESITO BUSCARLO , SOLO DUPLICAR EL REGISTRO DE SET CON ESTOS NUEVOS 
    	// DATOS Y LA DIFERENCIA ME DARA EL CAMBIO..PROBARR..

	    	$retorno=partjug::getJugadorPosIni($partido,$fecha,$iclub,$icate,$jugador);
   			if($retorno["0"]["posicionini"])	$posicioninicial = $retorno["0"]["posicionini"];


			// es un update
			$retorno2 = partjug::setPos($partido,$fecha,$iclub,$icate,$jugador,$posicioninicial,$posicial,$puestoUpd,$hora,$setnumero);

    };

    if($retorno2)
    {
        // se dio de alta bien la poscion
			$datos["estado"] = 1;
	        echo json_encode($datos);

    } else 
    {
    	// se modifico la posicion
			$datos["estado"] = 2;
	        $datos["setpos"] = "no se modifico: ".$retorno2;//es un array
	        echo json_encode($datos);
    };
    
//	$retorno = Sett::insert( $idpartido, $secuencia, $setnumero, $fecha,$horaset,$A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6,$estado,$puntoa, $puntob,$saque);

   }
?>
