<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require_once 'Jugador.php';
require('JugadorPartidoCab.php');
require_once('JugadorPuestos.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    // Decodificando formato Json
	// Decodificando <	
	
	$partido =	$_POST["idpartido"];
	$fecha	 =	"'".$_POST["fechapartido"]."'";
	$iclub	 =	$_POST["iclubescab"];
	$icate 	 =	$_POST["icatcab"];
	$categoriapartido = $_POST["categoriapartido"];
	$jugador =	$_POST["idjugador"];
	//necesito la psicion y traer el año !!: 
	$anioEq = $_POST["ianio"];
	

	$retorno=0;
    $mensajePre="";    
   	$jugadores = jugador::getJugadorPartidoInsert($partido,$fecha,$iclub,$icate,$anioEq,$jugador,$categoriapartido); 
   	
   	$mensajeErrorRemera ='El jugador no tiene puesto definido.';
	$puestosj = puestojugador::getRemeraCategoria($jugador,$anioEq,$iclub,$categoriapartido);
	//print_r($puestosj);
	if(isset($puestosj['0'])){
				$mensajeErrorRemera = '';
				for($contador=0; $contador < count($jugadores);$contador++ )
				{ // recorro vector de jugadores del equipo A
				$puesto = $jugadores[$contador]['puesto'];
				$mensajeAlta = "'".$mensajePre." insertar_jugador_partido::AGREGA JUGADOR DE OTRA CATEGORIA' ";
				$retorno = partjugCab::insert($partido,$fecha,$iclub,$icate,$jugador,
											  $puesto,$mensajeAlta);
				};
		}
				
	
	
	if($retorno)
	{
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["mensaje"] = $mensajeAlta;
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	}
	else {
			$datos["estado"] = 0;
	        $datos["mensaje"] = "Posible error: .".$mensajeErrorRemera;

			print json_encode($datos);}
} // recorriendo jugadoress
// GET
else // GET para probar
{

}// cierre del GET 

?>
