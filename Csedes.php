<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>VOLLEY.APP:: Configurar sedes</title>
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
<!--SCRIPTS-->
	   <script type="text/javascript">
		// cuando PRESIONO CLICK , LO ACTUALIZO
		$(document).ready(function(){
//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA ******************************/   
$("#itextbuscar").keyup(function()
	//	on("keyup keydown",function()
         {   
			var parametros = {
	        	"llamador" : "CONTROLAPP",
	        	"funcion" : "buscarclub",			
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
				$("#iclubb").empty();
    		},
            done: function(data){
			},
            success:  function (r){
 					
                $(r['Clubes']).each(function(i, v)
                { // indice, valor
              	if (! $('#iclubb').find("option[value='" + v.idclub + "']").length)
                	{
						$("#iclubb").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
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

//         on("keypress, keydown, keyup", function(e)   
          // AJAX DE CARGA POR ID DE SEDES...xº CLUB  
         $("#iclubb").on("click change",function()
         {
         var parametros = {"idclub" : $("#iclubb").val()};	
         $.ajax({ 
            url:   './abms/sedesxclub.php',
            type:  'POST',
            data: parametros ,
            datatype:   'text json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#isede2").prop('disabled', true);
    		},
            done: function(data){
            	
			},
            success:  function (r){
            	var re = JSON.parse(r);
            	
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// 		DESBloqueamos el SELECT de los cursos
				// 				Limpiamos el select
				// 					FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
				$(re['SedesXClub']).each(function(i, v)
                { // indice, valor
				  if (! $('#isede2').find("option[value='" + v.idsede + "']").length)
                	{
						$("#isede2").append('<option value="' + v.idsede + '">' + v.direccion + '</option>');
					}		
                });
                $("#isede2").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#isede2").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#isede2").val('9999');
				console.log(xhr.responseText);
				console.log(thrownError);
			$("#isede2").prop('disabled', false);
			}
            });
          });
		//**************** busqueda clubes con jquery *********************************************/      

            
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
        <h3>Ingreso de Sedes</h3>	
   <form id="formConfig" name="formsedes"  class="formSedes">
	<button id="btnSedes"   name="btnSedes" value="alta sede" class="btnIngreso">+</button>
		<label for="iclub">Club</label>
		<select id="iclub" class="SelList"> 
        <option value="1" selected>Seleccione un CLUB</option>
    	</select>
		<!-- el POST SOLO VE LO QUE TIENE NAME, sino no lo ve.-->
		<label for="sedenom">Nombre sede</label>
		<input id="sedenom" name="sedenom" type="text">
		<label for="direxsede">direccion</label>
		<input id="direxsede"	name="direxsede" "text">
	</form>
<!-- visualizacion de carga -->		
	<form id="formConfig" name="formSedes">
	<section id="busque" name="busque" class="busque">
	 	<div><label for="itextbuscar">Buscar</label></div>	
	 	<div><input type="text" id="itextbuscar" name="itextbuscar" class="inputSearch"/></div>
	 	<div></div>
 	</section>	
    <label for="iclubb">Club</label>
	    <select id="iclubb" name="iclubb" class="SelList"> 
	        <option value="9999" selected>Seleccione un club</option>
	    </select>
	
	<label for="isede2">Sedes cargadas</label>
	    <select id="isede2" name="isede2" class="SelList"> 
	        <option value="9999" selected>Seleccione una Sede</option>
	    </select>
	</form> 
<!-- visualizacion de carga -->		
</div>
 <!-- <div class="icc3"></div>
  <div class="icc4"></div>
<div class="icc5"></div>
<div class="icc6"></div>
  <div class="icc7"></div>
  <div class="icc8"></div>
  <div class="icc9"></div>-->
</section>		
</body>
</html>

