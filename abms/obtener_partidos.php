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
	
	$setNum=0;
		if(isset($_GET["setNum"])) $setNum = $_GET["setNum"];
	
	//CHEQUEO SI VIENEN LOS FILTROS PARA AGGREAR
		$estado = 0;
		if (isset($_GET["estado"]))	$estado = (int) $_GET["estado"];	
	
		$icomp = 0;
		if(isset($_GET["icomp"])) $icomp = (int) $_GET["icomp"];

		$icate = 0;
		if(isset($_GET["icate"])) $icate = (int) $_GET["icate"];
		
		$iclub = 0;
		if(isset($_GET["iclub"])) $iclub = (int) $_GET["iclub"];
		
		$icity = 0;
		if(isset($_GET["icity"])) $icity = (int) $_GET["icity"];	
		
		if (isset($_GET["icity2"])
			&& (int) $_GET["icity2"] <> 9999)
				$icity = (int) $_GET["icity2"];

		
				
		$fecDde="''";// sera string 
		if(isset($_GET["fdesde"])) $fecDde = "'".$_GET["fdesde"]."'";

		
		$fecHta="''";// sera string 
		if(isset($_GET["fhasta"])) $fecHta = "'".$_GET["fhasta"]."'";	

		$fecOrden = '';
		if (isset($_GET["fdesdeOrden"]))
			//$fecDdeOrden = $_GET["fdesdeOrden"];
				$fecOrden = filter_input(INPUT_GET, 'fdesdeOrden', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
		
		//CHEQUEO SI VIENEN LOS FILTROS PARA AGGREAR
	
	
	if($partidoid == 0)
	{
	    if($registros["0"]["count(*)"] > "0")
	     {
			// va a entrar por aca, ya que va a traer todos...
			// chequeo si tiene alguno para parametrizar...
			if (($icomp != 0) || ($icate != 0) || ($iclub != 0) || ($icity != 0) || ($fecDde != "''") || ($fecHta != "''"))
			$partidos = Partido::getAllcparms($icomp,$icate,$iclub,$icity,$fecDde,$fecHta,$fecOrden,$estado);
//			$partidos = Partido::getAllcparms($icomp,$icate,$iclub,$icity,$fecDde,$fecHta);
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
		// 29-08-2018	
		// este es el que usa el TABLERO !	
		$partidoRow = Partido::getById($partidoid,$fecpartido);

	    if($partidoRow)
	    {
			 $newset = Sett::ultSetNum($partidoid,$fecpartido);
			 //VACIO DIRECTAMENTE
			 //print_r($newset);
			 $XsetNum =0;
			 if(isset($newset['setnumero']))
				 $XsetNum = (int)$newset['setnumero'];
			 // calculamos hora inicio del Set y Hora Actual o final
				$setHoras = Sett::getHoraInicioHoraFin($partidoid,$fecpartido,$XsetNum);
				//print_r($setHoras);					

				if(count($setHoras)>0){
				$valorHoraInicio='';
				$vectorHoraInicio = sett::getByIdUltimoRegistro($partidoid,$XsetNum,(int)$setHoras['0']['primseq'],$fecpartido );
				$valorHoraInicio = $vectorHoraInicio['hora'];
				//echo "<br>Hora Inicio: $valorHoraInicio";	'08:08:50'
				$valorHoraFin='';	
				$vectorHoraFin    = sett::getByIdUltimoRegistro($partidoid,$XsetNum,(int)$setHoras['0']['ultmseq'],$fecpartido );
				$valorHoraFin    =	$vectorHoraFin['hora']; 
				//echo "<br> Hora Fin/Ultima grabacion: $valorHoraFin <br>"; '13:42:50'	
//				$sets[$indice]['horainicio']=$valorHoraInicio;	
//				$sets[$indice]['primseq']=(int)$setHoras['0']['primseq'];	
//				$sets[$indice]['ultmseq']=(int)$setHoras['0']['ultmseq'];	
//				$sets[$indice]['horafin']=$valorHoraFin;
			 // calculamos hora inicio del Set y Hora Actual o final
			  }
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
					$setData = Sett::getById($partidoid,$idUltimoSetdata,$secuencia,$fecpartido);
	    			//$setdata es un VECTOR..
//	    			echo("<br>");
//	    			echo("set data: <br>");
//	    			print_r($setData); //puede venir VACIO
//	    			echo("<br>+++++++++++++++++++++++++<br>");
			$ianioPartido = (int)substr($partidoRow["Fecha"], 0, 4);
			if(isset($setData) && !empty($setData) ){
			$jugadoresA = partjug::getJugSetLoad($partidoid,$fecpartido,(int)$setData["ClubA"],$ianioPartido,$idUltimoSetdata,(int)$setData["categoria"]); 
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
