<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require 'Club.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Decodificando formato Json
	$nombre = $_POST['nombre'];
	$clubabr = $_POST['clubabr'];
	$iciudad = $_POST['ciudad'];	
    //$body = json_decode(file_get_contents("php://input"), true);
    $escudo = "";
    if(isset($_POST['escudo'])) $escudo = $_POST['escudo'];
    // Insertar club
    $retorno = Club::insert($nombre,$clubabr,$escudo,$iciudad);

    if ($retorno) {
        // Código de éxito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creación exitosa')));
//        return json_encode(array('estado' => '1','mensaje' => 'Creación exitosa'));
    } else {
        // Código de falla
        //return json_encode(array('estado' => '2','mensaje' => 'Creación fallida'));
    }
}
?>