<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
require ('Posicion.php');
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petici�n GET
    $registros = Posicion::contar();
    // ESTA VOLVIENDO UN VECTOR DE VECTORES
    	//print_r ($registros["0"]["count(*)"]);
	$idpuesto=0;
		if(isset($_POST['idpuesto'])) $idpuesto = $_POST['idpuesto'];		
		if(isset($_GET['idpuesto'])) $idpuesto  = $_GET['idpuesto'];		
	
    if($registros["0"]["count(*)"] > "0")
     {
		if($idpuesto == 0)	
			$posiciones = Posicion::getAll();
		else
			$posiciones = Posicion::getById($idpuesto);
			    
	    if ($posiciones) {
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["Posiciones"] = $posiciones;//es un array
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	    else {
	    		print json_encode(array("id" => 2,"nombre" => "Sin posiciones cargadas"));
	    }
	}
	else
			print json_encode(array("id" => 3,"nombre" => "Tabla vacia, conteo 0"));
}

?>
