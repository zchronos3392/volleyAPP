<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require('./abms/Partido.php');
require('./abms/Jugador.php');
require('./abms/JugadorPartidoCab.php');


if($_SERVER['REQUEST_METHOD'] == 'GET') {
	
			$Fecha       = "'".$_GET['fechap']."'"; // debe llevar comillas
			$categoria   = $_GET['icate']; // numero
			$ClubA       = $_GET['iclub']; // numero
			$ClubB       = 50;
			$competencia =28;
			// agregados en abril 2019
				$tbset      = 0; // numero
				if(isset($_GET['valtbset'])){  $tbset = $_GET['valtbset'];} else { $tbset = 0; };				
				$finset      = 0; // numero
				if(isset($_GET['valfinset'])){  $finset = $_GET['valfinset'];} else { $finset = 0; };							
			// agregados en abril 2019			
			
			$ClubARes    = 0; // numero, se actualiza al finalizar
			$ClubBRes    = 0; // numero, se actualiza al finalizar
			
	        		
	$retornoIdPartido	= Partido::getPartidoId($Fecha,$categoria,$ClubA,$ClubB,$competencia);
	$anioEq=0; // necesitamos el anio porque los equipos cambian por año.
	if( isset($_GET['ianio']) )  $anioEq = $_GET['ianio'];
	//$retorno=$idpartido;
  	echo "el alta del partido retornó lo siguiente: <br>";
  	print_r($retornoIdPartido);
  	$idpartido = $retornoIdPartido['0']['idFinal'];
        //echo "  ultimo id cargado del partido: $idpartido y el anio : $anioEq";
    $mensajePre="";    
   // esto se hace una vez, asi que aca agrego la lista de jugadores por Defualt, de la categoria del partido.
   $jugador=0; //en esta pantalla no tengo el dato de los jugadores a mano...
   // PROCESAMOS LOS JUGADORES DE LA CATEGORIA POR DEFECTO DEL CLUB LOCAL,.
   // todos los que no tengan Fecha de Baja...
   	$jugadores = jugador::getJugadorPartidoInsert($idpartido,$Fecha,$ClubA,$categoria,$anioEq,$jugador,$categoria); 
//		ECHO "DATOS OBTENIDOS: ";
	
		for($contador=0; $contador < count($jugadores);$contador++ )
		{ // recorro vector de jugadores del equipo A
				$jugadorJuega = $jugadores[$contador]['idjugador']; 
				$puesto = $jugadores[$contador]['puesto'];
				$mensajeAlta = "'".$mensajePre." INSERTAR_SETS::INSERT jugadores default club Local' ";
				echo "<br>";
			 	print_r($jugadores[$contador]);
				//echo "<br>$retornoCat<br>";
				echo "<br>";
		};
}
?>