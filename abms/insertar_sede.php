<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require ('Sede.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
	$idclub = $_POST['iclub'];
	$sedenom = $_POST['sedenom'];
	$direccion = $_POST['direxsede'];
    // Insertar ciudad
    $retorno = sede::insert($direccion,$idclub,$sedenom);

    if ($retorno) {
        // C�digo de �xito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creaci�n exitosa')));
    } else {
        // C�digo de falla
    }
}
?>