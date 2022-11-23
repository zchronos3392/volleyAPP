<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require ('Categoria.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
 	//	"categoria" ,"edadi" ,"edadf"   
	$idcate = $_POST['icate'];
	$categoriaData = Categoria::getById($idcate);
	//print_r($categoriaData);
	//	$activar  = $_POST['activas']; 
	$categoriaDesc=	"'".$categoriaData["descripcion"]."'";
	$edadi	 =  $categoriaData["EdadInicio"];
	$edadf	 =  $categoriaData["EdadFin"];
	$setM	 =  $categoriaData["setMax"];
	$activar =  $categoriaData["categoriaActiva"];
	if($activar==0 )$activar=1;
		else $activar=0;
	
    // update categoria
    	$retorno = Categoria::update($idcate,$categoriaDesc,$edadi,$edadf,$setM,$activar);

    if ($retorno) {
        // Código de éxito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creación exitosa')));
    } else {
        echo($retorno);
    }

}
else
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
   // Decodificando formato Json
 	//	"categoria" ,"edadi" ,"edadf"   
	$idcate = $_GET['icate'];
	$categoriaData = Categoria::getById($idcate);
	print_r($categoriaData);
	//	$activar  = $_POST['activas']; 
	$categoriaDesc=	"'".$categoriaData["descripcion"]."'";
	$edadi	 =  $categoriaData["EdadInicio"];
	$edadf	 =  $categoriaData["EdadFin"];
	$setM	 =  $categoriaData["setMax"];
	$activar =  $categoriaData["categoriaActiva"];

	if($activar==0 )$activar=1;
		else $activar=0;

    // update categoria
    $retorno = Categoria::update($idcate,$categoriaDesc,$edadi,$edadf,$setM,$activar);

    if ($retorno) {
        // Código de éxito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creación exitosa')));
    } else {
        echo($retorno);
    }
    
	}
	
?>