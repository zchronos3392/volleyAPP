<?php

require ('Set.php');
require_once('JugadorPartido.php');
require_once('JugadorPartidoCab.php');
require_once('Partido.php');
require_once('Errores.php');
if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$idpartido = (int) $_POST['idpartido'];
	$setnumero =  (int) $_POST['setdata'];
	$anioEq = 0 ;
	$anioEq =  (int) $_POST['ianio'];
	$clublocal = (int) $_POST['iclub'];
	$fecha2 = "'".$_POST['fechapartido']."'";
	$icategoriaPartido = (int) $_POST['categoriapartido'];
	
	// TRAIGO LA LISTA DE JUGADORES ORIGINAL, CON EL VALOR 99  EN EL CAMPO ENTRASALE=99
	//$jugsA = partjug::getJugadoresListaInicial($idpartido,$fecha2,$clublocalA,$setnumero);
	// no envio la categoria, porque necesito a todos los que se agregaron de otra categoria tambien.
	// agrego / creo una funcion nueva 
	$jugsA = partjugCab::getJugListaInicio($idpartido,$fecha2,$clublocal,$anioEq,$icategoriaPartido);
	
	//print_r($jugsA);			
/*
		Array ( [0] => Array ( [numero] => 7 [nombre] => Leandro [categoria] => 15 [idjugador] => 96 [idclub] => 83 [jugador] => 96 [posicion] => 7 [puestoxcat] => 4 ) 
				[1] => Array ( [numero] => 6 [nombre] => Leo [categoria] => 15 [idjugador] => 97 [idclub] => 83 [jugador] => 97 [posicion] => 7 [puestoxcat] => 3 ) 
				[2] => Array ( [numero] => 12 [nombre] => Joaco [categoria] => 15 [idjugador] => 98 [idclub] => 83 [jugador] => 98 [posicion] => 7 [puestoxcat] => 3 ) 
				[3] => Array ( [numero] => 15 [nombre] => FedeSL [categoria] => 15 [idjugador] => 99 [idclub] => 83 [jugador] => 99 [posicion] => 7 [puestoxcat] => 8 ) 
				[4] => Array ( [numero] => 8 [nombre] => EITAN [categoria] => 15 [idjugador] => 100 [idclub] => 83 [jugador] => 100 [posicion] => 7 [puestoxcat] => 6 ) 
				[5] => Array ( [numero] => 14 [nombre] => ROCCO [categoria] => 15 [idjugador] => 101 [idclub] => 83 [jugador] => 101 [posicion] => 7 [puestoxcat] => 8 ) 
				[6] => Array ( [numero] => 11 [nombre] => THIAGO GH [categoria] => 15 [idjugador] => 102 [idclub] => 83 [jugador] => 102 [posicion] => 7 [puestoxcat] => 4 ) 
				[7] => Array ( [numero] => 5 [nombre] => FRAN MATH [categoria] => 15 [idjugador] => 103 [idclub] => 83 [jugador] => 103 [posicion] => 7 [puestoxcat] => 2 ) 
				[8] => Array ( [numero] => 17 [nombre] => TOMI B [categoria] => 15 [idjugador] => 104 [idclub] => 83 [jugador] => 104 [posicion] => 7 [puestoxcat] => 6 ) 
				[9] => Array ( [numero] => 16 [nombre] => IVAN GH [categoria] => 15 [idjugador] => 107 [idclub] => 83 [jugador] => 107 [posicion] => 7 [puestoxcat] => 6 ) 
				[10] => Array ( [numero] => 13 [nombre] => MAURI [categoria] => 15 [idjugador] => 108 [idclub] => 83 [jugador] => 108 [posicion] => 7 [puestoxcat] => 8 ) 
				[11] => Array ( [numero] => 2 [nombre] => Thiaguette [categoria] => 15 [idjugador] => 109 [idclub] => 83 [jugador] => 109 [posicion] => 7 [puestoxcat] => 5 ) 
				[12] => Array ( [numero] => 999 [nombre] => Juani [categoria] => 15 [idjugador] => 127 [idclub] => 83 [jugador] => 127 [posicion] => 7 [puestoxcat] => 8 ) 
				[13] => Array ( [numero] => 999 [nombre] => Marcel [categoria] => 15 [idjugador] => 128 [idclub] => 83 [jugador] => 128 [posicion] => 7 [puestoxcat] => 8 ) )	
	
*/		
	if( !empty($jugsA) && is_array($jugsA) )
		{
			 //partido : 1 , fecha: '2019-11-11' , club: 157 , cate: 3 , id jugador: 11
			// partido : 1 , fecha: '2019-11-11' , club: 157 , cate: 3 , id jugador: 12
			// partido : 1 , fecha: '2019-11-11' , club: 157 , cate: 3 , id jugador: 13
			// partido : 1 , fecha: '2019-11-11' , club: 157 , cate: 3 , id jugador: 14
			// partido : 1 , fecha: '2019-11-11' , club: 157 , cate: 3 , id jugador: 15
			// partido : 1 , fecha: '2019-11-11' , club: 157 , cate: 3 , id jugador: 16			
		 for($contador=0; $contador < count($jugsA);$contador++ )
	     { // recorro vector de jugadores del equipo A
				    $icate 	 =	$jugsA[$contador]['categoria'];
				    $jugador =	$jugsA[$contador]["idjugador"];
				    $puesto =	$jugsA[$contador]["puestoxcat"];
					//echo("<br>partido : ".$idpartido." , fecha: ".$fecha2." , club: ".$clublocal." , cate: ".$icate." , id jugador: ".$jugador." setnumero: ".$setnumero." puesto: ".$puesto);	
					$mensajeAlta = "'INSERTAR_JUGADORES_SETS::INSERT.SET'";

					$tipo="'AVISO'";
					//$fecha_hora,
					$scriptPrograma="'INSERTAR_JUGADORES_SETS'";
					$funcion="'partjug::insertSet'";
					$parametro[0]=$idpartido;
					$parametro[1]=$_POST['fechapartido'];
					$parametro[2]=$clublocal;
					$parametro[3]=$icate;
					$parametro[4]=$jugador;
					$parametro[5]=$setnumero;
					$parametro[6]=$puesto;
					$parametros= "'".implode(";",$parametro)."'";
					$ret = errorGrabado::insert($tipo,$scriptPrograma,$funcion,$parametros);

					$retorno03 = partjug::insertSet($idpartido,$fecha2,$clublocal,$icate,$jugador,$setnumero,$puesto,$mensajeAlta);

		 				//echo "$retorno03";
		 }// for 
   		};// if no empty
   };
   
   
?>
