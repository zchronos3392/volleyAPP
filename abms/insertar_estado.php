<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require ('Estado.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Decodificando formato Json
    $IDestado          = $_GET['estadoID']; 
	$estadoDescripcion = $_GET['estadoDescripcion'];
    $imagen = $_GET['imagenEstado'];
    $colorEstado = $_GET['colorEstado'];
    
        $retorno = Estado::insert($IDestado,$estadoDescripcion,$imagen,$colorEstado);

    if ($retorno) {
        // C�digo de �xito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creacion exitosa')));
    } else {
        // C�digo de falla
        echo(json_encode(array('estado' => '2','mensaje' => 'Creacion NO exitosa')));
    }
}
?>