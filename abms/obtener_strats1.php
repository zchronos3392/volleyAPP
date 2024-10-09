<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
require ('Estrategias.php');
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petici�n GET
    $registros = Strats1::contar();
    // ESTA VOLVIENDO UN VECTOR DE VECTORES
    	//print_r ($registros["0"]["count(*)"]);
	$idpuesto=0;
		if(isset($_POST['idpuesto'])) $idpuesto = $_POST['idpuesto'];		
		if(isset($_GET['idpuesto'])) $idpuesto  = $_GET['idpuesto'];		
	
    if($registros["0"]["count(*)"] > "0")
     {
		if($idpuesto == 0)	
			$estrategias = Strats1::getAll();
		else
			$estrategias = Strats1::getById($idpuesto);
			    
	    if ($estrategias) {
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["Strats1"] = $estrategias;//es un array
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	    else {
	    		print json_encode(array("codigo" => 'YYY',"nombre" => "Sin estrategias cargadas aun"));
	    }
	}
	else
	{
			$estrategias = array("codigo" => 'ZZZ',"nombre" => "Sin estrategias cargadas aun, conteo 0");
		    $datos["estado"] = 1;
	        $datos["Strats1"] = $estrategias;//es un array
	        print json_encode($datos);
	 
	}
}

?>
