<?php include('sesioner.php'); ?>
<html><head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title></title>
	<!--SCRIPTS-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">

	<script>
		$.urlParam = function(name){
			var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
			if (results==null){
			   return null;
			}
			else{
			   return decodeURI(results[1]) || 0;
			}
		};
		
	
		function jugadoresLista(){
				//aqui va ir tu codigo ajax, del cual tienes que regresar un .json desde php
				// por ejemplo asi:   echo json_encode($tuvariable);
				//entonces mandas llamar el php de esta manera
				//	ajax del obtener_jugadores_partido	
						//
						//alert($("#ianio").val());
			  		var paremetros =  {
						    "idpartido" : $.urlParam('idpartido'),
				  			"iclubescab" : $.urlParam('idclub'),
							"icatcab" : $("#icate").val(),
							"ianio"   :	 $("#ianio").val(),
							"fechapartido": <?php echo("'".$_GET['fecha']."'");?>,
							"categoriaPartido" : $.urlParam('idcate')
							
					         };						
				$("#cargajug").empty('');
/*ajax obtener jugadores por categoria...*/
					 $.ajax({ 
						url:   './abms/obtener_jugpartidoCab.php',
						type:  'GET',
						data: paremetros,
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
								var icheck='';
								//significa que no fue agregado a la lista original
								//si esta en la lista, lo muestro seleecionado y le agrego la funcion
								//para DESELECCIONARLO...
								var dadodeBaja='disabled';
								var activarAltaBaja='alert("Jugador dado de baja.Ups")';
								if(v.FechaEgreso == null)
									 dadodeBaja='';

								var	nombre=v.nombre+'( BAJA )';
								if(v.FechaEgreso == null)
									nombre=v.nombre;
									 
								if(v.FechaEgreso == null)
									 activarAltaBaja='onclick="altajugador(this);"';
								if(v.jugador == null)
									 icheck='<input id="CHECK_'+v.idclub+'_'+v.idjugador+'" name="CHECK_'+v.idclub+'_'+v.idjugador+'" type="checkbox" '+activarAltaBaja+ ' title="seleccionar" '+
												 dadodeBaja+
											  '/>';
								else
									icheck='<input id="CHECK_'+v.idclub+'_'+v.idjugador+'" name="CHECK_'+v.idclub+'_'+v.idjugador+'" type="checkbox" '+activarAltaBaja+ ' checked title="seleccionado"  '+dadodeBaja+'/>';

								//if(v.remeraNum != null)
									var remera="";
									if(v.remeraEnCatPartido == undefined)
										remera= '<div class="regjug"><input type="text" id="numero1" name="nume" value="'+v.numero+'" readonly></input></div>';
									else
										if($.urlParam('idcate') != $("#icate").val() )
											remera= '<div class="regjug"><input type="text" id="numero1" name="nume" value="'+v.remeraEnCatPartido+'" readonly class="redBack"></input></div>';
										else
										remera= '<div class="regjug"><input type="text" id="numero1" name="nume" value="'+v.remeraEnCatPartido+'" readonly ></input></div>';	
									//alert(remera);	
									//cargamos la listad de jugadores de nuevo
									$("#cargajug").append(
										'<section id="regridjug" class="regridjug2">'+
										'<div id="jugN" name="jugN" >'+
										icheck+
										'</div>'+remera+
										'<div class="regjugNom2"><input type="text" id="nombre1" name="nom1" value="'+nombre+'" readonly></input></div>'+
										'</section>');
						});
					},
						 error: function (xhr, ajaxOptions, thrownError) {
						// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						console.log(thrownError);
						console.log(xhr.responseText);
						}
						}); // FIN funcion ajax categorias
		}; // FIN funcion 
	
	
		function altajugador(object){
		
		    var arraids = object.id.split('_');
			var idclub = arraids[1] ;
			var idjugador = arraids[2];	  
			//alert($.urlParam('idclub'));
	
	
	  		var parametros =  {
			    "idpartido" : $.urlParam('idpartido'),
	  			"iclubescab" : $.urlParam('idclub'),
				"icatcab" : $("#icate").val(),
				"ianio"   :	 $("#ianio").val(),
				"fechapartido": <?php echo("'".$_GET['fecha']."'");?>,
				"idjugador" : idjugador,
				"categoriapartido" : $.urlParam('idcate')
		         };
	
			if(object.checked)
			{
				         
		         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
		            url:   './abms/insertar_jugador_partido.php',
		            type:  'POST',
		            data: parametros,
		            beforeSend: function (){
		            },
		            success:  function (r){
							//console.log(r);
							var respuesta = JSON.parse(r);
							if(respuesta.estado == 0)
							{
							  	alert(respuesta.mensaje);
							  	jugadoresLista();
							}
							 else 
								jugadoresLista();
		            },
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.responseText);
						console.log(thrownError);
		            }
		            }); // FIN funcion ajax
		            
			}//  agregar jugador end
			else
			{
		         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
		            url:   './abms/borrar_jugador_partido.php',
		            type:  'POST',
		            data: parametros,
		            beforeSend: function (){
		            },
		            success:  function (r){
							console.log(r);
							jugadoresLista();
		            },
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.responseText);
						console.log(thrownError);
		            }
		            }); // FIN funcion ajax

			} ;
			      
			};
		//example.com?param1=name&param2=&id=6
		//file:///C:/Users/nsanz/Downloads/lablocal/lab/CargarJugadores.html?idpartido=1&idclub=HACOAJ&fecha=2018-09-06
		//var Categorias = {"estado":1,"Categorias":[{"idcategoria":"2","descripcion":"SUB13","EdadInicio":"12","EdadFin":"13","setMax":"2"},{"idcategoria":"3","descripcion":"SUB15.CABALLEROS","EdadInicio":"13","EdadFin":"15","setMax":"5"}]};

		$(document).ready(function()
		{
		// LLEGA POR PARAMETRO:	
			//idpartido=1
			//setmax=5
			//idclub=LOCAL
			//fecha=2021-05-04	
		// LLEGA POR PARAMETRO:	
					
			var f=new Date();
			var fechapartido = f.getFullYear()-1 ;
			fechainicial = fechapartido -10;
			fechaFinal   = fechapartido +10;
			for (var i = fechainicial; i < fechaFinal; i++) 
			{
				if(i == fechapartido) $("#ianio").prepend('<option selected>' + (i + 1) + '</option>');
				else  $("#ianio").prepend('<option>' + (i + 1) + '</option>');
			}
			$("#ianio").prop('disabled', true);
			
			
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++			
			var partido = $.urlParam('idpartido'); // name
			var club = $.urlParam('idclub');        // 6
			var fecha = $.urlParam('fecha');   // null		
			//traer datos del partido, para completar lo que falta...

    		var parametros = {"idClub" : club};
				$.ajax({ 
				url:   './abms/obtener_club_por_id.php',
				type:  'GET',
				data: parametros,
				dataType: 'text json',
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
				beforeSend: function (){
					
				},
				done: function(data){
						
				},
				success:  function (r){
					//console.log(r);
					//$(r['nombre']).each(function(i, v)
					//		{ // indice,0 valor
							  $("#FechaPartido").text("Fecha evento: "+fecha);
							  $("#jugIDCLUB").text("Club: "+"( "+r['nombre']+" )");
					//		});
				
				},
				 error: function (xhr, ajaxOptions, thrownError) {
				// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				console.log(thrownError);
				console.log(xhr.responseText);
				}
				}); // FIN funcion ajax
				


			$("#icate").on("change",function() {
				jugadoresLista();
			});			
			
		$("#volver").on("click",function(e){
			e.preventDefault();
			$(location).attr('href','CSets2.php?id='+$.urlParam('idpartido')+'&setmax='+$.urlParam('setmax')+'&fecha='+$.urlParam('fecha'));
		});	
					
		 categoriapartido = $.urlParam('idcate');
		 parametros= {"activas" : "1"};
		 $.ajax({ 
					url:   './abms/obtener_categorias.php',
					type:  'GET',
					dataType: 'json',
					data: parametros,
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
								if(categoriapartido == v.idcategoria) $("#icate").append('<option value="' + v.idcategoria + '" selected>' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
								else  $("#icate").append('<option value="' + v.idcategoria + '">' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
						});
						jugadoresLista();
						
					},
					 error: function (xhr, ajaxOptions, thrownError) {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
					$("#icate").append('<option value="' + '9999' + '">' + 'JQERY:Tabla CATEGORIAS vacia' + '</option>');
					$("#icate").val('9999');
						//console.log(xhr.responseText);
						//console.log(thrownError);
						$("#icate").prop('disabled', false);
					}
					}); // FIN funcion ajax categorias
			
		//$("#todxs").on("click",function(){
		//		$("[name='idcategoriaNueva[]']").val($("#icatcab2").val());
		//	});

// CARGAR JUGADORES POR CATEGORIA..
		}); // FIN DE LAS FUNCIONES
	</script>
	</head>
