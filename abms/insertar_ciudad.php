<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require 'Ciudad.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
	$nombre = $_POST['ciudad'];
	$provincia = $_POST['provincia'];
    // Insertar ciudad
    $retorno = Ciudad::insert($nombre,$provincia);

    if ($retorno) {
        // Código de éxito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creación exitosa')));
    } else {
        // Código de falla
    }
}
?>