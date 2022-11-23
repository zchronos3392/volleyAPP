<?php
/**
 * Elimina una meta de la base de datos
 * distinguida por su identificador
 */

require 'Ciudad.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	$idcity = $_POST['icity'];
    $retorno = Ciudad::delete($idcity);

	if ($retorno)
	{
        echo(json_encode(array('estado' => '1','mensaje' => 'Eliminaci�n exitosa')));
    } else {
        echo(json_encode(array('estado' => '2','mensaje' => 'Eliminaci�n fallida')));
    }	
}
else // get para pruebas 
{
	$idcity = $_GET['icity'];
    $retorno = Ciudad::delete($idcity);

	if ($retorno)
	{
        echo(json_encode(array('estado' => '1','mensaje' => 'Eliminaci�n exitosa')));
    } else {
        echo(json_encode(array('estado' => '2','mensaje' => 'Eliminaci�n fallida')));
    }	
}
?>