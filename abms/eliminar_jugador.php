<?php
// 02-10-2019


require ('Jugador.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

// parametros = {"unclub" : unclub,"unjugador" : unjugador, "unanio" : unanio, "unacategoria" : unacategoria};		         
	$unclub = (int) $_POST['unclub'];
	$unjugador = (int) $_POST['unjugador'];
	$unanio = (int) $_POST['unanio'];
	$unacategoria = (int) $_POST['unacategoria'];


	$retorno = Jugador::delete($unclub,$unjugador,$unanio,$unacategoria);
//    echo($retorno);
    if($retorno) {
        // Codigo de �xito
        print(json_encode(array('estado' => '1','mensaje' => 'Creacion exitosa')));
    } else 
    {
        // Codigo de falla
		print(json_encode(array('estado' => '2','mensaje' => 'eliminacion NO exitosa')));
    }
   }
?>
