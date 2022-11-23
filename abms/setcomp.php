<?php
/**
 * Obtiene todas las Competencias de la base de datos
 */
require ('Competencia.php');
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petici�n GET
    	$idcomp = $_GET['idcomp'];
		$comps = Competencia::getsetcomp($idcomp);
		//print_r($comps);
//	    if($comps["0"]["setnmax"] >= "0")
//	    {
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["SetMaxComp1"] = $comps["0"]["setnmax"];
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
//	    }
//	    else {
//	    		print json_encode(array("id" => 2,"descr error" => "algo salio mel"));
//	    }

}

?>
