<?php

require ('Set.php');
require_once('JugadorPartido.php');
require_once('Rotaciones.php');
require_once('Partido.php');
require_once('Jugador.php');
//COMO FUNCIONA: 
//	1 PRIMERO BUSCO EL ULTIMO SET JUGADO, PODRIA SER EL PRIMERO ENTONCES NO HAY O HAY UNO ANTERIOR
//	ASI QUE AVANZO AL SIGUIENTE, PORQUE SI LLEGASTE HASTA ACA, ESTAS DANDO DE ALTA UN NUEVO SET.
// 2 Con el año del equipo, porque busco al equipo de este año, de la categoria del partido	
// 		y obtengo ciertos datos de la cabecera del partido que me sirven para ir controlando el fin del set
//   	o set ganado..
// 3 con el año, busco los jugadores de la misma categoria del partido y los cargo por 
//   		default en la tabla JUGADORES DEL PARTIDO, POR EQUIPO, CABECERA

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$idpartido = (int) $_POST['idpartido'];
	$setnumero =  (int) $_POST['idset'];
	$anioEq = 0 ;
	if(isset($_POST["anioEquipo"])) $anioEq = (int)$_POST["anioEquipo"]; 
	$mensajePre = "";
	$mensajePre = $_POST['mensajeAlta'];

	// 29-08-2018
	$fecha =  "'".$_POST['fechas']."'";
	$secuenciaarray =  Sett::ultSecuencia($idpartido,$setnumero,$fecha);
	//print_r($secuenciaarray);
	//echo($secuenciaarray[0]["secuencia"]);
	//echo($idpartido);
	//echo($setnumero);
	$secuencia = 0;
	if( !empty($secuenciaarray) ) $secuencia = (int) $secuenciaarray[0]["secuencia"];
    if($secuencia == 0) $secuencia = 1;
    else $secuencia++;
 
 	$saque=0; // sino no se definen
 	$saque=(int) $_POST['saque'];
 	 	 	 	
	$hora =  $_POST['horas'];
		$fecha =  $_POST['fechas'];
		$s = $fecha." ".$hora;
		$horaset = "'".$s."'"; // correcto !!!
// recorrer el array A de jugadores id y sus posiciones
	$A1 = $A2 = $A3 = $A4 = $A5 = $A6 = 0;
	// 16/09/2019
		$contadorpausasA = 2;
		$contadorpausasB = 2;
	// 16/09/2019		
	//eq.numero,eq.nombre,eq.categoria,eq.idjugador,
	//vappjugpartido.idclub,
	//vappjugpartido.posicion
	$fecha2 =  "'".$_POST['fechas']."'";
	$partidoStats = Partido::getById($idpartido,$fecha2 );
	//echo "datos del partido para grabar en los detalles: <br>";
	//	print_r($partidoStats);

	$clublocalA =$partidoStats["idcluba"];
	$clublocalB =$partidoStats["idclubb"];
	
	$categoriaPartido =	$partidoStats["idcat"];
	// CHEQUEADO, TRAE BIEN AL EQUIPO QUE FUE CARGADO ORIGINALMENTE PARA JUGAR
	// el que tiene la misma categoria, los de otra categoria se cargan a MANO..
	// esta lista de jugadores, llegan sin SET asignado..
	$ordenA =1;
	$ordenB =1;

/*	TODO ESTO SE MOVIO A INSERTAR_PARTIDO, Y JUGADORPARTIDOCABECERA.

*/
	
// una vez que tengo la carga inicial de los jugadores por default de la categoria, 
// traigo esos y los que se agregaron...	
	// en jugpartido esta cargado el set NUMERO 0, porque aun no se asignaron el grupo de 
	//jugadores al set activo...		
	$jugsA = partjug::getJugSetLoad($idpartido,$fecha2,$clublocalA,$anioEq,$setnumero,$categoriaPartido);
	//echo "Jugadores que se cargaron en la tabla. vappJugPartido <br>";
	//print_r($jugsA);
		if( !empty($jugsA) && is_array($jugsA) )
		{
		 for($contador=0; $contador < count($jugsA);$contador++ )
	     { // recorro vector de jugadores del equipo A
			switch ($jugsA[$contador]['posicion']) {
			case "0":
				        //echo "NO ASIGNADO<br>";
			        	break;
			    
			case "1":
		    		 $A1 =(int) $jugsA[$contador]['idjugador'];		
			    	break;
		    case "2":
	    			$A2 = (int)  $jugsA[$contador]['idjugador'];		
	    			break;
		    case "3":
	    			$A3 = (int)  $jugsA[$contador]['idjugador'];
	    			break;  
		    case "4":
	    			$A4 = (int)  $jugsA[$contador]['idjugador'];
	    			break;
		    case "5":
	    			$A5 = (int)  $jugsA[$contador]['idjugador'];
	    			break;
		    case "6":
	    			$A6 = (int)  $jugsA[$contador]['idjugador'];
	    			break;
		    case "7": // suplente
	    			//VECTOR DE SUPLENTES - 
	    			//$B6 = (int)  $jugsB[$contador-1];		
	    			break;
		    case "8": // libero
	    			//VECTOR DE LIBEROS -
	    			//$B6 = (int)  $jugsB[$contador-1];		
	    			break;
			}
	     }// for 
   		};// if no empty

