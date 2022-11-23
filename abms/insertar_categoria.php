<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require ('Categoria.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
 	//	"categoria" ,"edadi" ,"edadf"   
	$categoria = $_POST['categoria'];
	$edadi = $_POST['edadi'];
	$edadf = $_POST['edadf'];
	$setM  = $_POST['setM'];
		$activar  = $_POST['activas']; 
		
    // Insertar categoria
    $retorno = Categoria::insert($categoria,$edadi,$edadf,$setM,$activar);

    if ($retorno) {
        // Código de éxito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creación exitosa')));
    } else {
        echo($retorno);
    }
}
else
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	    // Decodificando formato Json
	 	//	"categoria" ,"edadi" ,"edadf"   
		$categoria = $_GET['categoria'];
		$edadi = $_GET['edadi'];
		$edadf = $_GET['edadf'];
		$setM  = $_GET['setM'];
			$activar  = $_GET['activas']; 
			
	    // Insertar categoria
	    $retorno = Categoria::insert($categoria,$edadi,$edadf,$setM,$activar);

	    if ($retorno) {
	        // Código de éxito
	        echo(json_encode(array('estado' => '1','mensaje' => 'Creación exitosa')));
	    } else {
	        echo($retorno);
	    }
	}
	
?>