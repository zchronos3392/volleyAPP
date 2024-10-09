<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require ('Categoria.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$idcate = $_POST['categoriaID'];
	$categoriaDesc = "'".$_POST['categoria']."'";

	$edadi	  = $_POST['edadi'];
	$edadf	  = $_POST['edadf'];
	$setM	  = $_POST['setM'];
	$activar  = $_POST['activas'];
	// if( $activar== 0 ) $activar=1;
	// 	else $activar=0;
	
    // update categoria
    	$retorno = Categoria::update($idcate,$categoriaDesc,$edadi,$edadf,$setM,$activar);

    if ($retorno) {
        // C�digo de �xito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creaci�n exitosa')));
    } else {
        echo($retorno);
    }

}
else
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$idcate = $_GET['categoriaID'];
		$categoriaDesc = "'".$_GET['categoria']."'";
		$edadi	  = $_GET['edadi'];
		$edadf	  = $_GET['edadf'];
		$setM	  = $_GET['setM'];
		$activar  = $_GET['activas'];
		// if($activar==0 )$activar=1;
		// 	else $activar=0;
	
		// update categoria
		$retorno = Categoria::update($idcate,$categoriaDesc,$edadi,$edadf,$setM,$activar);

		if ($retorno) {
			// C�digo de �xito
			echo(json_encode(array('estado' => '1','mensaje' => 'Creaci�n exitosa')));
		} else {
			echo($retorno);
		}
    
	}
	
?>