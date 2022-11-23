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
}



?>