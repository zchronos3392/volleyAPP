<?php
//revisado 29-08-2018
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/Funciones.php');

require_once ('Partido.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	//aca necesito solo grabar un registro igual al anterior pero con otro estado
	$idpartido = (int) $_POST['partido'];
	$fecha = "'".$_POST['fecha']."'";
	$clubGano = (int) $_POST['clubgano'];
	$estado = 2;
	$retorno = Partido::UpdSts($idpartido,$fecha,$estado);
    
/*
	"idpartido" : $("#partidoid").val(),
	"idset"     : $("#numSet").text(),
	"resa"      : $("#resa").text(),
	"resb"      : $("#resb").text(),
	"fechas"    : $("#fecha").text(),
	"horas"     : $("#stopwatch").text(),
	"saque"     : $("#saque").val(),
	"anioEquipo":	$("#ianio").val()
*/    

    if($retorno)
    {
        // Codigo de �xito
        print(json_encode(array('estado' => '1','mensaje' => 'Se modificó el partido ok')));
    } else 
    {
        // Codigo de falla
		print(json_encode(array('estado' => '2','mensaje' => 'no se pudo modificar el partido')));
    }
   }
?>
