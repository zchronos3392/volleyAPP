<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require ('Estrategias.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
 	//	"categoria" ,"edadi" ,"edadf"   
  //"stratCodigo" : $("#stratCodigo").val(),
  //"stratNombre"  	
	$codigo = "";
	if(isset($_POST['stratCodigo'])) $codigo = $_POST['stratCodigo'];	
	
   
	$descripcion = 0;
	if(isset($_POST['stratNombre'])) $idposicion = $_POST['stratNombre'];		
       
    // Insertar posicion
    $retorno = Strats1::update($codigo,$nombre);

    if ($retorno) {
        // Código de éxito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creación exitosa')));
    } else {
        // Código de falla
        echo(json_encode(array('estado' => '2','mensaje' => 'Creación NO exitosa')));
    }
}
?>