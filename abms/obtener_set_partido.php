<?php

require ('Set.php');
include ('Jugador.php');

require_once('JugadorPartido.php');

//este archivos sirve para traer datos del partido con los nombres de los jugadore tambien
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	if(isset($_GET['idpartido'])){  $idpartido = $_GET['idpartido'];} else { $idpartido = 0; };
	if(isset($_GET['idset'])){  $idset = $_GET['idset'];} else { $idset = 0; };

	$fecha ="";
	if(isset($_GET['fechas'])) $fecha = "'".$_GET['fechas']."'";	
	
	$ianioPartido = 0;
	if(isset($_GET['ianio']))$ianioPartido = $_GET['ianio'];
	 
		$secuenciaarray =  Sett::ultSecuencia($idpartido,$idset,$fecha);
		//print_r($secuenciaarray );
		$secuencia = 0;
			if( !empty($secuenciaarray) ) $secuencia = (int) $secuenciaarray[0]["secuencia"];
		$setData = Sett::getById($idpartido,$idset,$secuencia,$fecha);
		//print_r($setData);
		//print(jugador::getById((int)$setData["ClubA"],(int)$setData["pa_1"])) ;
		$liberosA= array();
		$liberosB= array();
		$vectorJugador = array();

	    if ($setData)
	    {
			$jugadoresA = partjug::getJugSetLoad($idpartido,$fecha,$setData["ClubA"],$ianioPartido,$idset,$setData["categoria"]); 
			$pointer1 =0;
			$pointer2 =0;			
			//echo "..:: LISTA DE JUGADORES DEL EQUIPO LOCAL ::..<br>";
			//print_r($jugadoresA);
			//echo "<br>..:: LISTA DE JUGADORES DEL EQUIPO LOCAL ::..<BR>";
			$pointerSuplentes=0;
			foreach($jugadoresA as $indice => $valor)
			{
				//echo "posicion : $indice <br>";
				//print_r($valor);
				//echo "<br>";
				if($valor["posicion"] == 7 ){
				  // echo $valor["nombre"]." es suplente<br>";
					$datos["SuplentesA"][$pointerSuplentes]= $valor; // tomar valido el campo PUESTO.
					$pointerSuplentes++;					
				}
			}
			
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
					else
					{
							$vectorJugador["idjugador"]=$valor["idjugador"];
							$vectorJugador["posicion"]=$valor["posicion"];
							$vectorJugador["puesto"]=$valor["puesto"];
							$vectorJugador["puestoxcat"]=$valor["puestoxcat"];
								$vectorJugador["ColorPuestoCancha"]=$valor["ColorPuestoCancha"];
								$vectorJugador["ColorPuestoCat"]=$valor["ColorPuestoCat"];
							$setJugadores["equipoA"][$pointer2]=$vectorJugador;	
							$pointer2++;
					}
			}
