<?php

require_once('JugadorPartido.php');
require_once('Jugador.php');
require ('Set.php');
require_once('../Funciones.php');
require_once('Partido.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petici�n GET
//    $registros = Sett::contar();
//    if($registros["0"]["count(*)"] > "0")
//     {
		if(isset($_GET['idpartido'])){  $idpartido = $_GET['idpartido'];} else { $idpartido = 0; };
		$fecha = "'".$_GET['idfecha']."'";
		
		$setNum=0; //obtengo todos
		//if(isset($_GET["setNum"])) $setNum = $_GET["setNum"];
		
		
		$sets = Sett::getSetData($idpartido,$fecha,$setNum);
	    //print_r($sets); //[setnumero] => 1
        if ($sets) {
	    	/** OBTENIENDO ULTIMA HORA DE GRABACION Y HORA DE COMIENZO **/
		foreach($sets as $indice => $setitem)
				{	
					$setHoras = Sett::getHoraInicioHoraFin($idpartido,$fecha,$setNum);
					//echo "setghoras x set Sett::getHoraInicioHoraFin($idpartido,$fecha,$setNum);<br>";
					//print_r($setHoras);					
					if(count($setHoras)>0){ //Solo consigo la hora final e inicio 
					$vectorHoraInicio = sett::getByIdUltimoRegistro($idpartido,$setNum,(int)$setHoras['0']['primseq'],$fecha );
						$valorHoraInicio = $vectorHoraInicio['hora'];
					
						$vectorHoraFin    = sett::getByIdUltimoRegistro($idpartido,$setNum,(int)$setHoras['0']['ultmseq'],$fecha );
						$valorHoraFin    =	$vectorHoraFin['hora'];
					
					$sets[$indice]['horainicio']=$valorHoraInicio;	
					$sets[$indice]['primseq']=(int)$setHoras['0']['primseq'];	
					$sets[$indice]['ultmseq']=(int)$setHoras['0']['ultmseq'];	
					$sets[$indice]['horafin']=$valorHoraFin;
				  }	
                      $partidoRow = Partido::getById($idpartido,$fecha);
                          //echo "<br>partido<br>";
                          //print_r($partidoRow);
                         //echo "<br>partido<br>";
                        // necesito de la cabecera de partido: anioEq,categoriapartido
                        $categoriapartido = $partidoRow['idcat'];
                        $clublocal =$partidoRow['idcluba'];
                        $clubvisitante=$partidoRow['idclubb'];
                        $setNum = (int) $sets[$indice]['setnumero'];
                        $anioEq = (int) substr($fecha,1,4); //porque la fecha viene como 

                        //echo "<br>LOCAL SET NRO $setNum : fx::obtener_posiciones_iniciales($idpartido,$fecha,$clublocal,$setNum,$anioEq,$categoriapartido);<br>";
                        //echo "<br>VISITA SET NRO $setNum : fx::obtener_posiciones_iniciales($idpartido,$fecha,$clubvisitante,$setNum,$anioEq,$categoriapartido);<br>";

                        $sets[$indice]['PosicionInicialLocal']=fx::obtener_posiciones_iniciales($idpartido,$fecha,$clublocal,$setNum,$anioEq,$categoriapartido);
                        $sets[$indice]['PosicionInicialVisita']=fx::obtener_posiciones_iniciales($idpartido,$fecha,$clubvisitante,$setNum,$anioEq,$categoriapartido);
				}	
	    	
	    	/** OBTENIENDO ULTIMA HORA DE GRABACION Y HORA DE COMIENZO **/

			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        $datos["estado"] = 1;
	        $datos["Sets"] = $sets;//es un array
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	    else {
	    		print json_encode(array("id" => 2,"nombre" => "Sin set data aun","idpartido" => $idpartido));
	    }
//	}
//	else
//			print json_encode(array("id" => 3,"nombre" => "Tabla vacia, conteo 0"));
}
?>