<body>
<?php include('includes/newmenu.php'); ?>

  <div id="ElegirJugadores" name="ElegirJugadores" class="ElegirJugadores">
	<div>
		<div>
			<input id="idclub" name="" value="" type="hidden"/>
			<input id="" name="" value="" type="hidden"/>			
		</div>
		
		 <select id="ianio" name="ianio" class="ianio">
			<option value="9999">Seleccionar año...</option>
		</select>
		<button id="volver" name="altajug" class="altajug" title="agregar registros"><<</button>
	  </div>	
	  <div id="FechaPartido"></div>
	  <div id="jugIDCLUB" name="jugN" ></div>
	  <section id="regridjug" class="regridjugPop">
	  	<div id="todxs" name="todxs" ><input type="checkbox" value="checked" title="Todos"/></div>
	  	<div id="jugSel" name="jugSel" ><select id="icate" name="icate" class="" ><option value="999" selected>Seleccionar CATEGORIAS...</option></select></div>
	  </section>  
  </div>
  <section id="cargajug" name="cargajug">
<!--	  <section id="regridjug" class="regridjugPop">
				<div id="jugN" name="jugN" ><input type="checkbox" value="checked" title="tiene saque"/></div>
				<div name="" id="" class="regjug">
					<input type="hidden" value="v.idjugador+" name="idjuga"></input>
					<input type="text" id="numeroA" name="numeroA" value="v.numero" readonly></input>
				</div>
				<div name="" id="" class="regjug">
					<input type="text" id="nombreA" name="nombreA" value="v.nombre" readonly></input>
				</div>
	  </section>  
-->	  
</section>

</body>

</html>
