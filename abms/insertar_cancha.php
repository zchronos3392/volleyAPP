<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require('Cancha.php');

//print(json_encode(array('metodo acceso' => $_SERVER['REQUEST_METHOD'])));

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
	$idclub = (int) $_POST['iclub'];
	$idsede = (int) $_POST['isede2'];
	$nombre = $_POST['nomcancha'];
	$ubicacion  = $_POST['direc_can'];
	$dimensiones  = $_POST['dimcan'];
        $foto = '""';
		if(isset($_POST['foto']))   $foto = "'".$_POST['foto']."'";
	
    // Insertar ciuda
	$ultimacancha =  Cancha::ultID();
//	Array ( [0] => Array ( [idcancha] => 7 ) ) 					      
  	$idcancha = 1;
	if( !empty($ultimacancha) ) $idcancha = (int) $ultimacancha[0]["idcancha"];
    if($idcancha == 0) $idcancha = 1;
    else $idcancha++;
  
  
    $retorno = Cancha::insert($idclub,$idsede,$idcancha,$nombre,$foto,$ubicacion,$dimensiones);

    if($retorno) {
        // Codigo de �xito
        print(json_encode(array('estado' => '1','mensaje' => 'Creacion exitosa')));
    } else {
        // Codigo de falla
		print(json_encode(array('estado' => '2','mensaje' => 'Creacion NO exitosa')));
    }
}
else
{
if($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Decodificando formato Json
	$idclub = $_GET['iclub'];
	$idsede = $_GET['isede2'];
	$nombre = $_GET['nomcancha'];
	$ubicacion  = $_GET['direc_can'];
	$dimensiones  = $_GET['dimcan'];
    $foto = '';
	$foto         = $_GET['foto'];
    // Insertar ciuda
    $retorno = Cancha::insert($idclub,$idsede,$nombre,$ubicacion,$dimensiones);

    if($retorno) {
        // C�digo de �xito
        print(json_encode(array('estado' => '1.1','mensaje' => 'Creacion exitosa')));
    } else {
        // C�digo de falla
		print(json_encode(array('estado' => '2.2','mensaje' => 'Creacion NO exitosa')));
    }
 }	
	
}
?>
