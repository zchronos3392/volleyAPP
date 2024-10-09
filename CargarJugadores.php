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
		

//	agregar la funcion de actualizar hora de pantalla antes de volver
function updatehora(preid){
			$("#"+preid).prop('disabled', true);
		// por el momento solo guardo la competencia del formulario
			var parametros = {
				"TEXTOCLAVE" : "HORASISTEMA",
				"origenrequest"		: $('#'+preid).val() //reuso clave origenrequest para
				//   que directamente grabe la sesion
			};

			$.ajax({
				url:   './abms/grabarsesion.php',
				type:  'GET',
				data: parametros ,
				datatype:   'text json',
				beforeSend: function () {},
				done: function(data) {},
				success:  function (r) {

				},
				error: function (xhr, ajaxOptions, thrownError) {console.log(thrownError);}
								
			});// falta el seleccion de la cancha, para cargar los campos..		  
};

function checkHoraSistema(){
			if($("#HoraSistema") != '') 
				updatehora('HoraSistema');
}


//reemplazar el volver por, tambien cualquier otra funcion que recargue la pantalla donde estamos usando la hora sesion.
	//  function volver(urlEjecutar){
	// 	//aca tengo que grabar la hora simulada del sistema
	// 	checkHoraSistema();
	// 	window.location.href = urlEjecutar;
	// }


		function habilitaJugador(idObjetoSelector,nombreClaveJugador){
			// mando directamente el objeto checkBox
			if(idObjetoSelector.checked)
				$("#"+nombreClaveJugador).prop('readonly', false);
			else
				$("#"+nombreClaveJugador).prop('readonly', true);
		}	

		function modifcarJugadorX(unclub,unjugador,unanio,unacategoria,idobjNombre){			
			//alert('llamamos a modificar');
			var nombreModificado=$("#"+idobjNombre).val();
			//console.log( unclub+','+unjugador+','+unanio+','+unacategoria+','+nombreModificado);
	  			var parametros =  {
	  					"iclubescab" : unclub,
						"icatcab" 	 : unacategoria,        	
						"nombre" 	 : nombreModificado,
						"unanio" 	 : unanio,
						"unJugador"  : unjugador
		         }
		         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
		            url:   './abms/modificar_jugador.php',
		            //type:  'GET',
		            data: parametros,
		            beforeSend: function (){
						//console.log(parametros);
		            },
		            success:  function (r){
							var respuesta = JSON.parse(r);
							if(respuesta.estado == 1)
								window.location.reload();
							else
								alert(r['Mensaje']);
							//
							// iclubescab = parametroURL('iclubescab');
							// icatcab    = parametroURL('icatcab');
							// location.href='Cjugadores.php?icatcab='+icatcab+'&iclubescab='+iclubescab;
		            },
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.responseText);
						console.log(thrownError);
		            }
		            }); // FIN funcion ajax
			//window.location.href='ABMjugadores.php?MODO=UPD&unjugador='+unjugador+'&ianio='+unanio+'&iclubescab='+unclub+'&icatcab='+unacategoria;

		//********************* FIN funcic ajax ELIMINAR JUGADOR					**************************
		};		


		function jugadoresLista(llamaQuien){
				//aqui va ir tu codigo ajax, del cual tienes que regresar un .json desde php
				// por ejemplo asi:   echo json_encode($tuvariable);
				//entonces mandas llamar el php de esta manera
				//	ajax del obtener_jugadores_partido	
						//
					//alert(llamaQuien);
					//"icatcab" : $("#icate").val($.urlParam('idcate')),
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
						success:  function (r)
						{
							if(r['estado'] == 1)
							{	
								$(r['Jugadores']).each(function(i, v)
								{ // indice,0 valor
									var icheck='';
									//significa que no fue agregado a la lista original
									//si esta en la lista, lo muestro seleecionado y le agrego la funcion
									//para DESELECCIONARLO...
									var dadodeBaja='disabled';
									var activarAltaBaja='alert("Jugador dado de baja.Ups")';
									var activarHabilitacion = 'alert("No se habilita a un jugador dado de baja.Ups")';
									//
									if(v.FechaEgreso == null)
										dadodeBaja='';

									var	nombre=v.nombre+'( BAJA )';
									if(v.FechaEgreso == null)
										nombre=v.nombre;

									varCubparms= $.urlParam('idclub');	
										claveJugador=varCubparms+'_'+v.idjugador;
									// si se encuentra activo puedo tener acciones: alta en cancha, modificar su nombre
									if(v.FechaEgreso == null){
										activarAltaBaja='onclick="altajugador(this);"';
										activarHabilitacion ='onclick="habilitaJugador(this,\'nombre_'+claveJugador+'\');"';
									}	
									// tiene datos									
									if(v.jugador == null){
										// lo puedo dar de alta en cancha
										icheck='<input id="CHECK_'+varCubparms+'_'+v.idjugador+'" name="CHECK_'+varCubparms+'_'+v.idjugador+'" type="checkbox" '+activarAltaBaja+ ' title="seleccionar" '+
													dadodeBaja+
												'/>';
										// permito modificar su nombre
										icheckHabilitar='<input id="CHECK_habilitar_'+v.idjugador+'" name="CHECK_habilitar_'+v.idjugador+'" type="checkbox" '+activarHabilitacion+ ' title="seleccionar" '+
													dadodeBaja+
												'/>';

										}												
									else{
										// sin acciones 
										icheck='<input id="CHECK_'+varCubparms+'_'+v.idjugador+'" name="CHECK_'+varCubparms+'_'+v.idjugador+'" type="checkbox" '+activarAltaBaja+ ' checked title="seleccionado"  '+dadodeBaja+'/>';
										
										icheckHabilitar='<input id="CHECK_habilitar_'+v.idjugador+'" name="CHECK_habilitar_'+v.idjugador+'" type="checkbox" '+activarAltaBaja+ ' checked title="seleccionado"  '+dadodeBaja+'/>';										
										}

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
											icheckHabilitar+
											'<div class="regjugNom2"><input type="text" id="nombre_'+claveJugador+'" name="nombre_'+claveJugador+'" value="'+nombre+'" readonly /></div>'+
											'<div><button class="btnGrilla" id="modificarJugador" onclick="modifcarJugadorX('+varCubparms+','+v.idjugador+','+$("#ianio").val()+','+$("#icate").val()+',\'nombre_'+claveJugador+'\')">Modificar</button></div>'+
											'</section><span class="EspacioFin" />');
								});
							}	
							else
							{
								if(r['estado'] == 10)
								$("#cargajug").append(r['Jugadores']);
							}			
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
	
			// guardo la hora simulada, porque esta accion refresca la pantalla completa	
				checkHoraSistema();
	
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
							  	jugadoresLista('altajugador::Check en Jugador con error');
							}
							 else 
								jugadoresLista('altajugador::Check en Jugador sin error');
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
							jugadoresLista('altajugador::Borrar Jugador');
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
				
			// RECUPERO LA HORA SIMULADA DEL SISTEMA, SI ES QUE SE GUARDÓ	
			<?php
				require_once('./abms/SesionTabla.php');
				$HoraSistemaSaved =  SesionTabla::getsessionX("'HORASISTEMA'"); //texto clave
				if(isset($HoraSistemaSaved["sesorigen"]))
					echo "$('#HoraSistema').val('".$HoraSistemaSaved["sesorigen"]."');";
			?>		

		// ***************************************************
		// 			AVANZO EL CRONOMETRO SI EXISTE
		// ***************************************************		
				var dt = new Date();
		//		var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
				var tiempo = {
					hora: dt.getHours(),
					minuto: dt.getMinutes(),
					segundo: dt.getSeconds()
				};

				var vHoraSistema = $("#HoraSistema").val();
				if (vHoraSistema != '')	
						var a1 = vHoraSistema.split(':'); // [18, 30, 01] -hora fingida sistema

				// FINGIENDO QUE LA HORA DE SISTEMA SIMULADA ESTA AVANZANDO MILI A MILIPILIsegundos
				if (vHoraSistema != '')	{
				var tiemposistema = {
					hora: a1['0'],
					minuto: a1['1'],
					segundo: a1['2'] 
				}
				}


				var tiempo_corriendo = null;

				tiempo_corriendo = setInterval(function(){
				// Segundos
				tiempo.segundo++;

				// MOVIENDO EL TIEMPO SIMULADO EN UN SOLO CRONOMETRO:SEGUNDOS
				if (vHoraSistema != '')
					tiemposistema.segundo++;

				if(tiempo.segundo >= 60)
				{
					tiempo.segundo = 0;
					tiempo.minuto++;
				}      

				// MUEVO EL TIEMPO SIMULADOR TAMBIEN:SEGUNDOS+MINUTO
				if (vHoraSistema != ''){
					if(tiemposistema.segundo >= 60)
					{
						tiemposistema.segundo = 0;
						tiemposistema.minuto++;
					}      		
				}	

				// Minutos
				if(tiempo.minuto >= 60)
				{
					tiempo.minuto = 0;
					tiempo.hora++;
				}

				// MOVIENDO TIMEPO SIMULADO: MINUTOS
				if (vHoraSistema != ''){
					if(tiemposistema.minuto >= 60)
					{
						tiemposistema.minuto = 0;
						tiemposistema.hora++;
					}
				}	

				// CRONOMETRO COMUN
				var tiempoTxtHora = tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora;
				var tiempoTxtMin  = tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto;
				var tiempoTxtSeg  = tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo;
				
				// CRONOMETRO SIMULADO
				if (vHoraSistema != ''){
				var XtiempoTxtHora = tiemposistema.hora < 10 ? '0' + tiemposistema.hora : tiemposistema.hora;
				var XtiempoTxtMin  = tiemposistema.minuto < 10 ? '0' + tiemposistema.minuto : tiemposistema.minuto;
				var XtiempoTxtSeg  = tiemposistema.segundo < 10 ? '0' + tiemposistema.segundo : tiemposistema.segundo;
				var XtiempoSinSegs = XtiempoTxtHora +':' + XtiempoTxtMin;		
					var XtiempoTxt = XtiempoTxtHora +':' + XtiempoTxtMin +':' + XtiempoTxtSeg ;
				}

				var tiempoTxt = tiempoTxtHora +':' + tiempoTxtMin +':' + tiempoTxtSeg ;

				// ACTUALIZO EL CRONOMETRO SIMULADO
				if (vHoraSistema != '')
					$("#HoraSistema").val(XtiempoTxt);

				$("#stopwatch").text(tiempoTxt);

				}, 1000); //funcion setinterval..
		// ***************************************************
		// 			AVANZO EL CRONOMETRO SI EXISTE
		// ***************************************************		

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

			var FechaParametros = $.urlParam('fecha');
			//CHATGPT Supongamos que el campo de texto tiene un ID de "miCampoTexto"
				var valorCampoTexto = FechaParametros; //$('#miCampoTexto').val();
				var fecha = new Date(valorCampoTexto);
				var anio = fecha.getFullYear();
				$("#ianio").val(anio);




			
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
				

			// $("#Habilitar").on("click",function() {
				
			// 	if ($("#Habilitar").html() == 'Deshabilitar' )		
			// 	{
			// 			$("#Habilitar").html('Habilitar');
			// 	//		$("input").prop('disabled', false);
			// 	}		
			// 	else
			// 	{
			// 			$("#Habilitar").html('Deshabilitar');
			// 	//		$("input").prop('disabled', true);
			//     }		

			// });	
			
			
			$("#icate").on("change",function() {
				jugadoresLista('CateOnchange');
			});			
			
		$("#volver").on("click",function(e){
			e.preventDefault();
			checkHoraSistema();
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
						conteoCategoriaParm=0;
						conteoCateogrias =0;
						$(r['Categorias']).each(function(i, v)
						{ // indice, valor
								conteoCateogrias++;
								if(categoriapartido == v.idcategoria) 
								{
									$("#icate").append('<option value="' + v.idcategoria + '" selected>' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
									conteoCategoriaParm++;
								}	
								else 
								{
									$("#icate").append('<option value="' + v.idcategoria + '">' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
								}	
						});
						//console.log('conteoCategoriaParm '+conteoCategoriaParm+' conteoCateogrias '+conteoCateogrias);
						if(conteoCategoriaParm == 0 && conteoCateogrias > 0)
								$("#jugIDCLUB").append('La categoria del partido no está activada...');

						jugadoresLista('Luego de obtener Categorias en el LOAD');
						
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
		<div class="HoraSimuladaBlock">
			<span>Hora Simulada</span>
			<input type="datetime" id="HoraSistema" name="HoraSistema" disabled />
			<!-- AL LADO DEL CRONOMETRO -->
			<div ><span id="stopwatch" style="display: none;"></span></div> 
		</div>	
	  </div>	
	  <div id="FechaPartido"></div>
	  <div id="jugIDCLUB" name="jugN" ></div>
	  <section id="regridjug" class="regridjugPop">
	  	<div id="todxs" name="todxs" ><input type="checkbox" value="checked" title="Todos"/></div>
	  	<div id="jugSel" name="jugSel" ><select id="icate" name="icate" class="" ><option value="999" selected>Seleccionar CATEGORIAS...</option></select></div>
		<!-- <div name="Habilitar" ><button value="Habilitar" id="Habilitar" class="btnGrilla">Habilitar</button></div> -->
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
