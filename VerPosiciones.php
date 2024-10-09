<?php include('sesioner.php'); ?>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title></title>
	<!--SCRIPTS-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   <link rel="stylesheet" href="./css/estiloCargaJugadores.css">	   
	<script>
		var stringcontenido2;
		var cont1=cont2=cont3=cont4=cont5=cont6='';
		$.urlParam = function(name){
			var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
			if (results==null){
			   return null;
			}
			else{
			   return decodeURI(results[1]) || 0;
			}
		};


function cargarDatosJugadores(){

			var contador=0;
			var partido = $.urlParam('idpartido'); // name
			var club = $.urlParam('idclub');        // 6
			var fecha = $.urlParam('fecha');   // null		
			// se agrega parametro del set?
			var setdata = $.urlParam('set');   // null	
			var anio = $("#ianio").val();
			var stringcontenido='';	
			var puestoPosta=0;
			var entro=0;
			//console.log('linea 143');
			var parametros = 
			 {
			    "idpartido" : $.urlParam('idpartido'),
	  			"iclubescab" : club,
				//"icatcab" : $("#icate").val(),
				"fechapartido": <?php echo("'".$_GET['fecha']."'");?>,
				"anioEquipo" : anio,
				"setdata" : $.urlParam('set'),
				"esVisualizar": $.urlParam('ver'),
			    "categoriapartido" : $.urlParam('idcate')
			 };
			//console.log(parametros);	
			 $.ajax({ 
				url:   './abms/obtener_jugpartido2.php',
				type:  'GET',
				data: parametros,
				dataType: 'text json',
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
				beforeSend: function (){
					$("#cargajug").empty('');
						//console.log('linea 161');
				},
				done: function(data){
					$("#canchaA").empty('');		
					//console.log('linea 165');	
					$("#CuadroJugadoresA").empty('');
					$("#canchaRotacion").empty('');
					
				},
				success:  function (r){
		
			// LOCATION.RELOAD Y LOAD INICIAL, WHEN READY			
				cont8='';
				if(r['estado']>0){
					$("#canchaA").html('');
					$("#liberos").html('');
					cont8='';

			   esVisualizar= $.urlParam('ver');
				
				if(esVisualizar=='S')
				{
					 //$datos["JugadoresINI"] = $jugadores2;//es un array
				// EACH ENLD JUGADORES POSICIONES INICIALES DEL SET EN VISUALIZAR	 
				//console.log();
				
				if(r['JugadoresINI'].length ==0 && r['Rotaciones'].length == 0)
					$("#content21").html('');						
				
				if(r['JugadoresINI'].length > 0)
				$("#CuadroJugadoresA").append(
					   '<div id="pos_0" name="pos_0" class="gridConfigJugVER">'+
				   	   '<div class="itemcnfju1VER">'+
				   	  	'<span class="itemcjug1VER NumeroJugador">POSICIONES </span>'+
				   	  	'<span class="itemcjug2VER nombreJugador">INICIALES</span></div>'+
				   	  '</div>');

				
				$(r['JugadoresINI']).each(function(i, v)
				{ // indice,0 valor
					//if(v.activoSN != null)
					//		alert('ES NULL !!!! '+ v.activoSN);
              		puestoPosta=0;
//	if(v.secuencia == 1)					
						if (! $('#canchaA').find("div[value='" + v.nombre + "']").length)
						{
								var selecter='';
								
								switch(v.posicionini) {
								case "1":
									// code block
										selecter='<div class="itemcjug4VER redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_"   >'+v.posicionini+'</div>';
									break;
								case "2":
										selecter='<div class="itemcjug4VER redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_"   >'+v.posicionini+'</div>';						  
									// code block
									break;
								case "3":
										selecter='<div class="itemcjug4VER redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_"   >'+v.posicionini+'</div>';						  
									// code block
									break;
								case "4":
										selecter='<div class="itemcjug4VER redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_"   >'+v.posicionini+'</div>';						   
									// code block
									break;
								case "5":
										selecter='<div class="itemcjug4VER redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_"   >'+v.posicionini+'</div>';						  
									// code block
										break;
								case "6":
										selecter='<div class="itemcjug4VER redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_"   >'+v.posicionini+'</div>';						 
									// code block
									break;
								default:
											selecter='<div class="itemcjug4VER redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_7" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_7" >Sup</div>';
									// code block
								}
								//CARGAR GRILLA DE LIBEROS
								var colorFondo = 'style="backGround:#000;"';
								puestoPosta =v.puestoxcat;	
								puestoCategoria=v.puestoxcat;
								colorFondo = 'style="backGround:'+v.ColorPuestoCat+';"';

								if(v.puestoxcat != v.puesto)
								{
									puestoPosta = v.puesto;
									colorFondo = 'style="backGround:'+v.ColorPuestoCancha+';"';
								}

								if(puestoPosta==2) // LIBEROS
									if (! $('#liberos').find("div[value='" + v.nombre + "']").length)
									{
										cont8+='<div '+colorFondo+'  value="'+v.nombre +'"   >'+v.nombre +'('+v.numero+')' +'</div>';
									}
								//CARGAR GRILLA DE LIBEROS
								botonPuestos = "";
								botonNewPuesto="";

								//CARGAR INDICADOR DE PUESTO ACTUAL 
								botonCentral='';	
								//BOTONES DE COLOR Y NOMBRE DE PUESTO AL LADO EN CARGA INICIAL
								// ES PUNTA
								if(puestoPosta == 4)						
								{
									//contador++;
									//alert(v.nombre+ ' ES UN ARMADOR, POR '+contador+ ' VEZ' );
									botonCentral='<button id="central_pos_'+v.idjugador+'" name="punta" class="itemcjug3VER punta"'+colorFondo+' title="marcar central al jugador" >{P}</button>';
								}
								
								// ES CENTRAL
								if(puestoPosta == 6){
									//alert(v.nombre+ ' ES UN central ' );
									botonCentral='<button id="central_pos_'+v.idjugador+'" name="central" class="itemcjug3VER central"'+colorFondo+' title="marcar central al jugador" >{C}</button>';
								}						
								
								if(puestoPosta == 3)	//ARMADOR..					
								{
									//contador++;
									//alert(v.nombre+ ' ES UN ARMADOR, POR '+contador+ ' VEZ' );
									botonCentral='<button id="central_pos_'+v.idjugador+'" name="armador" class="itemcjug3VER armador"'+colorFondo+' title="marcar armador al jugador" >{a}</button>';							
								}
								if(puestoPosta == 5)	//OPUESTO..
								{
									//alert(v.nombre+ ' ES UN opuesto ' );							
									botonCentral='<button id="central_pos_'+v.idjugador+'" name="opuesto" class="itemcjug3VER opuesto"'+colorFondo+' title="marcar opuesto al jugador" >{o}</button>';
								}					

								if(puestoPosta == 2){	//libero..
									//alert(v.nombre+ ' es un libero ' );
									botonCentral='<button id="central_pos_'+v.idjugador+'" name="libero" class="itemcjug3VER libero"'+colorFondo+' title="marcar opuesto al jugador" >{L}</button>';
								}	
								//CARGAR INDICADOR DE PUESTO ACTUAL 						
								
								
								$("#CuadroJugadoresA").append(
								'<div id="pos_'+v.idjugador+'" name="pos_'+v.idjugador+'" class="gridConfigJugVER">'+
							'<div class="itemcnfju1VER">'+
								'<span class="itemcjug1VER NumeroJugador">'+v.numero+'</span>'+
								'<span class="itemcjug2VER nombreJugador">'+v.nombre+'</span>'+
								botonPuestos +
								botonCentral+
								botonNewPuesto+selecter+'</div>'+
							'</div>');
							entro++;
							//alert(v.posicion);	
							switch(v.posicionini)
							{
								// elegir el puesto del jugador en cancha.
									//puestoPosta =v.puestoxcat;	
									//puestoCategoria=v.puestoxcat;
									//if(v.puestoxcat != v.puesto) puestoPosta = v.puesto;							
								// elegir el puesto del jugador en cancha.
								case "1" :	
											if(puestoPosta==6) stringcontenido += '<div id="canchaa1"  class="gridcanchaBetaA "'+colorFondo+'  value="'+v.nombre+'">POS 1 '+v.nombre +'('+v.numero+')' +'</div>';
											else
												if(puestoPosta==2) stringcontenido += '<div id="canchaa1"  class="gridcanchaBetaA "'+colorFondo+'  value="'+v.nombre+'">POS 1 '+v.nombre +'('+v.numero+')' +'</div>';
													else stringcontenido += '<div id="canchaa1"  class="gridcanchaBetaA "'+colorFondo+'  value="'+v.nombre+'">POS 1 '+v.nombre +'('+v.numero+')' +'</div>';
											break;
								case "2" :
											if(puestoPosta==6) stringcontenido += '<div id="canchaa2"  class="gridcanchaBetaB "'+colorFondo+'  >POS 2 '+v.nombre +'('+v.numero+')' +'</div>';
												else
													if(puestoPosta==2) stringcontenido += '<div id="canchaa2"  class="gridcanchaBetaB "'+colorFondo+' >POS 2 '+v.nombre +'('+v.numero+')' +'</div>';
														else stringcontenido += '<div id="canchaa2"  class="gridcanchaBetaB "'+colorFondo+'  >POS 2 '+v.nombre +'('+v.numero+')' +'</div>';
											break;
								case "3" :
											if(puestoPosta==6) stringcontenido += '<div id="canchaa3"  class="gridcanchaBetaC "'+colorFondo+'  >POS 3 '+v.nombre +'('+v.numero+')' +'</div>';
												else
													if(puestoPosta==2) stringcontenido += '<div id="canchaa3"  class="gridcanchaBetaC "'+colorFondo+'  >POS 3 '+v.nombre +'('+v.numero+')' +'</div>';
														else stringcontenido += '<div id="canchaa3"  class="gridcanchaBetaC "'+colorFondo+'  >POS 3 '+v.nombre +'('+v.numero+')' +'</div>';
											break;
								case "4" :
											if(puestoPosta==6) stringcontenido += '<div id="canchaa4"  class="gridcanchaBetaD "'+colorFondo+'  >POS 4 '+v.nombre +'('+v.numero+')' +'</div>';
												else
													if(puestoPosta==2) stringcontenido += '<div id="canchaa4"  class="gridcanchaBetaD "'+colorFondo+'  >POS 4 '+v.nombre +'('+v.numero+')' +'</div>';
														else stringcontenido += '<div id="canchaa4"  class="gridcanchaBetaD "'+colorFondo+'  >POS 4 '+v.nombre +'('+v.numero+')' +'</div>';
											break;
								case "5" :
											if(puestoPosta==6) stringcontenido += '<div id="canchaa5"  class="gridcanchaBetaE "'+colorFondo+'  >POS 5 '+v.nombre +'('+v.numero+')' +'</div>';
												else
													if(puestoPosta==2) stringcontenido += '<div id="canchaa5"  class="gridcanchaBetaE "'+colorFondo+'  >POS 5 '+v.nombre +'('+v.numero+')' +'</div>';
														else stringcontenido += '<div id="canchaa5"  class="gridcanchaBetaE "'+colorFondo+'  >POS 5 '+v.nombre +'('+v.numero+')' +'</div>';
											break;
								case "6" :
											if(puestoPosta==6) stringcontenido += '<div id="canchaa6"  class="gridcanchaBetaF "'+colorFondo+'  >POS 6 '+v.nombre +'('+v.numero+')' +'</div>';						
												else
													if(puestoPosta==2) stringcontenido += '<div id="canchaa6"  class="gridcanchaBetaF "'+colorFondo+'  >POS 6 '+v.nombre +'('+v.numero+')' +'</div>';
														else
															stringcontenido += '<div id="canchaa6"  class="gridcanchaBetaF "'+colorFondo+'  >POS 6 '+v.nombre +'('+v.numero+')' +'</div>';
											break;
								case "7" :
											//$("#canchaA").append();
											break;
							};
								
							}
						});// EACH ENLD JUGADORES POSICIONES INICIALES DEL SET EN VISUALIZAR
						};
				$("#canchaA").html(stringcontenido);
	 			$("#liberos").html(cont8);
	 			stringcontenido="";
	 			if(entro==0) $("#pos_0").html('');
	 			
				$(r['Rotaciones']).each(function(x, y)
				{ 
					//console.log("Rotacion nro  "+x );
					//alert(v.posicion);
				stringcontenido += '<div id="canchaC" class="canchaBeta_2VER ">'+
									'<div class="g2VERTexto">Tantos al rotar L: '+
									r['RotacionesPuntos'][x].puntoa+' V: '+
									r['RotacionesPuntos'][x].puntob+'</div>';	
					$(y).each(function(j, v)
						{
						//COLOR DEL LIBERO : background-color: #e29d1d;
							// elegir el puesto del jugador en cancha.
							var colorFondo = 'style="backGround:#000;"';
							 puestoPosta =v.puestoxcat;	
							 puestoCategoria=v.puestoxcat;
						     colorFondo = 'style="backGround:'+v.ColorPuestoCat+';"';

							if(v.puestoxcat != v.puesto)
							{
								 puestoPosta = v.puesto;
								 colorFondo = 'style="backGround:'+v.ColorPuestoCancha+';"';
							}
								// elegir el puesto del jugador en cancha.
								if(v.posicion == 1){
									//central
									if(puestoPosta==6) stringcontenido += '<div id="canchaa1"  class="gridcanchaBetaA_2VER "'+colorFondo+' value="'+v.nombre+'">POS 1 '+v.nombre +'('+v.remeraNum+')' +'</div>';
									else 
										if(puestoPosta==2) stringcontenido += '<div id="canchaa1"  class="gridcanchaBetaA_2VER "'+colorFondo+' value="'+v.nombre+'">POS 1 '+v.nombre +'('+v.remeraNum+')' +'</div>';
										else	stringcontenido += '<div id="canchaa1"  class="gridcanchaBetaA_2VER "'+colorFondo+' value="'+v.nombre+'">POS 1 '+v.nombre +'('+v.remeraNum+')' +'</div>';
								}
									
								if(v.posicion == 2){
									//central
									if(puestoPosta==6) stringcontenido += '<div id="canchaa2"  class="gridcanchaBetaB_2VER "'+colorFondo+' >POS 2 '+v.nombre +'('+v.remeraNum+')' +'</div>';
									else stringcontenido += '<div id="canchaa2"  class="gridcanchaBetaB_2VER "'+colorFondo+' >POS 2 '+v.nombre +'('+v.remeraNum+')' +'</div>';
									//libero
									if(puestoPosta==2) stringcontenido += '<div id="canchaa2"  class="gridcanchaBetaB_2VER "'+colorFondo+' >POS 2 '+v.nombre +'('+v.remeraNum+')' +'</div>';
									else stringcontenido += '<div id="canchaa2"  class="gridcanchaBetaB_2VER "'+colorFondo+' >POS 2 '+v.nombre +'('+v.remeraNum+')' +'</div>';												}

								if(v.posicion == 3){
									if(puestoPosta==6) stringcontenido += '<div id="canchaa3"  class="gridcanchaBetaC_2VER "'+colorFondo+' >POS 3 '+v.nombre +'('+v.remeraNum+')' +'</div>';
									else 	stringcontenido += '<div id="canchaa3"  class="gridcanchaBetaC_2VER "'+colorFondo+' >POS 3 '+v.nombre +'('+v.remeraNum+')' +'</div>';
									if(puestoPosta==2) stringcontenido += '<div id="canchaa3"  class="gridcanchaBetaC_2VER "'+colorFondo+' >POS 3 '+v.nombre +'('+v.remeraNum+')' +'</div>';
									else 	stringcontenido += '<div id="canchaa3"  class="gridcanchaBetaC_2VER "'+colorFondo+' >POS 3 '+v.nombre +'('+v.remeraNum+')' +'</div>';

								}
									
								if(v.posicion == 4){
									if(puestoPosta==6)  stringcontenido += '<div id="canchaa4"  class="gridcanchaBetaD_2VER "'+colorFondo+' >POS 4 '+v.nombre +'('+v.remeraNum+')' +'</div>';
									else stringcontenido += '<div id="canchaa4"  class="gridcanchaBetaD_2VER "'+colorFondo+' >POS 4 '+v.nombre +'('+v.remeraNum+')' +'</div>';
									if(puestoPosta==2)  stringcontenido += '<div id="canchaa4"  class="gridcanchaBetaD_2VER "'+colorFondo+' >POS 4 '+v.nombre +'('+v.remeraNum+')' +'</div>';
									else stringcontenido += '<div id="canchaa4"  class="gridcanchaBetaD_2VER "'+colorFondo+' >POS 4 '+v.nombre +'('+v.remeraNum+')' +'</div>';																		
								}

								if(v.posicion == 5){
									if(puestoPosta==6)  stringcontenido += '<div id="canchaa5"  class="gridcanchaBetaE_2VER "'+colorFondo+' >POS 5 '+v.nombre +'('+v.remeraNum+')' +'</div>';
									else stringcontenido += '<div id="canchaa5"  class="gridcanchaBetaE_2VER "'+colorFondo+' >POS 5 '+v.nombre +'('+v.remeraNum+')' +'</div>';
									if(puestoPosta==2)  stringcontenido += '<div id="canchaa5"  class="gridcanchaBetaE_2VER "'+colorFondo+' >POS 5 '+v.nombre +'('+v.remeraNum+')' +'</div>';
									else stringcontenido += '<div id="canchaa5"  class="gridcanchaBetaE_2VER "'+colorFondo+' >POS 5 '+v.nombre +'('+v.remeraNum+')' +'</div>';
								}

								if(v.posicion == 6){
									if(puestoPosta==6)  stringcontenido += '<div id="canchaa6"  class="gridcanchaBetaF_2VER "'+colorFondo+' >POS 6 '+v.nombre +'('+v.remeraNum+')' +'</div>';
									else stringcontenido += '<div id="canchaa6"  class="gridcanchaBetaF_2VER "'+colorFondo+' >POS 6 '+v.nombre +'('+v.remeraNum+')' +'</div>';									
									if(puestoPosta==2)  stringcontenido += '<div id="canchaa6"  class="gridcanchaBetaF_2VER "'+colorFondo+' >POS 6 '+v.nombre +'('+v.remeraNum+')' +'</div>';
									else stringcontenido += '<div id="canchaa6"  class="gridcanchaBetaF_2VER "'+colorFondo+' >POS 6 '+v.nombre +'('+v.remeraNum+')' +'</div>';																		
								}

								if(v.posicion == 7)  console.log('suplente...');

	 				 });	// EACH ENLD	   
					stringcontenido += '</div>';
					//console.log(stringcontenido);
				  });// EACH ENLD
				  //$("#canchaRotacion").append(stringcontenido);
				 $("#canchaRotacion").html(stringcontenido);
    			
 				// if($.urlParam('ver') == 'S')
				//			$("#itemcnf2").attr('disabled','disabled');
    			
    			
    			}// ESTADO = 0	
    		},// SUCCESS		
			 error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
					//console.log('linea 237 '+thrownError);
					console.log('linea 495 '+xhr.responseText);
			}// fin ERROR:FUNCT
			}); // FIN funcion ajax JUGASPARTIDO..
} // fin funcion CARGAR DATOS JUGADORES


