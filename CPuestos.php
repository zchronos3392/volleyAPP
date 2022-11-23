<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>
			VOLLEY.APP::Configurar Estados
		</title>
        <meta name="title" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   <!--SCRIPTS-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="./scripts/nsanz_script.js"></script> 
		<!--<script type="text/javascript" src="./css/delupd.js"></script> -->
		<script type="text/javascript" src="./jqs/ipuestos.js"></script>
		<script type="text/javascript">		
		$(document).ready(function(){
		// Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo
		<?php
		require_once('./abms/SesionTabla.php');
		$ingreso='';
			$graboSesion = SesionTabla::getsession("'".$_SERVER['REMOTE_ADDR']."'");
		if ((int)$graboSesion["sesid"] !=0) {
			echo('var sesion =1;');
			$_SESSION['INGRESO'] ="SI";
		} else {

			$_SESSION['INGRESO'] ="";
			echo('var sesion =0;');
		}
		?>

		if (sesion == 0 )
		location.href='index.php';
		// stopwatchjquery
		}); // parentesis del READY
		</script>		
</head>
<body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
    </header>
<section class="gridControl">
  <div class="icc1">
   </div>
  <div class="icc2">
 <!-- visualizacion de carga -->
   <div class="controlPosicion">	
		<div class="controlPos1"><label for="select_server">Puestos disponibles</label></div>
		<div class="controlPos2"><select name="select_puestos" id="select_puestos"></select></div>
	</div>
  <section>	
  	  <h3 style="text-align: center;">Posiciones</h3>
 	<form id="formConfig" name="formEtats"  class="formPosiciones">
    <label for="posicion"  class="">Posicion Nombre</label>
    	<input id="posicion"  name="posicion" type="text">
    <label for="codigo"  class="">Código</label>
    	<input id="codigo"  name="codigo" type="text">  
    <label for="color"  class="">Color</label>
    	<input id="colorPuesto"  name="colorPuesto" type="color" />  
	<button id="AltaPos" name="AltaPos" >+</button>
	<button id="BajaPos" name="BajaPos"  class="btnAzulFrancia" >-</button>	
	<button id="ModPos" name="ModPos"  class="btnAzulFrancia" >UPD</button>		
	</form>
</section>
</div>
</section>		
</body>
</html>
