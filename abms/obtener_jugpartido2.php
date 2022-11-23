<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax

require_once('JugadorPartido.php');
require_once('Jugador.php');
require_once('Set.php');
//echo($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar peticion GET
   	$partido =	$_GET["idpartido"];
	$fecha	 =	"'".$_GET["fechapartido"]."'";
	$iclub	 =	$_GET["iclubescab"];
	$setnum = $_GET["setdata"];
	$anioEq = 0;
	if(isset($_GET["anioEquipo"]))  $anioEq = $_GET["anioEquipo"];
	$esVisualizar = 'N';
	$categoriapartido = $_GET["categoriapartido"];
	if(isset($_GET["esVisualizar"]))	$esVisualizar = $_GET["esVisualizar"];

	$clublocal = $clubvisitante = 0;
	
	
	//$icate 	 =	$_GET["icatcab"];
 	//echo "partido id ".$partido;
 	//echo " fecha ".$fecha;
 	//echo " id club: ".$iclub;
 	//echo " numero set a jugar: ".$setnum;
	//$jugadores = partjug::getJugadoresLoad($partido,$fecha,$iclub,$setnum); 
	$jugadores2=array(); // para que no falle al cargar posiciones de verdad..
	$RotacionesPuntos=array();
	if($esVisualizar == 'S')
	{
	// se obtiene del primer registro de ROTACIONES las posiciones iniciales que se guardaron al 
	// comienzo
			//SELECT * FROM `vapprotaciones` WHERE idpartido=1 and fecha='2021-05-11'
			//and setnumero=2
			//and (1a <>0 and 2a <> 0 and 3a <> 0 and 4a <> 0 and 5a <> 0 and 6a <> 0 )
			//and (1b <>0 and 2b <> 0 and 3b <> 0 and 4b <> 0 and 5b <> 0 and 6b <> 0 )
			//ORDER BY secuenciaSet  LIMIT 1
		$isetjugok['0']['setjugok']=0;
		//TRAE LAS ROTACIONES COMO FUERON OCURRIENDO...
	    $jugadores = partjug::getJugXSetVer($partido,$fecha,$iclub,$anioEq,$setnum); 
//	    FORMATO DEL ARRAY:
//	    	 [idpartido] => 2 [fecha] => 2021-10-08 [setnumero] => 1 [secuenciaSet] => 20 
//	    	 [secuenciaautomatica] => 1 
//	    	 [1A] => 140 [2A] => 142 [3A] => 136 [4A] => 137 [5A] => 139 [6A] => 143 
//	    	 [1B] => 11 [2B] => 12 [3B] => 14 [4B] => 15 [5B] => 16 [6B] => 17 
//	    	 [mensaje] => por rotacion durante el partido... 
//	    	 [clubrota] => 83 
//	    	 [puntoa] => 8 
//	    	 [puntob] => 7
	    	 
//		echo "<br> LISTADO DE ROTACIONES en el SET.. <br>";
//		  for($conteo=0;$conteo < count($jugadores);$conteo++)
//		  {
//		  	    echo "<br>";
//					print_r($jugadores[$conteo]);
//				echo "<br>";					
//		}		
//		echo "<br> ************************************************* <br>";
		//Array ( [idpartido] => 2 [fecha] => 2021-11-06 [setnumero] => 4 [secuenciaSet] => 3 [secuenciaautomatica] => 1 [1A] => 140 [2A] => 136 [3A] => 141 [4A] => 138 [5A] => 143 [6A] => 137 [1B] => 9 [2B] => 11 [3B] => 12 [4B] => 13 [5B] => 14 [6B] => 15 [mensaje] => por cambio en jugador en posicion.A6 [clubrota] => 83 [puntoa] => 0 [puntob] => 0 )

		$jugadores2 = partjug::getJugSetLoad($partido,$fecha,$iclub,$anioEq,$setnum,$categoriapartido); 
		//opcion si viene vacia la tabla de posicioness
		if(count($jugadores2) == 0)
		{
			$partidoRow = Partido::getById($partido,$fecha);
			//print_r($partidoRow );
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
				$jugadores2=array();
				$jugador1 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['1A'] ) ;
					  if( count($jugador1)>0 ){array_push($jugadores2,$jugador1['0']);}

				$jugador2 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['2A'] ) ;
					  if( count($jugador2)>0 ) {array_push($jugadores2,$jugador2['0']);}

				$jugador3 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['3A'] ) ;
					  if( count($jugador3)>0 ) {array_push($jugadores2,$jugador3['0']);}

				$jugador4 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['4A'] ) ;
					  if( count($jugador4)>0 ) {array_push($jugadores2,$jugador4['0']);}

				$jugador5 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['5A'] ) ;
					  if( count($jugador5)>0 ) {array_push($jugadores2,$jugador5['0']);}			

				$jugador6 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['6A'] ) ;
					  if( count($jugador6)>0 ) {array_push($jugadores2,$jugador6['0']);}
		   }
			if( ($iclub == $clubvisitante) && (count($posicionesSetGrabadasInicial) > 0) )
			{ 
				$jugadores2=array();
				$jugador1 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['1B'] ) ;
					  if( count($jugador1)>0 ){array_push($jugadores2,$jugador1['0']);}

				$jugador2 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['2B'] ) ;
					  if( count($jugador2)>0 ) {array_push($jugadores2,$jugador2['0']);}

				$jugador3 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['3B'] ) ;
					  if( count($jugador3)>0 ) {array_push($jugadores2,$jugador3['0']);}

				$jugador4 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['4B'] ) ;
					  if( count($jugador4)>0 ) {array_push($jugadores2,$jugador4['0']);}

				$jugador5 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['5B'] ) ;
					  if( count($jugador5)>0 ) {array_push($jugadores2,$jugador5['0']);}			

				$jugador6 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['6B'] ) ;
					  if( count($jugador6)>0 ) {array_push($jugadores2,$jugador6['0']);}			


			}
		} // SI LA PRIMER CONSULTA EN ROTACIONES O POSICIONES INICALES NO TRAE NADA
		//print_r($jugadores2);
		
		$Rotaciones=array();
		
		if(isset($jugadores) && count($jugadores) > 0)
		{	
//			echo "<br> Rotaciones: <br>:";
//			print_r($jugadores);		
//REVISAR : partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$jugadores[$avance]['1A'] ) ;
/*SELECT eq.numero,eq.nombre,eq.categoria,eq.idjugador,vappjugpartido.idclub,vappjugpartido.puesto,vappjugpartido.posicion,vappjugpartido.Libero ,ptos.puestoxcat FROM vappjugpartido inner join vappequipo eq on eq.idclub = vappjugpartido.idclub and eq.idjugador = vappjugpartido.jugador left JOIN vapppuestojugador ptos on ptos.idjugador = eq.idjugador and ptos.pjcategoria = eq.categoria and ptos.idclub = eq.idclub and ptos.anioEquipo = eq.anioEquipo WHERE vappjugpartido.idpartido=2 and eq.anioEquipo=2021 and vappjugpartido.Fecha='2021-11-20' and vappjugpartido.idclub=83 and vappjugpartido.jugador = 138 and vappjugpartido.setnumero = 3 and vappjugpartido.secuencia=1 ORDER BY vappjugpartido.setnumero*/

/*SELECT * FROM vapprotaciones where idpartido=2 and fecha='2021-11-20'
and clubrota=83
order by setnumero,secuenciaSet,secuenciaautomatica*/
/*http://localhost/volleyAPP_desa/VerCSets.php?id=2&setmax=5&fecha=2021-11-20*/;				
/* FALLA EL ACCESO A LA SECUENCIA
SELECT eq.numero,eq.nombre,eq.categoria,eq.idjugador,vappjugpartido.idclub,vappjugpartido.puesto,vappjugpartido.posicion,vappjugpartido.Libero ,ptos.puestoxcat FROM vappjugpartido inner join vappequipo eq on eq.idclub = vappjugpartido.idclub and eq.idjugador = vappjugpartido.jugador left JOIN vapppuestojugador ptos on ptos.idjugador = eq.idjugador and ptos.pjcategoria = eq.categoria and ptos.idclub = eq.idclub and ptos.anioEquipo = eq.anioEquipo WHERE vappjugpartido.idpartido=2 and eq.anioEquipo=2021 and vappjugpartido.Fecha='2021-11-20' and vappjugpartido.idclub=83 and vappjugpartido.jugador = 138 and vappjugpartido.setnumero = 3 and vappjugpartido.secuencia=1 ORDER BY vappjugpartido.setnumero
order by setnumero,secuenciaSet,secuenciaautomatica;
*/
			//$jugadores
			// RECORRER ROTACIONES DE LOS JUGADORES, OBTENER NOMBRE, POSICION, PUESTO
			$conteo=1;
			$indicejugador=0;
			//$Rotaciones=array();
			for($avance=0;$avance < count($jugadores);$avance++)
			{
				//echo "<br> ANALIZANDO JUGADORES, ROTACIONES: <br>";
				//Array ( [numero] => 3 [nombre] => Mateo Castillo [categoria] => 16 [idjugador] => 140 [idclub] => 83 [puesto] => 3 [posicion] => 1 [Libero] => [puestoxcat] => 3 ) ) 
			   	$jugador1 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$jugadores[$avance]['1A'] ) ;
				// print_r($jugador1 );
				 if(count($jugador1)>0){$jugador1['0']['posicion'] = 1;$indicejugador++;}
				
				$jugador2 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$jugadores[$avance]['2A'] ) ;
				 if(count($jugador2)>0){$jugador2['0']['posicion'] = 2;$indicejugador++;}	
				
				$jugador3 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$jugadores[$avance]['3A'] ) ;
				 if(count($jugador3)>0){$jugador3['0']['posicion'] = 3;$indicejugador++;}					
				
				$jugador4 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$jugadores[$avance]['4A'] ) ;
				if(count($jugador4)>0){$jugador4['0']['posicion'] = 4;$indicejugador++;}				
				
				$jugador5 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$jugadores[$avance]['5A'] ) ;
				if(count($jugador5)>0){$jugador5['0']['posicion'] = 5;$indicejugador++;}				
				
				$jugador6 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$jugadores[$avance]['6A'] ) ;
				if(count($jugador6)>0){$jugador6['0']['posicion'] = 6;$indicejugador++;}				
				
				$jugador7 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$jugadores[$avance]['1B'] ) ;
				if(count($jugador7)>0){$jugador7['0']['posicion'] = 1;$indicejugador++;}								
				
				$jugador8 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$jugadores[$avance]['2B'] ) ;
				if(count($jugador8)>0){$jugador8['0']['posicion'] = 2;$indicejugador++;}								
				
				$jugador9 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$jugadores[$avance]['3B'] ) ;
				if(count($jugador9)>0){$jugador9['0']['posicion'] = 3;$indicejugador++;}								
				
				$jugador10 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$jugadores[$avance]['4B'] ) ;
				if(count($jugador10)>0){$jugador10['0']['posicion'] = 4;$indicejugador++;}								
				
				$jugador11 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$jugadores[$avance]['5B'] ) ;
				if(count($jugador11)>0){$jugador11['0']['posicion'] = 5;$indicejugador++;}								
				
				$jugador12 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$jugadores[$avance]['6B'] ) ;
				if(count($jugador12)>0){$jugador12['0']['posicion'] = 6;$indicejugador++;}								

				if($indicejugador >0)	$Rotaciones[$avance] =array();
				 		if(count($jugador1)>0)
				 		{
					 		array_push($Rotaciones[$avance], $jugador1['0']);
					 	}				
						if(count($jugador2)>0)
				 		{
				 			array_push($Rotaciones[$avance], $jugador2['0']);
					 	}				
						if(count($jugador3)>0)						
				 		{
				 			array_push($Rotaciones[$avance], $jugador3['0']);
					 	}				
						if(count($jugador4)>0)						
				 		{
				 			array_push($Rotaciones[$avance], $jugador4['0']);
						}				
						if(count($jugador5)>0)
				 		{
				 			array_push($Rotaciones[$avance], $jugador5['0']);
						}
						if(count($jugador6)>0)
				 		{
				 			array_push($Rotaciones[$avance], $jugador6['0']);
						}							
						if(count($jugador7)>0)
				 		{
				 			array_push($Rotaciones[$avance], $jugador7['0']);
						}							
						if(count($jugador8)>0)
				 		{
				 			array_push($Rotaciones[$avance], $jugador8['0']);
						}						
						if(count($jugador9)>0)
				 		{
				 			array_push($Rotaciones[$avance], $jugador9['0']);
						}						
						if(count($jugador10)>0)
				 		{
				 			array_push($Rotaciones[$avance], $jugador10['0']);
						}						
						if(count($jugador11)>0)
				 		{
				 			array_push($Rotaciones[$avance], $jugador11['0']);
						}						
						if(count($jugador12)>0)						
				 		{
				 			array_push($Rotaciones[$avance], $jugador12['0']);
						}				  
						$RotacionesPuntos[$avance]['puntoa'] = $jugadores[$avance]['puntoa'];
						$RotacionesPuntos[$avance]['puntob'] = $jugadores[$avance]['puntob'];
