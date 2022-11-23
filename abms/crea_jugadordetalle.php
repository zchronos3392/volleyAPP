<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require 'Jugador.php';
require 'JugadorPuestos.php';



if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $retorno = jugador::getAll();

	//print_r($retorno);

foreach($retorno as $campo => $valor){
			echo("------------------------------------------<br>");
			echo("registro nro: $campo ");
			foreach($valor as $indice => $valorJugador){
				//echo(" **** $indice => $valorJugador<br>");
				if($indice == "nombre") echo(" **** $indice => $valorJugador<br>");
				if($indice == "idjugador") $idjugador = $valorJugador;
				if($indice == "categoria") $icate     = $valorJugador;
				if($indice == "numero")    $remeraNum = $valorJugador;
				$idpuesto      = 1;
				$puestoCate    = 8;
				if($indice == "anioEquipo")   $ianio =  $valorJugador;
				if($indice == "idclub")  $iclubescab =  $valorJugador;

				$actualizaClub = date_create()->format('Y-m-d H:i:s');// fecha corecta de ahora
				$actualizaClub = "'".$actualizaClub."'";
			}
			$existe = puestojugador::existePuesto($idjugador,$ianio,$iclubescab,$idpuesto);
				//echo "<br>existe renglon ?<br>";
			if($existe["1"] == "1")
			{
				echo "<br> * existia NO SE ACTUALIZAN LOS DATOS<br>";
					//$retornoPos = puestojugador::update($idjugador,$indice,$remeraNum,$icate,$puestoCate,$actualizaClub);
			}
			else
			{
				echo "<br> * era nuevo SE AGREGA EL REGISTRO<br>";
				$retornoPos = puestojugador::insert($idjugador,$idpuesto,$actualizaClub,$remeraNum,$icate,$puestoCate,$ianio,$iclubescab);
								
			}
				
}

// [0] => 
// 		Array ( 
// 				[idclub] => 142 
// 				[idjugador] => 1 
// 				[anioEquipo] => 2018 
// 				[numero] => 6694 
// 				[nombre] => 
// 				jugador_6694 
// 				[edad] => 17 
// 				[ingresoClub] => 2018-08-25 
// 				[categoria] => 2 
// 				[categoriaInicio] => 2 
// 				[FechaActualiza] => 
// 				[Baja] => );
	
/*	
for($indice = 1;$indice<=$regMax;$indice++)
{

};
*/	
}

?>