function creaspuestos(idjugador,puesto,nombreObj){
	//alert('jugador : ' + idjugador +' puesto : ' +puesto);
	//alert();
	var selectPuesto = "";
        // esto arreglo el tema del alta triplle..
         $.ajax({ 
            url:   './abms/obtener_puestos.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){},
            done: function(data){},
            success:  function (r){
                $(r['Posiciones']).each(function(i, v)
                { // indice, valor
                	//alert(v.codigo);
                	if(puesto != 0 && v.idPosicion == puesto )
                		$("#"+nombreObj+"_"+idjugador).append('<option value="' + v.idPosicion + '" label="'+v.nombre+'" selected>' +v.nombre +'</option>');
                	else
						$("#"+nombreObj+"_"+idjugador).append('<option value="' + v.idPosicion + '" label="'+v.nombre+'">' +v.nombre +'</option>');

					//alert(selectPuesto);
				});		
             },
             error: function (xhr, ajaxOptions, thrownError) {}
            }); // FIN funcion ajax CLUBES	
	
return 	selectPuesto ;
};


// camnbior por cargar jugadores..			
function chequeacarga(){
				//insertar_jugadores_sets.php
			var parametros =
				{
			    "idpartido" : $.urlParam('idpartido'),
	  			"iclub" : $.urlParam('idclub'),
				"fechapartido": $.urlParam('fecha'),
				"setdata" : $.urlParam('set'),
				"ianio"   : $("#ianio").val(),
				"categoriapartido" : $.urlParam('idcate')
				};

		// primero chequeo que esté todo en orden con los queries
    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/check-insertar_jugadores_sets.php',
            type:  'GET',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
            },
            
            success:  function (r){
				//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET
	    			//cargaCancha();
	    			
	    			var vector = jQuery.parseJSON(r);
	    			//AUTORIZA = 0 NO HAY ERRORES ENCONTRADOS, AUTORIZA >= 1 HAY ERRORES Y SE LISTAN ACA:
					if(vector['autoriza'] != 0)
					{
		    			var mensajes = "Autorizar : "+vector['autoriza'];
		    			mensajes +=" Cadena del Error : <br>";
						mensajes += vector['error'];
		    			$("#MensajesError").html(mensajes);
					}
					
            },
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA				
					console.log(thrownError);
               }
		   	});

