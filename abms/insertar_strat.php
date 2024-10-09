<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require ('Estrategias.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
 	//	"categoria" ,"edadi" ,"edadf"   
	 //"nombre"
	 //"codigo"
 	
	$nombre = "";
	if(isset($_POST['nombre'])) $nombre = $_POST['nombre'];
	
	$codigo = "";
	if(isset($_POST['codigo'])) $codigo = $_POST['codigo'];	
	
    // Insertar posicion
    $retorno = Strats1::insert($codigo,$nombre);

    if ($retorno) {
        // Código de éxito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creación exitosa')));
    } else {
        // Código de falla
        echo(json_encode(array('estado' => '2','mensaje' => 'Creación NO exitosa')));
    }
}
?>