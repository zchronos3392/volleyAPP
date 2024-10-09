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
		
		<script type="text/javascript">
		
					// FUNCION PARA DETECTAR GANADORES AUTOMATICAMENTE REARMADA DESDE EXCEL..
			function DetectarGanador(resA,resB,clubA,clubB,valtiebreak)
			{
			var diferencia = 0;
			var maxPuntaje = 0;
			
			if(resA >= resB)
			{ // INICIO IF
			  // resA es MAYOR O IGUAL 
			  if(resA >=valtiebreak)
			   {
				 diferencia = resA - resB;
				 if(diferencia >=2)
				 {
				 	//alert(clubA + " - (a) wins the set");
				 	cerrarSet();
				 };	
			   }
			} // FIN DEL IF
			else
			{  // RESB ES MAYOR
			  if(resB >=valtiebreak)
			   {
				 diferencia = resB - resA;
				 if(diferencia >=2)
				 {
				 	//alert(clubB + " (b) wins the set");
				 	cerrarSet();
				 };	
			   }
			}; // fin del ELSE
			}; // FIN DE LA FUNCION		
		
		function  cerrarSet()
		{ // esta funcion cierra el set y vuelve a la pagina de CargaSets
			var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text()
			 };
			$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/cerrarsetdata.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
			
            },
            success:  function (r){
            	// volver a PAGINA DE SETS: CSets2.php
            	var partido = $("#partidoid").val();
				var fechapart = $("#fecha").text();
            	// COMENTO ESTO PARA QUE NO SE VAYA EL ERROR..
            	location.href = href='CSets2.php?id='+partido+'&setmax=<?php echo($_GET['setmax']); ?>'+'&fecha='+fechapart;
			},
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
            }
            }); // FIN funcion ajax
            
		};
		
		function enviarJugada(resa01,resa02)
		{
		
   		var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"resa"      : resa01,
    			"resb"      : resa02,
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text()
			 };
    		
    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertarsetdata.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
			
            },
            success:  function (r){
				var clubadetc = $("#idcluba").val();
				var clubbdetc = $("#idclubb").val();
				// porque necesito tener grabado el ultimo punto para controlar..
				var valtiebreak = 25;
				if($("#setmax").val() == $("#setactual").val()) valtiebreak= 15;
				//alert($("#setmax").val());
				//alert($("#setactual").val());
				
				DetectarGanador(resa01,resa02,clubadetc,clubbdetc,valtiebreak);
			},
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
            }
            }); // FIN funcion ajax
		};
		
		$(document).ready(function(){
		
		$("#popupAltaPosI").animate({
        		    width: "toggle"
			},0);
    			
			var iclubescab1 = 0;
			var iclubescab2 = 0;
			var icatcab1    = 0 ;

//			$("#incremA").prop('disabled', true);
//			$("#incremB").prop('disabled', true);
//			$("#decremA").prop('disabled', true);
//			$("#decremB").prop('disabled', true);

/* CARGA CAEBECERA DEL set*/
			<?php $idpartido = $_GET['id']; ?>
			var idpartido = <?php echo $idpartido;?>;
				var parametros = {"id" : idpartido,"fechapart" : <?php echo($_GET['fecha']);?> };
				$.ajax({ 
						url:   './abms/obtener_partidos.php',
						type:  'GET',
						data: parametros,
						dataType: 'text json',
						// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
						beforeSend: function (){
							
						},
						done: function(data){
								
						},
						success:  function (r){
							$(r['Partido']).each(function(i, v)
							{ // indice,0 valor
								$("#partidoCancha").text(v.cancha);
								$("#competencia").text(v.cnombre);
								$("#fecha").text(v.Fecha);

								$("#categoria").text(v.DescCate);
								$("#categoria").append('<input id="idcat" type="hidden" value="'+v.idcat+'"/>');
								icatcab1 = v.idcat;
								$("#nomA").text(v.ClubA);
								$("#jugATitulo").text(v.ClubA);
								$("#nomA").append('<input id="idcluba" type="hidden" value="'+v.idcluba+'"/></div>');
								iclubescab1 = v.idcluba;
								$("#nomB").text(v.ClubB);
								$("#jugBTitulo").text(v.ClubB);
								$("#nomB").append('<input id="idclubb" type="hidden" value="'+v.idclubb+'"/>');
								iclubescab2 = v.idclubb ;
								$("#setmax").text(v.setsnmax);								
							});
						},
						 error: function (xhr, ajaxOptions, thrownError) {
						// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						console.log(thrownError);
						console.log(xhr.responseText);
						}
				}); // FIN funcion ajax equipo

		
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
					
			
			
		 var resA = 0;
		 var resB = 0;
		  			
		$("#incremA").click(function(){
			var resa01 = $("#resa").text();
			resa01++;
			$("#resa").text(resa01);
			enviarJugada(resa01,0);
    	});
    	
    	$("#decremA").click(function(){
			var resa01 = $("#resa").text();
			if(resa01 > 1) resa01--;
			else resa01 = 0;
			$("#resa").text(resa01);
			//enviarJugada(resa01,0);
    	});		
    
		$("#incremB").click(function(){
			var resa02 = $("#resb").text();
			resa02++;
			$("#resb").text(resa02);
			enviarJugada(0,resa02);
    	});
    	
    	$("#decremB").click(function(){
			var resa02 = $("#resb").text();
			if(resa02 > 1) resa02--;
			else resa02 = 0;
			
			$("#resb").text(resa02);
			//enviarJugada(0,resa02);
    	});
    	
    	$("#CierraSet").click(function(){
				cerrarSet();
    	});

		$("#jugadoresA").click(function(){
			var clubaid = $("#idcluba").val();
			window.location='CargarJugadores.php?idpartido='+<?php echo $idpartido; ?>+'&idclub='+clubaid+'&fecha='+<?php echo($_GET['fecha']);?>;
		});


/*	carga jugadores de AMBOS EQUIPOS en la grilla */
    	$("#posicionesA").click(function(){
    		/*ACA CARGO LA PANTALLA*/	
			var parametros = {"iclubescab1" : iclubescab1,"icatcab1" : icatcab1};
	/*	carga jugadores del equipo A en la grilla */
				$.ajax({ 
				url:   './abms/obtener_jugadores.php',
				type:  'GET',
				data: parametros,
				dataType: 'text json',
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
				beforeSend: function (){
					$("#jugA").empty('');
				},
				done: function(data){
						
				},
				success:  function (r){
					$("#jugATitulo").append('<input type="checkbox" id="saqueA" name="saqueA" value="0" onclick="QuienSaque(1);"></input>');
	
					$(r['Jugadores']).each(function(i, v)
					{ // indice,0 valor
			$("#jugA").append(
		'<section id="regridjug" class="regridjugPop">'+
			'<div name="" id="" class="regjug"><input type="hidden" value="'+v.idjugador+'" name="idjuga"></input><input type="text" id="numeroA" name="numeroA" value="'+v.numero+'" readonly></input></div>'+
			'<div name="" id="" class="regjug"><input type="text" id="nombreA" name="nombreA" value="'+v.nombre+'" readonly></input></div>'+
			'<div name="" id="" class="regjug">'+

'<section id="grillaPosiciones">'+	
    	'<div id="gridPos" name="gridPos" class="gridPos">'+
			'<div id="gridposelem" class="gridposelem">'+
				'<div id="valorGrid" name="valorGrid" class="valorGrid">'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid">1</div>'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid"><input type="radio" name="posisa'+v.idjugador+'" value="i"></input></div>'+
				'</div>'+
			'</div>'+
			'<div id="gridposelem" class="gridposelem">'+
				'<div id="valorGrid" name="valorGrid" class="valorGrid">'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid">2</div>'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid"><input type="radio" name="posisa'+v.idjugador+'" value="ii"></input></div>'+
				'</div>'+
			'</div>'+
			'<div id="gridposelem" class="gridposelem">'+
				'<div id="valorGrid" name="valorGrid" class="valorGrid">'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid">3</div>'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid"><input type="radio" name="posisa'+v.idjugador+'" value="iii"></input></div>'+
				'</div>'+
			'</div>'+
						
			'<div id="gridposelem" class="gridposelem">'+
				'<div id="valorGrid" name="valorGrid" class="valorGrid">'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid">4</div>'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid"><input type="radio" name="posisa'+v.idjugador+'" value="iv"></input></div>'+
				'</div>'+
			'</div>'+
				
			'<div id="gridposelem" class="gridposelem">'+
				'<div id="valorGrid" name="valorGrid" class="valorGrid">'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid">5</div>'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid"><input type="radio" name="posisa'+v.idjugador+'" value="v"></input></div>'+
				'</div>'+
			'</div>	'+
						
			'<div id="gridposelem" class="gridposelem">'+
				'<div id="valorGrid" name="valorGrid" class="valorGrid">'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid">6</div>'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid"><input type="radio" name="posisa'+v.idjugador+'" value="vi"></input></div>'+
				'</div>'+
			'</div>'+
			'<div id="gridposelem" class="gridposelem">'+
				'<div id="valorGrid" name="valorGrid" class="valorGrid">'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid">00</div>'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid"><input type="radio" name="posisa'+v.idjugador+'" value="00"></input></div>'+
				'</div>'+
			'</div>'+
			'<div id="gridposelem" class="gridposelem">'+
				'<div id="valorGrid" name="valorGrid" class="valorGrid">'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid">Lib</div>'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid"><input type="radio" name="posisa'+v.idjugador+'" value="Lib"></input></div>'+
				'</div>'+
			'</div>'+
			'<div id="gridposelem" class="gridposelem">'+
				'<div id="valorGrid" name="valorGrid" class="valorGrid">'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid">Sup</div>'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid"><input type="radio" name="posisa'+v.idjugador+'" value="Sup"></input></div>'+
				'</div>'+
			'</div>		'+	

			'</div></section>');
					});
				},
				 error: function (xhr, ajaxOptions, thrownError) {
				// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				console.log(thrownError);
				console.log(xhr.responseText);
				}
				}); // FIN funcion ajax
	/*	FIN :: carga jugadores del equipo A en la grilla */
	/*  cargo jugadores del equipo B */
    		var parametros = {"iclubescab1" : iclubescab2,"icatcab1" : icatcab1};
				$.ajax({ 
				url:   './abms/obtener_jugadores.php',
				type:  'GET',
				data: parametros,
				dataType: 'text json',
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
				beforeSend: function (){
					$("#jugB").empty('');
				},
				done: function(data){
						
				},
				success:  function (r){
					
					$("#jugBTitulo").append('<input type="checkbox" id="saqueB" name="saqueB" value="0" onclick="QuienSaque(2);"></input>');
					$(r['Jugadores']).each(function(i, v)
					{ // indice,0 valor
			$("#jugB").append(
		'<section id="regridjug" class="regridjugPop">'+
			'<div name="" id="" class="regjug"><input type="hidden" value="'+v.idjugador+'" name="idjugb"></input><input type="text" id="numeroB" name="numeroB" value="'+v.numero+'" readonly></input></div>'+
			'<div name="" id="" class="regjug"><input type="text" id="nombreB" name="nombreB" value="'+v.nombre+'" readonly></input></div>'+
			'<div name="" id="" class="regjug">'+

'<section id="grillaPosiciones">'+	
    	'<div id="gridPos" name="gridPos" class="gridPos">'+
			'<div id="gridposelem" class="gridposelem">'+
				'<div id="valorGrid" name="valorGrid" class="valorGrid">'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid">1</div>'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid"><input type="radio" name="posisb'+v.idjugador+'" value="i"></input></div>'+
				'</div>'+
			'</div>'+
			'<div id="gridposelem" class="gridposelem">'+
				'<div id="valorGrid" name="valorGrid" class="valorGrid">'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid">2</div>'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid"><input type="radio" name="posisb'+v.idjugador+'" value="ii"></input></div>'+
				'</div>'+
			'</div>'+
			'<div id="gridposelem" class="gridposelem">'+
				'<div id="valorGrid" name="valorGrid" class="valorGrid">'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid">3</div>'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid"><input type="radio" name="posisb'+v.idjugador+'" value="iii"></input></div>'+
				'</div>'+
			'</div>'+
						
			'<div id="gridposelem" class="gridposelem">'+
				'<div id="valorGrid" name="valorGrid" class="valorGrid">'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid">4</div>'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid"><input type="radio" name="posisb'+v.idjugador+'" value="iv"></input></div>'+
				'</div>'+
			'</div>'+
				
			'<div id="gridposelem" class="gridposelem">'+
				'<div id="valorGrid" name="valorGrid" class="valorGrid">'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid">5</div>'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid"><input type="radio" name="posisb'+v.idjugador+'" value="v"></input></div>'+
				'</div>'+
			'</div>	'+
						
			'<div id="gridposelem" class="gridposelem">'+
				'<div id="valorGrid" name="valorGrid" class="valorGrid">'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid">6</div>'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid"><input type="radio" name="posisb'+v.idjugador+'" value="vi"></input></div>'+
				'</div>'+
			'</div>'+
			'<div id="gridposelem" class="gridposelem">'+
				'<div id="valorGrid" name="valorGrid" class="valorGrid">'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid">00</div>'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid"><input type="radio" name="posisb'+v.idjugador+'" value="00"></input></div>'+
				'</div>'+
			'</div>'+
			'<div id="gridposelem" class="gridposelem">'+
				'<div id="valorGrid" name="valorGrid" class="valorGrid">'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid">Lib</div>'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid"><input type="radio" name="posisb'+v.idjugador+'" value="Lib"></input></div>'+
				'</div>'+
			'</div>'+
			'<div id="gridposelem" class="gridposelem">'+
				'<div id="valorGrid" name="valorGrid" class="valorGrid">'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid">Sup</div>'+
					'<div  id="valoresGrid" name="valoresGrid" class="valoresGrid"><input type="radio" name="posisb'+v.idjugador+'" value="Sup"></input></div>'+
				'</div>'+
			'</div>		'+	

			'</div></section>');
					});
				},
				 error: function (xhr, ajaxOptions, thrownError) {
				// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				console.log(thrownError);
				console.log(xhr.responseText);
				}
				}); // FIN funcion ajax
			/* FIN :: cargo jugadores del equipo B FIN */
			//$("#popupAltaPosI").removeClass('hidden');
		        $("#popupAltaPosI").animate({
        		    width: "show"
		            /*
		            width: "show"
		            width: "hide"
		            */
        },500);
    });			
			//$("#popupAltaPosI").addClass('fade-in');
    	});
