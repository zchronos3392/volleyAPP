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
	// LISTA BASE DE JUGADORES A COPIAR EN CADA SET NUEVO..
		$jugsA = partjugCab::getJugListaInicio($idpartido,$fecha2,$clublocal,$anioEq,$icategoriaPartido);
		
	//	print_r($jugsA);
//		Array ( [0] => Array ( [numero] => 7 [nombre] => Leandro [categoria] => 15 [idjugador] => 96 [idclub] => 83 [jugador] => 96 [posicion] => 7 [puestoxcat] => 4 ) 

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
				    $puesto = 0;
						$puesto =	$jugsA[$contador]["puestoxcat"];
					$deBaja =	$jugsA[$contador]["FechaEgreso"];
						$nombre =	$jugsA[$contador]["nombre"];					
					//echo "<br>$nombre deBaja es $deBaja  y  puesto es $puesto <br>" ;
					if($deBaja == '' && $puesto != 0){
					//echo "nombre alta $nombre<br>";
					$orden =	0; //valor inicial.
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
					$parametro[7]=$orden;
					$parametros= "'".implode(";",$parametro)."'";
					$ret = errorGrabado::insert($tipo,$scriptPrograma,$funcion,$parametros);
					//echo "insertSet($idpartido,$fecha2,$clublocal,$icate,$jugador,$setnumero,$puesto,$orden,$mensajeAlta); <br>";
					$retorno03 = partjug::insertSet($idpartido,$fecha2,$clublocal,$icate,$jugador,$setnumero,$puesto,$orden,$mensajeAlta);
					}
		 				//echo "$retorno03";
		 }// for 
   		};// if no empty
   };
   
   
?>
