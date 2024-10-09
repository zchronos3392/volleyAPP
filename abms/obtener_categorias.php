<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
require ('Categoria.php');
if($_SERVER['REQUEST_METHOD'] == 'GET') {

	 $todxscat=0; // en cero no hace nada, en 1 achica la lista
     if(isset($_GET['todxscat']))  $todxscat = $_GET['todxscat'];

	 $ianio = 0;
     if(isset($_GET['ianio']))  $ianio = (int)$_GET['ianio'];

	 $activas = 0;
		     if(isset($_GET['activas']))  $activas = (int)$_GET['activas'];
	 $iclub = 0;
     if(isset($_GET['iclub']))  $iclub = (int)$_GET['iclub'];


    // Manejar petici�n GET
    $registros = Categoria::contar();
    // ESTA VOLVIENDO UN VECTOR DE VECTORES
    	//print_r ($registros["0"]["count(*)"]);
    if($registros["0"]["count(*)"] > "0")
     {
		if($todxscat == 1) $categorias = Categoria::getAllConJugadores($ianio,$iclub);
		else $categorias = Categoria::getAll($activas);

	    if ($categorias) {
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["Categorias"] = $categorias;//es un array
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	    else {
	    		print json_encode(array("id" => 2,"nombre" => "Sin categorias aun"));
	    }
	}
	else
			print json_encode(array("id" => 3,"nombre" => "Tabla vacia, conteo 0"));
}

?>
