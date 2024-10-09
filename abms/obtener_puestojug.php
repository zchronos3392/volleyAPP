<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
require ('JugadorPuestos.php');
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petici�n GET
    $idjugador  = 0;
    if(isset($_GET['idjugador'])) $idjugador  = $_GET['idjugador'];
    //agregado porque se repiten id de jugadores por ser un autonumerico...
    if(isset($_GET['iclubescab'])) $iclub = $_GET['iclubescab'];
    if(isset($_GET['ianio'])) $ianio  = $_GET['ianio'];
    //agregado porque se repiten id de jugadores por ser un autonumerico...            
	if($idjugador == '') $idjugador  = 0;
    $registros = puestojugador::contar($idjugador);
    // ESTA VOLVIENDO UN VECTOR DE VECTORES
    	//print_r ($registros);
    if($registros["0"]["count(*)"] > "0")
     {
		$puestosj = puestojugador::getAll($idjugador,$ianio,$iclub);
	    
	    if ($puestosj) {
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["PuestosJug"] = $puestosj;//es un array
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	    else {
	    		print json_encode(array("id" => 2,"nombre" => "Sin estados aun"));
	    }
	}
	else
			print json_encode(array("id" => 3,"nombre" => "Sin puestos para el jugador aun"));
}

?>
