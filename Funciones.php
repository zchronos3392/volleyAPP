<?php

/**
 * Representa el la estructura de las sedes
 * almacenadas en la base de datos
 */

class fx
{
    function __construct()
    {
    }

    /**
     * Retorna vector/Array con las posiciones cambiadas
     *
     * @param $posi,posii,posiii,posiv,posv,posvi Identificador de jugador en posicion i
     * @return array de posiciones de jugadores, pero rotados un lugar.
     */
    public static function rotar($posi,$posii,$posiii,$posiv,$posv,$posvi)
    {
       return array('I' => $posii,'II' => $posiii,'III' => $posiv,'IV' => $posv,'V' => $posvi,'VI' => $posi);

    }
    
    public static function antirotar($posi,$posii,$posiii,$posiv,$posv,$posvi)
    {
       return array('I' => $posvi,'II' => $posi,'III' => $posii,'IV' => $posiii,'V' => $posiv,'VI' => $posv);

    }    
    public static function detectaGanador($ClubARes,$ClubBRes,$ClubA,$ClubB,$setsnmax)
    {
    	
    	$ganador = "No hubo/ hay ganador ";



	 $puntos = array('mayor' => -1 , 'menor' => -1 ,'equipoMayor' => 0 , 'equipoMenor' => 0);
	// menor 
	//echo "vector cargado : <BR>";
	//print_r($puntos);
	
	if($ClubARes > $ClubBRes)
	{
	 $puntos['mayor'] = $ClubARes;
	 $puntos['equipoMayor'] = $ClubA;

	 $puntos['menor'] = $ClubBRes;
	 $puntos['equipoMenor'] = $ClubB;
	}
	else if($ClubBRes > $ClubARes)
	{
		 $puntos['mayor'] = $ClubBRes;
		 $puntos['equipoMayor'] = $ClubB;

		 $puntos['menor'] = $ClubARes;
		 $puntos['equipoMenor'] = $ClubA;
	};

	//echo " <BR>vector con datos ordenados: <BR> ";
	//print_r($puntos);
	
	
// ACA ESTA EL PROBLEMA, ES UN BUG, CUANDO LA CANTIDAD DE SET JUGADOS, A PARTIR DE LOS PUNTOS
// ES MENOR A LA CANTIDAD MAXIMA DE SETS POR DOFIRERNCIA DE 2, EL PROGRAMA ASUME QUE EL PARTIDO TERMINO...
// CON LO CUAL FALTA ALGO MAS...	
	$setsJugados = $ClubARes + $ClubBRes;
	$DifSetMax_Jug = $setsnmax - $setsJugados;// CANTIDA DE SETS QUE FALTAN JUGAR
		if($DifSetMax_Jug < 0) $DifSetMax_Jug *= -1; // por si queda negativo..
	
//1	
//echo " <BR>sets jugados totales: ".$setsJugados;
//2 
//echo" <BR>Aun faltan jugar $DifSetMax_Jug Sets ";
		
	// Si son iguales no se hace nada...esto se verifica chequeando que ninguno de los dos tenga valor 0
	if($puntos['mayor']!=-1 && $puntos['menor']!=-1)
	{
//3	  
//	  echo" <BR>ambos puntajes estan cargados en el vector, porque no son iguales..";
	  
	  $difpuntos = (int)$puntos['mayor'] - (int)$puntos['menor'];
//3.11	
//		echo" <BR>diferencia de puntos: ".$difpuntos."<br>";
//		// hasta aca se calcula bien la diferencia..
		
		if($setsnmax == 3) // compentecias con 3 sets maximos
		{
//4	
//		echo " <BR> set cantidad maxima: 3";
		 //diferencia entre setsmaximos y setsjugados
		   if($DifSetMax_Jug == 1 || $DifSetMax_Jug == 0)
			{
//5	
//					 echo " <BR> diferencia por sets jugados: ".$DifSetMax_Jug;
			 if($difpuntos == 2 || $difpuntos == 1)	$ganador=$puntos['equipoMayor'];
			}	
		}
		else // competencias con 5 sets maximo
		{
//6				
//					echo " <BR> set cantidad maxima 5";
		 //diferencia entre setsmaximos y setsjugados
		 // ACA NECESITO UN SWITCH QUE COMBINE CUANTOS SET FALTAN CON LA DIFERENCIA 
		 // DE PUNTOS DE CADA equipo
				switch ($DifSetMax_Jug) {
				    case 0:
//							echo " <BR>Se jugaron todos los Set<br>";
//							echo " <BR>Difrencia: $difpuntos<br>";	        	
							if($difpuntos >= 2 || $difpuntos >= 1 || $difpuntos >= 3) $ganador =$puntos['equipoMayor'];
				        	break;
				    case 1:
							$ganador = " Faltan jugar $DifSetMax_Jug setSs  ";
							//echo "<br> $ganador <br> ";
							if($difpuntos >= 2) $ganador = $puntos['equipoMayor'];
				        	break;
				    case 2:
					        $ganador = " <BR>Faltan jugar $DifSetMax_Jug setssss <br> ";
					        //echo "<br> $ganador <br> ";
					        if($difpuntos >= 2) $ganador = $puntos['equipoMayor'];
				        	break;
				}		 
//		   if($DifSetMax_Jug == 2 || $DifSetMax_Jug == 1 || $DifSetMax_Jug == 0)
//			{
//			 if($difpuntos == 3 || $difpuntos == 2 || $difpuntos == 1){$ganador=$puntos['equipoMayor'];};
//			}	
		}
	}
	
		return $winner['ganador'] = $ganador;

    }    

