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
    
  //SI LLEGA UN CENTRAL PARA ESA POSICION, DESACTIVO AL CENTRAL QUE ESTABA Y SIGO EL CURSO..
	cExisteCentralPos($secuencia,$partido,$fecha,$iclub,$icate,$jugador,$posicial,
					  $puestoUpd,$hora,$setnumero);    
  //SI LLEGA UN CENTRAL PARA ESA POSICION, DESACTIVO AL CENTRAL QUE ESTABA Y SIGO EL CURSO..

	if($secuencia == 1)		
    { 
    	$secuencia = 1;
    	$modo='INS';
		//echo("$modo='INS'");
    	//	ES CARGA DE POSICION INICIAL
    	// 	POSICION INICIAL  POSICION ACTUAL
    	// 	VERIFICAR PRIMERO QUE NO EXISTA EL JUGADOR CON OTRA SECUENCIA, PARA EL MISMO SET:
		//	ESTOY GUARDANDO LA POSICION INICIAL.
		$retorno2 = partjug::setPos($partido,$fecha,$iclub,$icate,$jugador,$posicial,$posicial,
									$puestoUpd,$hora,$setnumero);
									
	//ACTIVO AL JUGADOR[CENTRAL] SI TIENE UNA POSICION QUE NO SEA SUPLENTE,
	//SINO LO DESACTIVO
	$retorno=partjug::getJugadorPosIni($partido,$fecha,$iclub,$icate,$jugador);
	//Array ( [0] => 
				//Array ( [numero] => 1 [nombre] => Leandro [categoria] => 19 [idjugador] => 146
				// 		  [posicionini] => 7 [idclub] => 83 [posicion] => 7 
				//		  [activoSN] => [puestoxcat] => 4 [ColorPuestoCat] => #51007d 
				//		  [puesto] => 4 [ColorPuestoCancha] => #51007d 
				//		  [secuencia] => 1 [FechaEgreso] => ) )
	$puestoxCat = $retorno["0"]["puestoxcat"];
		$puestoActualizado = $retorno["0"]["puesto"];
	$puestoPosta = $puestoxCat;
	if($puestoPosta != $puestoActualizado )
			$puestoPosta = $puestoActualizado;
			
	//CENTRALES QUE NO SON SUPLENTES
	  // PORQUE EMPIEZAN EN CANCHA los activo para que aparezcan como seleccionables con el 
	  // cambio automatico de LIBERO
	if($posicial != 7 && $puestoPosta == 6)
	{
			$accionValor =1;
			$retornoAxt = partjug::updateActivaSN($partido,$fecha,
												  $iclub,$icate,$jugador,$setnumero,
												  $accionValor);
	} 
	//Deberia hacer aca lo mismo con los LIBEROS, CUANDO SOLO HAY UNO ;


	} //secuencia == 1 carga inicial
    else { 
    	$modo='UPD';
			//echo("$modo='UPD'");
	    	// ES UN CAMBIO 
	    	// LOS CAMBIOS SE REFLEJAN CAMBIANDO AL JUGADOR DEL EQUIPO CORRECTO
	    	// EN LA POSICION EN LA QUE SE ENCONTRABA...
	    	// NO NEESITO BUSCARLO , SOLO DUPLICAR EL REGISTRO DE SET CON ESTOS NUEVOS 
	    	// DATOS Y LA DIFERENCIA ME DARA EL CAMBIO..PROBARR..

			$retorno=partjug::getJugadorPosIni($partido,$fecha,$iclub,$icate,$jugador);
		   		if($retorno["0"]["posicionini"])
		   			$posicioninicial = $retorno["0"]["posicionini"];
			// Es un update. LA POSICION INICIAL NO SE TOCA NUNCA DSPS DEL INSERT.
			$retorno2 = partjug::setPos($partido,$fecha,$iclub,$icate,$jugador,
										$posicioninicial,$posicial,$puestoUpd,$hora,
										$setnumero);
			//ACTIVO AL JUGADOR[CENTRAL] SI TIENE UNA POSICION QUE NO SEA SUPLENTE,
			//SINO LO DESACTIVO
			$puestoxCat = $retorno["0"]["puestoxcat"];
			$puestoActualizado = $retorno["0"]["puesto"];
			$puestoPosta = $puestoxCat;
			if($puestoPosta != $puestoActualizado )
			$puestoPosta = $puestoActualizado;

			//CENTRALES QUE NO SON SUPLENTES
			//PORQUE EMPIEZAN EN CANCHA
			if($posicial != 7 && $puestoPosta == 6)
			{
			$accionValor =1;
			$retornoAxt = partjug::updateActivaSN($partido,$fecha,
									 			  $iclub,$icate,$jugador,$setnumero,
												  $accionValor);
			} 
			//ACTIVO AL JUGADOR[CENTRAL] SI TIENE UNA POSICION QUE NO SEA SUPLENTE,
			//SINO LO DESACTIVO
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
    

   }

function cExisteCentralPos($secuencia,$partido,$fecha,$iclub,$icate,$jugador,$posicial,
					  	   $puestoUpd,$hora,$setnumero)
{
//controlo primero si habia alguien en esa Posicion
//y si es Central y si el que llega tambien lo es.
	$retorno=partjug::getJugadorEnPos($partido,$fecha,$iclub,$icate,$posicial);
	// este control solo es valido si ya habia alguien..
	if(count($retorno) > 0)
	{
	//Array ( [0] => 
				//Array ( [numero] => 1 [nombre] => Leandro [categoria] => 19 [idjugador] => 146
				// 		  [posicionini] => 7 [idclub] => 83 [posicion] => 7 
				//		  [activoSN] => [puestoxcat] => 4 [ColorPuestoCat] => #51007d 
				//		  [puesto] => 4 [ColorPuestoCancha] => #51007d 
				//		  [secuencia] => 1 [FechaEgreso] => ) )
	$CentralEncontrado = $retorno["0"]["idjugador"];
	$puestoxCat = $retorno["0"]["puestoxcat"];
		$puestoActualizado = $retorno["0"]["puesto"];
	$puestoPosta = $puestoxCat;
	if($puestoPosta != $puestoActualizado )
			$puestoPosta = $puestoActualizado;	
	//si habia un central en esa pos que llegó. Lo desactivo		
	if($puestoPosta == 6 && $posicial != 7)
		{
		 $accionValor =0; //desactivo el que estaba ahi...
		$retornoAxt = partjug::updateActivaSN($partido,$fecha,
											  $iclub,$icate,$CentralEncontrado,$setnumero,
											  $accionValor);
		}

	}
}
?>
