<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
require ('Cancha.php');
if($_SERVER['REQUEST_METHOD'] == 'GET') {
		$idclub = (int) $_GET['idclub'];
	//	echo($idclub);
		$idsede = (int) $_GET['idsede'];
//		echo($idsede);
		
		$canchas = Cancha::getBySede($idclub,$idsede);
	 //   print_r($canchas); // viene un vector
	    if ($canchas) {
			 $datos['Canchas'] = $canchas;
	         print json_encode($datos);
	    //    el print lo puedo usar para cuando lo llamo desde android
	     }
	     else
		{
	    		 print json_encode(array("id" => 2,"nombre" => "Sin categorias aun"));
		}
}
?>
