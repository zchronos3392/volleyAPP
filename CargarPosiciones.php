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
					$("#CuadroJugadoresA").html('');
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
				$(r['JugadoresINI']).each(function(i, v)
				{ // indice,0 valor
					//if(v.Libero != null)
					//		alert('ES NULL !!!! '+ v.Libero);
              		puestoPosta=0;
//	if(v.secuencia == 1)					
				if (! $('#canchaA').find("div[value='" + v.nombre + "']").length){

						
						var selecter='';
						 
						switch(v.posicion) {
						  case "1":
						    // code block
								selecter='<div class="itemcjug2_1 redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_"   >'+v.posicion+'</div>';
						    break;
						  case "2":
								selecter='<div class="itemcjug2_2 redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_"   >'+v.posicion+'</div>';						  
						    // code block
						    break;
						  case "3":
								selecter='<div class="itemcjug2_3 redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_"   >'+v.posicion+'</div>';						  
						    // code block
						    break;
						   case "4":
								selecter='<div class="itemcjug2_4 redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_"   >'+v.posicion+'</div>';						   
						    // code block
						    break;
						  case "5":
								selecter='<div class="itemcjug2_5 redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_"   >'+v.posicion+'</div>';						  
						    // code block
							    break;
						 case "6":
								selecter='<div class="itemcjug2_6 redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_"   >'+v.posicion+'</div>';						 
						    // code block
						    break;
						  default:
						  			selecter='<div class="itemcjug2_7 redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_7" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_7" >Sup</div>';
						    // code block
						   }
						//CARGAR GRILLA DE LIBEROS
						//	alert(v.nombre+ ' puesto por default: '+v.puestoxcat + ' se cambio por:  ' +v.puesto );
						 puestoPosta =v.puestoxcat;	
						 puestoCategoria=v.puestoxcat;
						if(v.puestoxcat != v.puesto) puestoPosta = v.puesto;
						
						if(puestoPosta==2) // LIBERO
							if (! $('#liberos').find("div[value='" + v.nombre + "']").length){
									cont8+='<div class="itemL"  value="'+v.nombre +'"   >'+v.nombre +'('+v.numero+')' +'</div>';
							}
						//CARGAR GRILLA DE LIBEROS
						botonPuestos = "";
						botonNewPuesto="";
						//CARGAR INDICADOR DE PUESTO ACTUAL 
						botonCentral='';	
						// ES PUNTA
						if(puestoPosta == 4)						
						{
							//contador++;
							//alert(v.nombre+ ' ES UN ARMADOR, POR '+contador+ ' VEZ' );
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="punta" class="itemcjug4 punta" title="marcar central al jugador" >{P}</button>';
						}
						
						// ES CENTRAL
						if(puestoPosta == 6){
							//alert(v.nombre+ ' ES UN central ' );
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="central" class="itemcjug4 central" title="marcar central al jugador" >{C}</button>';
						}						
						
						if(puestoPosta == 3)	//ARMADOR..					
						{
							//contador++;
							//alert(v.nombre+ ' ES UN ARMADOR, POR '+contador+ ' VEZ' );
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="armador" class="itemcjug4 armador" title="marcar armador al jugador" >{a}</button>';							
						}
						if(puestoPosta == 5)	//OPUESTO..
						{
							//alert(v.nombre+ ' ES UN opuesto ' );							
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="opuesto" class="itemcjug4 opuesto" title="marcar opuesto al jugador" >{o}</button>';
						}					

						if(puestoPosta == 2){	//libero..
							//alert(v.nombre+ ' es un libero ' );
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="libero" class="itemcjug4 libero" title="marcar opuesto al jugador" >{L}</button>';
						}	
						//CARGAR INDICADOR DE PUESTO ACTUAL 						
						var nombreData = v.nombre;
						if(v.FechaEgreso != null)
							nombreData = v.nombre + ' (BAJA)';
							
						$("#CuadroJugadoresA").append(
						'<div id="pos_'+v.idjugador+'" name="pos_'+v.idjugador+'" class="gridConfigJug">'+
				   	   '<div class="itemcnfju1">'+
				   	  	'<span class="itemcjug1 NumeroJugador">'+v.numero+'</span>'+
				   	  	'<span class="itemcjug2  nombreJugador">'+nombreData+'</span>'+
						botonPuestos +
			  	    	botonCentral+
			  	    	botonNewPuesto+'</div>'+
				   	  	'<div class="itemcnfju2" >'+
							selecter+				   	  														  
				   	  	'</div>'+
				   	  '</div>');
					//alert(v.posicion);	
					switch(v.posicion)
					{
						case "1" :	
									stringcontenido += '<div id="canchaa1"  class="gridcanchaBetaA" value="'+v.nombre+'">POS 1 '+v.nombre +'('+v.numero+')' +'</div>';
									break;
						case "2" :
									stringcontenido += '<div id="canchaa2"  class="gridcanchaBetaB">POS 2 '+v.nombre +'('+v.numero+')' +'</div>';
									break;
						case "3" :
									stringcontenido += '<div id="canchaa3"  class="gridcanchaBetaC">POS 3 '+v.nombre +'('+v.numero+')' +'</div>';
									break;
						case "4" :
									stringcontenido += '<div id="canchaa4"  class="gridcanchaBetaD">POS 4 '+v.nombre +'('+v.numero+')' +'</div>';
									break;
						case "5" :
									stringcontenido += '<div id="canchaa5"  class="gridcanchaBetaE">POS 5 '+v.nombre +'('+v.numero+')' +'</div>';
									break;
						case "6" :
									stringcontenido += '<div id="canchaa6"  class="gridcanchaBetaF">POS 6 '+v.nombre +'('+v.numero+')' +'</div>';
									break;
						case "7" :
									//$("#canchaA").append();
									break;
 					   };
 					   	
				    }
				  });// EACH ENLD JUGADORES POSICIONES INICIALES DEL SET EN VISUALIZAR
				};	 	
				$(r['Jugadores']).each(function(i, v)
				{ // indice,0 valor
					//if(v.Libero != null)
					//		alert('ES NULL !!!! '+ v.Libero);
              		puestoPosta=0;
//	if(v.secuencia == 1)					
				if (! $('#canchaA').find("div[value='" + v.nombre + "']").length){

						
						var selecter='';
							var Activado = ' onclick="enviapos(this);" ';
							if(v.FechaEgreso != null)
								var Activado = ' onclick="alert(\'Jugador no disponible\');" ';
								
							if(v.posicion==1) selecter+='<div class="itemcjug2_1 redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_1" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_1"  value="1" label="1" '+Activado+' >1</div>'
							else selecter+='<div class="itemcjug2_1 redondo"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_1" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_1"  value="1" label="1" '+Activado+' >1</div>';
							
							if(v.posicion==2) selecter+='<div class="itemcjug2_2 redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_2" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_2"   value="2" label="2" '+Activado+' >2</div>';
							else selecter+='<div class="itemcjug2_2 redondo"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_2" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_2"   value="2" label="2" '+Activado+' >2</div>';
							
							if(v.posicion==3) selecter+='<div class="itemcjug2_3 redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_3" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_3"  value="3" label="3" '+Activado+' >3</div>';
							else selecter+='<div class="itemcjug2_3 redondo"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_3" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_3"  value="3" label="3" '+Activado+' >3</div>';
							
							if(v.posicion==4) selecter+='<div class="itemcjug2_4 redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_4" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_4"   value="4" label="4" '+Activado+' >4</div>';
							else selecter+='<div class="itemcjug2_4 redondo"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_4" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_4"   value="4" label="4" '+Activado+' >4</div>';
							
							if(v.posicion==5) selecter+='<div class="itemcjug2_5 redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_5" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_5"  value="5" label="5" '+Activado+' >5</div>';
							else selecter+='<div class="itemcjug2_5 redondo"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_5" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_5"  value="5" label="5" '+Activado+' >5</div>';
							
							if(v.posicion==6) selecter+='<div class="itemcjug2_6 redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_6" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_6"   value="6" label="6" '+Activado+' >6</div>';
							else selecter+='<div class="itemcjug2_6 redondo"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_6" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_6"   value="6" label="6" '+Activado+' >6</div>';
							
							if(v.posicion==7) selecter+='<div class="itemcjug2_7 redondo Grisado"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_7" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_7"   value="7" label="7" '+Activado+' >Sup</div>';
							else selecter+='<div class="itemcjug2_7 redondo"   id="jugadorubi_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'_7" name="jugadorubi_'+v.idclub+'_'+v.idjugador+'_7"   value="7" label="7" '+Activado+' >Sup</div>';
							
						
						
						//CARGAR GRILLA DE LIBEROS
						//	alert(v.nombre+ ' puesto por default: '+v.puestoxcat + ' se cambio por:  ' +v.puesto );

						 puestoPosta =v.puestoxcat;	
						 puestoCategoria=v.puestoxcat;
						if(v.puestoxcat != v.puesto) puestoPosta = v.puesto;
						
						if(puestoPosta==2) // LIBERO
							if (! $('#liberos').find("div[value='" + v.nombre + "']").length){
									cont8+='<div class="itemL"  value="'+v.nombre +'"   >'+v.nombre +'('+v.numero+')' +'</div>';
							}
						//CARGAR GRILLA DE LIBEROS
						
						botonPuestos = '<select class="itemcjug3" id=\'sjugadorp_'+v.idjugador+'\' name=\'sjugadorp_'+v.idjugador+'\' disabled="true" ></select>'+creaspuestos(v.idjugador,puestoCategoria,'sjugadorp');
						botonNewPuesto = '<select class="itemcjug5" id=\'jugadorpuesto_'+v.idjugador+'\' name=\'jugadorpuesto_'+v.idjugador+'\' ></select>'+creaspuestos(v.idjugador,puestoPosta,'jugadorpuesto');

						//CARGAR INDICADOR DE PUESTO ACTUAL 
						botonCentral='';
						clasePuesto = '';	
						// ES PUNTA
						if(puestoPosta == 4)						
						{
							//contador++;
							//alert(v.nombre+ ' ES UN ARMADOR, POR '+contador+ ' VEZ' );
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="punta" class="itemcjug4 punta" title="marcar central al jugador" onclick="alert(this.id);">{P}</button>';
						}
						
						// ES CENTRAL
						if(puestoPosta == 6){
							//alert(v.nombre+ ' ES UN central ' );
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="central" class="itemcjug4 central" title="marcar central al jugador" onclick="alert(this.id);">{C}</button>';
							clasePuesto= 'colorCentral';
						}						
						
						if(puestoPosta == 3)	//ARMADOR..					
						{
							//contador++;
							//alert(v.nombre+ ' ES UN ARMADOR, POR '+contador+ ' VEZ' );
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="armador" class="itemcjug4 armador" title="marcar armador al jugador" onclick="alert(this.id);">{a}</button>';							clasePuesto= 'colorArmador';
						}
						if(puestoPosta == 5)	//OPUESTO..
						{
							//alert(v.nombre+ ' ES UN opuesto ' );							
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="opuesto" class="itemcjug4 opuesto" title="marcar opuesto al jugador" onclick="alert(this.id);">{o}</button>';
							clasePuesto= 'colorOpuesto';
						}					

						if(puestoPosta == 2){	//libero..
							//alert(v.nombre+ ' es un libero ' );
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="libero" class="itemcjug4 libero" title="marcar opuesto al jugador" onclick="alert(this.id);">{L}</button>';
						}	
						//CARGAR INDICADOR DE PUESTO ACTUAL 						
						var nombreData = v.nombre;
						if(v.FechaEgreso != null)
							nombreData = v.nombre + ' (BAJA)';
						//CONFIGURACION DE CADA JUGADOR PREVIA ELECCION
						if(v.FechaEgreso == null){
						$("#CuadroJugadoresA").append(
						'<div id="pos_'+v.idjugador+'" name="pos_'+v.idjugador+'" class="gridConfigJug">'+
				   	   '<div class="itemcnfju1">'+
				   	  	'<span class="itemcjug1 NumeroJugador">'+v.numero+'</span>'+
				   	  	'<span class="itemcjug2  nombreJugador">'+nombreData+'</span>'+
						botonPuestos +
			  	    	botonCentral+
			  	    	botonNewPuesto+'</div>'+
				   	  	'<div class="itemcnfju2">'+
							selecter+				   	  															   	  	'</div>'+
				   	  '</div>');
						}
					//alert(v.posicion);	
					switch(v.posicion)
					{
						case "1" :	
									stringcontenido += '<div id="canchaa1"  class="gridcanchaBetaA '
									+ clasePuesto +'" value="'+v.nombre+'">POS 1 '+v.nombre +'('+v.numero+')' +'</div>';
									
									break;
						case "2" :
									stringcontenido += '<div id="canchaa2"  class="gridcanchaBetaB '
									+ clasePuesto +'">POS 2 '+v.nombre +'('+v.numero+')' +'</div>';
									break;
						case "3" :
									stringcontenido += '<div id="canchaa3"  class="gridcanchaBetaC '
									+ clasePuesto +'">POS 3 '+v.nombre +'('+v.numero+')' +'</div>';
									break;
						case "4" :
									stringcontenido += '<div id="canchaa4"  class="gridcanchaBetaD '
									+ clasePuesto +'">POS 4 '+v.nombre +'('+v.numero+')' +'</div>';
									break;
						case "5" :
									stringcontenido += '<div id="canchaa5"  class="gridcanchaBetaE '
									+ clasePuesto +'">POS 5 '+v.nombre +'('+v.numero+')' +'</div>';
									break;
						case "6" :
									stringcontenido += '<div id="canchaa6"  class="gridcanchaBetaF '
									+ clasePuesto +'">POS 6 '+v.nombre +'('+v.numero+')' +'</div>';
									break;
						case "7" :
									//$("#canchaA").append();
									break;
 					   };
 					   	
				    }
				  });// EACH ENLD
				 }; 
				 $("#canchaA").html(stringcontenido);
				 $("#liberos").html(cont8);
				 if(r['todos']['0'].setjugok==0){ $("#cargaSetjugadores").prop('disabled', true);$("#cargaSetjugadores").prop('title', 'Se cargaron todos los jugadores seleccionados');$("#cargaSetjugadores").css('background', '#A9AAC5');  }; 
				  //console.log("todos: "+r['todos']);
				 	if(r['todos'] < 0){$("#MensajesError").append('NO SE CARGARON JUGADORES NI POSICIONES EN ESTE SET');  }
    			
 				 if($.urlParam('ver') == 'S')
							$("#itemcnf2").attr('disabled','disabled');
    			
    			
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

