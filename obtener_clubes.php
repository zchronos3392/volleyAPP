<?php include('sesioner.php'); ?>
<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax
require 'Club.php';
echo($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petición GET
    $registros = Club::contar();
    // ESTA VOLVIENDO UN VECTOR DE VECTORES
    //	print_r ($registros["0"]["count(*)"]);
    if($registros["0"]["count(*)"] > "0")
     {
		$clubes = Club::getAll();
	    //print_r($clubes); // viene un vector
	    if ($clubes) {
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["Clubes"] = $clubes;//es un array
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	    else {
	    		print json_encode(array("id" => 2,"nombre" => "Sin clubes aun"));
	    }
	}
	else
			print json_encode(array("id" => 3,"nombre" => "Tabla vacia, conteo 0"));
}
?>