<?php

require ('Set.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petici�n GET
//    $registros = Sett::contar();
//    if($registros["0"]["count(*)"] > "0")
//     {
		if(isset($_GET['idpartido'])){  $idpartido = $_GET['idpartido'];} else { $idpartido = 0; };
		$fecha = "'".$_GET['idfecha']."'";
		
		$setNum=0;
		//if(isset($_GET["setNum"])) $setNum = $_GET["setNum"];
		
		
		$sets = Sett::getSetData($idpartido,$fecha,$setNum);
	    if ($sets) {
	    	
	    	/** OBTENIENDO ULTIMA HORA DE GRABACION Y HORA DE COMIENZO **/
		foreach($sets as $indice => $setitem)
				{	
					$setHoras = Sett::getHoraInicioHoraFin($idpartido,$fecha,$setNum);
					//echo "setghoras x set ";
					//print_r($setHoras);					
					if(count($setHoras)>0){
					$vectorHoraInicio = sett::getByIdUltimoRegistro($idpartido,$setNum,(int)$setHoras['0']['primseq'],$fecha );
						$valorHoraInicio = $vectorHoraInicio['hora'];
					
						$vectorHoraFin    = sett::getByIdUltimoRegistro($idpartido,$setNum,(int)$setHoras['0']['ultmseq'],$fecha );
						$valorHoraFin    =	$vectorHoraFin['hora'];
					
					$sets[$indice]['horainicio']=$valorHoraInicio;	
					$sets[$indice]['primseq']=(int)$setHoras['0']['primseq'];	
					$sets[$indice]['ultmseq']=(int)$setHoras['0']['ultmseq'];	
					$sets[$indice]['horafin']=$valorHoraFin;
				  }										
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
