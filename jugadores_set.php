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
	   <!--SCRIPTS PRIMERO HAY QUE VINCULAR LA LIBERIA JQUERY PARA QUE RECONOZCA EL $-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	   <!--SCRIPTS-->
	   <script type="text/javascript">
		// cuando PRESIONO CLICK , LO ACTUALIZO
		$(document).ready(function(){
		
		//	var parametros = {"CPartido" : "S"};		         
		//		data: parametros,
		 // FUNCION ajax CLUBES		
         $.ajax({ 
            url:   './abms/obtener_clubes.php',
            type:  'GET',
            dataType: 'json',
            
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#iclubescab").prop('disabled', true);
    		},
            done: function(data){
            	
			},
            success:  function (r){
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// DESBloqueamos el SELECT de los cursos
				// Limpiamos el select
				// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
                $(r['Clubes']).each(function(i, v)
                { // indice, valor
              	if (! $('#iclubescab').find("option[value='" + v.idclub + "']").length)
                	{
						$("#iclubescab").append('<option value="' + v.idclub + '">' +v.clubabr+'-'+ v.nombre + '</option>');
					}		
                });
                $("#iclubescab").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#iclubescab").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#iclubescab").val('9999');
				//console.log(xhr.responseText);
				//console.log(thrownError);
				$("#iclubescab").prop('disabled', false);
			}
            }); 
			// FIN funcion ajax CLUBES
			
		 // FUNCION ajax CLUBES		001
         $.ajax({ 
            url:   './abms/obtener_clubes.php',
            type:  'GET',
            dataType: 'json',
            
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#iclubescab1").prop('disabled', true);
    		},
            done: function(data){
            	
			},
            success:  function (r){
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// DESBloqueamos el SELECT de los cursos
				// Limpiamos el select
				// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
                $(r['Clubes']).each(function(i, v)
                { // indice, valor
              	if (! $('#iclubescab1').find("option[value='" + v.idclub + "']").length)
                	{
						$("#iclubescab1").append('<option value="' + v.idclub + '">' +v.clubabr+'-'+ v.nombre + '</option>');
					}		
                });
                $("#iclubescab1").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#iclubescab1").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#iclubescab1").val('9999');
				//console.log(xhr.responseText);
				//console.log(thrownError);
				$("#iclubescab1").prop('disabled', false);
			}
            }); 
			// FIN funcion ajax CLUBES
			
//************************ CATEGORIAS *************************************************              
         $.ajax({ 
            url:   './abms/obtener_categorias.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#icatcab").prop('disabled', true);
    		},
            done: function(data){
					console.log(data);	
			},
            success:  function (r){
            	$(r['Categorias']).each(function(i, v)
                { // indice, valor
                	if (! $('#icatcab').find("option[value='" + v.idcategoria + "']").length)
                	{
						$("#icatcab").append('<option value="' + v.idcategoria + '">' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
					}		
                });
                $("#icatcab").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#icatcab").append('<option value="' + '9999' + '">' + 'JQERY:Tabla CATEGORIAS vacia' + '</option>');
			$("#icatcab").val('9999');
				//console.log(xhr.responseText);
				//console.log(thrownError);
				$("#icatcab").prop('disabled', false);
			}
            }); // FIN funcion ajax categorias
//************************ CATEGORIAS *************************************************              			

//************************ CATEGORIAS 001*************************************************              
         $.ajax({ 
            url:   './abms/obtener_categorias.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#icatcab1").prop('disabled', true);
    		},
            done: function(data){
					console.log(data);	
			},
            success:  function (r){
            	$(r['Categorias']).each(function(i, v)
                { // indice, valor
                	if (! $('#icatcab1').find("option[value='" + v.idcategoria + "']").length)
                	{
						$("#icatcab1").append('<option value="' + v.idcategoria + '">' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
					}		
                });
                $("#icatcab1").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#icatcab1").append('<option value="' + '9999' + '">' + 'JQERY:Tabla CATEGORIAS vacia' + '</option>');
			$("#icatcab1").val('9999');
				//console.log(xhr.responseText);
				//console.log(thrownError);
				$("#icatcab1").prop('disabled', false);
			}
            }); // FIN funcion ajax categorias
