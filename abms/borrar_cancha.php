<?php
/**
 * Elimina una meta de la base de datos
 * distinguida por su identificador
 */

require 'Cancha.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	$idcan = $_POST['icancha'];
    $retorno = Cancha::delete($idcan);

	if ($retorno)
	{
        echo(json_encode(array('estado' => '1','mensaje' => 'Eliminación exitosa')));
    } else {
        echo(json_encode(array('estado' => '2','mensaje' => 'Eliminación fallida')));
    }	
}
else // get para pruebas 
{
	$idcan = $_GET['icancha'];
    $retorno = Cancha::delete($idcan);

	if ($retorno)
	{
        echo(json_encode(array('estado' => '1','mensaje' => 'Eliminación exitosa')));
    } else {
        echo(json_encode(array('estado' => '2','mensaje' => 'Eliminación fallida')));
    }	
}
?>