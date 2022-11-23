<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>VOLLEY.APP</title>
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
    </head>
<body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
		<?php //include('includes/menuConfig.php');; ?>
    </header>
<section class="gridControl">
  <div class="icc1"></div>
  <div class="icc2">
        <h3>Ingreso de Sedes</h3>	
		<form id="formConfig" name="formsedes"  class="formSedes">
			<p><!-- el POST SOLO VE LO QUE TIENE NAME, sino no lo ve.-->
				<label for="sedenom">Nombre sede</label>
				<input id="sedenom" name="sedenom" type="text">
			</p>
			<p>
				<label for="direxsede">direccion</label>
				<input id="direxsede"	name="direxsede" "text">
			</p>
			<p>
				<button id="btnSedes"   name="btnSedes" value="sape" class="btnIngreso">Sape...</button>
			</p>
		</form>
<!-- visualizacion de carga -->		
	<form id="formConfig" name="formSedes">
	<label for="isede">Sedes cargadas</label>
	    <select id="isede" class="SelList"> 
	        <option value="1" selected>Seleccione una Sede</option>
	    </select>
	</form> 
<!-- visualizacion de carga -->		
</div>
  <div class="icc3">
  	  	  	<section>	
  	  <h3>Ingreso de Ciudades</h3>
 	<form id="formConfig" name="formCiudad" class="formCiudad">
    <label for="ciudad"  class="">Ciudad</label>
    	<input id="ciudad"  name="ciudad" type="text">
	<label for="provCity" class="">Provincia</label>
    	<input id="provCity" name="provCity" type="text">
    	<!--<select name="provCity" class="SelListC"><option value="000">Sel provincia</option></select>-->
		<button id="AltaCiudad" name="AltaCiudad" >Alta Ciudad</button>
	</form>
</section>
<!-- visualizacion de carga -->		
	 	<form id="formConfig" name="formCiudad">
		<label for="iciudad">Ciudades cargadas</label>
            <select id="icity" class="SelList"> 
                <option value="1" selected>Seleccione una Ciudad</option>
            </select>
        </form> 
<!-- visualizacion de carga -->		

  
  </div>
  <div class="icc4"></div>
<div class="icc5">    
  <section>	
    <h3>Ingreso de Canchas</h3>
		<form id="formConfig" name="formCanchas" class="formCanchas">
			<label for="cancha" class="">Cancha</label>
			<input id="cancha" name="cancha"   type="text">
			<label for="direc_can" class="">Dirección</label>
			<input id="direc_can" name="direc_can" type="text">
			<label for="gym1" class="">Gimnasio 1</label>
			<input id="gym1"  name="gym1"  type="text">
			<label for="gym2" class="">Gimnasio 2</label>
			<input id="gym2"  name="gym2" type="text">
			<label for="gym3" class="">Gimnasio 3</label>
			<input id="gym3" name="gym3"  type="text">
				<button id="INGRESOcancha" name="INGRESOcancha">Submit</button>
		</form>
</section>
<!-- visualizacion de carga -->		
	 	<form id="formConfig" name="formCanchas">
		<label for="icancha">Canchas cargadas</label>
            <select id="icancha" class="SelList"> 
                <option value="1" selected>Seleccione una cancha</option>
            </select>
        </form> 
<!-- visualizacion de carga -->		

</div>

<div class="icc6">
  <h3>Ingreso de clubes</h3>	
	<form id="formConfig" name="formClubes"  class="formClubes	">
		<p><!-- el POST SOLO VE LO QUE TIENE NAME, sino no lo ve.-->
			<label for="nombre">Nombre club</label>
			<input id="nombre" name="nombre" type="text">
		</p>
		<p>
			<label for="clubabr">abreviatura</label>
			<input id="clubabr"	name="clubabr" "text">
		</p>
		<p>
			<button id="btnIngreso"   name="btnIngreso" value="sape" class="btnIngreso">Sape...</button>
		</p>
	</form>
<!-- visualizacion de carga -->		
 	<form id="formConfig" name="formClubess">
	<label for="iclub">Clubes cargados</label>
        <select id="iclub" class="SelList"> 
            <option value="1" selected>Seleccione un CLUB</option>
        </select>
    </form> 
<!-- visualizacion de carga -->		
	
</div>
  <div class="icc7"></div>
  <div class="icc8"></div>
  <div class="icc9"></div>
</section>		
</body>
</html>