/*	carga jugadores de AMBOS EQUIPOS en la grilla */

    	$("#cerrarPosA").click(function(){
			
			$("#popupAltaPosI").animate({
        		    width: "toggle"
    		},500);			
			
			var parms3 =
	    		 {
	    			"idpartido" : $("#partidoid").val(),
	    			"idset"     : $("#numSet").text(),
					"fechas"    : <?php echo($_GET['fecha']);?>
				 };
		    $.ajax({ 
				url:   './abms/obtener_set_partido.php',
				type:  'GET',
				data: parms3,
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
				beforeSend: function (){
					
				},
				done: function(data){
						
				},
				success:  function (r){
				if(r['estado'] != "0") {
					 $(r['Sets']).each(function(i, v)
					{ // indice,0 valor
						$("#canchaa1").text('En 1 - '+v.pa_1['jugx']); 
						$("#canchaa2").text('En 2 - '+v.pa_2['jugx']);
						$("#canchaa3").text('En 3 - '+v.pa_3['jugx']);
						$("#canchaa4").text('En 4 - '+v.pa_4['jugx']);
						$("#canchaa5").text('En 5 - '+v.pa_5['jugx']);
						$("#canchaa6").text('En 6 - '+v.pa_6['jugx']);
						$("#canchab1").text('En 1 - '+v.pb_1['jugx']);
						$("#canchab2").text('En 2 - '+v.pb_2['jugx']);
						$("#canchab3").text('En 3 - '+v.pb_3['jugx']);
						$("#canchab4").text('En 4 - '+v.pb_4['jugx']);
						$("#canchab5").text('En 5 - '+v.pb_5['jugx']);
						$("#canchab6").text('En 6 - '+v.pb_6['jugx']);
					});
				   }// fin estado != 0
				},
				 error: function (xhr, ajaxOptions, thrownError) {
				// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						console.log(thrownError);
						console.log(xhr.responseText);
				}
				}); // FIN funcion ajax equipo
						//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET	
		});// fin click cERRARpOSa							
		
		
    	$("#grabarPosA").click(function(){

    		var tagsA = new Array();
			$("#jugA").find("[name='idjuga']").each(
				function()
				{
					jugadorlineaid = $(this).val();
					texto = "input:radio[name='posisa"+jugadorlineaid+"']:checked";
					//input:radio[name=edad]:checked'
					// todos se llaman igual que el primero...
					if(! $(texto).val())
						//alert('Indefinido !!!! no lo seleccionaron');
						seleccion = '00';
					else
						seleccion=$(texto).val();	
						//alert(texto + '-> ' + $(texto).val());
					// busco para ese id, para posisa, el seleccionado y su valor..
					// busco para ese id, para posisa, el seleccionado y su valor..
					tagsA.push( $(this).val(),seleccion );
				}
			);
			
			var tagsB = new Array();
			$("#jugB").find("[name='idjugb']").each(
				function()
				{
					jugadorlineaid = $(this).val();
					texto = "input:radio[name='posisb"+jugadorlineaid+"']:checked";
					//input:radio[name=edad]:checked'
					// todos se llaman igual que el primero...
					if(! $(texto).val())
						//alert('Indefinido !!!! no lo seleccionaron');
						seleccion = '00';
					else
						seleccion=$(texto).val();	
						//alert(texto + '-> ' + $(texto).val());
					// busco para ese id, para posisa, el seleccionado y su valor..
					// busco para ese id, para posisa, el seleccionado y su valor..
					tagsB.push( $(this).val(),seleccion );
				}
			);



    		var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"resa"      : $("#resa").text(),
    			"resb"      : $("#resb").text(),
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text(),
    			"jugAIds"   : tagsA,
    			"jugBIds"   : tagsB,
    			"saque"    : $("#saqueA").val()
    		};
    		
			///funciona : alert(JSON.stringify(parametros));
			//alert(tagsA.toString());
//			alert(tagsB.toString());			
//    		 alert($("idjug[]").text());
    		//mandar por ajax a novedadSet
    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_sets.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#iclub").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			//$("#iclub").prop('disabled', false);
    			console.log(r);
//				$("#incremA").prop('disabled', false);
//				$("#incremB").prop('disabled', false);
//				$("#decremA").prop('disabled', false);
//				$("#decremB").prop('disabled', false);
				
				//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET
	    		var params2 =
	    		 {
	    			"idpartido" : $("#partidoid").val(),
	    			"idset"     : $("#numSet").text(),
					"fechas"    : <?php echo($_GET['fecha']);?>
	    		};
				
				$.ajax({ 
						url:   './abms/obtener_set_partido.php',
						type:  'GET',
						data: params2,
						dataType: 'json',
						// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
						beforeSend: function (){
							
						},
						done: function(data){
								
						},
						success:  function (r){
						if(r['estado'] != "0") {
							$(r['Sets']).each(function(i, v)
							{ // indice,0 valor
								$("#canchaa1").text('En 1- '+v.pa_1['jugx']); 
								$("#canchaa2").text('En 2 - '+v.pa_2['jugx']);
								$("#canchaa3").text('En 3 - '+v.pa_3['jugx']);
								$("#canchaa4").text('En 4 - '+v.pa_4['jugx']);
								$("#canchaa5").text('En 5 - '+v.pa_5['jugx']);
								$("#canchaa6").text('En 6 - '+v.pa_6['jugx']);
								$("#canchab1").text('En 1 - '+v.pb_1['jugx']);
								$("#canchab2").text('En 2 - '+v.pb_2['jugx']);
								$("#canchab3").text('En 3 - '+v.pb_3['jugx']);
								$("#canchab4").text('En 4 - '+v.pb_4['jugx']);
								$("#canchab5").text('En 5 - '+v.pb_5['jugx']);
								$("#canchab6").text('En 6 - '+v.pb_6['jugx']);							
							});
						  } // fin estado != 0	
					},
						 error: function (xhr, ajaxOptions, thrownError) {
						// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
								console.log(thrownError);
								console.log(xhr.responseText);
						}
						}); // FIN funcion ajax equipo
						//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET

            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#iclub").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
    		
    		// recargar tabla de jugadores A
    		//mandar por ajax a novedadSet
    		
			//$("#popupAltaPosI").removeClass('fade-in');
			//$("#popupAltaPosI").addClass('hidden');
			$("#popupAltaPosI").animate({
        		    width: "hide"
    		},500);
			//$("#lineaAltaJug").addClass('hidden');
			$("#lineaAltaJug").animate({
        		    width: "hide"
    		},500);
    	});
    	// detecta esc y cierra ventana de carga de jugadores
		$(document).keyup(function(event){
        	if(event.which==27)
        {
			$("#popupAltaPosI").animate({
        		    width: "toggle"
    		},500);
        }

		});// document,.ready 	
		
