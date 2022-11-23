<?php
/**
 * Insertar una nuevo Jugador/es en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require 'Jugador.php';

require_once 'JugadorPuestos.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
	// Decodificando <	
	$iclubescab = $_POST["iclubescab"]; //iclubescab: 1
	$icatcab = $_POST["icatcab"]; //icatcab: 2
		// nuevo agregado 2019:
			$ianio = 0;
			if(isset($_POST["ianio"])) $ianio   = $_POST["ianio"];
	if($ianio == 0)	{
		if(isset($_POST["anioactivo"])) $ianio = $_POST["anioactivo"];
	};
			
	// se cargan tres vectores con el mismo indice !!!
	if(isset($_POST["numero"])) $numeros = $_POST["numero"];
	if(isset($_POST["nombre"])) $nombres = $_POST["nombre"];
	if(isset($_POST["edad"]))  $edades = $_POST["edad"]; 

	$regMax  = 0;
	if(isset($nombres)) $regMax  = count($nombres);//viene la cantida de registros agregados
		//echo(" CANTIDAD DE REGS AGREGADOS: ".$regMax."<br>");
		 //		echo(" EDADES: ".print_r($edades)."<br>");//imprimo el vector que viene cargado con indice 0
		 //		echo(" NOMBRES: ".print_r($nombres)."<br>");//imprimo el vector que viene cargado con indice 0
		 //		echo(" NUMEROS: ".print_r($numeros)."<br>");//imprimo el vector que viene cargado con indice 0
	$GenQ=0;
	if(isset($_POST["altagen"])) $altaGen = $_POST["altagen"];
	if(isset($_POST["gencuantos"])) $GenQ = $_POST["gencuantos"]; 
	$ingresoClub = date_create()->format('Y-m-d H:i:s');// fecha corecta de ahora
	//echo(" ALTA GEN: ".$altaGen."<br>");
	$ingresoClub = "'".$ingresoClub."'";
	
	$egresoClub = $_POST["egresoEnclub"];
//	echo("CANTIDAD DE GENERICOS: ".$GenQ."<br>");
	
	// hay que da de alta genericos..
	
	if($GenQ > 0)
	{
		//print "cantidad de registros a dar de alta: ".$GenQ;
		//creacion de genericos..
		for($i = 0;$i < $GenQ;$i++)
		{
			$edadg = rand(8,21);
			$remerag = rand(1000,9999);
			$nombreg = "'"."jugador_".$remerag."'";
			//echo("registro ".$i." a dar de alta<br>");
							$retorno = jugador::insert($iclubescab,$ianio,$remerag,$nombreg,$edadg,$ingresoClub,$icatcab,$icatcab);

							$idjugador =0;
							$indice	   =1;
							$puestoCate = 8;
    						$retorno = jugador::getId($iclubescab,$ianio,$ingresoClub);
						    //print_r($retorno);
								if($retorno["0"]["idjugador"] > 0){
										$idjugador = $retorno["0"]["idjugador"];
									 	$retornoPos = puestojugador::insert($idjugador,$indice,$ingresoClub,$remerag,$icatcab,$puestoCate,$ianio,$iclubescab);
								}; 

		 }
	}
	else // no son genericos..
	{
	$ajugadores = array();//nuevo array de jugadores
// primero creo un array con los nombres 
	if(( !empty($edades) && is_array($edades) ) && 
	   ( !empty($nombres) && is_array($nombres) ) &&
	   ( !empty($numeros) && is_array($numeros) ))
	{ 
	    for($contador=0; $contador < count($nombres);$contador++ )
	     { 
	 		  $ajugadores[$contador]["edad"] = $edades[$contador];
			  $ajugadores[$contador]["nombre"] = $nombres[$contador];
	 		  $ajugadores[$contador]["num"] = $numeros[$contador];
	 		 // $ajugadores[$contador]["club"] = $iclubescab;
	 		 // $ajugadores[$contador]["cate"] = $icatcab;

	     }
    }//cierre del if de no vacios..
    $ingresoClub = date_create()->format('Y-m-d H:i:s');// fecha corecta de ahora
		$ingresoClub = "'".$ingresoClub."'";
	
	foreach($ajugadores as $jugador)
	{
		//print "JUGADOR: <br>";
		foreach($jugador as $dato => $valor)
		{
			switch ($dato) 
			{
			    case "edad":
			        echo "edad: ".$valor."  , ";
			        $eda = $valor;
			        break;
			    case "nombre":
			        echo "nombre: ".$valor."  , ";
			        $nom = "'".$valor."'";
			        break;
			    case "num":
			        echo "num remera: ".$valor."  , ";
			        $reme = $valor;
			        break;
			    case "club":
					echo "club id: ".$valor."  , ";
			        break;
			    case "cate":
			        echo "cate id: ".$valor;
			        break;			            
			}	
		} // fin de carga de variables de alta desde array
		$retorno = jugador::insert($iclubescab,$ianio,$reme,$nom,$eda,$ingresoClub,$icatcab,$icatcab);
		//print "<br>";	
	} // recorriendo jugadoress
   } // else NO SON GENERICOSS
 }
// GET
else // GET para probar
    {
    // Decodificando formato Json
	// Decodificando <	
	$iclubescab = $_GET["iclubescab"]; //iclubescab: 1
	$icatcab = $_GET["icatcab"]; //icatcab: 2
		// nuevo agregado 2019:
			$ianio = 0;
			if(isset($_GET["ianio"])) $ianio   = $_GET["ianio"];
	if($ianio == 0)	{
		if(isset($_GET["anioactivo"])) $ianio = $_GET["anioactivo"];
	};
			
	// se cargan tres vectores con el mismo indice !!!
	if(isset($_GET["numero"])) $numeros = $_GET["numero"];
	if(isset($_GET["nombre"])) $nombres = $_GET["nombre"];
	if(isset($_GET["edad"]))  $edades = $_GET["edad"]; 

	$regMax  = 0;
	if(isset($nombres)) $regMax  = count($nombres);//viene la cantida de registros agregados
		//echo(" CANTIDAD DE REGS AGREGADOS: ".$regMax."<br>");
		 //		echo(" EDADES: ".print_r($edades)."<br>");//imprimo el vector que viene cargado con indice 0
		 //		echo(" NOMBRES: ".print_r($nombres)."<br>");//imprimo el vector que viene cargado con indice 0
		 //		echo(" NUMEROS: ".print_r($numeros)."<br>");//imprimo el vector que viene cargado con indice 0
	$GenQ=0;
	if(isset($_GET["altagen"])) $altaGen = $_GET["altagen"];
	if(isset($_GET["gencuantos"])) $GenQ = $_GET["gencuantos"]; 
	$ingresoClub = date_create()->format('Y-m-d H:i:s');// fecha corecta de ahora
	//echo(" ALTA GEN: ".$altaGen."<br>");
	$ingresoClub = "'".$ingresoClub."'";
//	$egresoClub = $_GET["egresoEnClub"];	
//	echo("CANTIDAD DE GENERICOS: ".$GenQ."<br>");
	
	// hay que da de alta genericos..
	
	if($GenQ > 0)
	{
		print "cantidad de registros a dar de alta: ".$GenQ;
		//creacion de genericos..
		for($i = 0;$i < $GenQ;$i++)
		{
			$edadg = rand(8,21);
			$remerag = rand(1000,9999);
			$nombreg = "'"."jugador_".$remerag."'";
			//echo("registro ".$i." a dar de alta<br>");
							$retorno = jugador::insert($iclubescab,$ianio,$remerag,$nombreg,$edadg,$ingresoClub,$icatcab,$icatcab);

							$idjugador =0;
							$indice	   =1;
							$puestoCate = 8;
    						$retorno = jugador::getId($iclubescab,$ianio,$ingresoClub);
						    //print_r($retorno);
								if($retorno["0"]["idjugador"] > 0){
										$idjugador = $retorno["0"]["idjugador"];
									 	$retornoPos = puestojugador::insert($idjugador,$indice,$ingresoClub,$remerag,$icatcab,$puestoCate,$ianio,$iclubescab);
								}; 

		 }
	}
	else // son genericos..
	{
	$ajugadores = array();//nuevo array de jugadores
// primero creo un array con los nombres 
	if(( !empty($edades) && is_array($edades) ) && 
	   ( !empty($nombres) && is_array($nombres) ) &&
	   ( !empty($numeros) && is_array($numeros) ))
	{ 
	    for($contador=0; $contador < count($nombres);$contador++ )
	     { 
	 		  $ajugadores[$contador]["edad"] = $edades[$contador];
			  $ajugadores[$contador]["nombre"] = $nombres[$contador];
	 		  $ajugadores[$contador]["num"] = $numeros[$contador];
	 		 // $ajugadores[$contador]["club"] = $iclubescab;
	 		 // $ajugadores[$contador]["cate"] = $icatcab;

	     }
    }//cierre del if de no vacios..
    $ingresoClub = date_create()->format('Y-m-d H:i:s');// fecha corecta de ahora
		$ingresoClub = "'".$ingresoClub."'";
//	$egresoClub = $_GET["egresoEnClub"];
	foreach($ajugadores as $jugador)
	{
		print "JUGADOR: <br>";
		foreach($jugador as $dato => $valor)
		{
			switch ($dato) 
			{
			    case "edad":
			        echo "edad: ".$valor."  , ";
			        $eda = $valor;
			        break;
			    case "nombre":
			        echo "nombre: ".$valor."  , ";
			        $nom = "'".$valor."'";
			        break;
			    case "num":
			        echo "num remera: ".$valor."  , ";
			        $reme = $valor;
			        break;
			    case "club":
					echo "club id: ".$valor."  , ";
			        break;
			    case "cate":
			        echo "cate id: ".$valor;
			        break;			            
			}	
		} // fin de carga de variables de alta desde array
		$retorno = jugador::insert($iclubescab,$ianio,$reme,$nom,$eda,$ingresoClub,$icatcab,$icatcab);
		print "<br>";	
	} // recorriendo jugadoress
   } // else NO SON GENERICOSS
  }// cierre del GET 

?>
