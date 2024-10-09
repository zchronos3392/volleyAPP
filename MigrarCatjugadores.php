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
		

/****************************************************************************************/
function ObtenerJugadores(paginaPedida,quienLLama){
// la funcion phph obtener_jugadores necesita: 
// valor del campo iclubescab,
// valor del campo ianio
// valor del campo icatcab	
var parametros = {"iclubescab1" : $("#iclubescab").val(),"icatcab1" : $("#icatcab").val(),"ianio":$("#ianio").val(),"pag":paginaPedida,"xnombre":$("#ijugclub").val(),"xnomAll" : $("#ijugclubAll").val() };

	console.log("pagina pedida: "+ paginaPedida +" " +$("#iclubescab").val());
	console.log("pagina pedida: "+ paginaPedida +" " +$("#icatcab").val());
	console.log("pagina pedida: "+ paginaPedida +" " +$("#ianio").val());		
//    console.log("pagina pedida: "+ paginaPedida +" " +$("#ijugclub").val());

$.ajax({ 
url:   './abms/obtener_jugadores.php',
type:  'GET',
data: parametros,
dataType: 'text json',
// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
beforeSend: function (){
	$("#cargajug").empty('');
	$("#regsj").empty('');
	$("#renglonesAltaMasiva").empty('');	
},
done: function(data){
		
},
success:  function (r){
   //{"id":2,"nombre":"Sin jugadores cargados para el a\u00f1o: 9999"}
    $("#renglonesAltaMasiva").empty('');
	$("#renglonesAltaMasiva").append('<div id="regsj" class="regsjugadoreMass">'+
		'<div name="nombreReaonly" id="nombreReaonly" class="regjug1 fondoBlanco">Numero Jugador</div>'+
		'<div name="" id="" class="regjug2">Nombre Jugador</div>'+
		'<div name="" id="" class="regjug3">Fch Ingreso Club</div>'+
		'<div name="" id="" class="regjug4">Categoria Actual</div>'+
		'<div name="" id="" class="regjug5">Nueva Categoria</div></div>');
	
	
	if(r['nombre'] != 'Sin jugadores cargados') {
	
	if( r['Jugadores'].length != 'undefined')
	{
		$("#contador").val(r['Jugadores'].length);
		var contadorRegistros = r['Jugadores'].length;
	}
	else $("#contador").val(0);
	}
	
	$(r['Jugadores']).each(function(i, v)
	{ // indice,0 valor
//	    $('[name="ijugclubFull"]').show();
	   $("#renglonesAltaMasiva").append(
	    '<div id="regsj" class="regsjugadoreMass">'+
	    '<input type="hidden" id="idjugador" name="idjugador[]" value="'+v.idjugador+'"></input>'+
		'<div name="" id="" class="regjug1"><input type="text" id="numero" name="numero[]" value="'+v.numero+'" ></input></div>'+
		'<div name="" id="" class="regjug2"><input type="text" id="nombre" name="nombre[]" value="'+v.nombre+'" ></input></div>'+
		'<div name="" id="" class="regjug3"><input type="text" id="nombre" name="anio[]" value="'+v.ingresoClub+'" readonly></input></div>'+
		'<div name="" id="" class="regjug4">'+CategoriaCopia('categoriaVieja',v.categoria)+
		'<input type="hidden" id="catVieja" name="catAnt[]" value="'+v.categoria+'" readonly></input></div>'+
		'<div name="" id="" class="regjug5">'+CategoriaCopia('idcategoriaNueva',0)+
		'<input type="hidden" id="idcatNueva" name="catNew[]" value=""></input></div></div>');							
		//	
//		if( ! $("#ijugclub option").length > 0)
	});
	//alert(r['TotalPaginas']);
	//armar links paginador...
	var tamanioPaginar = r['tamanio'];
	if(r['TotalPaginas'] > 1 && ( (contadorRegistros >= tamanioPaginar) || !(pagActual == Ultima) ) )
	{
		$("#GridControlPaginador").css("display","grid");
		if(paginaPedida != 0)
				pagActual = paginaPedida;
		else pagActual = r['paginaPedida'];
		
		Ultima = r['TotalPaginas'];
		pagSiguiente = pagActual + 1;
		pagAnterior = pagActual - 1;	
		if(pagActual == 1)
		{
		$("#itemcontrolpag1").html("");
		$("#itemcontrolpag2").html("");
		$("#itemcontrolpag3").html("Pag Nro "+pagActual);
		$("#itemcontrolpag4").html("<a href=\"\" title=\"Pag. Sig.\"  onclick=\"ObtenerJugadores("+pagSiguiente+","+quienLLama+");\">Siguiente ></a>");
		
		$("#itemcontrolpag5").html("<a href=\"\" title=\"Ultima pag\"  onclick=\"ObtenerJugadores("+Ultima+","+quienLLama+");\">Ultima >></a>");			
		}
		else {
					//console.log(pagActual);
				if(pagActual == Ultima)
				{
				$("#itemcontrolpag1").html("");
				$("#itemcontrolpag1").html("<a href=\"\" title=\"Primer pag\"  onclick=\"ObtenerJugadores(1,"+quienLLama+");\"><< Primero</a>");
				$("#itemcontrolpag2").html("");
				$("#itemcontrolpag2").html("<a href=\"\" title=\"Pag Ant.\"  onclick=\"ObtenerJugadores("+pagAnterior+","+quienLLama+");\">< Anterior</a>");
				$("#itemcontrolpag3").html("");
				$("#itemcontrolpag3").html("Ultima Pag ("+paginaPedida+")");
				$("#itemcontrolpag4").html("");
				$("#itemcontrolpag5").html("");
				}	
				else {
				$("#itemcontrolpag1").html("");
				$("#itemcontrolpag1").html("<a href=\"\" title=\"Primer pag\"  onclick=\"ObtenerJugadores(1"+quienLLama+");\"><< Primero</a>");
				$("#itemcontrolpag2").html("");
				$("#itemcontrolpag2").html("<a href=\"\" title=\"Pag Ant.\"  onclick=\"ObtenerJugadores("+pagAnterior+","+quienLLama+");\">< Anterior</a>");
				$("#itemcontrolpag3").html("");
				$("#itemcontrolpag3").html("Pag Nro "+paginaPedida);
				$("#itemcontrolpag4").html("");
				$("#itemcontrolpag4").html("<a href=\"\" title=\"Pag. Sig.\"  onclick=\"ObtenerJugadores("+pagSiguiente+","+quienLLama+");\">Siguiente ></a>");
				$("#itemcontrolpag5").html("");
				$("#itemcontrolpag5").html("<a href=\"\" title=\"Ultima pag\"  onclick=\"ObtenerJugadores("+Ultima+","+quienLLama+");\">Ultima >></a>");			
				}
		}
	}
	else 
	{
	 $("#GridControlPaginador").css("display","none");
	}
},
 error: function (xhr, ajaxOptions, thrownError) {
// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
	console.log(thrownError);
		console.log(xhr.responseText);
}
}); // FIN funcion ajax categorias	
event.preventDefault();
}
 /**  **************************************************************************************/

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
		
		 var iselectorCateGen = '<select id="'+idasignar+indiceUnico+'" name="'+idasignar+'[]" class="'+idasignar+indiceUnico+'"><option value="9999">Seleccionar categoria</option>'+Cates+'</select>';
			//console.log(iselectorCateGen);
				return	iselectorCateGen;
		};