/*

*/				
}	


		
		$(document).ready(function()
		{
			//var contador=0;
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
			
			$("#ianio").val($.urlParam('anio'));
			
			esVisualizar= $.urlParam('ver');
			if(esVisualizar=='S')
			{ 
					$("#cargaSetjugadores").prop('disabled', true);
					$("#cargaSetjugadores").css('background', '#A9AAC5');  
					
					$("#borraSetjugadores").prop('disabled', true); 
					$("#borraSetjugadores").css('background', '#A9AAC5');  
			};
			
			chequeacarga();			

		
// ELIMINAR JUGADORES DEL SET 
// camnbior por cargar jugadores..			
		$("#borraSetjugadores").on("click",function(e){
				//insertar_jugadores_sets.php
			var parametros =
				{
			    "idpartido" : $.urlParam('idpartido'),
	  			"iclub" : $.urlParam('idclub'),
				"fechapartido": $.urlParam('fecha'),
				"setdata" : $.urlParam('set'),
				};


    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/borrar_jugadores_sets.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
            },
            
            success:  function (r){
				//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET
	    		//cargaCancha();
					location.reload();
					//console.log(r);
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA				
					console.log(thrownError);
               }
		   	});
				
		});	

// ELIMINAR JUGADORES DEL SET		
// camnbior por cargar jugadores..						
			
		$("#volver").on("click",function(e){
			e.preventDefault();
			//encotnrar quien lo llama...
				parent.history.back();
				return false;
			//			$(location).attr('href','CSets.php?id='+$.urlParam('idpartido')+'&setmax='+$.urlParam('setmax')+'&fecha='+$.urlParam('fecha'));
		});	
		  
			//console.log('linea 136');
			// LOCATION.RELOAD Y LOAD INICIAL, WHEN READY
			cargarDatosJugadores();			

