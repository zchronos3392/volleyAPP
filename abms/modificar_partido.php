<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require('Partido.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	        $idPartido    = $_POST['idpartido']; 
			$Fecha       = $_POST['fechap']; // debe llevar comillas
			$categoria   = $_POST['icate']; // numero
			$ClubA       = $_POST['iclub']; // numero
			$ClubB       = $_POST['iclubb']; // numero
				$CanchaId    = $_POST['icancha']; // numero			
			$competencia = $_POST['icomp']; // numero
			$ciudad      = $_POST['icity']; // numero
			if(isset($_POST['isede']) && $_POST['isede'] != "" )
				$sedeId      =  explode("_",$_POST['isede'])[1] ; // numero
			else
				$sedeId      =  0;

				$descripcionp = "'".$_POST['descripcionp']."'";
			// agregados en abril 2019
				$tbset      = 0; // numero
				if(isset($_POST['valtbset'])){  $tbset = $_POST['valtbset'];} else { $tbset = 0; };				
				$finset      = 0; // numero
				if(isset($_POST['valfinset'])){  $finset = $_POST['valfinset'];} else { $finset = 0; };							
			// agregados en abril 2019			
			
			$s = $Fecha." ".$_POST['horai'].":00";
				//$date = strtotime($s);
				$HoraIni = $s; // correcto !!!
					$HoraIni = "'".$HoraIni."'";
				$Horafin     = $Fecha." 00:00:00";
					$Horafin   = "'".$Horafin."'";  
			$ClubARes    = $_POST['ResA']; // numero
			$ClubBRes    = $_POST['ResB']; // numero
			
			
			 $setsmax = 0;	
			 if(isset($_POST['SetMaxCat'])){  $smaxCate = $_POST['SetMaxCat'];} else { $smaxCate = 0; };
			 if(isset($_POST['SetMaxComp'])){ $smaxcomp = $_POST['SetMaxComp']; } else { $smaxcomp =0; };
			// ejemplo:	SetMaxCat=3 - SetMaxComp=0
			
	        if(  ($smaxcomp > 0) && ($smaxCate >0)  ) { $setsmax = $smaxcomp;};
    	    if(  ($smaxcomp == 0) && ($smaxCate > 0) ) { $setsmax = $smaxCate;};
        	if(  ($smaxcomp > 0) && ($smaxCate == 0) ){  $setsmax = $smaxcomp;};
			
			
    // Insertar partido
        		$Fecha = "'".$Fecha."'";
 
	$retorno = Partido::actualiza($idPartido,$Fecha,$categoria,$ClubA,$ClubB,$CanchaId,$competencia,$sedeId,$ciudad,$HoraIni,$Horafin,$ClubARes,$ClubBRes,$setsmax,$tbset,$finset,$descripcionp);
	
    if ($retorno) {
        // C�digo de �xito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creaci�n exitosa')));
    } else {
        // C�digo de falla
		echo $retorno;
    }

}
else{

if($_SERVER['REQUEST_METHOD'] == 'GET') {
	        $idPartido    = $_GET['idpartido']; 
			$Fecha       = $_GET['fechap']; // debe llevar comillas
			$categoria   = $_GET['icate']; // numero
			$ClubA       = $_GET['iclub']; // numero
			$ClubB       = $_GET['iclubb']; // numero
				$CanchaId    = $_GET['icancha']; // numero			
			$competencia = $_GET['icomp']; // numero
			$ciudad      = $_GET['icity']; // numero
			$sedeId      =  explode("_",$_GET['isede'])[1] ; // numero
			$descripcionp = "'".$_GET['descripcionp']."'";
			
				$tbset      = 0; // numero
				if(isset($_GET['valtbset'])){  $tbset = $_GET['valtbset'];} else { $tbset = 0; };				
				$finset      = 0; // numero
				if(isset($_GET['valfinset'])){  $finset = $_GET['valfinset'];} else { $finset = 0; };							
		
				if($tbset== '') $tbset =0;
				if($finset== '') $finset =0;
			   //echo("tbset ".$tbset." finset ".$finset);
			
			$s = $Fecha." ".$_GET['horai'].":00";
				$HoraIni = $s; // correcto !!!
					$HoraIni = "'".$HoraIni."'";
				$Horafin     = $Fecha." 00:00:00";
					$Horafin   = "'".$Horafin."'";  

			$ClubARes    = $_GET['ResA']; // numero
			$ClubBRes    = $_GET['ResB']; // numero

			$setsmax = 0;
			 if(isset($_GET['SetMaxCat']))  $smaxCate = $_GET['SetMaxCat'];else  $smaxCate = 0;
			 if(isset($_GET['SetMaxComp'])) $smaxcomp = $_GET['SetMaxComp']; else $smaxcomp =0; 
			// ejemplo:	SetMaxCat=3 - SetMaxComp=0
			// busco el maximo entre el max categoria y el max competicion..porque pueden variar..
	        if(  ($smaxcomp > 0) && ($smaxCate >0)  ) { $setsmax = $smaxcomp;};
    	    if(  ($smaxcomp == 0) && ($smaxCate > 0) ) { $setsmax = $smaxCate;};
        	if(  ($smaxcomp > 0) && ($smaxCate == 0) ){  $setsmax = $smaxcomp;};
		
    // Insertar partido
    $Fecha = "'".$Fecha."'";
    		
	$retorno = Partido::actualiza($idPartido,$Fecha,$categoria,$ClubA,$ClubB,$CanchaId,$competencia,$sedeId,$ciudad,$HoraIni,$Horafin,$ClubARes,$ClubBRes,$setsmax,$tbset,$finset,$descripcionp);

    if ($retorno) 
    {
        echo(json_encode(array('estado' => '1','mensaje' => 'Creaci�n exitosa')));
    } else 
    	{
        // C�digo de falla
        echo("Algo no salio bien !!!");
    	}
	}//fin del IF
} // FIN DEL ELSE
?>