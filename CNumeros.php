<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Numeros / Usuarios</title>
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
		<script type="text/javascript">
		/**************************************************************/
		$(document).ready(function(){

				// SALIR SINO HAY INICIADA UNA SESION
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

			//**************** busqueda clubes con jquery *********************************************/      
			$("#btnBuscarNumero").click(function(){ 
			        var textoSearch =	$("#itext").val().toUpperCase();
			        if(textoSearch != ''){
					$("#inumeros option:contains("+textoSearch+")").each(function(){
			    			$(this).attr('selected', true).css({"font-size":"40px","color":"red"});
					});
					} else
					$("#inumeros option:contains("+textoSearch+")").each(function(){
			    			$(this).attr('selected', true).css("");
					});
					return false;
			}); // parentesis el .CLICK buscar club
			//**************** PARTIDPS *********************************************/ 
			
		$("#btnUpdNumero").click(function(){ 
			//alert('solo el texto '+$("#inumeros option:selected").text());

				
		var parametros = 
		{
        	"valor" : $("#updNumero").val(),
        	"clave" : $("#inumeros option:selected").text()
        } 
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/actualiza_numero.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#inumeros").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			$("#inumeros").prop('disabled', false);
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				$("#inumeros").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
         			
    			//event.preventDefault();	
			}); // parentesis el .CLICK actualizar numeros
			
			$("#inumeros").on('click change',function(){
					$("#verNumero").empty('');
					$("#verNumero").append($("#inumeros").val());
					$("#updNumero").val($("#inumeros").val());
			});
	     });	
			
		</script>
    </head>
<body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
    </header>
<section class="gridControl">
  <div class="icc1"></div>
  <div class="icc2"><section>	
  	  <h3>Ingreso de Numeros</h3>
 	<form id="formConfig" name="formCiudad" class="formNumeros">
	<button id="AltaNumeros" name="AltaNumeros" >+</button>
    <label for="tabla"  class="">Palabra Asoc. / Usuario</label>
						<input id="tabla"  name="tabla" type="text">
	<label for="provCity" class="">Numero key</label>
						<input id="numclave" name="numclave" type="text">
	</form>
</section>
<!-- visualizacion de carga -->		
	 	<form id="formConfig" name="formNumeros">
		<button id="btnUpdNumero"   name="btnUpdNumero" value="..." class="btnBuscar">+/-</button>				
		<label for="icity">Numeros</label>
            <select id="inumeros" class="SelList"> 
                <option value="999" selected>Seleccione una palabra / usuario</option>
            </select>
			<div id="verNumero" class="vernumero">##</div>
			<input type="text" id="updNumero"   name="updNumero" value="..." >Valor ##</input>
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

