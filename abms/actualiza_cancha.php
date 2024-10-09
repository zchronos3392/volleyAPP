<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
require ('Cancha.php');
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$idcancha = (int) $_POST['idcancha'];
	$idclub   = (int) $_POST['idclub'];
	$idsede   = (int) $_POST['idsede'];
		
		$nombre="";
		if(isset($_POST['nomcancha']))
			$nombre 		= $_POST['nomcancha'];
		$direccion="";
		if(isset($_POST['direc_can']))
			$direccion   	= $_POST['direc_can'];
		
		$dimensiones = "";
		if(isset($_POST['dim_can']))		
			$dimensiones   	= $_POST['dim_can'];
		
		$accion = "";
		if(isset($_POST['accion']))
			$accion   	= $_POST['accion'];

	if($accion == 'UPD')	
		$retorno = Cancha::ActualizaCancha($idcancha,$idclub,$idsede,$nombre,$direccion,$dimensiones);
	else
		if($accion == 'DEL')	
			$retorno = Cancha::delete($idclub,$idsede,$idcancha);
	

	    if ($retorno)
		{
	        $datos["estado"] = 1;
	        $datos["resultado"] = $retorno;//es un array
	        print json_encode($datos);
	    }
	    else 
		{
	    		print json_encode(array("id" => 2,"resultado" => "error en actualizacion de cancha"));
	    }
}

?>
