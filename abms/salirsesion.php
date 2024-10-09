<?php
/**
 * Obtiene todas las Sesion de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax
require_once('SesionTabla.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$clave = "'".$_POST['TEXTOCLAVE']."'";
		//echo "CLAVE: $clave";
		//$comando = "DELETE FROM vappsesiones WHERE sesusuario=$ipconeccion";
		$return = SesionTabla::deletesessionOrigen($clave);
		//header("Location: ../index.php");	
			echo($return);
		
}
else if ($_SERVER['REQUEST_METHOD'] == 'GET') {

	$clave = "'".$_GET['TEXTOCLAVE']."'";
	$return = SesionTabla::deletesession($clave);
	//header("Location: ../index.php");
	echo($return);
}	

?>