//************************ CATEGORIAS 001 ************************************************* 

			$("#agregaReg").on("click",function(e){
				e.preventDefault();
				$("#altajugador").append('<section id="regridjug" class="regridjug">'+
					'<div name="" id="" class="regjug"><input type="text" id="numero" name="numero[]" value="num"></input></div>'+
					'<div name="" id="" class="regjug"><input type="text" id="nombre" name="nombre[]" value="nombre"></input></div>'+
					'<div name="" id="" class="regjug"><input type="text" id="edad" name="edad[]" value="edad"></input></div>'+
				'</section>');
			}); // fin evento AGREGAREG ON CLICK
//************************ CATEGORIAS 001 ************************************************* 
			// insert en la tabla
	       $("#altajug").on("click",function(e){

    //QUE SE RECARGUE CUANDO PRESIONO CLICK..
    	var parametros =  $("#altajugador").serialize();
  	/*	var parametros =  {
  			"iclubescab" : $("#iclubescab").val(),
			"icatcab" : $("#icatcab").val(),        	
			"numero" : $("#numero").serialize(),
			"nombre" : $("#nombre").serialize(),
			"edad" : $("#edad").serialize(),
			"altagen" :	$("#altagen").val(),
			"gencuantos" :	$("#gencuantos").val()
	         }
	         */
//	       for (var a=[], i=$("#numero").length; i;) a[--i] = $("#numero")[i]; 
	       
	    	console.log(parametros);
	    	//e.preventDefault();
        
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_jugador.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){

            },
            
            success:  function (r){
					//alert(r['mensaje']);
            },
			error: function (xhr, ajaxOptions, thrownError) {
				console.log(xhr.responseText);
				console.log(thrownError);
            }
            }); // FIN funcion ajax
         
		}); // parentesis el .CLICK ALTAP


			$("#altagen").on('click',function()
			{
				if($("#altagen").prop('checked'))
						$("#gencuantos").removeAttr('readonly','readonly');
				else{
					$("#gencuantos").val(0);
					$("#gencuantos").attr('readonly','readonly');
					}
			});
			
			$("#busqjugs").on("click",function(){
				     //alert('click buscar');
					var parametros = {"iclubescab1" : $("#iclubescab1").val(),"icatcab1" : $("#icatcab1").val()};			     
					 $.ajax({ 
						url:   './abms/obtener_jugadores.php',
						type:  'GET',
						data: parametros,
						dataType: 'text json',
						// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
						beforeSend: function (){
							$("#cargajug").empty('');
						},
						done: function(data){
								
						},
						success:  function (r){
							$(r['Jugadores']).each(function(i, v)
							{ // indice,0 valor
									$("#cargajug").append(
										'<section id="regridjug1" class="regridjug1">'+
										'<div class="regjug"><input type="text" id="numero1" name="nume" value="'+v.numero+'" readonly></input></div>'+
										'<div class="regjugNom"><input type="text" id="nombre1" name="nom1" value="'+v.nombre+'" readonly></input></div>'+
										'</section>');
							});
						},
						 error: function (xhr, ajaxOptions, thrownError) {
						// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						console.log(thrownError);
						console.log(xhr.responseText);
						}
						}); // FIN funcion ajax categorias
			});
		}); // parentesis del READY

		</script>
    </head>
    <body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
		<?php //include('includes/menuConfig.php');; ?>
    </header>
	<div id="jugadoresf" name="jugadoresf" class="JugadoresGrid">
		<div id="jugdata" name="jugdata" class="jugdata">
