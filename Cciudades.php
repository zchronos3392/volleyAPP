<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Ciudades</title>
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

function buscarCiudad(origen,destinoId){
	
	var parametros = {
    	"llamador" : "Cciudades",
    	"funcion" : "buscarciudad",			
    	"filtro" : $("#"+origen).val(),
		};		         
		
         $.ajax({ 
            url:   './abms/obtener_varios.php',
            type:  'GET',
            data: parametros,
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
				$("#"+destinoId).empty();
    		},
            done: function(data){
			},
            success:  function (r){
 				if(r['estado'] != 99){
	                $(r['Ciudades']).each(function(i, v)
	                { // indice, valor
	                    if (! $("#"+destinoId).find("option[value='" + v.idCiudad + "']").length)
	                	{		
	                    	$("#"+destinoId).append('<option value="' + v.idCiudad + '">' + v.Nombre + '</option>');
						}
	                });
 				}	
 				else
 					$("#"+destinoId).append('<option value="' + r['estado'] + '">' + r['Ciudades'] + '</option>');

             },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			 console.log(xhr);
			 console.log(thrownError);
			}
            }); // FIN funcion ajax CANCIONES todas:
};
//**************** FUNCION DE BUSQUEDA DE CIUDADES MODERNA *********************************************/ 		
		
		/**************************************************************/
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

			//**************** busqueda clubes con jquery *********************************************/      
/*
			$("#btnBuscarCity").click(function(){ 
			        var textoSearch =	$("#itext").val().toUpperCase();
			 //               $("#iclub option:contains("+textoSearch+")").attr('selected', true).css({"font-size":"40px","color":"red"});
			                //$("#iclub option:contains("+textoSearch+")").attr('selected', true).css({"font-size":"40px","color":"red"});
			        if(textoSearch != ''){
					$("#icity option:contains("+textoSearch+")").each(function(){
			    			$(this).attr('selected', true).css({"font-size":"40px","color":"red"});
							//else $(this).attr('selected', true).css('');
					});
					} else
					$("#icity option:contains("+textoSearch+")").each(function(){
			    			$(this).attr('selected', true).css("");
					});
					return false;
			}); // parentesis el .CLICK buscar club
*/			
			//**************** PARTIDPS *********************************************/ 
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
  	  <h3>Ingreso de Ciudades</h3>
 	<form id="formConfig" name="formCiudad" class="formCiudad">
	<button id="AltaCiudad" name="AltaCiudad" >+</button>
    <label for="ciudad"  class="">Ciudad</label>
    	<input id="ciudad"  name="ciudad" type="text">
	<label for="provCity" class="">Provincia</label>
    	<input id="provCity" name="provCity" type="text">
    	<!--<select name="provCity" class="SelListC"><option value="000">Sel provincia</option></select>-->
	</form>
</section>
<!-- visualizacion de carga -->		
	 	<form id="formConfig" name="formCiudad">
		<section id="busque" name="busque" class="busque">
		 	<div><label for="itext">Buscar</label></div>	
		 	<div><input type="text" id="itext" name="itext" class="inputSearch" onkeyup="buscarCiudad(this.id,'icity');"/></div>
		 	<div><!--<button id="btnBuscarCity"   name="btnBuscarCity" value="..." class="btnBuscar">Sape...</button>--></div>
	 	</section>	 	
		<label for="icity">Ciudades cargadas</label>
            <select id="icity" class="SelList"> 
                <option value="999" selected>Seleccione una Ciudad</option>
            </select>
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

