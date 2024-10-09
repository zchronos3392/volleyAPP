<?php
/**
 * Elimina una meta de la base de datos
 * distinguida por su identificador
 */

require 'Categoria.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	$idcate = $_POST['icate'];
    $retorno = Categoria::delete($idcate);

	if ($retorno)
	{
        echo(json_encode(array('estado' => '1','mensaje' => 'Eliminación exitosa')));
    } else {
        echo(json_encode(array('estado' => '2','mensaje' => 'Eliminación fallida')));
    }	
}
else // get para pruebas 
{
	$idcate = $_GET['icate'];
    $retorno = Categoria::delete($idcate);

	if ($retorno)
	{
        echo(json_encode(array('estado' => '1','mensaje' => 'Eliminación exitosa')));
    } else {
        echo(json_encode(array('estado' => '2','mensaje' => 'Eliminación fallida')));
    }	
}
?>