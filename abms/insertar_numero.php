<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require 'Numeros.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
	$nombre = "'".$_POST['tabla']."'";
	$clave = $_POST['clave'];
    // Insertar ciudad
    $retorno = Numeros::setnumeros($nombre,$clave);

    if ($retorno) {
        // C�digo de �xito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creaci�n exitosa')));
    } else {
        // C�digo de falla
    }
}
?>