<!-- ********************************************************************************* -->
<!-- **********************LADO DE ALTA DE JUGADORES, ACA VA EL FORM**************** -->
<!-- ********************************************************************************* -->
		<form id="altajugador" class="altajugador" name="altajugador" >
			<!-- CABECERA DE SELECCION DE VALORES IGUALES-->
			<section id="GridAltaJug" class="GridAltaJug">
				<div id="grid_det_jug" class="grid_det_jugSeCl">
					<select id="iclubescab" name="iclubescab" class="iclubescab">
						<option value="9999">Seleccionar club</option>
					</select>
				</div>
				<div id="grid_det_jug" class="grid_det_jug">
					<select id="icatcab" name="icatcab" class="icatcab">
						<option value="9999">Seleccionar categoria</option>
					</select>
				</div>
				<div id="grid_det_jug" class="grid_det_jug"><button id="agregaReg" name="agregaReg" class="agregaReg" title="nuevo registro">++</button></div>
				<div id="grid_det_jug" class="grid_det_jug"><button id="altajug" name="altajug" class="altajug" title="agregar registros">+</button></div>
				<div id="grid_det_jug" class="grid_det_jug">Gen.<input type="checkbox" name="altagen" id="altagen" value="checked"></input></div>
				<div id="grid_det_jug" class="grid_det_jug">
					<input type="number" name="gencuantos" id="gencuantos" class="gencuantos" value="0" readonly></input>
				</div>
			</section>
			<section id="regsj" class="regsj">
		<!-- REGISTROS PARA ALTA / GRILLA DE JUGADORES POR CLUB Y CATEGORIA-->
				<section id="regridjug" class="regridjug">
					<div name="" id="" class="regjug"><input type="text" id="numero" name="numero[]" value="num"></input></div>
					<div name="" id="" class="regjug"><input type="text" id="nombre" name="nombre[]" value="nombre"></input></div>
					<div name="" id="" class="regjug"><input type="text" id="edad" name="edad[]" value="edad"></input></div>
				</section>
		<!-- REGISTROS PARA ALTA / GRILLA DE JUGADORES POR <ng-app Y CATEGORIA-->
			</section>
			</form>		
		</div>
<!-- ********************************************************************************* -->
<!-- **********************LADO DE ALTA DE JUGADORES, ACA VA EL FORM**************** -->
<!-- ********************************************************************************* -->


<!-- ********************************************************************************* -->
<!-- **********************LADO DE VISTA DE JUGADORES********************************* -->
<!-- ********************************************************************************* -->
		<!-- CABECERA DE BUSQUEDA EN GRILLA DE JUGADORES POR CLUB Y CATEGORIA-->
		<div id="jugdata" name="jugdata" class="jugdata">
			<section id="GridVerJug" class="GridVerJug">
				<div id="grid_det_ver_jug" class="grid_det_ver_jugSC">
					<!-- ICLUBES CABECERA DE SELECCION-->
					<select id="iclubescab1" name="iclubescab1" class="iclubescab">
						<option value="9999">Seleccionar club</option>
					</select>
				</div>
				<div id="grid_det_ver_jug" class="grid_det_ver_jug">
								<!-- ICATEGORIAS PARA CABECERA -->
					<select id="icatcab1" name="icatcab1" class="icatcab">
						<option value="9999">Seleccionar categoria</option>
					</select>
				</div>
				<div id="grid_det_ver_jug" class="grid_det_ver_jug derbut">
				
				<button id="busqjugs" name="busqjugs" class="altajug" title="buscar registros">Bsq</button>
				</div>
			</section>

		<!-- CABECERA DE BUSQUEDA EN GRILLA DE JUGADORES POR CLUB Y CATEGORIA-->		
			
		   <!-- GRILLA DE JUGADORES FILTRADA POR CLUB Y CATEGORIA-->		
				<div id="cargajug" name="cargajug">
					<section id="regridjug1" class="regridjug1">
						<div class="regjug"><input type="text" id="numero1" name="nume" value="num" readonly></input></div>
						<div class="regjugNom"><input type="text" id="nombre1" name="nom1" value="nombre" readonly></input></div>
					</section>
				</div>	
		</div>
			   <!-- GRILLA DE JUGADORES FILTRADA POR CLUB Y CATEGORIA-->		
<!-- *********************************************************************************->
<!-- **********************LADO DE VISTA DE JUGADORES********************************* -->
<!-- ********************************************************************************* -->
	</div>          <!-- GRILLA FORMULARIO DE ALTA DE JUGADORES Y DE LISTADO DE LOS MISMOS....-->		
</body>
</html>

