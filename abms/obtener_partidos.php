<?php

function buscarJugador($jugadoresLista,$idAbuscar){
//		echo "<br>llego un jugador  : $idAbuscar <br>";
//		print_r($jugadoresLista);
 $busqueda=False;
	 		foreach($jugadoresLista as $indice => $juglistaitem)
			   foreach($juglistaitem as $indice => $valor)
					if($indice == 'idjugador' && $valor == $idAbuscar)
							{
						 		
						 		$busqueda=True;
							}	 
								
return $busqueda;
}


function armarJugador($jugadoresLista,$idAbuscar){
 $busqueda=array();
 $colorBase = "#00abe3";

 //echo("<br>lista de jugadores y su data: ");
 //print_r($jugadoresLista);
 //DENTRO DE $jugadoresLista debe de estar: 
 	//[puestoxcat] => 5 [ColorPuestoCat]    => #dc2327 
 	//[puesto]     => 4 [ColorPuestoCancha] => #1bd80e
 // echo("<br>+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++");
	 		foreach($jugadoresLista as $indice => $juglistaitem)
			   foreach($juglistaitem as $clave => $valor)
					if($clave == 'idjugador' && $valor == $idAbuscar)
							{
								//encontré al jugador posta , armo el vector con sus datos
								$busqueda['jugx']= $jugadoresLista[$indice]['nombre']."(".$jugadoresLista[$indice]['numero'].")" ;
								$busqueda['idjugador']= $jugadoresLista[$indice]['idjugador'];
								$puestoPosta = 0;
								//coloco los valores por Default
									$colorPuestoPosta=$jugadoresLista[$indice]['ColorPuestoCat'];
									$puestoPosta = $jugadoresLista[$indice]['puestoxcat'];
								// si tiene color
								// else
								if($puestoPosta != $jugadoresLista[$indice]['puesto'])
								{
								  $puestoPosta= $jugadoresLista[$indice]['puesto'];	
								  $colorPuestoPosta=$jugadoresLista[$indice]['ColorPuestoCancha'];
								}
								if($colorPuestoPosta == "") $colorPuestoPosta = $colorBase;
								$busqueda['puesto']= $puestoPosta;
								$busqueda['puestoColor']= $colorPuestoPosta;														}	 
return $busqueda;
}