function enviapos(select_pos){
// obtener las claves desde el id
	var arraids = select_pos.id.split('_');
	var idclub = arraids[1] ;
	var idjugador = arraids[2];	  
	var categoria = arraids[3];
	var pos_nueva = arraids[4];

	 stringcontenido='';
					
	var puesto = $("#jugadorpuesto_"+idjugador).val(); 
	var nombrePuesto = $("#jugadorpuesto_"+idjugador+ ' option:selected').html() ;
//	alert($("#jugadorpuesto_"+idjugador));
	
	//alert('es el jugador :'+idjugador+' del club '+idclub+' de la categoria: '+categoria + ' y en puesto : ' +nombrePuesto);

	//alert('club: ' + idclub+' jugador: ' + idjugador+' categoria: ' + categoria+' posicion inicial: ' + pos_nueva+' nuevo puesto ' + puesto + '( '+nombrePuesto+' )');

	var parametros =
		{
	    "idpartido" : $.urlParam('idpartido'),
		"iclubescab" : idclub,
		"icatcab" : categoria,
		"fechapartido": <?php echo("'".$_GET['fecha']."'");?>,
		"jugador":idjugador,
		"posicion":pos_nueva,
		"puestoSet": puesto,
		"setdata" : $.urlParam('set'),
		"horas"     : $("#stopwatch").text()
		};

	
	 $.ajax({ 
		url:   './abms/inserta_jugador_set.php',
		type:  'POST',
		data: parametros,
		dataType: 'text json',
		// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
		beforeSend: function (){
			
		},
		done: function(data){
				
		},
		success:  function (r){
		$("#canchaA").empty('');
		$("#CuadroJugadoresA").empty('');
		var anio = $("#ianio").val();	
			var params00 = 
	 		{
	 			"idpartido" : $.urlParam('idpartido'),
				"iclubescab" : idclub,
				"fechapartido": <?php echo("'".$_GET['fecha']."'");?>,
				"anioEquipo" : anio,
				"setdata" : $.urlParam('set'),
				"categoriapartido" : $.urlParam('idcate')
			};
	 	$.ajax({ 
			url:   './abms/obtener_jugpartido2.php',
			type:  'GET',
			data: params00,
			dataType: 'text json',
		// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
			beforeSend: function (){
				
			},
			done: function(data){
				
				//console.log('se limpio la cancha..');			
			},
			success:  function (r){
				//location.reload();
				cargarDatosJugadores();
			},// SUCCESS	
		 error: function (xhr, ajaxOptions, thrownError) {
		// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
		console.log(thrownError);
		console.log(xhr.responseText);
		}// fin ERROR:FUNCT
		});	//ajax
		}, //succes del alta
		error: function (xhr, ajaxOptions, thrownError) {
	// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			console.log(thrownError);
			console.log(xhr.responseText);
		}// fin ERROR:FUNCT
		}); // FIN funcion ajax JUGASPARTIDO..			
	
};
		
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
			
			//$("#ianio").val($.urlParam('anio'));
			
			esVisualizar= $.urlParam('ver');
			if(esVisualizar=='S')
			{ 
					$("#cargaSetjugadores").prop('disabled', true);
					$("#cargaSetjugadores").css('background', '#A9AAC5');  
					
					$("#borraSetjugadores").prop('disabled', true); 
					$("#borraSetjugadores").css('background', '#A9AAC5');  
			};
			
			
// camnbior por cargar jugadores..			
		$("#cargaSetjugadores").on("click",function(e){
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
					else
					{
			    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
			            url:   './abms/insertar_jugadores_sets.php',
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
						
					}
            },
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA				
					console.log(thrownError);
               }
		   	});

/*

*/				
		});	
		
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
		<a href="index.php"><img  class="LogoApp" alt="VOLLEY.app" src="./img/textovolleyAPP_pequeno.png" /></a>
	</section>	
</header>
   <div class="ControlesPosicion21_2 ">
	 <div class="control1"><select id="ianio" name="ianio" class="ianio">
			<option value="9999">Seleccionar año...</option>
		  </select>
	 </div>
	 <div class="control2"><button id="volver" name="altajug" class="altajug" title="agregar registros"><<</button></div>
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
   	  <section id="CuadroJugadoresA" name="CuadroJugadoresA" class="CuadroJugadores_2 "></section>
</div>

</body>

</html>
