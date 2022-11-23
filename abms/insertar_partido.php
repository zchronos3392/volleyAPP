<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require('Partido.php');
require('Jugador.php');
require('JugadorPartidoCab.php');


if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
			$Fecha       = $_POST['fechap']; // debe llevar comillas
			$categoria   = $_POST['icate']; // numero
			$ClubA       = $_POST['iclub']; // numero
			$ClubB       = $_POST['iclubb']; // numero
				$CanchaId    = $_POST['icancha']; // numero			
			$competencia = $_POST['icomp']; // numero
			$ciudad      = $_POST['icity']; // numero
			$descripcionp = "'".$_POST['descripcionp']."'";
			// agregados en abril 2019
				$tbset      = 0; // numero
				if(isset($_POST['valtbset'])){  $tbset = $_POST['valtbset'];} else { $tbset = 0; };				
				$finset      = 0; // numero
				if(isset($_POST['valfinset'])){  $finset = $_POST['valfinset'];} else { $finset = 0; };							
			// agregados en abril 2019			
			
			$s = $Fecha." ".$_POST['horai'].":00";
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
			 if(isset($_POST['SetMaxCat'])){  $smaxCate = $_POST['SetMaxCat'];} else { $smaxCate = 0; };
			 if(isset($_POST['SetMaxComp'])){ $smaxcomp = $_POST['SetMaxComp']; } else { $smaxcomp =0; };
			// ejemplo:	SetMaxCat=3 - SetMaxComp=0
			
	        if(  ($smaxcomp > 0) && ($smaxCate >0)  ) { $setsmax = $smaxcomp;};
    	    if(  ($smaxcomp == 0) && ($smaxCate > 0) ) { $setsmax = $smaxCate;};
        	if(  ($smaxcomp > 0) && ($smaxCate == 0) ){  $setsmax = $smaxcomp;};
			
			
    // Insertar partido
        		$Fecha = "'".$Fecha."'";
        		
	$retorno = Partido::insert($Fecha,$categoria,$ClubA,$ClubB,$CanchaId,$competencia,$ciudad,$HoraIni,$Horafin,$ClubARes,$ClubBRes,$estado,$setsmax,$tbset,$finset,$descripcionp);
	// luego de haber dado de alta el partido, agregamos poor defecto los jugadores de cada Club
	// de la categoria del partido:

	$retornoIdPartido	= Partido::getPartidoId($Fecha,$categoria,$ClubA,$ClubB,$competencia);
	$anioEq=0; // necesitamos el anio porque los equipos cambian por año.
	if( isset($_POST['ianio']) )  $anioEq = $_POST['ianio'];
	//$retorno=$idpartido;
  	//echo "el alta del partido retornó lo siguiente: <br>";
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



    if ($retorno) {
        // Código de éxito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creación exitosa')));
    } else {
        // Código de falla
		echo $retorno;
    }

}
else{

if($_SERVER['REQUEST_METHOD'] == 'GET') {
	
			$Fecha       = $_GET['fechap']; // debe llevar comillas
			$categoria   = $_GET['icate']; // numero
			$ClubA       = $_GET['iclub']; // numero
			$ClubB       = $_GET['iclubb']; // numero
				$CanchaId    = $_GET['icancha']; // numero			
			$competencia = $_GET['icomp']; // numero
			$ciudad      = $_GET['icity']; // numero
			$descripcionp = "'".$_GET['descripcionp']."'";
			// agregados en abril 2019
				$tbset      = 0; // numero
				if(isset($_GET['valtbset'])){  $tbset = $_GET['valtbset'];} else { $tbset = 0; };				
				$finset      = 0; // numero
				if(isset($_GET['valfinset'])){  $finset = $_GET['valfinset'];} else { $finset = 0; };							
			// agregados en abril 2019			
			
			$s = $Fecha." ".$_GET['horai'].":00";
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
			 if(isset($_GET['SetMaxCat'])){  $smaxCate = $_GET['SetMaxCat'];} else { $smaxCate = 0; };
			 if(isset($_GET['SetMaxComp'])){ $smaxcomp = $_GET['SetMaxComp']; } else { $smaxcomp =0; };
			// ejemplo:	SetMaxCat=3 - SetMaxComp=0
			
	        if(  ($smaxcomp > 0) && ($smaxCate >0)  ) { $setsmax = $smaxcomp;};
    	    if(  ($smaxcomp == 0) && ($smaxCate > 0) ) { $setsmax = $smaxCate;};
        	if(  ($smaxcomp > 0) && ($smaxCate == 0) ){  $setsmax = $smaxcomp;};
			
			
    // Insertar partido
        		$Fecha = "'".$Fecha."'";


	$parametro[0]=$_GET['fechap'];
	$parametro[1]="categoria: ".$categoria;
	$parametro[2]="clob local ".$ClubA;
	$parametro[3]="club vistante ".$ClubB;
	$parametro[4]="cancha: ".$CanchaId;
	$parametro[5]="compentecia : ".$competencia;
	$parametro[6]="ciudad : ".$ciudad;
	$parametro[7]="horaI: ".$_GET['horai'];
	$parametro[8]="horaF: ".$_GET['horai'];
	$parametro[9]="clubARes: ".$ClubARes;					
	$parametro[10]="clubBRes: ".$ClubBRes;					
	$parametro[11]="estado: ".$estado;					
	$parametro[12]="setsmax: ".$setsmax;					
	$parametro[13]="tbset : ".$tbset;	
	$parametro[14]="finset: ".$finset;
	$parametro[15]="descr partido: ".$_GET['descripcionp'];		

	$parametros= "'".implode(";",$parametro)."'";

	echo "PARAMETROS RECIBIDOS: ".$parametros."<BR>";
        		
	$retorno = Partido::insert($Fecha,$categoria,$ClubA,$ClubB,$CanchaId,$competencia,$ciudad,$HoraIni,$Horafin,$ClubARes,$ClubBRes,$estado,$setsmax,$tbset,$finset,$descripcionp);

	echo "retorno insert: : ".$retorno ."<BR>";
		
	
// Luego de haber dado de alta el partido, agregamos poor defecto los jugadores de cada Club
// de la categoria del partido:

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



    if ($retorno) {
        // Código de éxito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creación exitosa')));
    } else {
        // Código de falla
		echo $retorno;
    }
} // FIN DEL ELSE
}
?>