/**
 * Obtiene todas las Clubs de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax
require ('Partido.php');
require_once('Set.php'); 
require_once('Jugador.php');
require_once('JugadorPartido.php');


// // *******************			DOCUMENTACION API JSON 		****************************
// PARAMETROS:
// id DEL PARTIDO, es clave
// fechapart DEL PARTIDO, es clave
// DEVUELVE:
// CentralesB[] lista de centrales del visitante
//  ClubA:67  club local
//  ClubB:  83 club visitante
//  LiberosB :  [,…] liberos visitante
	//ejemplo del json: LiberosA/B
		// ColorPuestoCancha:"#f76420",ColorPuestoCat	:"#f76420",FechaEgreso:	null,Orden:	1,activoSN:	1,categoria:19,
		// idclub: 83,idjugador: 184,nombre	:"Mauri",numero	: 5,posicion: 5,posicionini: 7,puesto: "2"	,
		// puestoxcat: 2,secuencia: 3
// DATOS DE LA CABECERA DEL PARTIDO
	//  Partido :  {idPartido: 1, Fecha: "2023-11-20", descripcionp: "PARTIDO 1 CLASIFICACION", DescCate: "SUB18[CAB]",…}
//  SuplentesB :  [,…] suplentes del visitante
		//mismo ejemplo del json que LiberosA/B
//  estado :  2	estado del partido
//  estadoSet :  "FINALIZADO" estado del set
//  horainicio :  "10:04:22"
//  mensajeSet :  "Fin del set"
//  pa_1 :  false datos del jugador local en la posicion X
		//estructura del json para todos: idjugador: 203,jugx: "Lucho(10)",puesto: 5,puestoColor: "#dc2327"
//  pa_2 :  false  datos del jugador local en la posicion X
//  pa_3 :  false  datos del jugador local en la posicion X
//  pa_4 :  false  datos del jugador local en la posicion X
//  pa_5 :  false  datos del jugador local en la posicion X
//  pa_6 :  false  datos del jugador local en la posicion X
//  pb_1 :  {jugx: "Lucho(10)", idjugador: 203, puesto: 5, puestoColor: "#dc2327"}  datos del jugador visitante en la posicion X
//  pb_2 :  {jugx: "THIAGO GH(3)", idjugador: 186, puesto: 6, puestoColor: "#ff9999"}  datos del jugador visitante en la posicion X
//  pb_3 :  {jugx: "Bruno (8)", idjugador: 201, puesto: "5", puestoColor: "#dc2327"}  datos del jugador visitante en la posicion X
//  pb_4 :  {jugx: "Leandro(1)", idjugador: 181, puesto: 4, puestoColor: "#37bdde"}  datos del jugador visitante en la posicion X
// pb_5: {jugx: "Mauri(5)", idjugador: 184, puesto: 2, puestoColor: "#f76420"}  datos del jugador visitante en la posicion X
// pb_6: {jugx: "Uriel(11)", idjugador: 200, puesto: "3", puestoColor: "#1ba191"}  datos del jugador visitante en la posicion X
// puntoa: 10 puntos en el set del local
// puntob: 15 puntos en el set del visitante
// saque: 83 quien tiene el saque
// tiempoPedidoA: 1 cuantos tiempos le quedan al local
// tiempoPedidoB: 1 cuantos tiempos le quedan al visitante
// transcurrido: "00hs:59min" cuanto tiempo transcurriod desde el ppio
// valorHoraFinSet: "11:03:44" cuando terminó el Set
// valorHoraInicioSet: "10:46:28"	 cuando inició el Set,.
// // *******************			DOCUMENTACION API JSON 		****************************

//echo($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petici�n GET
    $registros = Partido::contar();
    // ESTA VOLVIENDO UN VECTOR DE VECTORES
    	//print_r ($registros["0"]["count(*)"]);
	
	$partidoid = 0;
	if(isset($_GET["id"])) $partidoid = (int) $_GET["id"];
	// 29-08-2018
	$fecpartido="''";// sera string 
	if(isset($_GET["fechapart"])) $fecpartido = "'".$_GET["fechapart"]."'";
	$fechaPartidoParm ="";
	if(isset($_GET["fechapart"])) $fechaPartidoParm = $_GET["fechapart"];
	//  echo " fecpartido $fecpartido <br>";
	$setNum=0;
		if(isset($_GET["setNum"])) $setNum = $_GET["setNum"];
	
	//CHEQUEO SI VIENEN LOS FILTROS PARA AGGREAR
		$estado = 0;
		if (isset($_GET["estado"]))	$estado = (int) $_GET["estado"];	
	
		$Segundo_estado = 0;
		if (isset($_GET["estado2"]))	$Segundo_estado = (int) $_GET["estado2"];	
		
		
		$icomp = 0;
		if(isset($_GET["icomp"])) $icomp = (int) $_GET["icomp"];

		$icate = 0;
		if(isset($_GET["icate"])) $icate = (int) $_GET["icate"];
		
		$iclub = 0;
		if(isset($_GET["iclub"])) $iclub = (int) $_GET["iclub"];
		
		//JUNIO 2023, NUEVA BUSQUEDA POR NOMBRE DE CLUB O PORCION DEL MISMO
		//EN AMBOS CAMPOS DE CLUB
		$ClubNombre = "";
		if(isset($_GET["buscarClubNombre"])) $ClubNombre = $_GET["buscarClubNombre"];

		$icity = 0;
		if(isset($_GET["icity"])) $icity = (int) $_GET["icity"];	
		
		if (isset($_GET["icity2"])
			&& (int) $_GET["icity2"] <> 9999)
				$icity = (int) $_GET["icity2"];

		
				
		$fecDde="''";// sera string 
		if(isset($_GET["fdesde"])) $fecDde = "'".$_GET["fdesde"]."'";

		// echo " fecDde $fecDde <br>";
		$fecHta="''";// sera string 
		if(isset($_GET["fhasta"])) $fecHta = "'".$_GET["fhasta"]."'";	
		// echo " fecHta $fecHta <br>";
		$fecOrden = '';
		if (isset($_GET["fdesdeOrden"]))
			//$fecDdeOrden = $_GET["fdesdeOrden"];
				$fecOrden = filter_input(INPUT_GET, 'fdesdeOrden', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
		
		//CHEQUEO SI VIENEN LOS FILTROS PARA AGGREAR
		$codigoError = 9999; //generico por retrocompatibilidad con obtener_listados_partidos_xfecha
		$codigopartido = "";
	if($partidoid == 0)
	{
	    if($registros["0"]["count(*)"] > "0")
	     {
			// va a entrar por aca, ya que va a traer todos...
			// chequeo si tiene alguno para parametrizar...
			if (($icomp != 0) || ($icate != 0) || ($iclub != 0) || ($ClubNombre != "") || ($icity != 0) || ($fecDde != "''") || ($fecHta != "''"))
			$partidos = Partido::getAllcparms($icomp,$icate,$iclub,$ClubNombre,$icity,$fecDde,$fecHta,$fecOrden,$estado,$Segundo_estado,$codigoError,$codigopartido);
			else				
				$partidos = Partido::getAll();
			
		    if ($partidos)
		    {
				//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
		        $datos["estado"] = 1;
		        $datos["Partidos"] = $partidos;//es un array
		        print json_encode($datos);
		        //el print lo puedo usar para cuando lo llamo desde android
		    }
		    else 
		    {
		    		print json_encode(array("id" => 2,"nombre" => "Sin partidos aun"));
		    }
		}
		else
				print json_encode(array("id" => 3,"nombre" => "Tabla vacia, conteo 0"));
	}
	else // uso la funcion getbyid(); partidoid no es 0
	{
		//ESTA PORCION ES LA QUE UTILIZA EL TABLERO PARA ENVIAR EL RESUMEN ACTUAL
		// 29-08-2018	
		// este es el que usa el TABLERO !	
		$partidoRow = Partido::getById($partidoid,$fecpartido);
		//echo("<br>++++++++++++++ Partido::getById($partidoid,$fechaPartidoParm); +++++++++++<br>");
		//print_r($partidoRow);
	    if(isset($partidoRow))
	    {
			 $newset = Sett::ultSetNum($partidoid,$fecpartido); //CARGO EN VARIABLE CUAL ES EL SET MAS NUEVO
			 //VACIO DIRECTAMENTE
			 //print_r($newset);
			 $XsetNum =0;
			 if(isset($newset['setnumero']))
				 $XsetNum = (int)$newset['setnumero'];
			 // calculo para el SET CONSULTADO: hora inicio del Set y Hora Actual o final del mismo
				$setHoras = Sett::getHoraInicioHoraFin($partidoid,$fecpartido,$XsetNum);
				//  print_r($setHoras);					
				//  echo "<br>";

				if(count($setHoras)>0)
				{
					//obtener el valor mas actual del registro del partido	
					$valorHoraInicio='';
					$vectorHoraInicio = sett::getByIdUltimoRegistro($partidoid,$XsetNum,(int)$setHoras['0']['primseq'],$fecpartido );
					//echo "vector vectorHoraInicio ";
					// print_r($vectorHoraInicio);
					$valorHoraInicio = $vectorHoraInicio['hora'];
					//echo "<br>Hora Inicio: $valorHoraInicio";	
					$valorHoraFin='';	
					$vectorHoraFin    = sett::getByIdUltimoRegistro($partidoid,$XsetNum,(int)$setHoras['0']['ultmseq'],$fecpartido );
					$valorHoraFin    =	$vectorHoraFin['hora']; 
					//echo "<br> Hora Fin/Ultima grabacion: $valorHoraFin <br>"; 
	//				$sets[$indice]['horainicio']=$valorHoraInicio;	
	//				$sets[$indice]['primseq']=(int)$setHoras['0']['primseq'];	
	//				$sets[$indice]['ultmseq']=(int)$setHoras['0']['ultmseq'];	
	//				$sets[$indice]['horafin']=$valorHoraFin;
				// calculamos hora inicio del Set y Hora Actual o final
			    }
			//   esto es para calcular el tiempo total del partido !!!
			 $cosaHorrorosaoQUE = Sett::TiempoTranscurrido($partidoid,$fecpartido);
			 	//print_r($cosaHorrorosaoQUE);
			 // viene VACIO ASI  :
			 //Array ( [idpartido] => [HoraInicial] => [HoraFinal] => [transcurrido] => )	
			 $idUltimoSetdata=0;
	    	 if(isset($newset['setnumero']))
		    	 $idUltimoSetdata =(int) $newset['setnumero']; 
		    // agregado 22.10.2021: si llega por parametro un numero de set, muestro solo ese:
				if($setNum != 0 ) $idUltimoSetdata = $setNum  ;

			 $secuenciaarray =  Sett::ultSecuencia($partidoid,$idUltimoSetdata,$fecpartido);
			 $secuencia = 0;
			if( !empty($secuenciaarray) ) $secuencia = (int) $secuenciaarray[0]["secuencia"];
			// esto es la poster !!
				$setData = Sett::getById($partidoid,$idUltimoSetdata,$secuencia,$fecpartido); //datos del registro del Set actual
   			//$setdata es un VECTOR..
//	    			echo("<br>");
//	    			echo("set data: <br>");
//	    			print_r($setData); //puede venir VACIO
	    			//echo("<br>++++++++++++++ ".$partidoRow["Fecha"]." +++++++++++<br>");
					//echo (substr($partidoRow["Fecha"], 0, 4));
			 $ianioPartido = (int)substr($partidoRow["Fecha"], 0, 4);
			 if(isset($setData) && !empty($setData) ){
					//print_r($setData);		
					// var_dump($partidoid,$fecpartido,(int)$setData["ClubA"],$ianioPartido,$idUltimoSetdata,(int)$setData["categoria"]);
				$jugadoresA = partjug::getJugSetLoad($partidoid,$fecpartido,(int)$setData["ClubA"],$ianioPartido,$idUltimoSetdata,(int)$setData["categoria"]); 
					//print_r($jugadoresA);
				$pointer1 = 0;
				$pointer3 = 0;
				$pointer7 = 0;
						// echo("<br>");
						// echo("jugadoresA: partjug::getJugSetLoad <br>");
						// print_r($jugadoresA);
						// echo("<br>+++++++++++++++++++++++++<br>");

				foreach($jugadoresA as $indice => $valor)
				{
					$puesto=$valor["puestoxcat"];
					if($puesto != $valor["puesto"]) $puesto= $valor["puesto"];
					//echo "puesto : $puesto <br>";
					if($puesto ==2) //libero
						{
								$datos["LiberosA"][$pointer1]= $valor; // tomar valido el campo PUESTO...
								$pointer1++;
						}	
					if($puesto ==6) //central
						{
								$datos["CentralesA"][$pointer3]= $valor; // tomar valido el campo PUESTO...
								$pointer3++;
						}

						if($valor["posicion"] == 7)	
						{
								$datos["SuplentesA"][$pointer7]= $valor; // tomar valido el campo PUESTO...
								$pointer7++;
						}	

				}

				$jugadoresB = partjug::getJugSetLoad($partidoid,$fecpartido,(int)$setData["ClubB"],$ianioPartido,$idUltimoSetdata,(int)$setData["categoria"]); 
				$pointer2 =0;			
				$pointer4 =0;	
				$pointer8 =0;		
				foreach($jugadoresB as $indice => $valor)
				{
					$puesto=$valor["puestoxcat"];
					if($puesto != $valor["puesto"]) $puesto= $valor["puesto"];
					//echo "puesto : $puesto <br>";
					if($puesto ==2) //libero
						{
								$datos["LiberosB"][$pointer2]= $valor; // tomar valido el campo PUESTO...
								$pointer2++;
						}	
					if($puesto ==6) //CENTRALES
						{
								$datos["CentralesB"][$pointer4]= $valor; // tomar valido el campo PUESTO...
								$pointer4++;
						}	
						if($valor["posicion"] == 7)	
						{
								$datos["SuplentesB"][$pointer8]= $valor; // tomar valido el campo PUESTO...
								$pointer8++;
						}	

				}
			 } //VIENE EL SET CON DATOS...


			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["Partido"] = $partidoRow;//es un array
	        if(isset($setData) && !empty($setData) ) $datos["ClubA"]  = $setData["ClubA"];
	        if(isset($setData) && !empty($setData) ) $datos["ClubB"]  = $setData["ClubB"]; 
	        if(isset($setData) && !empty($setData) ) $datos["estado"] = $setData["estado"];
	        if(isset($setData) && !empty($setData) ) $datos["puntoa"] = $setData["puntoa"];
	        if(isset($setData) && !empty($setData) ) $datos["puntob"] = $setData["puntob"];
	        if(isset($setData) && !empty($setData) ) $datos["saque"]  = $setData["saque"];
	        if(isset($setData) && !empty($setData) ) $datos["estadoSet"]  = $setData["descripcion"];
	        if(isset($setData) && !empty($setData) ) $datos["mensajeSet"]  = $setData["mensaje"];
	        if(isset($cosaHorrorosaoQUE) && !empty($cosaHorrorosaoQUE) ){ 
	        	$datos["transcurrido"]  = $cosaHorrorosaoQUE["transcurrido"];
	        	$datos["horainicio"]  = $cosaHorrorosaoQUE["HoraInicial"];
	        	}
	        if(isset($setData) && !empty($setData) ) $datos["tiempoPedidoA"]  = $setData["CantPausaA"];
	        if(isset($setData) && !empty($setData) ) $datos["tiempoPedidoB"]  = $setData["CantPausaB"];
	        if(isset($setData) && !empty($setData) ) $datos["valorHoraInicioSet"]  = $valorHoraInicio;
	        if(isset($setData) && !empty($setData) ) $datos["valorHoraFinSet"]  = $valorHoraFin;
	        //AGREGAMOS LA DATA DEL SETPOINT Y DEL MATCHPOINT y SU MENSAJE matchPoint(N11), setPoint(N11) ,textoSpecialPnt(V128)
	        if(isset($setData) && !empty($setData) ) $datos["setPoint"]  = $setData["setPoint"];;
			if(isset($setData) && !empty($setData) ) $datos["matchPoint"]  = $setData["matchPoint"];;
	        if(isset($setData) && !empty($setData) ) $datos["textoSpecialPnt"]  = $setData["textoSpecialPnt"];;
	        
// datos de las posiciones:
/** JUGADOR A*/
	if(isset($setData) && !empty($setData) ){
			if(buscarJugador($jugadoresA,(int)$setData["pa_1"]))	//
				$datos["pa_1"] = armarJugador($jugadoresA,(int)$setData["pa_1"]);
			else
				$datos["pa_1"] = jugador::getById((int)$setData["ClubA"],(int)$setData["pa_1"],(int)$setData["categoria"]) ;

			if(buscarJugador($jugadoresA,(int)$setData["pa_2"]))	//
				$datos["pa_2"] = armarJugador($jugadoresA,(int)$setData["pa_2"]);
			else
				$datos["pa_2"] = jugador::getById((int)$setData["ClubA"],(int)$setData["pa_2"],(int)$setData["categoria"]);

			if(buscarJugador($jugadoresA,(int)$setData["pa_3"]))	//
				$datos["pa_3"] = armarJugador($jugadoresA,(int)$setData["pa_3"]);
			else
				$datos["pa_3"] = jugador::getById((int)$setData["ClubA"],(int)$setData["pa_3"],(int)$setData["categoria"]);

			if(buscarJugador($jugadoresA,(int)$setData["pa_4"]))	//
				$datos["pa_4"] = armarJugador($jugadoresA,(int)$setData["pa_4"]);
			else
				$datos["pa_4"] = jugador::getById((int)$setData["ClubA"],(int)$setData["pa_4"],(int)$setData["categoria"]);

			if(buscarJugador($jugadoresA,(int)$setData["pa_5"]))	//
				$datos["pa_5"] = armarJugador($jugadoresA,(int)$setData["pa_5"]);
			else
				$datos["pa_5"] = jugador::getById((int)$setData["ClubA"],(int)$setData["pa_5"],(int)$setData["categoria"]);

			if(buscarJugador($jugadoresA,(int)$setData["pa_6"]))	//
				$datos["pa_6"] = armarJugador($jugadoresA,(int)$setData["pa_6"]);
			else
				$datos["pa_6"] = jugador::getById((int)$setData["ClubA"],(int)$setData["pa_6"],(int)$setData["categoria"]);
/** JUGADOR A*/
/** JUGADOR B*/
			if(buscarJugador($jugadoresB,(int)$setData["pb_1"]))	//
				$datos["pb_1"] = armarJugador($jugadoresB,(int)$setData["pb_1"]);
			else
				$datos["pb_1"] = jugador::getById((int)$setData["ClubB"],(int)$setData["pb_1"],(int)$setData["categoria"]) ;

			if(buscarJugador($jugadoresB,(int)$setData["pb_2"]))	//
				$datos["pb_2"] = armarJugador($jugadoresB,(int)$setData["pb_2"]);
			else
				$datos["pb_2"] = jugador::getById((int)$setData["ClubB"],(int)$setData["pb_2"],(int)$setData["categoria"]);

			if(buscarJugador($jugadoresB,(int)$setData["pb_3"]))	//
				$datos["pb_3"] = armarJugador($jugadoresB,(int)$setData["pb_3"]);
			else
				$datos["pb_3"] = jugador::getById((int)$setData["ClubB"],(int)$setData["pb_3"],(int)$setData["categoria"]);

			if(buscarJugador($jugadoresB,(int)$setData["pb_4"]))	//
				$datos["pb_4"] = armarJugador($jugadoresB,(int)$setData["pb_4"]);
			else
				$datos["pb_4"] = jugador::getById((int)$setData["ClubB"],(int)$setData["pb_4"],(int)$setData["categoria"]);

			if(buscarJugador($jugadoresB,(int)$setData["pb_5"]))	//
				$datos["pb_5"] = armarJugador($jugadoresB,(int)$setData["pb_5"]);
			else
				$datos["pb_5"] = jugador::getById((int)$setData["ClubB"],(int)$setData["pb_5"],(int)$setData["categoria"]);

			if(buscarJugador($jugadoresB,(int)$setData["pb_6"]))	//
				$datos["pb_6"] = armarJugador($jugadoresB,(int)$setData["pb_6"]);
			else
				$datos["pb_6"] = jugador::getById((int)$setData["ClubB"],(int)$setData["pb_6"],(int)$setData["categoria"]);
/** JUGADOR B*/
				}

		// datos de las posiciones
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	    else 
	    {
	    		print json_encode(array("id" => 4,"nombre" => "Error leyendo partido"));
	    }
		    		
	}
}


?>
