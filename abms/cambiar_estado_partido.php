<?php
//revisado 29-08-2018

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/Funciones.php');

require_once ('Partido.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	//aca necesito solo grabar un registro igual al anterior pero con otro estado
	$idpartido = (int) $_POST['partido'];
	$fecha = $_POST['fecha'];
	$estado = (int) $_POST['estadoNuevo'];

	//echo("idpatido : ".$idpartido."<br>");
	//echo("fecja : ".$fecha."<br>");
	//echo("Estado : ".$estado."<br>");

	$retorno = Partido::UpdSts($idpartido,$fecha,$estado);
    
    if($retorno)
    {
        // Codigo de �xito
        print(json_encode(array('estado' => '1','mensaje' => 'Creacion exitosa')));
    } else 
    {
        // Codigo de falla
		print(json_encode(array('estado' => '2','mensaje' => 'Creacion NO exitosa')));
    }
   }
   else
   {
	$idpartido = (int) $_GET['partido'];
	$fecha = "'".$_GET['fecha']."'";
	$estado = (int) $_GET['estadoNuevo'];
	   
   }
?>
