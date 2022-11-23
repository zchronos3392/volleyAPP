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
		<script type="text/javascript" src="./jqs/ietats.js"></script>
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
  <div class="icc1"></div>
  <div class="icc2">
  <section>	
  	  <h3>Estados</h3>
 	<form id="formConfig" name="formEtats"  class="formCategoria">
    <label for="estados"  class="">Estados</label>
    <input id="estados"  name="estados" type="text">
	<button id="AltaEtats" name="AltaEtats" >+</button>
	<button id="btnEliminaEst"   name="btnEliminaEst" value="..." class="btnDel">-</button>
	</form>
</section>
	<!-- visualizacion de carga -->
	<form id="formConfig" name="formCiudad">
		<section id="busque" name="busque" class="busque">
		<div>
		
			</div>
			<div>
			</div>
		</section>
		<label for="ietats">
			Estados cargados
		</label>
		<select id="ietats" class="SelList">
			<option value="9999" selected>
				Seleccione un Estado
			</option>
		</select>
	</form>
<!-- visualizacion de carga -->	
</div>
<!--  <div class="icc3"></div>
<div class="icc4"></div>
<div class="icc5"></div>
  <div class="icc6"></div>
  <div class="icc7"></div>
  <div class="icc8"></div>
  <div class="icc9"></div>-->
</section>		
</body>
</html>

