<?php
/**
 * Obtiene todas las Categorias de la base de datos
 */
require ('Categoria.php');
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petici�n GET
    	$idcate = $_GET['idcate'];
		$categorias = Categoria::getcate($idcate);
	    //print_r($clubes); // viene un vector
	    if ($categorias) {
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["SetMaxCat1"] = $categorias;//es un array
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	    else {
	    		print json_encode(array("id" => 2,"descr error" => "algo salio mel"));
	    }
}

?>
