<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>
			VOLLEY.APP::Configurar Categorias
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
		<script type="text/javascript" src="./scripts/delupd.js"></script> 
		<script type="text/javascript">
		
			$(document).ready(function() {
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
 	<form id="formConfig21" name="formCategoria" class="formCategoria">
	  	<div class="grillaCat21">	
	  	 <div class="itemCat21_1"><h3>Ingreso de Categorias</h3></div>
	     <div class="itemCat21_2">Categoria Nombre</div>
	     <div class="itemCat21_3"><input id="categoria"  name="categoria" type="text"></div>
		 <div class="itemCat21_4">
		    <div class="gridEdad">
			    <div class="itmGridEdad1">Edad Inicio</div>
				<div class="itmGridEdad2"><input id="edadi"  name="edadi" type="number"></div>
			    <div class="itmGridEdad3">Edad Fin</div>
				<div class="itmGridEdad4"><input id="edadf"  name="edadf" type="number"></div>
			</div>
		  </div>
		  <div class="itemCat21_5">MaxNro Sets</div>
		  <div class="itemCat21_6">
		  	  <select id="setM"  name="setM" >
		  	  	<option value="1">1</option>
		  	  	<option value="2">2</option>
		  	  	<option value="3">3</option>
		  	  	<option value="4">4</option>
		  	  	<option value="5">5</option>
		  	  </select>
		  </div>
		  <div class="itemCat21_7">Activar</div>
		  <div class="itemCat21_8"><input id="activar"  class="CheckActivar" name="activar" type="checkbox"></div>
		   <div class="itemCat21_9"><button id="AltaCategoria" name="AltaCategoria" >+</button></div>
		</div>
	</form>
<!-- visualizacion de carga -->		
	 	<form id="formConfig" name="formCiudad">
	 	<div class="grillaABMCat">
		 	<div class="itmABMCat1"><button id="btnEliminaCat"   name="btnEliminaCateg" value="..."  class="buttonAzul">-</button></div>
		 	<div class="itmABMCat2"><button id="btnActivarCat"   name="btnActivarCateg" value="..."  class="buttonAzul">(A)</button></div>
			<div class="itmABMCat3">Categorias cargadas</div>
            <div class="itmABMCat4"><select id="icate" class="SelList"> 
                <option value="999" selected>Seleccione una Categoria</option>
            </select>
            </div>
	 	</div>
        </form> 
<!-- visualizacion de carga -->		
</div>
<!--<div class="icc3"></div>
  <div class="icc4"></div>
<div class="icc5"></div>
<div class="icc6"></div>
  <div class="icc7"></div>
  <div class="icc8"></div>
  <div class="icc9"></div>-->
</section>		
</body>
</html>

