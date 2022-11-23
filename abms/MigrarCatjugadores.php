<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Cambiar la categoria de los jugadores</title>
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
		
//************************ CATEGORIAS *************************************************              
	function GeneraOpciones(){
		 $.ajax({ 
            url:   './abms/obtener_categorias.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    		},
            done: function(data){
					
			},
            success:  function (r){
            	$(r['Categorias']).each(function(i, v)
                { // indice, valor
					$("#categoryS").append('<option value="' + v.idcategoria + '">'+ v.descripcion+'</option>');
                });
             },
             error: function (xhr, ajaxOptions, thrownError) 
			    {
				}
            }); // FIN funcion ajax categorias
	};
//************************ TRAE CATEGORIAS EXISTENTES UNIDAS************************************************* 		
		
		
//************************ GENERA SELECT GENERICO DE CATEGORIAS EXISTENTES ************************************************* 				
	    function CategoriaCopia(idasignar,valor){
				// Retorna un entero aleatorio entre min (incluido) y max (excluido)
					// ¡Usando Math.round() te dará una distribución no-uniforme!
					// Math.floor(Math.random() * (max - min)) + min;
		var indiceUnico = 	Math.floor(Math.random() * (500 - 1)) + 1;
		var Cates= '';
		var GlobalCats = '';
		$("#categoryS option").each(function(){
				GlobalCats += '<option value="' + $(this).attr('value') + '">'+ $(this).text()+'</option>'
		});
		Cates = GlobalCats;
		if(valor != 0){
			// analizar en donde se encuentra el texto value="v.idcategoria">
			var str = '<option value="'+valor+'">';
			var str2 = '<option value="'+valor+'" selected>';
			Cates = GlobalCats.replace(str,str2);
		};
		
		 var iselectorCateGen = '<select id="'+idasignar+indiceUnico+'" name="icatcab[]" class="'+idasignar+indiceUnico+'"><option value="9999">Seleccionar categoria</option>'+Cates+'</select>';
			console.log(iselectorCateGen);
				return	iselectorCateGen;
		};
//************************ GENERA SELECT GENERICO DE CATEGORIAS EXISTENTES ************************************************* 				
		
		$(document).ready(function(){
		//	var parametros = {"CPartido" : "S"};		         
		//		data: parametros,
		 // FUNCION ajax CLUBES		
		var f=new Date();
		var fechapartido = f.getFullYear() ;
		fechainicial = fechapartido -10;
		fechaFinal   = fechapartido +10;
		for (var i = fechainicial; i < fechaFinal; i++) $("#ianio").prepend('<option>' + (i + 1) + '</option>');
		 
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
						$("#iclubescab").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
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
			
			
//************************ CATEGORIAS *************************************************              
         $.ajax({ 
            url:   './abms/obtener_categorias.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
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
		$("#volver").on("click",function(e){
			e.preventDefault();
			$(location).attr('href','Cjugadores.php');
		});	
	// insert en la tabla
	       $("#actjug").on("click",function(e){

	    //QUE SE RECARGUE CUANDO PRESIONO CLICK..
				var parametros =  $("#altajugador").serialize();// serializa el form...
	  	/*EL SERIALIZE RESUMEN TODO LO QUE SIGUE
	  		var parametros =  {
	  			"iclubescab" : $("#iclubescab").val(),
				"icatcab" : $("#icatcab").val(),        	
				"numero" : $("#numero").serialize(),
				"nombre" : $("#nombre").serialize(),
				"edad" : $("#edad").serialize(),
				"altagen" :	$("#altagen").val(),
				"gencuantos" :	$("#gencuantos").val()
		         }
		 */
		         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
		            url:   './abms/migrar_jugador.php',
		            type:  'POST',
		            data: parametros,
		            beforeSend: function (){
		            },
		            success:  function (r){
							console.log(r);
		            },
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.responseText);
						console.log(thrownError);
		            }
		            }); // FIN funcion ajax
				}); // parentesis el .CLICK ALTAP


			$("#icatcab").on("click change",function(){
					var parametros = {"iclubescab1" : $("#iclubescab").val(),"icatcab1" : $("#icatcab").val(),"ianio":$("#ianio").val()};
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
							    '<div><input type="hidden" id="idjugador" name="idjugador[]" value="'+v.idjugador+'"></input>'+
								'<input type="text" id="numero" name="numero[]" value="'+v.numero+'" readonly></input></div>'+
								'<div><input type="text" id="nombre" name="nombre[]" value="'+v.nombre+'" readonly></input></div>'+
								'<div><input type="text" id="nombre" name="anio[]" value="'+v.ingresoClub+'" readonly></input></div>'+
								CategoriaCopia('categoriaVieja',v.categoria)+
								'<input type="hidden" id="catVieja" name="catAnt[]" value="'+v.categoria+'"></input>'+
								CategoriaCopia('idcategoriaNueva',0)+
								'<input type="hidden" id="idcatNueva" name="catNew[]" value=""></input>');
							});
						},
						 error: function (xhr, ajaxOptions, thrownError) {
						// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						console.log(thrownError);
						console.log(xhr.responseText);
						}
						}); // FIN funcion ajax categorias

						
				}); // parentesis del READY
			GeneraOpciones();
		});
		</script>
    </head>
    <body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
		<?php ////include('includes/menuConfig.php');; ?>
    </header>
	<input  type="hidden" id="categories" name="categories" class="categories" value="">
		<select id="categoryS" style="display:none;"></select>
	</input>
	<div id="jugadoresf" name="jugadoresf" class="JugadoresGrid">
		<div id="jugdata" name="jugdata" class="jugdata">
