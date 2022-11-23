<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require ('Posicion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
 	//	"categoria" ,"edadi" ,"edadf"   
	$posicion = "";
	if(isset($_POST['posicion'])) $posicion = $_POST['posicion'];
	
	$codigo = "";
	if(isset($_POST['codigo'])) $codigo = $_POST['codigo'];	
	
	$color = "";
	if(isset($_POST['color'])) $color = $_POST['color'];		
   
	$idposicion = 0;
	if(isset($_POST['idposicion'])) $idposicion = $_POST['idposicion'];		
       
    // Insertar posicion
    $retorno = Posicion::update($idposicion,$posicion,$codigo,$color);

    if ($retorno) {
        // C�digo de �xito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creaci�n exitosa')));
    } else {
        // C�digo de falla
        echo(json_encode(array('estado' => '2','mensaje' => 'Creaci�n NO exitosa')));
    }
}
?>