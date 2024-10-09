<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require ('Estado.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Decodificando formato Json
        $idEstado          = $_GET['estadoID'];
    
        $retorno = Estado::delete($idEstado);

    if ($retorno) {
        // C�digo de �xito
        echo(json_encode(array('estado' => '1','mensaje' => 'Eliminacion exitosa')));
    } else {
        // C�digo de falla
        echo(json_encode(array('estado' => '2','mensaje' => 'Eliminacion NO exitosa')));
    }
}
?>