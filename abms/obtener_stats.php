<?php
/**
 * Obtiene todas las Jugadores de la base de datos
 */
require ('Jugador.php');
if($_SERVER['REQUEST_METHOD'] == 'GET') {
	   $op = "";
  	   if(isset($_GET['OPCION'])) $op = $_GET['OPCION'];
  	   $anioe = 0;
  	   if(isset($_GET['aniofiltro'])) $anioe = $_GET['aniofiltro'];
  	   $idclub = 0;
  	   if(isset($_GET['clubefiltro'])) $idclub = $_GET['clubefiltro'];
	
	switch($op){
		case "JUGENCAT":
					$jugadores = 	jugador::jugadoresEnClubCat($idclub,$anioe);
				    //print_r($jugadores); // viene un vector
				    if ($jugadores) {
						//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
				        $datos["estado"] = 1;
				        $datos["Stats1"] = $jugadores;//es un array
				        print json_encode($datos);
				        //el print lo puedo usar para cuando lo llamo desde android
				    }
				    else 
				    {
				    		print json_encode(array("id" => 2,"nombre" => "Sin categorias aun"));
				    }
				    break;
	}
 } // GET
	//else
	//		print json_encode(array("id" => 3,"nombre" => "Tabla vacia, conteo 0"));
//}

?>
