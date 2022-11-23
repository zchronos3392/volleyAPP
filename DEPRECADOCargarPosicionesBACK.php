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

function creaspuestos(idjugador,puesto){
	//alert(puesto);
	//alert(idjugador);
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
                		$("#sjugadorp_"+idjugador).append('<option value="' + v.idPosicion + '" label="'+v.nombre+'" selected>' +v.nombre +'</option>');
                	else
						$("#sjugadorp_"+idjugador).append('<option value="' + v.idPosicion + '" label="'+v.nombre+'">' +v.nombre +'</option>');

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
	 stringcontenido='';
	var puesto = $("#sjugadorp_"+idjugador).val(); 
	//alert('es el jugador :'+idjugador+' del club '+idclub+' de la categoria: '+categoria + ' y en puesto : ' +puesto);
	var pos_inicial = select_pos.value;
	
	var parametros =
		{
	    "idpartido" : $.urlParam('idpartido'),
		"iclubescab" : idclub,
		"icatcab" : categoria,
		"fechapartido": <?php echo("'".$_GET['fecha']."'");?>,
		"jugador":idjugador,
		"posicion":pos_inicial,
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
		$("canchaA").empty('');
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
				location.reload();
			/*	
			if(r['estado']>0){
				$("#canchaA").html('');
				$("#liberos").html('');
				cont8='';
			$(r['Jugadores']).each(function(i, v)
			{ // indice,0 valor
				switch(v.posicion)
				{
					case "1" :	
								cont1= '<div id="canchaa1"  class="gridcanchaBetaA">POS 1 '+v.nombre+'('+v.numero+')' +'</div>';
								break;
					case "2" :
								cont2= '<div id="canchaa2"  class="gridcanchaBetaB">POS 2 '+v.nombre +'('+v.numero+')' +'</div>';
								break;
					case "3" :
								cont3= '<div id="canchaa3"  class="gridcanchaBetaC">POS 3 '+v.nombre +'('+v.numero+')' +'</div>';
								break;
					case "4" :
								cont4= '<div id="canchaa4"  class="gridcanchaBetaD">POS 4 '+v.nombre +'('+v.numero+')' +'</div>';
								break;
					case "5" :
								cont5= '<div id="canchaa5"  class="gridcanchaBetaE">POS 5 '+v.nombre +'('+v.numero+')' +'</div>';
								break;
					case "6" :
								cont6= '<div id="canchaa6"  class="gridcanchaBetaF">POS 6 '+v.nombre +'('+v.numero+')' +'</div>';
								break;
					case "7" :
								//$("#canchaA").append();
								break;
				};	

			if(v.puestoxcat == 2) // visualizar LIBERO segun PUESTO y no por posicion 8
					if (! $('#liberos').find("div[value='" + v.nombre + "']").length){
											cont8+='<div class="itemL"  value="'+v.nombre +'"   >'+v.nombre +'('+v.numero+')' +'</div>';
										}
								//$("#canchaA").append();
			  });// EACH ENLD
			 };//estado == 1
			 stringcontenido = cont1+cont2+cont3+cont4+cont5+cont6;	
			  $("#canchaA").html(stringcontenido);
			  $("#liberos").html(cont8);
*/		
		},// SUCCESS	
		 error: function (xhr, ajaxOptions, thrownError) {
		// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
		console.log(thrownError);
		console.log(xhr.responseText);
		}// fin ERROR:FUNCT
		});	
		},
		error: function (xhr, ajaxOptions, thrownError) {
	// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			console.log(thrownError);
			console.log(xhr.responseText);
		}// fin ERROR:FUNCT
		}); // FIN funcion ajax JUGASPARTIDO..			
	
};
		
		$(document).ready(function()
		{
			
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
			if(esVisualizar=='s')
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
			var partido = $.urlParam('idpartido'); // name
			var club = $.urlParam('idclub');        // 6
			var fecha = $.urlParam('fecha');   // null		
			// se agrega parametro del set?
			var setdata = $.urlParam('set');   // null	
			var anio = $("#ianio").val();
			var stringcontenido='';	
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
					$("canchaA").empty('');		
					//console.log('linea 165');	
				},
				success:  function (r){
/**
estado: 1
todos: [{setjugok: "0"}
	Libero: null
	categoria: "6"
	idclub: "55"
	idjugador: "1"
	nombre: "jugador_88"
	numero: "4"
	posicion: "7"
	puestoxcat: "8"
	secuencia: "2" <-- EL PRROBLEMA ESTA ACA, SOLO SE MUESTRA LA SECUENCIA 1...
	Y LAS SIGUIENTES?.............
	SELECT * FROM `vappjugpartido`
		WHERE idpartido=1 and Fecha='20210826'
			order by idpartido,Fecha, idclub, setnumero,secuencia; 
*/						
				cont8='';
				if(r['estado']>0){
					$("#canchaA").html('');
					$("#liberos").html('');
					cont8='';
				$(r['Jugadores']).each(function(i, v)
				{ // indice,0 valor
					//if(v.Libero != null)
					//		alert('ES NULL !!!! '+ v.Libero);
              	
//	if(v.secuencia == 1)					
				if (! $('#canchaA').find("div[value='" + v.nombre + "']").length){

						var selecter='';
						if($.urlParam('ver') == 's')
							selecter='<select id="ipos_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'" name="ipos_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'" disabled>';
						else
							selecter='<select id="ipos_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'" name="ipos_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'" onclick="enviapos(this);" onchange="enviapos(this);">';

							if(v.posicion==1) selecter+='<option value="1" selected>en 1</option>';
							else selecter+='<option value="1">en 1</option>';
							
							if(v.posicion==2) selecter+='<option value="2" selected>en 2</option>';
							else selecter+='<option value="2">en 2</option>';
							
							if(v.posicion==3) selecter+='<option value="3" selected>en 3</option>';
							else selecter+='<option value="3">en 3</option>';
							
							if(v.posicion==4) selecter+='<option value="4" selected>en 4</option>';
							else selecter+='<option value="4">en 4</option>';
							
							if(v.posicion==5) selecter+='<option value="5" selected>en 5</option>';
							else selecter+='<option value="5">en 5</option>';
							
							if(v.posicion==6) selecter+='<option value="6" selected>en 6</option>';
							else selecter+='<option value="6">en 6</option>';
							
							if(v.posicion==7) selecter+='<option value="7" selected>Suplente</option>';
							else selecter+='<option value="7">Suplente</option>';
							
//							if(v.puesto==8) selecter+='<option value="8" selected>Libero</option>';
//							else selecter+='<option value="8">Libero</option>';
						
							selecter+='</select>';
						var puestoPosta =v.puestoxcat;	
						if(v.puestoxcat != v.puesto) puestoPosta = v.puesto;
						
						if(puestoPosta==2) // LIBERO
							if (! $('#liberos').find("div[value='" + v.nombre + "']").length){
									cont8+='<div class="itemL"  value="'+v.nombre +'"   >'+v.nombre +'('+v.numero+')' +'</div>';
							}
  						
						
						botonCentral='';	
						// ES PUNTA
						if(puestoPosta == 4)						
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="punta" class="punta" title="marcar central al jugador" onclick="alert(this.id);">{P}</button>';
						
						// ES CENTRAL
						if(puestoPosta == 6)						
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="central" class="central" title="marcar central al jugador" onclick="alert(this.id);">{C}</button>';
						
						if(puestoPosta == 3)	//ARMADOR..					
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="armador" class="armador" title="marcar armador al jugador" onclick="alert(this.id);">{a}</button>';

						if(puestoPosta == 5)	//OPUESTO..					
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="opuesto" class="opuesto" title="marcar opuesto al jugador" onclick="alert(this.id);">{o}</button>';

						if(puestoPosta == 2)	//libero..					
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="libero" class="libero" title="marcar opuesto al jugador" onclick="alert(this.id);">{L}</button>';

							
						botonPuestos = '<select id=\'sjugadorp_'+v.idjugador+'\' name=\'sjugadorp_'+v.idjugador+'\' ></select>'+creaspuestos(v.idjugador,puestoPosta);
						//'('+v.nombre+')'+
						$("#CuadroJugadoresA").append('<div id="pos_'+v.idjugador+'" name="pos_'+v.idjugador+'" class="item" '+
						'  >'+
						'<span class="NumeroJugador">'+v.numero+'</span>'+
						'<span class="nombreJugador">'+v.nombre+'</span>'+
						selecter+
						botonPuestos+botonCentral+
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
				  });// EACH ENLD
				 }; 
				 $("#canchaA").html(stringcontenido);
				 $("#liberos").html(cont8);
				 if(r['todos']['0'].setjugok==0){ $("#cargaSetjugadores").prop('disabled', true);$("#cargaSetjugadores").prop('title', 'Se cargaron todos los jugadores seleccionados');$("#cargaSetjugadores").css('background', '#A9AAC5');  }; 
				  //console.log("todos: "+r['todos']);
				 	if(r['todos'] < 0){$("#MensajesError").append('NO SE CARGARON JUGADORES NI POSICIONES EN ESTE SET');  }
    			},// SUCCESS	
			 error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
					//console.log('linea 237 '+thrownError);
					console.log('linea 495 '+xhr.responseText);
			}// fin ERROR:FUNCT
			}); // FIN funcion ajax JUGASPARTIDO..

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
								if(clubParm == iclubA) $("#clubNombre").val(v.ClubA);
								if(clubParm == iclubB) $("#clubNombre").val(v.ClubB);
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
<header class="headerIngreso">
	<section class="LogoApp" style="z-index: 0;">
		<a href="index.php"><img  class="LogoApp" alt="VOLLEY.app" src="./img/textovolleyAPP_pequeno.png" /></a>
	</section>	
</header>

   <div class="ControlesPosicion21">
	 <div class="control1"><select id="ianio" name="ianio" class="ianio">
			<option value="9999">Seleccionar año...</option>
		  </select>
	 </div>
	 <div class="control2"><button id="volver" name="altajug" class="altajug" title="agregar registros"><<</button></div>
	 <div class="control3"><button id="cargaSetjugadores" name="altajug" class="altajugsetpartido" title="Trae lista jugadores">(+)</button></div>
	 <div class="control4"><button id="borraSetjugadores" name="bajajugs" class="bajajugsetpartido" title="Borrar">(Del)</button></div>	 		

	 <div class="control5">Club</div>
	 <div class="control6"><input id="clubNombre" name="clubNombre"	disabled /> </div>
	 <div class="control7">Categoria</div>
	 <div class="control8"><input id="categoria" name="categoria"  disabled />  </div>	 		


   </div>	
  <section id="MensajesError" name="MensajesError" class=""></section>
   
  <section id="CuadroJugadoresA" name="CuadroJugadoresA" class="CuadroJugadores MARGENTOP1"></section>
<div id="liberos" class="LIBEROS"></div>	
<div id="canchaA" class="canchaBeta"></div>

</body>

</html>
