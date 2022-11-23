<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax
require_once ('EquipoAnio.php');

//echo($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petici�n GET
	//var parametros={"llamador":'controlador',"funcion":'borrarclubanio',"ianio":anio,"iclub":idclub};

    $ianio = 0;
     if(isset($_GET['ianio']))  $ianio = (int)$_GET['ianio'];
    
     $llamador="";
        if(isset($_GET['llamador']))  $llamador = (int)$_GET['llamador'];

    $funcion="";
        if(isset($_GET['funcion']))  $funcion = (int)$_GET['funcion'];
     
    $iclub=0;
        if(isset($_GET['iclub']))  $iclub = (int)$_GET['iclub'];

    $idequipoanio=0;
        if(isset($_GET['equipoanioID']))  $idequipoanio = (int)$_GET['equipoanioID'];

    if($funcion == "borrarclubanio")
    {
    $clubes = EquipoAnio::delete($idequipoanio);
        //$datos["estado"] = 1;	        
        //$datos["Clubes"] = $clubes;//es un array
	    //print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
    }

    if($funcion == "agregarclubanio")
    {
    $clubes = EquipoAnio::insert( $iclub, $ianio);
        //$datos["estado"] = 1;	        
        //$datos["Clubes"] = $clubes;//es un array
	    //print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
    }


}

?>
