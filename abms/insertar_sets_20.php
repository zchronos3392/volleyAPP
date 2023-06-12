<?php

require ('Set.php');
require_once('JugadorPartido.php');
require_once('Partido.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$idpartido = (int) $_POST['idpartido'];
	$setnumero =  (int) $_POST['idset'];
	// 29-08-2018
	$fecha =  "'".$_POST['fechas']."'";
	$secuenciaarray =  Sett::ultSecuencia($idpartido,$setnumero,$fecha);
//	print_r($secuenciaarray);
//	echo($secuenciaarray[0]["secuencia"]);
//	echo($idpartido);
//	echo($setnumero);
	$secuencia = 0;
	if( !empty($secuenciaarray) ) $secuencia = (int) $secuenciaarray[0]["secuencia"];

 	// incorporar CONTINUAR PARTIDO 17 09 2019
	$setData = Sett::getById($idpartido,$setnumero,$secuencia,$fecha);
   	//print_r($setData);						
	$contadorpausasA = (int)$setData["CantPausaA"];
	$contadorpausasB = (int)$setData["CantPausaB"];


	$ordenA =1;
		$ordenA = (int)$setData['ordenA'];
	$ordenB =1;
		$ordenB = (int)$setData['ordenB'];


    if($secuencia == 0) $secuencia = 1;
    else $secuencia++;
    
	$anioEq = (int)$_POST["anioEquipo"];
 	
 	$saque=0; // sino no se definen
 	$saque=(int) $_POST['saque'];
 	 	 	 	
	$hora =  $_POST['horas'];
		$fecha =  $_POST['fechas'];
		$s = $fecha." ".$hora;
		$horaset = "'".$s."'"; // correcto !!!
// recorrer el array A de jugadores id y sus posiciones
	$A1 = $A2 = $A3 = $A4 = $A5 = $A6 = 0;
	
	//eq.numero,eq.nombre,eq.categoria,eq.idjugador,
	//vappjugpartido.idclub,
	//vappjugpartido.posicion
	$fecha2 =  "'".$_POST['fechas']."'";
	$partidoStats = Partido::getById($idpartido,$fecha2 );
	
	//	print_r($partidoStats);
	
	$clublocalA =$partidoStats["idcluba"];
	$clublocalB =$partidoStats["idclubb"];
	$categoriaPartido = $partidoStats["idcat"];
	
	$jugsA = partjug::getJugSetLoad($idpartido,$fecha2,$clublocalA,$anioEq,$setnumero,$categoriaPartido);
	
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

	if(isset($_POST['estadoset'])){  $estado = $_POST['estadoset'];} else { $estado = 5; };
	// el primer estado, o de configuracion sera 0, para indicar el primer registro del SEt...
	$puntoa =  (int) $_POST['resa'];
	$puntob	 =  (int) $_POST['resb'];
	//02 DIC.2022::ENVIO LA ESTRATEGIA CON RESPECTO A LOS LIBEROS
		//PARA QUE SABER QUÉ HACER AUTOMATICAMENTE EN SUS CAMBIOS..
			$estrategiaA = "''";
			if(isset($_POST['estrategiaLa'])) $estrategiaA = "'".$_POST['estrategiaLA']."'";
			$estrategiaB = "''";
			if(isset($_POST['estrategiaLB'])) $estrategiaB = "'".$_POST['estrategiaLB']."'";
		//PARA QUE SABER QUÉ HACER AUTOMATICAMENTE EN SUS CAMBIOS..
	//02 DIC.2022::ENVIO LA ESTRATEGIA CON RESPECTO A LOS LIBEROS

    // Insertar Set
	$retorno =0;
	$mensaje = "'Ajuste del set en vivo...'";
	$retorno = Sett::insert( $idpartido, $secuencia, $setnumero, $fecha2,$horaset,
							 $A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6,
							 $estado,$puntoa, $puntob,$saque,$estrategiaA,$estrategiaB,
							 $ordenA,$ordenB,
							 $mensaje,$contadorpausasA,$contadorpausasB);
    //echo($retorno);
    if($retorno) {
        // Codigo de �xito
        print(json_encode(array('estado' => '1','mensaje' => 'Creacion exitosa')));
    } else 
    {
        // Codigo de falla
		print(json_encode(array('estado' => '2','mensaje' => 'Creacion NO exitosa')));
    }
   }
  else 
   if($_SERVER['REQUEST_METHOD'] == 'GET') {

	$idpartido = (int) $_GET['idpartido'];
	$setnumero =  (int) $_GET['idset'];
	// 29-08-2018
	$fecha =  "'".$_GET['fechas']."'";
	$secuenciaarray =  Sett::ultSecuencia($idpartido,$setnumero,$fecha);

//	print_r($secuenciaarray);
//	echo("<br> ultima secuencia ".$secuenciaarray[0]["secuencia"]."<br>");
//	echo("<br> $idpartido <br>");
//	echo("<br> $setnumero <br>");

	$secuencia = 0;
	if( !empty($secuenciaarray) ) $secuencia = (int) $secuenciaarray[0]["secuencia"];

 	// incorporar CONTINUAR PARTIDO 17 09 2019
	$setData = Sett::getById($idpartido,$setnumero,$secuencia,$fecha);
   	
   	echo("<br> Set data : desde el ultimo registro <br>");
   		print_r($setData);						
	
	$contadorpausasA = (int)$setData["CantPausaA"];
	$contadorpausasB = (int)$setData["CantPausaB"];


	$ordenA =1;
		$ordenA = (int)$setData['ordenA'];
	$ordenB =1;
		$ordenB = (int)$setData['ordenB'];


    if($secuencia == 0) $secuencia = 1;
    else $secuencia++;
    
	$anioEq = (int)$_GET["anioEquipo"];
 	
 	$saque=0; // sino no se definen
 	$saque=(int) $_GET['saque'];
 	 	 	 	
	$hora =  $_GET['horas'];
		$fecha =  $_GET['fechas'];
		$s = $fecha." ".$hora;
		$horaset = "'".$s."'"; // correcto !!!
// recorrer el array A de jugadores id y sus posiciones
	$A1 = $A2 = $A3 = $A4 = $A5 = $A6 = 0;
	
	//eq.numero,eq.nombre,eq.categoria,eq.idjugador,
	//vappjugpartido.idclub,
	//vappjugpartido.posicion
	$fecha2 =  "'".$_GET['fechas']."'";
	$partidoStats = Partido::getById($idpartido,$fecha2 );
	
	//	print_r($partidoStats);
	
	$clublocalA =$partidoStats["idcluba"];
	$clublocalB =$partidoStats["idclubb"];
	$categoriaPartido = $partidoStats["idcat"];
	
	//ESTO ESTA MAL, PORQUE SE MUEVE ESTE REGISTRO TODO EL TIEMPO...
	$jugsA = partjug::getJugSetLoad($idpartido,$fecha2,$clublocalA,$anioEq,$setnumero,$categoriaPartido);
	echo "<br> JUGADORES DEL EQUIPO LOCAL <BR>";
	foreach($jugsA as $indice => $valor){
			echo "<br> indice $indice ";	
				print_r($valor);
			echo "<br>";	
	}
	
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
	echo "<br> JUGADORES DEL EQUIPO VISITANTE <BR>";
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

	if(isset($_GET['estadoset'])){  $estado = $_GET['estadoset'];} else { $estado = 5; };
	// el primer estado, o de configuracion sera 0, para indicar el primer registro del SEt...
	$puntoa =  (int) $_GET['resa'];
	$puntob	 =  (int) $_GET['resb'];
	//02 DIC.2022::ENVIO LA ESTRATEGIA CON RESPECTO A LOS LIBEROS
		//PARA QUE SABER QUÉ HACER AUTOMATICAMENTE EN SUS CAMBIOS..
			$estrategiaA = "''";
			if(isset($_GET['estrategiaLA'])) $estrategiaA = "'".$_GET['estrategiaLA']."'";
			$estrategiaB = "''";
			if(isset($_GET['estrategiaLB'])) $estrategiaB = "'".$_GET['estrategiaLB']."'";			
		//PARA QUE SABER QUÉ HACER AUTOMATICAMENTE EN SUS CAMBIOS..
	//02 DIC.2022::ENVIO LA ESTRATEGIA CON RESPECTO A LOS LIBEROS
	
    // Insertar Set
	$retorno =0;
	$mensaje = "'Ajuste del set en vivo...'";
	$retorno = Sett::insert( $idpartido, $secuencia, $setnumero, $fecha2,$horaset,
							 $A1,$A2,$A3,$A4,$A5,$A6,$B1,$B2,$B3,$B4,$B5,$B6,
							 $estado,$puntoa, $puntob,$saque,$estrategiaA,$estrategiaB,
							 $ordenA,$ordenB,
							 $mensaje,$contadorpausasA,$contadorpausasB);
    //echo($retorno);
    if($retorno) {
        // Codigo de �xito
        print(json_encode(array('estado' => '1','mensaje' => 'Creacion exitosa')));
    } else 
    {
        // Codigo de falla
		print(json_encode(array('estado' => '2','mensaje' => 'Creacion NO exitosa')));
    }
   } 
?>
