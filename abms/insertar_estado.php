<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require ('Estado.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
 	//	"categoria" ,"edadi" ,"edadf"   
	$estado = $_POST['estados'];
    // Insertar ciudad
    $retorno = Estado::insert($estado);

    if ($retorno) {
        // C�digo de �xito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creaci�n exitosa')));
    } else {
        // C�digo de falla
        echo(json_encode(array('estado' => '2','mensaje' => 'Creaci�n NO exitosa')));
    }
}
?>