//			echo "<br> +++++++++++++++++++++++++++++++++++++++++++++++++++ <br>";
//				print_r($Rotaciones);
//			echo "<br> +++++++++++++++++++++++++++++++++++++++++++++++++++ <br>";
			}
		  $jugadores=array();
			
		}
		else
		{
			//$jugadores = partjug::getJugSetLoad($partido,$fecha,$iclub,$anioEq,$setnum,$categoriapartido); 
			//print_r($jugadores);
			$isetjugok = partjug::getCantJugSetLoad($partido,$fecha,$iclub,$anioEq,$setnum); 
			//echo "NO SE CARGARON JUGADORES EN CANCHA EN ESTE SET (sejugo : )";
			//print_r($isetjugok);
			//echo " entra por ELSE VISUALIZAR";
		}	
		$setjugok = $isetjugok['0']['setjugok'];
		
//		echo "<br> LISTADO DE ROTACIONES POR JUGADOR.. <br>";
//			print_r($jugadores2);
//		echo "<br> ************************************************* <br>";

// viene del if($esVisualizar == 'S')
	}
	
	else  // NO ES VISUALIZAR...ES CARGAR POSICIONES POSTA
	{
	//	echo " entra por NO ES VISUALIZAR";
	// traigo desde la tabla ROTACIONES, la primer formacion
		$jugadores = partjug::getJugSetLoad($partido,$fecha,$iclub,$anioEq,$setnum,$categoriapartido); 
		$setjugok = partjug::getCantJugSetLoad($partido,$fecha,$iclub,$anioEq,$setnum); 
	};	

	//print_r($jugadores);
	if ( (isset($jugadores)) || (isset($jugadores2))  )
	{
	        $datos["estado"] = 1;
	        if(isset($jugadores))
		        $datos["Jugadores"] = $jugadores;//es un array CON LAS POSICIONES INICIALES..
			if(isset($Rotaciones))
				$datos["Rotaciones"] = $Rotaciones;//es un array CON LAS POSICIONES INICIALES..
				$datos["RotacionesPuntos"] = $RotacionesPuntos;//es un array CON LAS POSICIONES INICIALES..
	        $datos["JugadoresINI"] = $jugadores2;//es un array SIEMPRE EN VISUALIZAR, POS INI
					$datos["todos"] = $setjugok;//es un array
	        				echo json_encode($datos);
	        
    };
}        
?>