function QuienSaque(clubsaque)
{
	switch(clubsaque) {
		case 1: 
				//alert($("#idcluba").val());
				$("#saqueA").val($("#idcluba").val());
				break;
		case 2 :
				//alert($("#idclubb").val());
				$("#saqueA").val($("#idclubb").val());
				break;
	}
};
		
		</script>
    </head>
    <body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
		<?php ////include('includes/menuConfig.php');; 
			require('abms/Set.php'); 
 			  $idpartido = (int) $_GET['id'];
			  //$newset = Sett::ultSetNum($idpartido);
			  $idnewset = (int) $_GET['setid']; 
		
		?>	
    </header>
<section id="medioset" class="medioset">
    <section id="setcontrol" class="setcontrol">
    <div id="competencia"	class="setcontrolcol" >PARTIDO</div>
    <input id="partidoid" value="<?php echo $idpartido; ?>" type="hidden"/>
    <div id="partidoCancha"	class="setcontrolcol" >COMPETENCIA</div>
    <div id="categoria" class="setcontrolcol" >CATEGORIA<input id="idcat" type="hidden" value=""/></div>
    <div id="fecha" name="fecha" class="setcontrolcol" >FECHA - </div>

    <div class="setcontrolcol" >SET </div>
    <div id="numSet" class="setcontrolcol" ><?php echo($idnewset);?></div>
    <div class="setcontrolcol" ><span id="stopwatch"></span></div>
    <div id="partidoid" class="setcontrolcol" >
    	<a href="CSets.php?id=<?php echo $idpartido; ?>&setmax=<?php echo($_GET['setmax']); ?>&fecha=<?php echo($_GET['fecha']);?>"><input type="button" id="volver" title="volver a partidos" name="volver" class="btnSet" value="<<"></input></a>
	</div>
    </section>
    <section id="cronocontrolesCAB" class="cronocontrolesCAB">
    <div id="nomA" class="gridcolcab" >EQUIPO AAAAAAAAAAA<input id="idcluba" type="hidden" value=""/></div>
    <div id="nomB" class="gridcol">EQUIPO BBBBBBBBBBBB<input id="idclubb" type="hidden" value=""/></div>
    </section>
    <section id="botoneraAx" class="botoneraAx">
    	<div class="GridBotCol">
    		<input id="CierraSet" name="CierraSet" class="cerrar" type="button" value="X" />
    	</div>
    	<div class="GridBotCol">
    		<input type="hidden" id="setactual" value="<?php echo($idnewset); ?>"/><input type="hidden" id="setmax" value="<?php echo($_GET['setmax']); ?>"/>    	
    	</div>
    	<div class="GridBotCol"></div>
   </section>

