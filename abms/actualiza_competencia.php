<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
require ('Competencia.php');
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$idcompetencia = (int) $_POST['idcomp'];
	$compnombre  =  $_POST['cnombre'];
 	$setsmaxnum  =(int) $_POST['setnmax'];

	$competenciaActivar = 0;
		if(isset($_POST['competenciaActiva'])) $competenciaActivar = $_POST['competenciaActiva'];
		
	$retorno = Competencia::ActualizaCompetencia($idcompetencia,$compnombre,$setsmaxnum,$competenciaActivar);
	    if ($retorno)
		{
	        $datos["estado"] = 1;
	        $datos["resultado"] = $retorno;//es un array
	        print json_encode($datos);
	    }
	    else 
		{
	    		print json_encode(array("id" => 2,"resultado" => "error al actualizar competencia"));
	    }
}

?>
