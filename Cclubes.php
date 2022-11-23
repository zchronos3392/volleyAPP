<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>
			VOLLEY.APP::Configurar Clubes
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
				
			$("#iescudosclub").on("change click",function(){
				if($("#iescudosclub").val() == '9999')
					$("#escudo").attr("src","img/jugadorGen.png");
				else
					$("#escudo").attr("src","img/escudos/"+$("#iescudosclub").val());
				});
		
         $.ajax({ 
            url:   './abms/obtener_ciudades.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#iciudadclub").prop('disabled', true);
            },
            done: function(data){
			},
            success:  function (r){
                $(r['Ciudades']).each(function(i, v)
                { // indice, valor
                    if (! $('#iciudadclub').find("option[value='" + v.idCiudad + "']").length)
                	{		
                    $("#iciudadclub").append('<option value="' + v.idCiudad + '">' + v.Nombre + '</option>');
					}
					
                });
                $("#iciudadclub").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#iciudadclub").append('<option value="' + '9999' + '">' + 'JQERY:Tabla Ciudades vacia' + '</option>');			
			$("#iciudadclub").val('9999');
				$("#iciudadclub").prop('disabled', false);				
			}
          }); // FIN funcion ajax para CIUDADES		
			
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
  	  <h3>Ingreso de clubes</h3>	
	<form id="formConfig" name="formClubes"  class="formClubes ">
		
	 <div class="ffclubes">
			<div class="ffclubes1"><label for="escudo">Escudo</label></div>
			<div class="ffclubes2">
					<select id="iescudosclub" name="iescudosclub">
					<option value="9999">Seleccionar escudo</option>
					<?php 
						$imagenEncontrada = scandir('./img/escudos/');
						
						foreach($imagenEncontrada as $indice => $valor)
							if($valor != "." && $valor != ".." && $valor != "" )
						  			echo "<option value='$valor'>$valor</option>";
					?>
				</select>
			</div>	
			<div class="ffclubes3">
				<img  src="img/jugadorGen.png" class="imgjugador" id="escudo"></img>
		    </div>		
		<div class="ffclubes4">
			<label for="nombre">Nombre club</label>
		</div>	
		<div class="ffclubes5">
			<input id="nombre" name="nombre" type="text"></input>
		</div>
		<div class="ffclubes51">
			<label for="iciudadclub">ciudad</label>
		</div>
		<div class="ffclubes52">
			<select id="iciudadclub" name="iciudadclub"  class="SelList"></select>
		</div>				
		<div class="ffclubes6"><label for="clubabr">abreviatura</label></div>
		<div class="ffclubes7"><input id="clubabr"	name="clubabr" type="text"></input></div>
		<div class="ffclubes8">
			<button id="btnIngreso"   name="btnIngreso" value="+" class="btnIngreso">+</button>
		</div>
	 </div>	
	 
	</form>
<!-- visualizacion de carga -->		
 	<form id="formConfig" name="formClubess">
 	<section id="busque" name="busque" class="busque">
	 	<div><label for="itext">Buscar</label></div>	
	 	<div><input type="text" id="itextbuscar" name="itext" class="inputSearch"/></div>
	 	<div><!--<button id="btnBuscarClub"   name="btnBuscarClub" value="..." class="btnBuscar">Sape...</button>--></div>
	 	<div></div>
 	</section>
 	
 	<label for="iclub">Clubes cargados</label>
        <select id="iclub" name="iclub" class="SelList"> 
            <option value="9999" selected>Seleccione un CLUB</option>
        </select>
    </form> 
<!-- visualizacion de carga -->		
</div>

</section>		
</body>
</html>

