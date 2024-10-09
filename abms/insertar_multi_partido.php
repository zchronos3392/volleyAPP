<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require('Partido.php');
require('Jugador.php');
require('JugadorPartidoCab.php');


if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
			$competencia = 0;
			if(isset($_POST['icompetencia']))  $competencia = $_POST['icompetencia'];				
			if(isset($_GET['icompetencia']))   $competencia  = $_GET['icompetencia'];				
			
			$smaxcomp = 0;
			if(isset($_POST['SetMaxComp']))  $smaxcomp = $_POST['SetMaxComp'];				
			if(isset($_GET['SetMaxComp']))   $smaxcomp  = $_GET['SetMaxComp'];				

			// datos de los partidos a cargar
				$items = "";
				if(isset($_GET['listapartidos']))  $items = $_GET['listapartidos'];
				if(isset($_POST['listapartidos']))  $items = $_POST['listapartidos'];
			// datos de los partidos a cargar
			for($i=1;$i<count($items);$i++)
			{
				$Fecha       = $items[$i]['fechap']; // debe llevar comillas
				$descripcionp = "'".$items[$i]['dscp']."'";
				$s 			  = $Fecha." ".$items[$i]['horai'].":00";
				$categoria    = $items[$i]['icate']; // numero
				$smaxCate 	  = 0;
				$smaxCate 	  = $items[$i]['SetMaxCat'];
				$ClubA        = $items[$i]['icluba']; // numero
				$ClubB        = $items[$i]['iclubb']; // numero
				$CanchaId     = $items[$i]['icancha']; // numero			
				$ciudad       = $items[$i]['icity']; // numero
				$sedeId       =   explode("_",$items[$i]['isede'])[1] ; // numero
					// TENGO QUE AGREGAR ESTOS..
				$tbset        = 0; // numero
				$tbset        = $items[$i]['valtbset'];				
				$finset       = 0; // numero
				$finset       = $items[$i]['valfinset'];							
					//$date = strtotime($s);
					$HoraIni = $s; // correcto !!!
					$Horafin = $s; // correcto !!!
						$HoraIni = "'".$HoraIni."'";
						$Horafin = "'".$Horafin."'";  
					//$Horafin     = $Fecha." 00:00:00";

				$ClubARes    = 0; // numero, se actualiza al finalizar
				$ClubBRes    = 0; // numero, se actualiza al finalizar
			
				$estado      = 1 ; // programado
				
				$setsmax = 0;	
				// ejemplo:	SetMaxCat=3 - SetMaxComp=0
			
				if(  ($smaxcomp > 0) && ($smaxCate >0)  ) { $setsmax = $smaxcomp;};
				if(  ($smaxcomp == 0) && ($smaxCate > 0) ) { $setsmax = $smaxCate;};
				if(  ($smaxcomp > 0) && ($smaxCate == 0) ){  $setsmax = $smaxcomp;};

				$Fecha = "'".$Fecha."'";
	            $retorno = Partido::insert($Fecha,$categoria,$ClubA,$ClubB,$CanchaId,$competencia,$sedeId,$ciudad,$HoraIni,$Horafin,$ClubARes,$ClubBRes,$estado,$setsmax,$tbset,$finset,$descripcionp);
	
					// Luego de haber dado de alta el partido, agregamos poor defecto los jugadores de cada Club
					// de la categoria del partido:

					 	$retornoIdPartido	= Partido::getPartidoId($Fecha,$categoria,$ClubA,$ClubB,$competencia);
						// hay que enviar el AÑO !
						$anioEq=0; // necesitamos el anio porque los equipos cambian por a�o.
					 	if( isset($_POST['ianio']) )  $anioEq = $_POST['ianio'];
					
						 	//$retorno=$idpartido;
					   	//echo "el alta del partido retorn� lo siguiente: <br>";
					   	//print_r($retornoIdPartido);
					   	$idpartido = $retornoIdPartido['0']['idFinal'];
					         //echo "  ultimo id cargado del partido: $idpartido y el anio : $anioEq";
					     $mensajePre="";    
					    // esto se hace una vez, asi que aca agrego la lista de jugadores por Defualt, de la categoria del partido.
					    $jugador=0; //en esta pantalla no tengo el dato de los jugadores a mano...
					   // PROCESAMOS LOS JUGADORES DE LA CATEGORIA POR DEFECTO DEL CLUB LOCAL,.
					   // todos los que no tengan Fecha de Baja...
					   	$jugadores = jugador::getJugadorPartidoInsert($idpartido,$Fecha,$ClubA,$categoria,$anioEq,$jugador,$categoria); 
						
							for($contador=0; $contador < count($jugadores);$contador++ )
							{ // recorro vector de jugadores del equipo A
									$jugadorJuega = $jugadores[$contador]['idjugador']; 
									$puesto = $jugadores[$contador]['puesto'];
									$mensajeAlta = "'".$mensajePre." INSERTAR_SETS::INSERT jugadores default club Local' ";
									$retornoCab = partjugCab::insert($idpartido,$Fecha,$ClubA,$categoria,$jugadorJuega,$puesto,$mensajeAlta);
									//echo "<br>$retornoCat<br>";
							};

					   // PROCESAMOS LOS JUGADORES DE LA CATEGORIA POR DEFECTO DEL CLUB VISITANTE,.
					   	$jugadores = jugador::getJugadorPartidoInsert($idpartido,$Fecha,$ClubB,$categoria,$anioEq,$jugador,$categoria); 
							for($contador=0; $contador < count($jugadores);$contador++ )
							{ // recorro vector de jugadores del equipo A
									$jugadorJuega = $jugadores[$contador]['idjugador']; 
									$puesto = $jugadores[$contador]['puesto'];
									$mensajeAlta = "'".$mensajePre." INSERTAR_SETS::INSERT jugadores default club Visitante' ";
									$retornoCab = partjugCab::insert($idpartido,$Fecha,$ClubB,$categoria,$jugadorJuega,$puesto,$mensajeAlta);
									//echo "<br>$retornoCat<br>";
							};
			}		



    if ($retorno) {
        // C�digo de �xito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creaci�n exitosa')));
    } else {
        // C�digo de falla
		echo $retorno;
    }

}

?>