//************************ GENERA SELECT GENERICO DE CATEGORIAS EXISTENTES ************************************************* 				
		
		$(document).ready(function(){
		//	var parametros = {"CPartido" : "S"};		         
		//		data: parametros,
		 // FUNCION ajax CLUBES	
		
		$("#todxs").attr('checked', false);
		 
		var f=new Date();
		var fechapartido = f.getFullYear() ;
		var anioActual = fechapartido;
		fechainicial = fechapartido -10;
		fechaFinal   = fechapartido +10;
		
		for (var i = fechainicial; i < fechaFinal; i++) 
				if(i == anioActual )
					$("#ianio").prepend('<option selected>' + (anioActual) + '</option>');
				else	
					$("#ianio").prepend('<option>' + (i) + '</option>');
		 
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
						$("#icatcab2").append('<option value="' + v.idcategoria + '">' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
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
		            	//e.preventDefault();
		            },
		            success:  function (r){
							//alert(r);
		            },
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.responseText);
						console.log(thrownError);
		            }
		            }); // FIN funcion ajax
				}); // parentesis el .CLICK ALTAP



			$("#icatcab2").on("click change",function(){
				$("[name='idcategoriaNueva[]']").val($("#icatcab2").val());
			});

			$("#icatcab").on("click change",function(){
					//var parametros = {"iclubescab1" : $("#iclubescab").val(),"icatcab1" : $("#icatcab").val(),"ianio":$("#ianio").val()};
					ObtenerJugadores(0,'icatcab');
/*
					 $.ajax({ 
						url:   './abms/obtener_jugadores.php',
						type:  'GET',
						data: parametros,
						dataType: 'text json',
						// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
						beforeSend: function (){
							$("#renglonesAltaMasiva").empty('');
						},
						done: function(data){
								
						},
						success:  function (r){
							$("#contador").val(r['Jugadores'].length);
							$(r['Jugadores']).each(function(i, v)
							{ // indice,0 valor

							   $("#renglonesAltaMasiva").append(
							    '<div id="regsj" class="regsjugadoreMass">'+
							    '<input type="hidden" id="idjugador" name="idjugador[]" value="'+v.idjugador+'"></input>'+
								'<div name="" id="" class="regjug1"><input type="text" id="numero" name="numero[]" value="'+v.numero+'" ></input></div>'+
								'<div name="" id="" class="regjug2"><input type="text" id="nombre" name="nombre[]" value="'+v.nombre+'" ></input></div>'+
								'<div name="" id="" class="regjug3"><input type="text" id="nombre" name="anio[]" value="'+v.ingresoClub+'" readonly></input></div>'+
								'<div name="" id="" class="regjug4">'+CategoriaCopia('categoriaVieja',v.categoria)+
								'<input type="hidden" id="catVieja" name="catAnt[]" value="'+v.categoria+'" readonly></input></div>'+
								'<div name="" id="" class="regjug5">'+CategoriaCopia('idcategoriaNueva',0)+
								'<input type="hidden" id="idcatNueva" name="catNew[]" value=""></input></div></div>');							
							
							});
						},
						 error: function (xhr, ajaxOptions, thrownError) {
						// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						console.log(thrownError);
						console.log(xhr.responseText);
						}
						}); // FIN funcion ajax categorias
*/			
			}); // parentesis del ICATCAB DENTRO DEL READY

			$("#todxs").on("click",function(){
				
				var verTodos = $("#activo").val();
				if(verTodos == 0 ) $("#activo").val(1);
				else $("#activo").val(0);
				
		        var parametros = {"ianio":$("#ianio").val(),"todxs":$("#activo").val()};
				 $.ajax({ 
					url:   './abms/obtener_clubes.php',
					type:  'GET',
					dataType: 'json',
					data:parametros,
					// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
					beforeSend: function (){
						// Bloqueamos el SELECT de los cursos
						$("#iclubescab").prop('disabled', true);
						$("#iclubescab").empty();
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
				});						

				GeneraOpciones();
			//**************************CATEGORIAS CARGADAS DEL CLUB*/
			$("#todxscat").on("click",function(){
			// TRAMPITA PARA OBTENER EL VALOR 
			// DE UN CHECK CON JQUERY:
			// DEJO UN FLAG ESCONDIDO PARA SABER EL ULTIMO VALOR
			// DEPENDIENDO DE ESO, LE ASIGNO AL parametros
			// SI O NO...
			//pero, encontre otra forma:
			var verTodos = 0;
	        // Hacer algo si el checkbox ha sido seleccionado
			if( $("#todxscat").is(':checked') ) verTodos = 1;
					
		     var parametros = {"ianio":$("#ianio").val(),"todxscat":verTodos};
	         $.ajax({ 
	            url:   './abms/obtener_categorias.php',
	            type:  'GET',
	            dataType: 'json',
				data:parametros,
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
	            beforeSend: function (){
					// Bloqueamos el SELECT de los cursos
					$("#icatcab").empty();
	    			$("#icatcab").prop('disabled', true);
	    		},
	            done: function(data){
						//console.log(data);	
				},
	            success:  function (r){
	            	$(r['Categorias']).each(function(i, v)
	                { // indice, valor
	                	if (! $('#icatcab').find("option[value='" + v.CategoriaId + "']").length)
	                	{
							$("#icatcab").append('<option value="' + v.CategoriaId + '">' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
						}		
	                });
	                $("#icatcab").prop('disabled', false);
	            },
	             error: function (xhr, ajaxOptions, thrownError)
	             {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						$("#icatcab").append('<option value="' + '9999' + '">' + 'JQERY:Tabla CATEGORIAS vacia' + '</option>');
						$("#icatcab").val('9999');
						$("#icatcab").prop('disabled', false);
				 }
	            }); // FIN funcion ajax categorias
	        }); // fin de la funcion TODXSCAT  			
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
			<div class="GridControlJugador">
			<!--SECCION DE CABECERA DEL FORMULARIO DE INGRESO DE JUGADORES -->
				<div id="" class="itemcontrolju1" >
					Año Actual <select id="ianio" name="ianio" class="ianio">
						<option value="9999">Seleccionar año...</option>
					</select>
				</div>

  			    <div id="" class="itemcontrolju2" > <!-- FILAS DEL FORM, CLUB Y CATEGORIA..-->
					<input type="checkbox" id="todxs"><span>Con jugadores..</span></input>							
					<input type="hidden" id="anioactivo" name="anioactivo" val="0"></input>
					<input type="hidden" id="activo" val="0"></input>
				</div>	
				<div id="" class="itemcontrolju3" ><!-- FILAS DEL FORM, CLUB Y CATEGORIA..-->
						Clubes <select id="iclubescab" name="iclubescab" class="iclubescab">
							<option value="9999">Seleccionar club</option>
						</select>
				</div>

				<div id="" class="itemcontrolju4" >
					Categorias <select id="icatcab" name="icatcab" class="icatcab">
						<option value="9999">Seleccionar categoria</option>
						<input type="text"  value="" id="contador" readonly="true"/>

					</select>
				</div>
				<div id="" class="itemcontrolju5" >
						<input type="checkbox" id="todxscat"><span>Categorias cargadas</span></input>
				</div>		
			</div>
			<div class="GridControlJugador SINTOPE">
			<!--SECCION DE CABECERA DEL FORMULARIO DE INGRESO DE JUGADORES -->
				<div id="" class="itemcontrolju1" name="ijugclubFull" >
				  Jugadores <select id="ijugclub" name="ijugclub" class="ijugclub">
				 					<option value="9999">Seleccionar nombre jugador</option>
							</select>
				</div>

  			    <div id="" class="itemcontrolju2" > <!-- FILAS DEL FORM, CLUB Y CATEGORIA..-->
				  TODOS LOS JUGADORES <select id="ijugclubAll" name="ijugclubAll" class="ijugclub">
				 					<option value="9999">Seleccionar nombre jugador</option>
							</select>
				</div>	
				<div id="" class="itemcontrolju3" ><!-- FILAS DEL FORM, CLUB Y CATEGORIA..-->
				</div>

				<div id="" class="itemcontrolju4" >
				</div>
				<div id="" class="itemcontrolju5" >
				</div>		
			</div>
			
			<div class="gridControlEquipo">					
				<div class="controlEq1">
					<span class="TituloEqControl">ACCIONES</span>
				</div>
				<div class="controlEq2">
								<button id="volver" name="altajug" class="butControlEq" title="agregar registros"><<</button>
				</div>
				<div class="controlEq3">
					<button id="actjug" name="altajug" class="butControlEqGren" title="agregar registros">Cat+</button>
				</div>
				<div class="controlEq4">
				  <div class="grillita1">
					<div class="grillitaitem1"><span>Cambiar Todos a</span></div> 
					<div class="grillitaitem2"><select id="icatcab2" name="icatcab2" class="icatcab">
						<option value="9999">Seleccionar categoria</option>
					</select></div>
				   </div>
				</div>				
			</div>			
			<div class="GridControlPaginador" id="GridControlPaginador">
			<!--SECCION DE CABECERA DEL FORMULARIO DE INGRESO DE JUGADORES -->
				<div id="itemcontrolpag1" class="itemcontrolpag1" ><a href="" title="Primer pag"><< Primero</a>
				</div>
  			    <div id="itemcontrolpag2" class="itemcontrolpag2" > <!-- FILAS DEL FORM, CLUB Y CATEGORIA..-->
					<a href="" title="Anterior pag">< Anterior</a>
				</div>	
				<div id="itemcontrolpag3" class="itemcontrolpag3" ><!-- FILAS DEL FORM, CLUB Y CATEGORIA..-->
					Pag: 
				</div>

				<div id="itemcontrolpag4" class="itemcontrolpag4" >
					<a href="" title="ultima pag.">Siguiente ></a>
				</div>

				<div id="itemcontrolpag5" class="itemcontrolpag5" >
					<a href="" title="ultima pag.">Ultimo >></a>
				</div>
			</div>
			

			<div id="renglonesAltaMasiva">

			</div>
			</form>		
		</div>
<!-- ********************************************************************************* -->
<!-- **********************LADO DE ALTA DE JUGADORES, ACA VA EL FORM**************** -->
<!-- ********************************************************************************* -->


<!-- ********************************************************************************* -->
	</div>          <!-- GRILLA FORMULARIO DE ALTA DE JUGADORES Y DE LISTADO DE LOS MISMOS....-->		
</body>
</html>