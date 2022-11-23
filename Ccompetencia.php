<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>
			VOLLEY.APP::Configurar Competencia
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
			


//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA ******************************/   
$("#itextbuscar").keyup(function()
	//	on("keyup keydown",function()
         {   
			var parametros = {
	        	"llamador" : "CCOMPS",
	        	"funcion" : "buscarcompetencia",			
	        	"filtro" : $("#itextbuscar").val(),
				};		         
		
         $.ajax({ 
            url:   './abms/obtener_varios.php',
            type:  'GET',
            data: parametros,
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
				$('#icomp').empty();
    		},
            done: function(data){
			},
            success:  function (r){
 					
                $(r['Competencias']).each(function(i, v)
                { // indice, valor
						//TUVE QUE AGREGARLE, QUE NO EXISTA EL ELEMENTO, PORQUE SE ESTA
                		// TRIPLICANDO UN EVENTO QUE NO PUDE ENCONTRAR Y CARGABA TODOS LOS DATOS TRES VECESSS
                	if (! $('#icomp').find("option[value='" + v.idcomp + "']").length)
                	{
						$("#icomp").append('<option value="' + v.idcomp + '">' + v.cnombre + '</option>');
					}		
                });

             },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			 console.log(xhr);
			 console.log(thrownError);
			}
            }); // FIN funcion ajax CANCIONES todas:
       });

//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 

 
	     });	
			
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
  	  <h3>Ingreso de Competencias</h3>
 	<form id="formConfig" name="formCategoria" class="formCategoria" enctype='multipart/form-data'>
		<button type="submit" id="AltaComp" name="AltaComp" >+</button>
    	<label for="nombre"  class="">Nombre</label>
    	<input id="nombre"  name="nombre" type="text">
    	 <p>
    	 <div class="GridConfigCompes">
	    	 <div class="gridcCompesIt1">
		    	 Max Cant. Sets
	    	 </div>	
	    	<div class="gridcCompesIt2">
	    		<input type="text" id="SetMaxCate" name="SetMaxCate" class="inputSets" />
	        </div>
	        <div class="gridcCompesIt3">
	    	 	Activo
	    	 </div>
	        <div class="gridcCompesIt4">
	    	 	<input type="checkbox" id="SetActivo" name="SetActivo" class="inputSets" />
	    	 </div>
	        <div class="gridcCompesIt5">

			<div class="grillaFormularioHojas">
				<div  class="itemform1">Seleccionar logo<input type="file" value="" name="miLogo" id="miLogo"/>
				</div>
			</div>
	    	 </div>
    	 </div>
    	 </p>
	</form>
</section>
<!-- visualizacion de carga -->		
	 	<form id="formConfig" name="formCiudad">
	<section id="busque"  class="busque">
	 	<div><label for="itextbuscar">Buscar</label></div>	
	 	<div><input type="text" id="itextbuscar" name="itextbuscar" class="inputSearch"/></div>
	 	<div></div>
 	</section>
	 		<label for="icomp">Competencias</label>
            <select id="icomp" class="SelList"> 
                <option value="999" selected>Seleccione una Competencia</option>
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

