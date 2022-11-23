<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require 'Jugador.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$eda = 1000; // se cambiara de alguna forma a futuro..
    // Decodificando formato Json
	// Decodificando <	
	$iclubescab = $_POST["iclubescab"];
	$icatcab = $_POST["icatcab"]; // es la categoria ACTUAL O VIEJA !!!!
		// nuevo agregado 2019:
			$ianio   = (int)$_POST["ianio"];
			$ianio += 1;
		// nuevo agregado 2019:			
	// se cargan tres vectores con el mismo indice !!!
	$numeros = $_POST["numero"];
	$nombres = $_POST["nombre"];
	$ingreso = $_POST["anio"];
	// son vectores
//		$CategoriaVieja = $_POST["catAnt"]; 
		$CatNueva = $_POST["idcategoriaNueva"]; 	
	$idsjugador = $_POST["idjugador"]; 	//no se para que lo tengo...
	$regMax  = count($nombres);//viene la cantida de registros agregados
		//echo(" CANTIDAD DE REGS AGREGADOS: ".$regMax."<br>");
		 //		echo(" EDADES: ".print_r($edades)."<br>");//imprimo el vector que viene cargado con indice 0
		 //		echo(" NOMBRES: ".print_r($nombres)."<br>");//imprimo el vector que viene cargado con indice 0
		 //		echo(" NUMEROS: ".print_r($numeros)."<br>");//imprimo el vector que viene cargado con indice 0
	
	$ajugadores = array();//nuevo array de jugadores
// 19 09 2019 primero creo un array con lo que tengo, armando lo mas posible del registro a grabar en tabla..
	if(( !empty($ingreso) && is_array($ingreso) ) && 
	   ( !empty($nombres) && is_array($nombres) ) &&
	   ( !empty($numeros) && is_array($numeros) ))
	{ 
	    for($contador=0; $contador < count($nombres);$contador++ )
	     { 
	 	 	  $ajugadores[$contador]["num"] = $numeros[$contador];
			  $ajugadores[$contador]["nombre"] = $nombres[$contador];			  
	 		  $ajugadores[$contador]["ingresoClub"] = $ingreso[$contador];
			  $ajugadores[$contador]["catenueva"] = $CatNueva[$contador];
				// LA CATEGORIA ANTERIOR, LA TENGO EN $icatcab, el club en $iclubescab y el ianio nuevo en $ianio
					// $ajugadores[$contador]["club"] = $iclubescab;
					// $ajugadores[$contador]["cate"] = $icatcab;
	     }
    }//cierre del if de no vacios..
	
	// una vez que arme todo, lo cargo en variables unitarias para ir insertando...de a uno..
	foreach($ajugadores as $jugador)
	{
		print "JUGADOR: <br>";
		foreach($jugador as $dato => $valor)
		{
			switch ($dato) 
			{
			    case "edad":
			        //echo "edad: ".$valor."  , ";
			        $eda = 1000; // se cambiara de alguna forma a futuro..
			        break;
			    case "nombre":
			        //echo "nombre: ".$valor."  , ";
			        $nom = "'".$valor."'";
			        break;
			    case "num":
			        //echo "num remera: ".$valor."  , ";
			        $reme = $valor;
			        break;
			    case "ingresoClub":
					//echo "club id: ".$valor."  , ";
					$ingresoClub = "'".$valor."'";
			        break;
			    case "catenueva":
					$CategoriaNueva = $valor;
			        //echo "cate id: ".$valor;
			        break;			            
			}	
		} // fin de carga de variables de alta desde array
		if($CategoriaNueva != 9999)
					$retorno = jugador::insert($iclubescab,$ianio,$reme,$nom,$eda,$ingresoClub,$CategoriaNueva,$icatcab);
	} // recorriendo jugadoress
 }
// GET
else // GET para probar
    {
	$eda = 1000; // se cambiara de alguna forma a futuro..
    // Decodificando formato Json
	// Decodificando <	
	$iclubescab = $_GET["iclubescab"];
	$icatcab = $_GET["icatcab"]; // es la categoria ACTUAL O VIEJA !!!!
		// nuevo agregado 2019:
			$ianio   = (int)$_GET["ianio"];
			$ianio += 1;
		// nuevo agregado 2019:			
	// se cargan tres vectores con el mismo indice !!!
	$numeros = $_GET["numero"];
	$nombres = $_GET["nombre"];
	$ingreso = $_GET["anio"];
	// son vectores
//		$CategoriaVieja = $_GET["catAnt"]; 
		$CatNueva = $_GET["idcategoriaNueva"]; 	
	$idsjugador = $_GET["idjugador"]; 	//no se para que lo tengo...
	$regMax  = count($nombres);//viene la cantida de registros agregados
		//echo(" CANTIDAD DE REGS AGREGADOS: ".$regMax."<br>");
		 //		echo(" EDADES: ".print_r($edades)."<br>");//imprimo el vector que viene cargado con indice 0
		 //		echo(" NOMBRES: ".print_r($nombres)."<br>");//imprimo el vector que viene cargado con indice 0
		 //		echo(" NUMEROS: ".print_r($numeros)."<br>");//imprimo el vector que viene cargado con indice 0
	
	$ajugadores = array();//nuevo array de jugadores
// 19 09 2019 primero creo un array con lo que tengo, armando lo mas posible del registro a grabar en tabla..
	if(( !empty($ingreso) && is_array($ingreso) ) && 
	   ( !empty($nombres) && is_array($nombres) ) &&
	   ( !empty($numeros) && is_array($numeros) ))
	{ 
	    for($contador=0; $contador < count($nombres);$contador++ )
	     { 
	 	 	  $ajugadores[$contador]["num"] = $numeros[$contador];
			  $ajugadores[$contador]["nombre"] = $nombres[$contador];			  
	 		  $ajugadores[$contador]["ingresoClub"] = $ingreso[$contador];
			  $ajugadores[$contador]["catenueva"] = $CatNueva[$contador];
				// LA CATEGORIA ANTERIOR, LA TENGO EN $icatcab, el club en $iclubescab y el ianio nuevo en $ianio
					// $ajugadores[$contador]["club"] = $iclubescab;
					// $ajugadores[$contador]["cate"] = $icatcab;
	     }
    }//cierre del if de no vacios..
	
	// una vez que arme todo, lo cargo en variables unitarias para ir insertando...de a uno..
	foreach($ajugadores as $jugador)
	{
		print "JUGADOR: <br>";
		foreach($jugador as $dato => $valor)
		{
			switch ($dato) 
			{
			    case "edad":
			        //echo "edad: ".$valor."  , ";
			        $eda = 1000; // se cambiara de alguna forma a futuro..
			        break;
			    case "nombre":
			        //echo "nombre: ".$valor."  , ";
			        $nom = "'".$valor."'";
			        break;
			    case "num":
			        //echo "num remera: ".$valor."  , ";
			        $reme = $valor;
			        break;
			    case "ingresoClub":
					//echo "club id: ".$valor."  , ";
					$ingresoClub = "'".$valor."'";
			        break;
			    case "catenueva":
					$CategoriaNueva = $valor;
			        //echo "cate id: ".$valor;
			        break;			            
			}	
		} // fin de carga de variables de alta desde array
		if($CategoriaNueva != 9999)
				$retorno = jugador::insert($iclubescab,$ianio,$reme,$nom,$eda,$ingresoClub,$CategoriaNueva,$icatcab);
		else
		   echo("<br>.....> ! no se inserta<br>");
	} // recorriendo jugadoress	
	
	
	
	
   }// cierre del GET 

?>
