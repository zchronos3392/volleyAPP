<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require ('Estrategias.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
 	//	"categoria" ,"edadi" ,"edadf"   
	$strategiaCodigo = "";
	if(isset($_POST['strategiaCodigo'])) $strategiaCodigo = $_POST['strategiaCodigo'];
	
    // Insertar posicion
    $retorno = Strats1::delete($strategiaCodigo);

    if ($retorno) {
        // C�digo de �xito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creaci�n exitosa')));
    } else {
        // C�digo de falla
        echo(json_encode(array('estado' => '2','mensaje' => 'Creaci�n NO exitosa')));
    }
}
?>