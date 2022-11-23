<?php
/**
 * Elimina una meta de la base de datos
 * distinguida por su identificador
 */

require 'Sede.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	$idsede = $_POST['isede2'];
    $retorno = Sede::delete($idsede);

	if ($retorno)
	{
        echo(json_encode(array('estado' => '1','mensaje' => 'Eliminación exitosa')));
    } else {
        echo(json_encode(array('estado' => '2','mensaje' => 'Eliminación fallida')));
    }	
}
else // get para pruebas 
{
	$idsede = $_GET['isede2'];
    $retorno = Sede::delete($idsede);

	if ($retorno)
	{
        echo(json_encode(array('estado' => '1','mensaje' => 'Eliminación exitosa')));
    } else {
        echo(json_encode(array('estado' => '2','mensaje' => 'Eliminación fallida')));
    }	
}
?>