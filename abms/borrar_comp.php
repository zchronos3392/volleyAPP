<?php
/**
 * Elimina una meta de la base de datos
 * distinguida por su identificador
 */

require 'Competencia.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	$idcompe = $_POST['icomp'];
    $retorno = Competencia::delete($idcompe);

	if ($retorno)
	{
        echo(json_encode(array('estado' => '1','mensaje' => 'Eliminaci�n exitosa')));
    } else {
        echo(json_encode(array('estado' => '2','mensaje' => 'Eliminaci�n fallida')));
    }	
}
else // get para pruebas 
{
	$idcompe = $_GET['icomp'];
    $retorno = Competencia::delete($idcompe);

	if ($retorno)
	{
        echo(json_encode(array('estado' => '1','mensaje' => 'Eliminaci�n exitosa')));
    } else {
        echo(json_encode(array('estado' => '2','mensaje' => 'Eliminaci�n fallida')));
    }	
}
?>