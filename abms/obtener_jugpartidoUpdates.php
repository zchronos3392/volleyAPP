<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax

require_once('JugadorPartido.php');
require_once('JugadorPartidoCab.php');
require_once('Jugador.php');
require_once('Set.php');
//echo($_SERVER['REQUEST_METHOD']);
$retorno03 = 0;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar peticion GET
   	// SOLO NECESITO ESTO PARA COMPARAR POR MISMO PARTIDO/SET
    $partido =	$_GET["idpartido"];
	$fecha	 =	"'".$_GET["fechapartido"]."'";
	$iclub	 =	$_GET["iclubescab"];
	$anioEq = 0;
	if(isset($_GET["ianio"]))  $anioEq = $_GET["ianio"];
     $setnum = 0;
        if(isset($_GET["setdata"]) )  $setnum = $_GET["setdata"];
    // SOLO NECESITO ESTO PARA COMPARAR POR MISMO PARTIDO/SET

	// traigo desde la primer formacion
		$jugadoresXSet = partjug::getJugSetVsCab($partido,$fecha,$iclub,$anioEq,$setnum); 
//    	echo "<br>En cancha: <br>";
//        print_r($jugadoresXSet[0]);
//         foreach($jugadoresXSet[0] as $indice => $valor)
        //     echo "$indice => $valor <br>";
        //ahora la lista de jugadores en cabecera
        $icategoriaPartido =0;
        $jugadoresPresentes = partjugCab::getJugListaInicio($partido,$fecha,$iclub,$anioEq,$icategoriaPartido);
        //     echo "<br>Presentes: <br>";
         //    foreach($jugadoresPresentes[0] as $indice => $valor)
         //    echo "$indice => $valor <br>";
        $variableX =0;

        if(count($jugadoresXSet) == count($jugadoresPresentes) )
                $variableX =0;
        else
           if(count($jugadoresXSet) > count($jugadoresPresentes) )
           {
                    // echo "Se quitó a alguno de la lista";
                    //actualizarListadoJugadores('DEL');
                    $jugadorDistinto = buscar($jugadoresPresentes,$jugadoresXSet,1);
                   // echo "<br>Quitando a ".$jugadorDistinto['nombre']."<br>";
                     $icate 	     =	$jugadorDistinto['categoria'];
                     $jugador        =	$jugadorDistinto["idjugador"];
                     $retorno03 = partjug::deleteSet($partido,$fecha,$iclub,$icate,$jugador,$setnum);
                     echo "<br>Se eliminó a uno de la lista: $retorno03<br>";
            }     
           else
                if(count($jugadoresXSet) < count($jugadoresPresentes) )
                {
                    //actualizarListadoJugadores('INS');
                    //de donde saco los datos que me faltan ?
                    $jugadorDistinto = buscar($jugadoresPresentes,$jugadoresXSet,2);
                   // echo "<br>Agregando a ".$jugadorDistinto['nombre']."<br>";
				      $icate 	     =	$jugadorDistinto['categoria'];
				      $jugador        =	$jugadorDistinto["idjugador"];
				      $puesto         =	$jugadorDistinto["puestoxcat"];
					  $orden          =	0; //valor inicial.
					  $mensajeAlta    = "'INSERTAR_JUGADORES_SETS::INSERT.SET'";
                        $retorno03 = partjug::insertSet($partido,$fecha,$iclub,$icate,$jugador,$setnum,$puesto,$orden,$mensajeAlta);
                     echo "Se agregó a alguno de la lista";
                }

	 if ( $retorno03 )
	     $datos["estado"] = 1;
      else
         $datos["estado"] = 0;
      print json_encode($datos);

}
function buscar($jugadoresPresentes,$jugadoresXSet,$modo)
{
    $jugadorDistinto = Array();

    if($modo == 1) //busco el que falta del vector de En Cancha
    {
        for($i = 0;$i < count($jugadoresXSet);$i++ )
                $jugadoresXSet[$i]['hallado']=0; //los pongo a todos en 0 para saber cual no cambio, ese sera el nuevo

        for($i = 0;$i < count($jugadoresXSet);$i++ )
        {
                //echo "$indice => $valor <br>";
                //  $jugadoresPresentes es mas grande porque se agrego uno
                for($j = 0;$j < count($jugadoresPresentes);$j++ )
                {
                    if($jugadoresXSet[$i]['idjugador'] == $jugadoresPresentes[$j]['idjugador'])    
                            $jugadoresXSet[$i]['hallado']=1;
                }


        }
        //echo "<br>valores en Cancha (QUITAR JUGADOR): <br>";
            //print_r($jugadoresPresentes);
            foreach ($jugadoresXSet as $indice => $jugador)
             {
                foreach ($jugador as $key => $value) 
                        //echo "<br>$key => $value";
                        if($key == 'hallado' && $value == 0)
                            $jugadorDistinto = $jugador;
                
                //echo "<br>";   
             }
        //echo "<br>";
    }


    if($modo == 2) //busco el que sobra del vector de Presentes
    {
        for($i = 0;$i < count($jugadoresPresentes);$i++ )
                $jugadoresPresentes[$i]['hallado']=0; //los pongo a todos en 0 para saber cual no cambio, ese sera el nuevo

        for($i = 0;$i < count($jugadoresPresentes);$i++ )
        {
                //echo "$indice => $valor <br>";
                //  $jugadoresPresentes es mas grande porque se agrego uno
                for($j = 0;$j < count($jugadoresXSet);$j++ )
                {
                    if($jugadoresPresentes[$i]['idjugador'] == $jugadoresXSet[$j]['idjugador'])    
                            $jugadoresPresentes[$i]['hallado']=1;
                }


        }
        //echo "<br>valores en los presentes(SE AGREGO ALGUIEN): <br>";
            //print_r($jugadoresPresentes);
            foreach ($jugadoresPresentes as $indice => $jugador)
             {
                foreach ($jugador as $key => $value) 
                        //echo "<br>$key => $value";
                        if($key == 'hallado' && $value == 0)
                            $jugadorDistinto = $jugador;
                
                //echo "<br>";   
             }
        //echo "<br>";
    }


 return    $jugadorDistinto;
}        
?>