// TRAIGO LOS DATOS DEL PARTIDO
			var clubParm = $.urlParam('idclub');
			var parametros = 
			 {
			    "id" : $.urlParam('idpartido'),
				"fechapart": <?php echo("'".$_GET['fecha']."'");?>,
			 };
			//console.log(parametros);
			//http://localhost/volleyAPP_desa/abms/obtener_partidos.php?fechapart=2021-09-04&id=1	
/*{"estado":"5",
"Partido":{
		"Fecha":"2021-09-04",
		"idPartido":"1",
		"DescCate":"Sub17[CAB]",
		"idcat":"6",
		"ClubA":"HARRODS",
		"ClubB":"HACOAJ",
		"idcluba":"84",
		"idclubb":"83",
*/
			 $.ajax({ 
				url:   './abms/obtener_partidos.php',
				type:  'GET',
				data: parametros,
				dataType: 'text json',
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
				beforeSend: function (){},
				done: function(data){},
				success:  function (r){
					  $(r['Partido']).each(function(i, v)
							{ // indice,0 valor
								iclubA = v.idcluba;
								iclubB = v.idclubb ;
								if(clubParm == iclubA)
								{
									 $("#clubNombre").val(v.ClubA);
									 $("#EsLocalVisitante").val('Local');
								}		 
								if(clubParm == iclubB)
								{
									 $("#clubNombre").val(v.ClubB);
									 $("#EsLocalVisitante").val('Visitante');
								}
								
								
								// agregado para guardar el id partido y tenerlo disponible..

								$("#categoria").val(v.DescCate);
						});	
				},// SUCCESS	
			 error: function (xhr, ajaxOptions, thrownError) {
					console.log('linea 238 '+xhr.responseText);
			}// fin ERROR:FUNCT
			}); // FIN funcion ajax JUGASPARTIDO..




