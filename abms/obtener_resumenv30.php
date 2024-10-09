<style>
/* MEDIDAS DE VIEWPORT GRANDE.... */
/* MEDIDAS DE VIEWPORT PEQUEÑA.... */		
		html, body{
			height: auto;
		}

		.seccionContiene{
				margin: 1em 0 0 0.2rem;
				padding-top: 0em;
				width: 60%;
		}
		
		.seccioninfoTodo{
			display: grid;
			grid-template-columns: 17% 17% 17% 17% 17%  ;	/*33% 1fr 1fr;*/
			border: 2px solid white;
			text-align: center;
			column-gap: 0.5em;
			
			width: 23em;
			margin-top: 0%;
			} 
			
				.seccioninfoSet{
						display:block;
						height:auto;
						border:var(--borde-linea);
						width: 100%;
				}
					.setinfoceldas {
						display: grid;
						grid-template-columns: 100% 100%; /*dos columnas, una para puntoa y otra para puntob*/
						grid-template-rows: 2em;
						width: 50%;
						height: auto;
						font-size: 8px;
					}
						.encab{color: white; background-color: #ff30eb;}
						.infopunto{	border:1px solid black;	background-color:#428bca; }
						.infosinpunto{border:1px solid black; background-color:white;}
		
</style>
<?php
/*
* DEVUELVE UN RESUMEN POR PUNTOS DE CADA SET DEL PARTIDO...
*/
require ('Partido.php');
require_once('Set.php'); 

//echo($_SERVER['REQUEST_METHOD']."<br>");
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    // Manejar petici�n GET
    //$registros = Partido::contar();
    // ESTA VOLVIENDO UN VECTOR DE VECTORES
	$partidoid = 0;
	if(isset($_GET["id"])) $partidoid = (int) $_GET["id"];
	// 29-08-2018
	$fecpartido="''";// sera string 
	if(isset($_GET["fecha"])) $fecpartido = "'".$_GET["fecha"]."'";

$partidoData = Partido::getById($partidoid,$fecpartido);
//print_r( $partidoData);

//print_r($partidoData);

if($partidoData['estado'] == 'FINALIZADO'){
	
	
$resumenarray =  Sett::getResumenPartido($partidoid,$fecpartido);
//print json_encode($resumenarray);
// MUETRO TODOS LOS DATOS TAL CUAL LLEGAN DEL SET...
// secuencia, setnumero, puntoa, puntob, hora,HoraAnterior
// $HoraInicio =  DateTime::createFromFormat('H:i:s', $resumenarray[1]['HoraAnterior']);
// $HoraFin    = DateTime::createFromFormat('H:i:s', $resumenarray[(sizeof($resumenarray)-1)]['hora']);
// $intervalo = $HoraInicio->diff($HoraFin);

// 	// Obtenemos la diferencia en minutos
// $diferencia_minutos = $intervalo->i;	
// $diferencia_segundos = $intervalo->s;	
// 	echo " Inicio en ".$resumenarray[1]['HoraAnterior'].", Finalizado en ".$resumenarray[(sizeof($resumenarray)-1)]['hora'].", Duracion Total Partido ($diferencia_minutos MM $diferencia_segundos SS)<br>";

$setActual = 1;
$i=0;

$EstructuraResumen  = "<div class='Resumen'>";
$CadenaLocal        = "<div class='TableroResumen'><div>Club local nombre</div><div>".$partidoData['ClubA']."</div></div>";
$CadenaVisitante    = "<div class='TableroResumen'><div>Club visitante nombre</div><div>".$partidoData['ClubB']."</div></div>";

// RESUMEN
// TableroResumen
// 	ITEM1
// 	ITEM2


while($i<(sizeof($resumenarray)-1))
// for($i=0;$i<sizeof($resumenarray);$i++)
{
//   if( ($resumenarray[$i]['setnumero'] == 1) && ($i !=0) )
//  if( ($i =0) )  
$ResultadoFinalLocal  = 0;
$ResultadoFinalVisita = 0;


 while($resumenarray[$i]['setnumero'] == $setActual && $i<(sizeof($resumenarray)-1) )
 {
	if($resumenarray[$i]['secuencia'] == 1)
		{
			$HoraInicio =  DateTime::createFromFormat('H:i:s', $resumenarray[$i]['HoraAnterior']);
			//$indiceHoraInicio = $i; 	
		}
		// echo "<br>indice procesando : $i<br>";
		// Creamos objetos DateTime con las cadenas de texto
		$datetime1 = DateTime::createFromFormat('H:i:s', $resumenarray[$i]['hora']);
		$datetime2 = DateTime::createFromFormat('H:i:s', $resumenarray[$i]['HoraAnterior']);

		// Calculamos la diferencia de tiempo
		$intervalo = $datetime1->diff($datetime2);

		// Obtenemos la diferencia en minutos
		$diferencia_minutos = $intervalo->i;	
		$diferencia_segundos = $intervalo->s;	
		//  echo "<div >indice: ".$i." Secuencia: ".$resumenarray[$i]['secuencia']." Set: ".$resumenarray[$i]['setnumero']." pa: ".$resumenarray[$i]['puntoa']." pb: ".$resumenarray[$i]['puntob']." hora registro: ".$resumenarray[$i]['hora']." Hr Anterior: ".$resumenarray[$i]['HoraAnterior']."($diferencia_minutos MM $diferencia_segundos SS)</div><br>";
		$i++; // avanzo la coleccion completa
		//$HoraFin    = DateTime::createFromFormat('H:i:s', $resumenarray[$i]['hora']);
 } // sea el mismo set

	$sHoraInicio = $HoraInicio->format('H:i:s');
	$HoraFin    = DateTime::createFromFormat('H:i:s', $resumenarray[($i-1)]['hora']);
	$ResultadoFinalLocal  = $resumenarray[$i-1]['puntoa'];
	$ResultadoFinalVisita = $resumenarray[$i-1]['puntob'];

	//		$intervalo = $HoraFin->diff($HoraInicio);
	$intervalo = $HoraInicio->diff($HoraFin);
	//		print_r($intervalo);
	// Obtenemos la diferencia en minutos
	$diferencia_minutos = $intervalo->i; // aca esta la posta.	
	$diferencia_segundos = $intervalo->s;	
		echo " Inicio Set ".$setActual." en ".$sHoraInicio.", Finalizado en ".$resumenarray[($i-1)]['hora'].", Duracion Total Partido ($diferencia_minutos MM $diferencia_segundos SS)<br>";
 		echo "Resultado Final Local $ResultadoFinalLocal <br>";
		 echo "Resultado Final Visitante $ResultadoFinalVisita <br>";
		$setActual  = $resumenarray[$i]['setnumero'];
	$resumenarray[$i]['TotalTiempoSet']=$diferencia_minutos."MM";

} // while que recorre todos los puntos de todos los sets


//print json_encode($resumenarray);

echo "<section id='seccioninfoTodo' name='seccioninfoTodo' class='seccioninfoTodo'> <!--GRID DE TRES FILAS, 100% DE ANCHO, ALTO 50% -->";
$setnumero=$i=$ApareceSetDistinto=0;
/* LEER DATOS DEL SET ACA: */



for($j=0;$j<sizeof($resumenarray);$j++)	
{
//corte de control por set		
	if($setnumero <> $resumenarray[$j]['setnumero']	)
	{
//		ECHO "APERTURA DE SET.<br>"	;
	    $setnumero = $resumenarray[$j]['setnumero']	;		
	    $ApareceSetDistinto = $j;
	    //echo "ApareceSetDistinto SET EN ". $ApareceSetDistinto;
   	    echo "<section id='seccioninfoSet' name='seccioninfoSet' class='seccioninfoSet'> <!--GRID DE UNA FILA Y CINCO COLUMNAS 20% DE ANCHO, ALTO 100% -->";
		   echo "<div id='setinfoceldas' name='setinfoceldas' class='setinfoceldas'><div id='encab' class='encab'>".$partidoData['ClubA']."</div><div id='encab' class='encab'>".$partidoData['ClubB']."</div></div>"; 
		while(isset($resumenarray[$i]['setnumero']) && $resumenarray[$i]['setnumero']==$setnumero && $i < sizeof($resumenarray) )
		{
			   if( /*$i != $ApareceSetDistinto*/ 1) 
			   // PROCESAMOS EL PUNTO DEL LOCAL, QUE SIEMPRE ES EL PRIMERO EN VERSE, A LA IZQUIERDA..
			   if($i == 0){	}//el primero registro de la tabla es la preparacioon del set, no tiene puntos
			   else
			   {
					echo "<div id='setinfoceldas' name='setinfoceldas' class='setinfoceldas'>";

				   if (($resumenarray[$i-1]['puntoa'] == $resumenarray[$i]['puntoa']) &&($resumenarray[$i-1]['puntob'] != $resumenarray[$i]['puntob'])  || ($resumenarray[$i]['puntob'] == $resumenarray[$i]['puntoa'])  ) {
					   if ($resumenarray[$i]['puntoa'] <= 9){//primeros pntos menores a 10
						   	$puntobien= '0'.$resumenarray[$i]['puntoa'];
						   echo "<div id='infosinpunto' name='infosinpuntoa' class='infosinpunto'>".$puntobien."</div>";						       
					   }
					   else{ 	   
					   			echo "<div id='infosinpunto' name='infosinpuntoa' class='infosinpunto'>".$resumenarray[$i]['puntoa']."</div>";
					  } 
				}
				else {
					   if( ($resumenarray[$i]['puntoa'] == $resumenarray[$i]['puntob']) ){}
						else {
							if ($resumenarray[$i]['puntoa'] <= 9) {
								$puntobien= '0'.$resumenarray[$i]['puntoa'];
								echo "<div id='infosinpunto' name='infosinpuntoa' class='infosinpunto'>".$puntobien."</div>";
								}
							else {							
								echo "<div id='infopunto' name='infopuntoa' class='infopunto'>".$resumenarray[$i]['puntoa']."</div>";}
	}
				   }
			   } // NO ES EL PUNTO INICIAL	
			   
			   // PROCESAMOS EL PUNTO DEL VISITANTE A LA DERECHA DEL LOCAL...
			   if($i == 0){	}//el primero registro de la tabla es la preparacioon del set, no tiene puntos
			   else
			   {
				if (($resumenarray[$i-1]['puntob'] == $resumenarray[$i]['puntob'])
				&&($resumenarray[$i-1]['puntoa'] != $resumenarray[$i]['puntoa']) || ($resumenarray[$i]['puntob'] == $resumenarray[$i]['puntoa'])   ) {
					if ($resumenarray[$i]['puntob'] <= 9) {
						$puntobien= '0'.$resumenarray[$i]['puntob'];
						echo "<div id='infosinpunto' name='infosinpuntoa' class='infosinpunto'>".$puntobien."</div>";
						
					} else {
						echo "<div id='infosinpunto' name='infosinpuntob' class='infosinpunto'>".$resumenarray[$i]['puntob']."</div>"; }
				}	
				else {
					   if( ($resumenarray[$i]['puntoa'] == $resumenarray[$i]['puntob']) ){}
						else //$puntajeB = "PUNTO B";	//PODRIA HABER ERROR...
						{
							if ($resumenarray[$i]['puntob'] <= 9)
							{
								$puntobien= '0'.$resumenarray[$i]['puntob'];
								echo "<div id='infosinpunto' name='infosinpuntoa' class='infosinpunto'>".$puntobien."</div>";
								
							}
							else {		
								echo "<div id='infopunto' name='infopuntob' class='infopunto'>".$resumenarray[$i]['puntob']."</div>";}
						}
				     }
			    }
					$i++;
					if( $i != $ApareceSetDistinto)  
					echo "</div>";// INFO DEL SET, CON Y SIN PUNTO
		    } // solo set ACTIVO EN EL CIcLO DE afuera, se guarda la esstructura especial..
		//    		ECHO "CIERRE SET.<br>"	;
		echo("</section>");
	}	// FIN del if $setnumero <> $resumenarray[$j]['setnumero']
	
 } //fin del for...
}
} // fin de GET 
/* CIERRE DE LA REPETICION POR SET..*/	
echo("</section>");	/* section info todo*/	    			

?>
<!-- INFO TABLERO FIN -->
