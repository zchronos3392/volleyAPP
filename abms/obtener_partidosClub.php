<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax

/*
If your code is running on multiple servers with different environments (locations from where your scripts run) the following idea may be useful to you:

a. Do not give absolute path to include files on your server.
b. Dynamically calculate the full path (absolute path)

Hints:
Use a combination of dirname(__FILE__) and subsequent calls to itself until you reach to the home of your '/index.php'. Then, attach this variable (that contains the path) to your included files.

One of my typical example is:
<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/config.php');
?>

instead of:
<?php require_once('/var/www/public_html/config.php'); ?>

After this, if you copy paste your codes to another servers, it will still run, without requiring any further re-configurations.
*/

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/Funciones.php');

require ('Partido.php');
require_once('Club.php');

//echo($_SERVER['REQUEST_METHOD']);
if($_SERVER['REQUEST_METHOD'] == 'GET') {
	
	$partidoid = 0;
	if(isset($_GET["id"])) $partidoid = (int) $_GET["id"];
	// 29-08-2018
	$fecpartido="''";// sera string 
	if(isset($_GET["fechapart"])) $fecpartido = "'".$_GET["fechapart"]."'";
	
	//CHEQUEO SI VIENEN LOS FILTROS PARA AGGREAR
	$estado = 0;
	if (isset($_GET["estado"]))	$estado = (int) $_GET["estado"];	
	
	$icomp = 9999;
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
	
	
	$clubData = Club::getByIdStatsClub($iclub);	

	$clubAnalizado = $clubData["0"]['clubabr'];	
	//echo "CLUB ANLIZANDO : $clubAnalizado <BR>";
					
	$fecDde="''";// sera string 
	if(isset($_GET["fdesde"])) $fecDde = "'".$_GET["fdesde"]."'";

		
	$fecHta="''";// sera string 
	if(isset($_GET["fhasta"])) $fecHta = "'".$_GET["fhasta"]."'";	

	$fecOrden = '';
		if (isset($_GET["fdesdeOrden"]))
			//$fecDdeOrden = $_GET["fdesdeOrden"];
				$fecOrden = filter_input(INPUT_GET, 'fdesdeOrden', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
		
		//CHEQUEO SI VIENEN LOS FILTROS PARA AGGREAR

	    // Manejar petici�n GETstat
    	$registros = Partido::contarStatsClub($icomp,$icate,$iclub,$icity,$fecDde,$fecHta,$fecOrden,$estado);
    	// ESTA VOLVIENDO UN VECTOR DE VECTORES
    	//print_r ($registros["0"]["count(*)"]);
			
	
	    if($registros["0"]["count(*)"] > "0")
	     {
			// va a entrar por aca, ya que va a traer todos...
			// chequeo si tiene alguno para parametrizar...
			if (($icomp != 0) || ($icate != 0) || ($iclub != 0) || ($icity != 0) || ($fecDde != "''") || ($fecHta != "''"))
					$partidos = Partido::getAllcparmsClub($icomp,$icate,$iclub,$icity,$fecDde,$fecHta,$fecOrden,$estado);
			
		    if ($partidos)
		    {
		    	$gano   =0;
		    	$perdio =0;
		    	$nsnc   =0;
				for($contador=0; $contador < count($partidos);$contador++ )
				{ // recorro vector de partidos para elegir el ganador del partido
				//Fecha":"2021-09-04",
				 // "idPartido":"2",
				 // "CatDesc":"SUB19[CAB]",
				 // "setsnmax":"5",
				 // "ClubA":"HARRODS",
				 // "ClubB":"HACOAJ",
				 // "cancha":"HARRODS - CAPITAL-BELGRANO - GIMNASIO 1 - CAP",
				  //"cnombre":"Clasificaci\u00f3n::Inferiores - Nivel B::Caballeros",
				 // "nombre":"CAPITAL FEDERAL",
				 // "Inicio":"17:00",
				 // "Horafin":"2021-09-04 17:00:00",
				 // "ClubARes":"0",
				 // "ClubBRes":"0",
				 // "descripcion":"PROGRAMADO				
				$ClubARes  = $partidos[$contador]['ClubARes']; 
				$ClubBRes = $partidos[$contador]['ClubBRes']; 
				$ClubA    =  $partidos[$contador]['ClubA']; 
				$ClubB    =  $partidos[$contador]['ClubB']; 
				$setsnmax =  $partidos[$contador]['setsnmax']; 
				$IdGanador = fx::detectaGanador($ClubARes,$ClubBRes,$ClubA,$ClubB,$setsnmax);
				
				//echo "<br> ganador detectado : $IdGanador vs club analizando $clubAnalizado <br>";
				if($IdGanador == $clubAnalizado) $gano++;
				else{ 
							if($IdGanador == 'No hubo/ hay ganador ') $nsnc++;
						 	else $perdio++;
						};
						 		
				$partidos[$contador]['Ganador']= $IdGanador;
						//echo "<br>$IdGanador<br>";
				};
		    	
		    	
				//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
		        $datos["estado"] = 1;
		        $datos["registros"] = $registros["0"]["count(*)"];
		        $datos["ganados"] = $gano; 
		        $datos["perdidos"] = $perdio;
		        $datos["noinfo"] = $nsnc;
		        $datos["Stats2"] = $partidos;//es un array
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


?>