// recorrer el array B de jugadores id y sus posiciones
	$B1 = $B2 = $B3 = $B4 = $B5 = $B6 = 0;
	$jugsB = partjug::getJugSetLoad($idpartido,$fecha2,$clublocalB,$anioEq,$setnumero,$categoriaPartido);
	//echo "<br>";
	//print_r($jugsB);
		if( !empty($jugsB) && is_array($jugsB) )
		{
		 for($contador=0; $contador < count($jugsB);$contador++ )
	     { // recorro vector de jugadores del equipo A
				switch ($jugsB[$contador]['posicion']) {
				case "0":
					        //echo "NO ASIGNADO<br>";
				        	break;
				    
				case "1":
			    		 $B1 =(int) $jugsB[$contador]['idjugador'];		
				    	break;
			    case "2":
		    			$B2 = (int)  $jugsB[$contador]['idjugador'];		
		    			break;
			    case "3":
		    			$B3 = (int)  $jugsB[$contador]['idjugador'];
		    			break;  
			    case "4":
		    			$B4 = (int)  $jugsB[$contador]['idjugador'];
		    			break;
			    case "5":
		    			$B5 = (int)  $jugsB[$contador]['idjugador'];
		    			break;
			    case "6":
		    			$B6 = (int)  $jugsB[$contador]['idjugador'];
		    			break;
			    case "7": // suplente
		    			//VECTOR DE SUPLENTES - 
		    			//$B6 = (int)  $jugsB[$contador-1];		
		    			break;
			    case "8": // libero
		    			//VECTOR DE LIBEROS -
		    			//$B6 = (int)  $jugsB[$contador-1];		
		    			break;
				}
		 } // FIN DEL FORº
		};// FIN DEL IF

	if(isset($_POST['estadoset'])){  $estado = $_POST['estadoset'];} else { $estado = 5; };//configuracion INICIAL SET
	// el primer estado, o de configuracion sera 5, para indicar el primer registro del SEt...
	$puntoa =  (int) $_POST['resa'];
	$puntob	 =  (int) $_POST['resb'];

	//02 DIC.2022::ENVIO LA ESTRATEGIA CON RESPECTO A LOS LIBEROS
		//PARA QUE SABER QUÉ HACER AUTOMATICAMENTE EN SUS CAMBIOS..
		// ESTA API TAMBIEN SE LLAMA DESDE CREAR SET, Y COMO NO ENVIO LA ESTRATEGIA
		// SE ESTABA QUEDANDO VACIA LA VARIABLES DE ESTRATEGIA, Y SIN COMILLAS DE VACIO
		// ENTONCES TIRABA ERROR AL CREAR EL SET.
			$estrategiaA = "''";
			if(isset($_POST['estrategiaLA'])) $estrategiaA = "'".$_POST['estrategiaLA']."'";
			$estrategiaB = "''";
			if(isset($_POST['estrategiaLB'])) $estrategiaB = "'".$_POST['estrategiaLB']."'";
		//PARA QUE SABER QUÉ HACER AUTOMATICAMENTE EN SUS CAMBIOS..
	//02 DIC.2022::ENVIO LA ESTRATEGIA CON RESPECTO A LOS LIBEROS
	
    // Insertar Set
	$retorno =0;
	if($mensajePre == 'Novedades30::grabaPos')
	  if($puntoa != 0 | $puntob !=0)
		$mensaje = "'Arreglo de posiciones...'"; // POST	  
	  else
	   {
		$mensaje = "'Confirmando posiciones en planilla...'"; // POST
		// ESTABLECEMOS COMO ESTRATEGIA INICIAL SIEMPRE QUE HAY UN LIBERO
		$estrategiaA=$estrategiaB="'UNLIBERO'";
		$ordenA =1;
		$ordenB =1;
	   }	
	else
		if($mensajePre == 'Novedades30::Partido::Reanudado')
			$mensaje = "' Se reanuda juego'";
		else
		$mensaje = "'Esperando silbato inicial...'";
	
	$retorno = Sett::insert( $idpartido, $secuencia, $setnumero, $fecha2,$horaset,
							 $A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6,
							 $estado,$puntoa, $puntob,$saque,$estrategiaA,$estrategiaB,
							 $ordenA,$ordenB,
							 $mensaje,$contadorpausasA,$contadorpausasB);
	$retornoRotaciones = 0;
	$mensaje = "'por carga inicial del partido...'";		
	$retornoRotaciones = Rotaciones::insert($idpartido,$fecha2,$setnumero,$secuencia,$A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6,$mensaje,0);
	
	//echo("mensaje de rotaciones: ".$retornoRotaciones);
	
	
	
    if($retorno) {
        // Codigo de exito
		$getRegistroSet = Sett::getByIdUltimoRegistro($idpartido,$setnumero,$secuencia,$fecha2 );
		$HoraInicioSeteada="";
		if( !empty($getRegistroSet) ) $HoraInicioSeteada=$getRegistroSet['hora'];
        print(json_encode(
			array('estado' => '1',
				  'mensaje' => 'Creacion exitosa',
				  'ingresoRotacion' => $retornoRotaciones,
				  'HoraInicial'  => $HoraInicioSeteada
				
				)));
    } else 
    {
        // Codigo de falla
		print(json_encode(array('estado' => '2','mensaje' => 'Creacion NO exitosa')));
    }
}
   else{
// LLEGA DESDE UN GET, para pruebass

	$idpartido = (int) $_GET['idpartido'];
	$setnumero =  (int) $_GET['idset'];
	$anioEq = 0 ;
	if(isset($_GET["anioEquipo"])) $anioEq = (int)$_GET["anioEquipo"]; 
	$mensajePre = "";
	$mensajePre = $_GET['mensajeAlta'];

	// 29-08-2018
	$fecha =  "'".$_GET['fechas']."'";
	$secuenciaarray =  Sett::ultSecuencia($idpartido,$setnumero,$fecha);
	//print_r($secuenciaarray);
	//echo($secuenciaarray[0]["secuencia"]);
	//echo($idpartido);
	//echo($setnumero);
	$secuencia = 0;
	if( !empty($secuenciaarray) ) $secuencia = (int) $secuenciaarray[0]["secuencia"];
    if($secuencia == 0) $secuencia = 1;
    else $secuencia++;
 
 	$saque=0; // sino no se definen
 	$saque=(int) $_GET['saque'];
 	 	 	 	
	$hora =  $_GET['horas'];
		$fecha =  $_GET['fechas'];
		$s = $fecha." ".$hora;
		$horaset = "'".$s."'"; // correcto !!!
// recorrer el array A de jugadores id y sus posiciones
	$A1 = $A2 = $A3 = $A4 = $A5 = $A6 = 0;
	// 16/09/2019
		$contadorpausasA = 2;
		$contadorpausasB = 2;
	// 16/09/2019		
	//eq.numero,eq.nombre,eq.categoria,eq.idjugador,
	//vappjugpartido.idclub,
	//vappjugpartido.posicion
	$fecha2 =  "'".$_GET['fechas']."'";
	$partidoStats = Partido::getById($idpartido,$fecha2 );
	echo "datos del partido para grabar en los detalles: <br>";
		print_r($partidoStats);

	$clublocalA =$partidoStats["idcluba"];
	$clublocalB =$partidoStats["idclubb"];
	
	$categoriaPartido =	$partidoStats["idcat"];
	// CHEQUEADO, TRAE BIEN AL EQUIPO QUE FUE CARGADO ORIGINALMENTE PARA JUGAR
	// el que tiene la misma categoria, los de otra categoria se cargan a MANO..
	// esta lista de jugadores, llegan sin SET asignado..

/*	TODO ESTO SE MOVIO A INSERTAR_PARTIDO, Y JUGADORPARTIDOCABECERA.


*/
	
// una vez que tengo la carga inicial de los jugadores por default de la categoria, 
// traigo esos y los que se agregaron...	
	// en jugpartido esta cargado el set NUMERO 0, porque aun no se asignaron el grupo de 
	//jugadores al set activo...		
	$jugsA = partjug::getJugSetLoad($idpartido,$fecha2,$clublocalA,$anioEq,$setnumero,$categoriaPartido);
	echo "<br>Jugadores que se cargaron en la tabla. vappJugPartido <br>";
	print_r($jugsA);
		if( !empty($jugsA) && is_array($jugsA) )
		{
		 for($contador=0; $contador < count($jugsA);$contador++ )
	     { // recorro vector de jugadores del equipo A
			switch ($jugsA[$contador]['posicion']) {
			case "0":
				        //echo "NO ASIGNADO<br>";
			        	break;
			    
			case "1":
		    		 $A1 =(int) $jugsA[$contador]['idjugador'];		
			    	break;
		    case "2":
	    			$A2 = (int)  $jugsA[$contador]['idjugador'];		
	    			break;
		    case "3":
	    			$A3 = (int)  $jugsA[$contador]['idjugador'];
	    			break;  
		    case "4":
	    			$A4 = (int)  $jugsA[$contador]['idjugador'];
	    			break;
		    case "5":
	    			$A5 = (int)  $jugsA[$contador]['idjugador'];
	    			break;
		    case "6":
	    			$A6 = (int)  $jugsA[$contador]['idjugador'];
	    			break;
		    case "7": // suplente
	    			//VECTOR DE SUPLENTES - 
	    			//$B6 = (int)  $jugsB[$contador-1];		
	    			break;
		    case "8": // libero
	    			//VECTOR DE LIBEROS -
	    			//$B6 = (int)  $jugsB[$contador-1];		
	    			break;
			}
	     }// for 
   };// if no empty

// recorrer el array B de jugadores id y sus posiciones
	$B1 = $B2 = $B3 = $B4 = $B5 = $B6 = 0;
	$jugsB = partjug::getJugSetLoad($idpartido,$fecha2,$clublocalB,$anioEq,$setnumero,$categoriaPartido);
	echo "<br>";
	print_r($jugsB);
		if( !empty($jugsB) && is_array($jugsB) )
		{
		 for($contador=0; $contador < count($jugsB);$contador++ )
	     { // recorro vector de jugadores del equipo A
				switch ($jugsB[$contador]['posicion']) {
				case "0":
					        //echo "NO ASIGNADO<br>";
				        	break;
				    
				case "1":
			    		 $B1 =(int) $jugsB[$contador]['idjugador'];		
				    	break;
			    case "2":
		    			$B2 = (int)  $jugsB[$contador]['idjugador'];		
		    			break;
			    case "3":
		    			$B3 = (int)  $jugsB[$contador]['idjugador'];
		    			break;  
			    case "4":
		    			$B4 = (int)  $jugsB[$contador]['idjugador'];
		    			break;
			    case "5":
		    			$B5 = (int)  $jugsB[$contador]['idjugador'];
		    			break;
			    case "6":
		    			$B6 = (int)  $jugsB[$contador]['idjugador'];
		    			break;
			    case "7": // suplente
		    			//VECTOR DE SUPLENTES - 
		    			//$B6 = (int)  $jugsB[$contador-1];		
		    			break;
			    case "8": // libero
		    			//VECTOR DE LIBEROS -
		    			//$B6 = (int)  $jugsB[$contador-1];		
		    			break;
				}
		 } // FIN DEL FORº
		};// FIN DEL IF

	if(isset($_GET['estadoset'])){  $estado = $_GET['estadoset'];} else { $estado = 5; };//configuracion INICIAL SET
	// el primer estado, o de configuracion sera 5, para indicar el primer registro del SEt...
	$puntoa =  (int) $_GET['resa'];
	$puntob	 =  (int) $_GET['resb'];
    // Insertar Set
	$retorno =0;
	if($mensajePre == 'Novedades30::grabaPos')
		$mensaje = "'Confirmando posiciones en planilla...'"; //GET
	else
		$mensaje = "'Esperando silbato inicial...'";

		$comando ="";
    	$comando = "DEPRECATED:INSERT INTO vappset (idpartido, secuencia, setnumero, fecha, hora, 1A, 2A, 3A, 4A, 5A, 6A, ".
    				"1B, 2B, 3B, 4B, 5B, 6B, estado, puntoa, puntob,saque,mensaje,CantPausaA,CantPausaB) ".
					" VALUES (  $idpartido, $secuencia, $setnumero, $fecha2,$horaset,$A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6,$estado,$puntoa, $puntob,$saque,$mensaje,$contadorpausasA,$contadorpausasB ) " ;    	
		
		echo("<br>$comando <br>");
	
	
	$retornoRotaciones = 0;
	$mensaje = "'por carga inicial del partido...'";		
//	echo("mensaje de rotaciones: ".$retornoRotaciones);
	
	
	
    if($retorno) {
        // Codigo de �xito
        print(json_encode(array('estado' => '1','mensaje' => 'Creacion exitosa','ingresoRotacion' => $retornoRotaciones)));
    } else 
    {
        // Codigo de falla
		print(json_encode(array('estado' => '2','mensaje' => 'Creacion NO exitosa')));
    }

 
   };
   
   
?>
