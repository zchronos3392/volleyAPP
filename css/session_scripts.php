$(document).ready(function(){
    // Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo
<?php
	require_once('./abms/SesionTabla.php');
	$ingreso='';
	$graboSesion = SesionTabla::getsession('INGRESO');
	if ((int)$graboSesion["sesid"] !=0) {
		echo('var sesion =1;');
		$_SESSION['INGRESO'] ="SI";
	} else {

		$_SESSION['INGRESO'] ="";
		echo('var sesion =0;');
	}
?>

	if (sesion == 0 )
		location.href='index.php';
	// stopwatchjquery
}); // parentesis del READY



    