/*
			echo " LIBEROS ONLY <BR>";
				
			foreach($datos["LiberosA"] as $indice => $valor)				
			{
					echo "indice $indice : ";
					print_r($valor);
					echo " <br>";
			}
			echo " EQUIPO RESTANTE SIN LIBEROS...<br>";

			foreach($setJugadores["equipoA"] as $indice => $valor)				
			{
					echo "indice $indice : ";
					print_r($valor);
					echo " <br>";
			}
*/
/**
* 
* @var ***************************************************************************************
* 
*/
			$jugadoresB = partjug::getJugSetLoad($idpartido,$fecha,$setData["ClubB"],$ianioPartido,$idset,$setData["categoria"]); 
			$pointer1 =0;
			$pointer2 =0;

			$pointerSuplentes=0;
			foreach($jugadoresB as $indice => $valor)
			{
				if($valor["posicion"] == 7 ){
				  // echo $valor["nombre"]." es suplente<br>";
					$datos["SuplentesB"][$pointerSuplentes]= $valor; // tomar valido el campo PUESTO.
					$pointerSuplentes++;					
				}
			}

			foreach($jugadoresB as $indice => $valor)
			{
				$puesto=$valor["puestoxcat"];
				  if($puesto != $valor["puesto"]) $puesto= $valor["puesto"];
				   //echo "puesto : $puesto <br>";
				   if($puesto ==2) //libero
					{
							$datos["LiberosB"][$pointer1]= $valor; // tomar valido el campo PUESTO...
							$pointer1++;
					}	
					else
					{
							$vectorJugador["idjugador"]=$valor["idjugador"];
							$vectorJugador["posicion"]=$valor["posicion"];
							$vectorJugador["puesto"]=$valor["puesto"];
							$vectorJugador["puestoxcat"]=$valor["puestoxcat"];
							// Nuevo agregado el color del puesto 
							$vectorJugador["ColorPuestoCancha"]=$valor["ColorPuestoCancha"];
							$vectorJugador["ColorPuestoCat"]=$valor["ColorPuestoCat"];
							
							$setJugadores["equipoB"][$pointer2]=$vectorJugador;	
							$pointer2++;
					}
			}

			
			$datos["estado"] = 1;
			//esta funcion getBYId no trae ni el puesto ni el color...
			//porque se resuelve del lado del cliente..
				$setJugadores["pa_1"] = jugador::getById((int)$setData["ClubA"],(int)$setData["pa_1"],$setData["categoria"]) ;
				$setJugadores["pa_2"] = jugador::getById((int)$setData["ClubA"],(int)$setData["pa_2"],$setData["categoria"]);
				$setJugadores["pa_3"] = jugador::getById((int)$setData["ClubA"],(int)$setData["pa_3"],$setData["categoria"]);
				$setJugadores["pa_4"] = jugador::getById((int)$setData["ClubA"],(int)$setData["pa_4"],$setData["categoria"]);
				$setJugadores["pa_5"] = jugador::getById((int)$setData["ClubA"],(int)$setData["pa_5"],$setData["categoria"]);
				$setJugadores["pa_6"] = jugador::getById((int)$setData["ClubA"],(int)$setData["pa_6"],$setData["categoria"]);
				$setJugadores["pb_1"] = jugador::getById((int)$setData["ClubB"],(int)$setData["pb_1"],$setData["categoria"]);
				$setJugadores["pb_2"] = jugador::getById((int)$setData["ClubB"],(int)$setData["pb_2"],$setData["categoria"]);
				$setJugadores["pb_3"] = jugador::getById((int)$setData["ClubB"],(int)$setData["pb_3"],$setData["categoria"]);
				$setJugadores["pb_4"] = jugador::getById((int)$setData["ClubB"],(int)$setData["pb_4"],$setData["categoria"]);
				$setJugadores["pb_5"] = jugador::getById((int)$setData["ClubB"],(int)$setData["pb_5"],$setData["categoria"]);
				$setJugadores["pb_6"] = jugador::getById((int)$setData["ClubB"],(int)$setData["pb_6"],$setData["categoria"]);	
			


			$setJugadores["pa_1idjugx"] = (int)$setData["pa_1"];
			$setJugadores["pa_2idjugx"] = (int)$setData["pa_2"];
			$setJugadores["pa_3idjugx"] = (int)$setData["pa_3"];
			$setJugadores["pa_4idjugx"] = (int)$setData["pa_4"];
			$setJugadores["pa_5idjugx"] = (int)$setData["pa_5"];
			$setJugadores["pa_6idjugx"] = (int)$setData["pa_6"];
			$setJugadores["pb_1idjugx"] = (int)$setData["pb_1"];
			$setJugadores["pb_2idjugx"] = (int)$setData["pb_2"];
			$setJugadores["pb_3idjugx"] = (int)$setData["pb_3"];
			$setJugadores["pb_4idjugx"] = (int)$setData["pb_4"];
			$setJugadores["pb_5idjugx"] = (int)$setData["pb_5"];
			$setJugadores["pb_6idjugx"] = (int)$setData["pb_6"];	
								
	        $setJugadores["estado"] = $setData["estado"];
	        $setJugadores["saque"]  = $setData["saque"];
	        $setJugadores["puntoa"] = $setData["puntoa"];
	        $setJugadores["puntob"] = $setData["puntob"];
	        $setJugadores["CantPausaA"] = $setData["CantPausaA"];
	        $setJugadores["CantPausaB"] = $setData["CantPausaB"];
	        
	        $datos["PartidoData"] = $setData;//es un array
	        $datos["Sets"] = $setJugadores;//es un array
	        		print json_encode($datos);
		}
	    else
	    {
	    	$setData = array("id" => 2,"nombre" => "Sin set data aun");
	    	$datos["estado"] = 0;
	        $datos["Sets"] = $setData;
	    	print json_encode($datos);
	    }
	}

?>
