<?php

require ('Set.php');
require_once ('Partido.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $fecha ="";
        if(isset($_GET['fechapart'])){  $fecha = "'".$_GET['fechapart']."'";}
    $idpartido=0;
        if(isset($_GET['id'])){  $idpartido = $_GET['id'];}
    $setnumero =0;
        if(isset($_GET['setnumero'])){  $setnumero = $_GET['setnumero'];}

    $secuenciainihr =0;
        if(isset($_GET['secuenciahoraini'])){  $secuenciainihr = $_GET['secuenciahoraini'];}
    $secuenciafinhr =0;
        if(isset($_GET['secuenciahorafin'])){  $secuenciafinhr = $_GET['secuenciahorafin'];}    
    $valorHoraInicio ='';
        if(isset($_GET['horainicio'])){  $valorHoraInicio = "'".$_GET['horainicio']."'";}
    $valorHoraFin='';
        if(isset($_GET['horafin'])){  $valorHoraFin = "'".$_GET['horafin']."'";}

    $puntoLocal = 0;
        if(isset($_GET['nuevopuntolocal'])){  $puntoLocal = $_GET['nuevopuntolocal'];}
    $puntoVisitante = 0;
        if(isset($_GET['nuevopuntovisita'])){  $puntoVisitante = $_GET['nuevopuntovisita'];}


    $valorFuncionalidad='';
        if(isset($_GET['funcion'])){  $valorFuncionalidad = $_GET['funcion'];}

    //necesito saber a que secuencia pertenece la hora actualizada  o traer las dos secuencias !!!! 
 

    switch ($valorFuncionalidad) {
        case "CAMBIOHORAS":
            //$vectorHoraInicio = sett::getByIdUltimoRegistro($idpartido,$setnumero,$secuenciainihr,$fecha );
            //$vectorHoraFin    = sett::getByIdUltimoRegistro($idpartido,$setnumero,$secuenciafinhr,$fecha );

            //echo " VECTOR DE HORA INICIO  PREUPDATE, SECUENCIA $secuenciainihr, NUEVA HORA A CAMBIAR : $valorHoraInicio <br>";
            //print_r($vectorHoraInicio);
            //echo "<BR> VECTOR DE HORA FIN  PREUPDATE, SECUENCIA $secuenciafinhr, NUEVA HORA FIN A CAMBIAR : $valorHoraFin <br>";
            //print_r($vectorHoraFin );
            $vectorHoraInicio = sett::updateHoraByIdRegistro($idpartido,$setnumero,$secuenciainihr,$fecha,$valorHoraInicio );
            $vectorHoraFin    = sett::updateHoraByIdRegistro($idpartido,$setnumero,$secuenciafinhr,$fecha,$valorHoraFin );

            //echo "<br> RESPUESTA AL PRIMER UPDATE:  <br>";
            //print_r($vectorHoraInicio);
            //echo "<br> RESPUESTA AL SEGUNDO UPDATE:  <br>";
            //print_r($vectorHoraFin );

            //$vectorHoraInicio = sett::getByIdUltimoRegistro($idpartido,$setnumero,$secuenciainihr,$fecha );
            //$vectorHoraFin    = sett::getByIdUltimoRegistro($idpartido,$setnumero,$secuenciafinhr,$fecha );

            //echo "<br>  VECTOR DE HORA INICIO POST UPDATE, SECUENCIA $secuenciainihr, NUEVA HORA CAMBIADA : $valorHoraInicio <br>";
            //print_r($vectorHoraInicio);
            //echo "<BR> VECTOR DE HORA FIN POST UPDATE, SECUENCIA $secuenciafinhr, NUEVA HORA FIN CAMBIADA : $valorHoraFin <br>";
            //print_r($vectorHoraFin );


        /*  
            if(  count($vectorHoraInicio) > 0 && count($vectorHoraFin) > 0 )
            {
                    //Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
        */
                    $datos["estado"] = 1;
        /*
                }
                else {
                    $datos["estado"] = 0;
                }
        */     
        break;
        case "CAMBIOPUNTOS":
            // CAMBIO AMBOS
            $vectorUpdateResult = sett::updatePuntoABByIdRegistro($idpartido,$setnumero,$secuenciafinhr,$fecha,$puntoLocal,$puntoVisitante);

			$ResultadosEquipo = Partido::getResultados($idpartido,$fecha);

			// //print_r($ResultadosEquipo);
            $ganador ="";
            $ClubLocal = (int) $ResultadosEquipo["0"]["ClubA"];
            $ClubVisitante = (int) $ResultadosEquipo["0"]["ClubB"];
            $restaPuntos =  ($puntoLocal - $puntoVisitante);
            // SETMAX = 5, SI SETMAX = 3 ENTONCES LA LOGICA ES OTRA..
            if( ($restaPuntos > 2) && ($puntoLocal >= 25 || $puntoVisitante >= 25) ) $ganador = (int) $ResultadosEquipo["0"]["ClubA"];
                            else 
                                if( ($restaPuntos < 2) && ($puntoLocal >= 25 || $puntoVisitante >= 25) ) $ganador = (int) $ResultadosEquipo["0"]["ClubB"];
                                        else $ganador = 0;
    
			 $clubares = (int) $ResultadosEquipo["0"]["ClubARes"];
			 $clubbres = (int) $ResultadosEquipo["0"]["ClubBRes"];
			// analiza resultado si es resultado de cierre de set, sumo un punto al CLUB. 
            // ME FALTAN DATOS, COMO SAQUE, PUNTOS,ETC
             if($ClubLocal == $ganador )
			 	{
			 	  $clubares++;	
			 	  Partido::UpdResultados($idpartido,$fecha,$clubares,0);	
			     }	
			     //tenia saque el equipo B, pero vino punto de A
			 if($ClubVisitante == $ganador )
			 	{
			 	$clubbres++;	
			 	  Partido::UpdResultados($idpartido,$fecha,0,$clubbres);	
			     }	


            $datos["estado"] = 1;
            $datos["Resultado"] = $vectorUpdateResult;
            break;
    }

   print json_encode($datos);

}
?>
