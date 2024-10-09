<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require 'Jugador.php';
require 'JugadorPuestos.php';
require_once 'JugadorPartidoCab.php';


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $ianio = 0;
	    $ianio   = $_GET["ianio"];
    $idjugador  = 0;
        $idjugador  = $_GET["idjugador"];
    $iclubescab = 0;
        $iclubescab = $_GET["iclubescab"]; //iclubescab: 1
    $icate = 0;
        $icate = $_GET["icate"]; //icatcab: 2

    $indice = 0;
        $indice = $_GET["indice"];
    $remeraNum = 0;
        $remeraNum = $_GET["remeranum"];

    $puestoCate = 0;
        $puestoCate = $_GET["puestocate"];

    // SE CARGA ACA DEL LADO DEL SERVIDOR
        $actualizaClub = date_create()->format('Y-m-d H:i:s');// fecha corecta de ahora
        $actualizaClub = "'".$actualizaClub."'";    
    // SE CARGA ACA DEL LADO DEL SERVIDOR
		 $existe = puestojugador::existePuesto($idjugador,$ianio,$iclubescab,$indice);
		//echo "<br>existe renglon ? $existe <br>";
		if(is_array($existe)){
               // echo "ACTUALIZAR";
                $retornoPos = puestojugador::update($idjugador,$indice,$remeraNum,$icate,$puestoCate,$ianio,$iclubescab,$actualizaClub);
        }
        else
        {
            //echo "AGREGAR";
            $indice=1; // se insertara de a uno
            $retornoPos = puestojugador::insert($idjugador,$indice,$actualizaClub,$remeraNum,$icate,$puestoCate,$ianio,$iclubescab);
        }
        
   $datos["estado"] = 1;	        
   $datos["retorno"] = $retornoPos;//es un array
	    print json_encode($datos);
	    //el print lo puedo usar para cuando lo llamo desde android		 	
}

?>
