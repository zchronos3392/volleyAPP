<?php
/**
 * Obtiene todas los juegadores en su posicion inicial de cada set, o de todos los Sets.
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax

// // *******************			DOCUMENTACION API JSON 		****************************
// PARAMETROS:
// idpartido: 1,iclubescab: 83,fechapartido: 20231120 ,anioEquipo: 2023  , setdata: 1 ,esVisualizar: S ,categoriapartido: 19
// VARIAS COLECCIONES DE DATOS:
// Jugadores: []
// JugadoresINI: [,…] estructura del json:
	// ColorPuestoCancha: "",ColorPuestoCat: "",FechaEgreso: null,Orden: 0,activoSN: null,categoria: 19,idclub: 83,idjugador: 185,
	// nombre: "Arreglo Posiciones",numero: 1000,posicion: 7,posicionini: 7,puesto: "8",puestoxcat: 8,secuencia: 1
// Rotaciones: [[,…], [,…],…]
// INDICE POR CADA ROTACION GUARDADA:
//  VECTOR POR CADA JUGADOR CARGADO EN LA ROTACION ( 6 JUGADORES POR TURNO)
// 	0: {numero: 10, nombre: "Lucho", categoria: 19, idjugador: 203, idclub: 83, puesto: "5", posicion: 1,…}
// 	DONDE LA ESTRUCTURA DEL JSON DEL JUGADOR Es: 
// 		ColorPuestoCancha: "#dc2327",ColorPuestoCat: "#dc2327",activoSN: null,categoria: 19,idclub: 83,idjugador: 203,
// 		nombre: "Lucho",numero: 10,posicion: 1,puesto: "5",puestoxcat: 5,remeraNum: 10
// 	1: {numero: 3, nombre: "THIAGO GH", categoria: 19, idjugador: 186, idclub: 83, puesto: "6", posicion: 2,…}
// 	2: ETC
// 	3: 
// 	4: 
// 	5: 
// RotacionesPuntos: [{puntoa: 0, puntob: 0}, {puntoa: 1, puntob: 9}, {puntoa: 2, puntob: 10}, {puntoa: 3, puntob: 11},…]
		//ASOCIACION DEL INDICE EN LAS ROTACION CO LOS PUNTOS AL MOMENTO DE ROTAR (puntoa,puntob)
// estado: 1
// todos: 0
// // *******************			DOCUMENTACION API JSON 		****************************
require_once('JugadorPartido.php');
require_once('Jugador.php');
require_once('Set.php');
//echo($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar peticion GET
   	$partido =	$_GET["idpartido"];
	$fecha	 =	"'".$_GET["fechapartido"]."'";
	$iclub	 =	$_GET["iclubescab"];
	$setnum = $_GET["setdata"];
	$anioEq = 0;
	if(isset($_GET["anioEquipo"]))  $anioEq = $_GET["anioEquipo"];
	$esVisualizar = 'N';
	$categoriapartido = $_GET["categoriapartido"];
	if(isset($_GET["esVisualizar"]))	$esVisualizar = $_GET["esVisualizar"];

	$clublocal = $clubvisitante = 0;
	
	
	//$icate 	 =	$_GET["icatcab"];
 	//echo "partido id ".$partido;
 	//echo " fecha ".$fecha;
 	//echo " id club: ".$iclub;
 	//echo " numero set a jugar: ".$setnum;
	//$jugadores = partjug::getJugadoresLoad($partido,$fecha,$iclub,$setnum); 
	$jugadores2=array(); // para que no falle al cargar posiciones de verdad..
    $jugadores2 = partjug::getJugSetLoad($partido,$fecha,$iclub,$anioEq,$setnum,$categoriapartido); 
    //opcion si viene vacia la tabla de posicioness
    $jugadoresLocal=array();
    $jugadoresVisitante=array();

    if(count($jugadores2) == 0)
    {
        $partidoRow = Partido::getById($partido,$fecha);
        echo "<br>partido<br>";
        print_r($partidoRow);
        echo "<br>partido<br>";

        $clublocal =$partidoRow['idcluba'];
        $clubvisitante=$partidoRow['idclubb'];
        
        $posicionesSetGrabadasInicial = Sett::getSetPosInicialesGrabadas($partido,$setnum,$fecha);			
        if(count($posicionesSetGrabadasInicial) <> 0) $jugadores2 = array();
        //echo "<br> posicionesSetGrabadasInicial <br>";
        //print_r($posicionesSetGrabadasInicial);
        //echo "<br> <br>";
        $conteo=-1;	
        if( ($iclub == $clublocal) && (count($posicionesSetGrabadasInicial) > 0) )
        {
            //echo "<br> es el club local <br>";
                $jugador1 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['1A'] ) ;
                    if( count($jugador1)>0 ){array_push($jugadoresLocal,$jugador1['0']);}

                $jugador2 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['2A'] ) ;
                    if( count($jugador2)>0 ) {array_push($jugadoresLocal,$jugador2['0']);}

                $jugador3 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['3A'] ) ;
                    if( count($jugador3)>0 ) {array_push($jugadoresLocal,$jugador3['0']);}

                $jugador4 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['4A'] ) ;
                    if( count($jugador4)>0 ) {array_push($jugadoresLocal,$jugador4['0']);}

                $jugador5 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['5A'] ) ;
                    if( count($jugador5)>0 ) {array_push($jugadoresLocal,$jugador5['0']);}			

                $jugador6 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['6A'] ) ;
                    if( count($jugador6)>0 ) {array_push($jugadoresLocal,$jugador6['0']);}
        }
        if( ($iclub == $clubvisitante) && (count($posicionesSetGrabadasInicial) > 0) )
        { 
                $jugador1 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['1B'] ) ;
                    if( count($jugador1)>0 ){array_push($jugadoresVisitante,$jugador1['0']);}

                $jugador2 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['2B'] ) ;
                    if( count($jugador2)>0 ) {array_push($jugadoresVisitante,$jugador2['0']);}

                $jugador3 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['3B'] ) ;
                    if( count($jugador3)>0 ) {array_push($jugadoresVisitante,$jugador3['0']);}

                $jugador4 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['4B'] ) ;
                    if( count($jugador4)>0 ) {array_push($jugadoresVisitante,$jugador4['0']);}

                $jugador5 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['5B'] ) ;
                    if( count($jugador5)>0 ) {array_push($jugadoresVisitante,$jugador5['0']);}			

                $jugador6 = partjug::getJugSetVer($partido,$fecha,$iclub,$anioEq,$setnum,(int)$posicionesSetGrabadasInicial['0']['6B'] ) ;
                    if( count($jugador6)>0 ) {array_push($jugadoresVisitante,$jugador6['0']);}			
        }
    } // SI LA PRIMER CONSULTA EN ROTACIONES O POSICIONES INICALES NO TRAE NADA
    Else
    {
       // procesamos la posicion inicial cargadas
        // print_r($jugadores2);
        $partidoRow = Partido::getById($partido,$fecha);
        // echo "<br>partido<br>";
        // print_r($partidoRow);
        // echo "<br>partido<br>";
        $clublocal =$partidoRow['idcluba'];
        $clubvisitante=$partidoRow['idclubb'];

        for($i=0;$i<sizeof($jugadores2);$i++)
        {
          //	echo "<div style='color:white'>indice: ".$i." Set: ".$resumenarray[$i]['setnumero']." pa: ".$resumenarray[$i]['puntoa']." pb: ".$resumenarray[$i]['puntob']."</div><br>";
          if($clublocal == $jugadores2[$i]['idclub']) array_push($jugadoresLocal,$jugadores2[$i]);
          if($clubvisitante == $jugadores2[$i]['idclub']) array_push($jugadoresVisitante,$jugadores2[$i]);
            
        }
    }
				
	//print_r($jugadores);
	if ( (isset($jugadores2))  )
	{
	        $datos["estado"] = 1;
	        $datos["JugadoresINILocal"] = $jugadoresLocal;//es un array SIEMPRE EN VISUALIZAR, POS INI
            $datos["JugadoresINIVisitante"] = $jugadoresVisitante;//es un array SIEMPRE EN VISUALIZAR, POS INI

	        				echo json_encode($datos);
	        
    };
}        
?>
