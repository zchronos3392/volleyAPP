<?php
/**
 * Elimina una meta de la base de datos
 * distinguida por su identificador
 */

require 'Club.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	$idclub = $_POST['iclub'];
    $retorno = Club::delete($idclub);

	if ($retorno)
	{echo(json_encode(array('estado' => '1','mensaje' => 'Eliminación exitosa')));} 
    else 
    {echo(json_encode(array('estado' => '2','mensaje' => 'Eliminación fallida')));}	
}
else // get para pruebas 
{
	$idclub = $_GET['iclub'];
    $retorno = Club::delete($idclub);

	if ($retorno)
	{
        echo(json_encode(array('estado' => '1','mensaje' => 'Eliminación exitosa')));
    } else {
        echo(json_encode(array('estado' => '2','mensaje' => 'Eliminación fallida')));
    }	
}
?>