// TRAIGO LOS DATOS DEL PARTIDO

		var dt = new Date();
//		var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
	    var tiempo = {
	        hora: dt.getHours(),
	        minuto: dt.getMinutes(),
	        segundo: dt.getSeconds()
	    };

    	var tiempo_corriendo = null;

		tiempo_corriendo = setInterval(function(){
        // Segundos
        tiempo.segundo++;
        if(tiempo.segundo >= 60)
        {
        	tiempo.segundo = 0;
            tiempo.minuto++;
        }      

        // Minutos
        if(tiempo.minuto >= 60)
        {
        	tiempo.minuto = 0;
            tiempo.hora++;
        }

		var tiempoTxtHora = tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora;
		var tiempoTxtMin  = tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto;
		var tiempoTxtSeg  = tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo;
		
		var tiempoTxt = tiempoTxtHora +':' + tiempoTxtMin +':' + tiempoTxtSeg ;
				
		$("#stopwatch").text(tiempoTxt);

		}, 1000); //funcion setinterval..
		

}); // document READY
// CARGAR JUGADORES POR CATEGORIA..
</script>	

<span id="stopwatch" style="display: none;"></span>
</head>
<body>
<div id="stikcy">
<header class="headerIngreso_2">
	<section class="LogoApp fijaLogo" style="z-index: 0;">
		<a href="index.php">
			<!-- <img  class="LogoApp" alt="VOLLEY.app" src="./img/textovolleyAPP_pequeno.png" /> -->
		</a>
	</section>	