<!-- ********************************************************************************* -->
<!-- **********************LADO DE ALTA DE JUGADORES, ACA VA EL FORM**************** -->
<!-- ********************************************************************************* -->
		<form id="altajugador" class="altajugador" name="altajugador" >
			<!-- CABECERA DE SELECCION DE VALORES IGUALES-->
			<section id="GridAltaJug" class="GridMigraJug"> <!--SECCION DE CABECERA DEL FORMULARIO DE INGRESO DE JUGADORES -->
  			   <section id="" class="gridaltajfila" > <!-- FILAS DEL FORM, CLUB Y CATEGORIA..-->
						<select id="ianio" name="ianio" class="ianio">
							<option value="9999">Seleccionar año...</option>
						</select>
				</section>
			
				<section id="" class="gridmigrajfila" > <!-- FILAS DEL FORM, CLUB Y CATEGORIA..-->
						<select id="iclubescab" name="iclubescab" class="iclubescab">
							<option value="9999">Seleccionar club</option>
						</select>
				</section>
				<section id="" class="gridmigrajfila" >
					<select id="icatcab" name="icatcab" class="icatcab">
						<option value="9999">Seleccionar categoria</option>
					</select>
					<span class="derecha">
						<button id="volver" name="altajug" class="altajug" title="agregar registros"><<</button>
						<button id="actjug" name="altajug" class="altajug" title="agregar registros">Cat+</button>
					</span>
					
				</section>
			</section> <!--SECCION DE CABECERA DEL FORMULARIO DE INGRESO DE JUGADORES -->			
			
			<section id="regsj" class="regsj">
		<!-- REGISTROS PARA ALTA / GRILLA DE JUGADORES POR CLUB Y CATEGORIA-->
				<section id="cargajug" class="regridmigrjug">
					<div id="nombre"><input type="text" id="numero" name="numero[]" value="5" readonly=""></div>
					<div id="nombre"><input type="text" id="nombre" name="nombre[]" value="tito" readonly=""></div>
					<div id="nombre"><input type="text" id="anio" name="anio[]" value="2018" readonly=""></div>
					<select id="categoriaVieja" name="icatcab" class="icatcab">
						<option value="9999">Seleccionar categoria 1</option>
					</select>
					<select id="idcategoriaNueva" name="icatcab" class="icatcab">
						<option value="9999">Seleccionar categoria 2</option>
					</select>
				</section>
		<!-- REGISTROS PARA ALTA / GRILLA DE JUGADORES POR <ng-app Y CATEGORIA-->
			</section>
			</form>		
		</div>
<!-- ********************************************************************************* -->
<!-- **********************LADO DE ALTA DE JUGADORES, ACA VA EL FORM**************** -->
<!-- ********************************************************************************* -->


<!-- ********************************************************************************* -->
	</div>          <!-- GRILLA FORMULARIO DE ALTA DE JUGADORES Y DE LISTADO DE LOS MISMOS....-->		
</body>
</html>