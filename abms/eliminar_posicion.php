<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require ('Posicion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
 	//	"categoria" ,"edadi" ,"edadf"   
	$posicion = "";
	if(isset($_POST['posicion'])) $posicion = $_POST['posicion'];
	
    // Insertar posicion
    $retorno = Posicion::delete($posicion);

    if ($retorno) {
        // Código de éxito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creación exitosa')));
    } else {
        // Código de falla
        echo(json_encode(array('estado' => '2','mensaje' => 'Creación NO exitosa')));
    }
}
?>