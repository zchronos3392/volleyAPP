<?php

require ('Set.php');

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

    //necesito saber a que secuencia pertenece la hora actualizada  o traer las dos secuencias !!!! 
 


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

   print json_encode($datos);

}
?>
