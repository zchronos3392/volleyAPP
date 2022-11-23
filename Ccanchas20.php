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
    <script type="text/javascript">
	$(document).ready(function(){
    // AJAX DE CARGA POR ID DE SEDES...xº CLUB  
         $("#iclub").change(function()
         {
         var parametros = {"idclub" : $("#iclub").val()};	
         $.ajax({ 
            url:   './abms/sedesxclub.php',
            type:  'POST',
            data: parametros ,
            datatype:   'text json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#isede2").prop('disabled', true);
    		},
            done: function(data){
            	
			},
            success:  function (r){
				var re = JSON.parse(r);
				// vuelve del POST, con un json que no es un array aun,
				// es necesario convertirlo a array
				$(re['SedesXClub']).each(function(i, v)
                { // indice, valor
				  if (! $('#isede2').find("option[value='" + v.idsede + "']").length)
                	{
                		$("#isede2").empty().append('<option value="9999">Seleccionar sede</option>');	
						$("#isede2").append('<option value="' + v.idsede + '">' + v.direccion + '</option>');
					}		
                });
                //$("#isede2").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError)
             {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#isede2").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#isede2").val('9999');
			}
            });// CIERRE DEL AJAX
          });//change del ICLUB
         
         $("#isede2").change(function()
         {
         	$("#direc_can").val("");	
         	$("#direc_can").val($("#isede2 option:selected").text());// direccion por DEFAULT, LA DE LA CANCHA
		 });// cambio en el isede	

//**************** CANCHAS *********************************************/            
		//**************** CANCHAS OBTENER *********************************************/            
         $.ajax({ 
            url:   './abms/obtener_canchas.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#icancha").prop('disabled', true);
    		},
            done: function(data){
			},
            success:  function (r){
            	//var re = JSON.parse(r);
                $(r['Canchas']).each(function(i, v)
                { // indice, valor
                	if (! $('#icancha').find("option[value='" + v.idcancha + "']").length)
                	{
						$("#icancha").append('<option value="' + v.idcancha + '">' + v.nombre + '</option>');
					}		
                });
                $("#icancha").prop('disabled', false);
           },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#icancha").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#icancha").val('9999');
			$("#icancha").prop('disabled', false);
			}
            }); // FIN funcion ajax CANCHAS todas:
/*            
$("#IngCancha").click(function(){ 
        // Guardamos el select de cursos
        if( ($("#iclub").val() != '') &&  ($("#isede2").val() != '') &&  ($("#nomcancha").val() != '') )
        {
		var parametros = {
        	"iclub" : $("#iclub").val(),
        	"isede2" : $("#isede2").val(),			
        	"nomcancha" : $("#nomcancha").val(),			
        	"direc_can" : $("#direc_can").val(),
        	"dimcan" : $("#dimcan").val()
			};		         
         
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_cancha.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#icancha").prop('disabled', true);
            },
            
            success:  function (r){
				//var re = JSON.parse(r);
				console.log(r['estado']);
				console.log(r['mensaje']);
				// vuelve del POST, con un json que no es un array aun,
				// es necesario convertirlo a array
				// DESBloqueamos el SELECT de los cursos
    			$("#icancha").prop('disabled', false);

			},    
   			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				console.log(xhr);
				console.log(thrownError);
				$("#icancha").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
        } // else THIS.VAL <> ''
        else // SI EL VAL ES EMPTY, CARGO UN MENSAJE EN EL SELECT:
        {
        }
}); // parentesis el .CLICK INGRESOcancha
*/

//**************** CATEGORIAS *********************************************/ 		 
    	}); // cierre ready
    </script>
    </head>
<body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
		<?php //include('includes/menuConfig.php');; ?>
		
    </header>
<section class="gridControl">
  <div class="icc1"></div>
  <div class="icc2">
  	    
  <section>	
    <h3>Ingreso de Canchas</h3>
		<form id="formConfig" name="formCanchas" class="formCanchas" action="./abms/insertar_cancha.php">
			<label for="iclub" class="">Club</label>
			<select id="iclub" name="iclub" class="SelList"> 
		        <option value="9999" selected>Seleccione un club</option>
		    </select> 
		    <label for="isede2" class="">Sedes</label>
		    <select id="isede2" name="isede2" class="SelList"> 
		        <option value="9999" selected>Seleccione una Sede</option>
		    </select>     
			<label for="nomcancha" class="">Cancha nombre</label>
			<input id="nomcancha" name="nomcancha"   type="text">
			<label for="direc_can" class="">Ubicación</label>
			<input id="direc_can" name="direc_can" type="text">
			<label for="dimcan" class="">Dimensiones</label>
			<input id="dimcan" name="dimcan" type="text">
				<button id="Ingcancha" name="Ingcancha" type="submit" >Submit</button>
		</form>
</section>
<!-- visualizacion de carga -->		
	 	<form id="formConfig" name="formCanchas">
		<label for="icancha">Canchas cargadas</label>
            <select id="icancha" name="icancha" class="SelList"> 
                <option value="9999" selected>Seleccione una cancha</option>
            </select>
        </form> 
<!-- visualizacion de carga -->		
</div>
  <div class="icc3"></div>
  <div class="icc4"></div>
<div class="icc5"></div>
<div class="icc6"></div>
  <div class="icc7"></div>
  <div class="icc8"></div>
  <div class="icc9"></div>
</section>		
</body>
</html>