	public static function obtener_posiciones_iniciales($partido,$fecha,$iclub,$setnum,$anioEq,$categoriapartido){
		
		// $clublocal = $clubvisitante = 0;
		//$icate 	 =	$_GET["icatcab"];
		//echo "partido id ".$partido;
		//echo " fecha ".$fecha;
		//echo " id club: ".$iclub;
		//echo " numero set a jugar: ".$setnum;
		//$jugadores = partjug::getJugadoresLoad($partido,$fecha,$iclub,$setnum); 
		$jugadoresListaInicial=array(); // para que no falle al cargar posiciones de verdad..
    	$jugadoresListaInicial = partjug::getJugSetLoad($partido,$fecha,$iclub,$anioEq,$setnum,$categoriapartido); 
	    //opcion si viene vacia la tabla de posicioness
    	// $jugadoresListaInicial=array();
    	// $$jugadoresListaInicial=array();

		if(count($jugadoresListaInicial) == 0)
		{
			$partidoRow = Partido::getById($partido,$fecha);
			// echo "<br>partido<br>";
			// print_r($partidoRow);
			// echo "<br>partido<br>";

			$clublocal =$partidoRow['idcluba'];
			$clubvisitante=$partidoRow['idclubb'];
			
			$posicionesSetGrabadasInicial = Sett::getSetPosInicialesGrabadas($partido,$setnum,$fecha);			
			if(count($posicionesSetGrabadasInicial) <> 0) $jugadores2 = array();
			//echo "<br> posicionesSetGrabadasInicial <br>";
			//print_r($posicionesSetGrabadasInicial);
			//echo "<br> <br>";
			$conteo=-1;	
			if( ($iclub == $clublocal) && (count($posicionesSetGrabadasInicial) > 0) )
			{
				//echo "<br> es el club local <br>";
					$jugador1 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['1A'] ) ;
						if( count($jugador1)>0 ){array_push($jugadoresListaInicial,$jugador1['0']);}

					$jugador2 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['2A'] ) ;
						if( count($jugador2)>0 ) {array_push($jugadoresListaInicial,$jugador2['0']);}

					$jugador3 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['3A'] ) ;
						if( count($jugador3)>0 ) {array_push($jugadoresListaInicial,$jugador3['0']);}

					$jugador4 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['4A'] ) ;
						if( count($jugador4)>0 ) {array_push($jugadoresListaInicial,$jugador4['0']);}

					$jugador5 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['5A'] ) ;
						if( count($jugador5)>0 ) {array_push($jugadoresListaInicial,$jugador5['0']);}			

					$jugador6 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['6A'] ) ;
						if( count($jugador6)>0 ) {array_push($jugadoresListaInicial,$jugador6['0']);}
			}
			if( ($iclub == $clubvisitante) && (count($posicionesSetGrabadasInicial) > 0) )
			{ 
					$jugador1 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['1B'] ) ;
						if( count($jugador1)>0 ){array_push($$jugadoresListaInicial,$jugador1['0']);}

					$jugador2 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['2B'] ) ;
						if( count($jugador2)>0 ) {array_push($$jugadoresListaInicial,$jugador2['0']);}

					$jugador3 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['3B'] ) ;
						if( count($jugador3)>0 ) {array_push($$jugadoresListaInicial,$jugador3['0']);}

					$jugador4 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['4B'] ) ;
						if( count($jugador4)>0 ) {array_push($$jugadoresListaInicial,$jugador4['0']);}

					$jugador5 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['5B'] ) ;
						if( count($jugador5)>0 ) {array_push($$jugadoresListaInicial,$jugador5['0']);}			

					$jugador6 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['6B'] ) ;
						if( count($jugador6)>0 ) {array_push($$jugadoresListaInicial,$jugador6['0']);}			
			}
		} // SI LA PRIMER CONSULTA EN ROTACIONES O POSICIONES INICALES NO TRAE NADA
    // Else
	// 	{
		// procesamos la posicion inicial cargadas
			// print_r($jugadores2);
			// $partidoRow = Partido::getById($partido,$fecha);
			// echo "<br>partido<br>";
			// print_r($partidoRow);
			// echo "<br>partido<br>";

			// $clublocal =$partidoRow['idcluba'];
			// $clubvisitante=$partidoRow['idclubb'];
			// for($i=0;$i<sizeof($jugadores2);$i++)
			// {
			// //	echo "<div style='color:white'>indice: ".$i." Set: ".$resumenarray[$i]['setnumero']." pa: ".$resumenarray[$i]['puntoa']." pb: ".$resumenarray[$i]['puntob']."</div><br>";
			// if($clublocal == $jugadores2[$i]['idclub']) array_push($jugadoresListaInicial,$jugadores2[$i]);
			// if($clubvisitante == $jugadores2[$i]['idclub']) array_push($$jugadoresListaInicial,$jugadores2[$i]);
				
			// }
		// }

		return 	$jugadoresListaInicial;
	// //print_r($jugadores);
	// if ( (isset($jugadores2))  )
	// {
	//         $datos["estado"] = 1;
	//         $datos["JugadoresINILocal"] = $jugadoresListaInicial;//es un array SIEMPRE EN VISUALIZAR, POS INI
    //         $datos["JugadoresINIVisitante"] = $$jugadoresListaInicial;//es un array SIEMPRE EN VISUALIZAR, POS INI

	//         				echo json_encode($datos);
	        
    // };

	}
	// -------------------------------------------------------------------------
	// FIN DE LA FUNCION OBTENER POSICIONES INICIALES POR SET
	// ----------------------------------------------------------------------------
}
?>