</header>
   <div class="ControlesPosicion21_2 ">
	 <div class="control1"><select id="ianio" name="ianio" class="ianio">
			<option value="9999">Seleccionar año...</option>
		  </select>
	 </div>
	 <div class="control2"><input type="button" id="volver" name="altajug" class="btnSet2021" title="volver" placeholder="<<" value="<<"></input></div>
	 <div class="control3"><button id="cargaSetjugadores" name="altajug" class="altajugsetpartido" title="Trae lista jugadores">(+)</button></div>
	 <div class="control4"><button id="borraSetjugadores" name="bajajugs" class="bajajugsetpartido" title="Borrar">(Del)</button></div>	 		

	 <div class="control5">
	 	<input id="EsLocalVisitante" name="EsLocalVisitante"	disabled /> 
	 </div>
	 <div class="control6"><input id="clubNombre" name="clubNombre"	disabled /> </div>
	 <div class="control8"></div>
	 <div class="control7"><input id="categoria" name="categoria"  disabled />  </div>	 		

   </div>	
 	<section id="MensajesError" name="MensajesError" class=""></section>
 	<div id="liberos" class="LIBEROS_2 fondoBlanco" ></div>	
	<div id="canchaA" class="canchaBeta_2 "></div>
</div>
<div id="content21">
   	  <section id="CuadroJugadoresA" name="CuadroJugadoresA" class="CuadroJugadores_2Ver "></section>

<section id="canchaRotacion" name="canchaRotacion" class="CuadroJugadores_2VerRotacion ">
	
</section>
</div>

</body>

</html>
