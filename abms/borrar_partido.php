<?php
//revisado 26-03-2021
require_once ('Partido.php');
require ('Set.php');
require_once('JugadorPartido.php');
require_once('JugadorPartidoCab.php');
require_once('Rotaciones.php');



if($_SERVER['REQUEST_METHOD'] == 'POST') {
	//aca necesito solo grabar un registro igual al anterior pero con otro estado
	$idpartido = (int) $_POST['partido'];
	$fecha = $_POST['fecha'];
	//ECHO "<br>idpartido $idpartido , fecha $fecha<br>";


//http://localhost/volleyAPP_desa/abms/borrar_partido.php?partido=4&fecha=%272021-03-20%27
	//$estado = 2;
	$retorno  = Partido::delete($idpartido,$fecha);
	$retorno2 = Sett::deleteAll($idpartido,$fecha);
	$retorno3 = partjug::deleteAll($idpartido,$fecha);
	$retorno3 = partjugCab::deleteAllJPCab($idpartido,$fecha);
	//echo "que paso con JUGPARTIDOCAB ? -> $retorno3 <br>";
	$retorno4 = Rotaciones::deleteAll($idpartido,$fecha);    
    
    if($retorno)
    {
        // Codigo de �xito
        print(json_encode(array('estado' => '1','mensaje' => 'Se elimiono el partido ok')));
    } else 
    {
        // Codigo de falla
		print(json_encode(array('estado' => '2','mensaje' => 'no se pudo eliminaar el partido')));
    }
   }
?>