<!--    <div class="gridcol" ><span id="stopwatch">00:00:00</span></div>-->
    <section id="cronocontroles" class="cronocontroles">
    <div class="gridcol"><input id="incremA" name="incremA" class="incremento" type="button" value="+" /></div>
    <div class="gridcol"><input id="decremA" name="decremA" class="decremento" type="button" value="-" /></div>
    <div class="gridcol"><input id="incremB" name="incremB" class="incremento" type="button" value="+" /></div>
	<div class="gridcol"><input id="decremB" name="decremB" class="decremento" type="button" value="-" /></div>

    <div class="gridcolEsp1" id="resa" name="resa">0</div>
    
    <div class="gridcolEsp2" id="resb" name="resb">0</div>
    <div class="gridcol"></div>
    </section>
<p>
    <section id="lineaAltaJug" class="cronocontrolesCAB">
    <!--<div id="lineaAltaJug" class="gridcolcab" >POSICIONES INICIALES DEL SET</div>-->
    <!-- Botón en HTML (lanza el modal en Bootstrap) -->
	<!--<a href="#victorModal" role="button" class="btn btn-large btn-primary" data-toggle="modal">Abrir ventana modal</a>-->
 		<button id="jugadoresA" name="jugadoresA" title="cargar jugadores equipo A" class="btnPop" >Jugadores Equipo Local</button>
		<button id="posicionesA" name="posicionesA" title="cargar posiciones equipo A" class="btnPop">POS INI. E.LOCAL</button>
		<button id="jugadoresB" name="jugadoresB" title="cargar jugadores equipo B" class="btnPop">Jugadores Equipo Visitante</button>
    	<button id="posicionesB" name="posicionesB" title="cargar posiciones equipo B" class="btnPop">POS INI. E.VISTANTE</button>		
    	   
    
    
    <div class="gridcol">
    	<button id="posicionesA" name="posicionesA" title="cargarJugadores equipo A" class="btnPop">POS INICIALES</button>
		
		<div id="popupAltaPosI" draggable="true" class="fade-in">
			<button id="cerrarPosA" name="cerrarPosA" class="btnPop">Cerrar</button>
			<button id="grabarPosA" name="grabarPosA" class="btnPop">Grabar Posiciones</button>				
			<div id="jugATitulo" ></div>
			<div id="jugA" ></div>	
			<hr />
			<div id="jugBTitulo" ></div>
			<div id="jugB"></div>
    	</div>
    </div>	
    </section>
	
    <section id="canchaA" class="cancha">
    <div id="canchaa5" class="gridcancha" >EN 5A - REMERA ##</div>
    <div id="canchaa4" class="gridcancha  bordeRight" >JUGADOR EN 4A - REMERA ##</div>
    <div id="canchaa6" class="gridcancha" >JUGADOR EN 6A - REMERA ##</div>
    <div id="canchaa3" class="gridcancha  bordeRight" >JUGADOR EN 3A - REMERA ##</div>
    <div id="canchaa1" class="gridcancha" >JUGADOR EN 1A - REMERA ##</div>
    <div id="canchaa2" class="gridcancha  bordeRight" >JUGADOR EN 2A - REMERA ##</div>
    </section>
</p>
<p>    
    <section id="canchaB" class="cancha">
    <div id="canchab4" class="gridcancha  bordeLeft" >JUGADOR EN 4B - REMERA ##</div>
    <div id="canchab5" class="gridcancha" >JUGADOR EN 5B - REMERA ##</div>
    <div id="canchab3" class="gridcancha  bordeLeft" >JUGADOR EN 3B - REMERA ##</div>
    <div id="canchab6" class="gridcancha" >JUGADOR EN 6B - REMERA ##</div>
    <div id="canchab2" class="gridcancha  bordeLeft" >JUGADOR EN 2B - REMERA ##</div>
    <div id="canchab1" class="gridcancha" >JUGADOR EN 1B - REMERA ##</div>
    </section>
</p>
</section> 


</body>
</html>

