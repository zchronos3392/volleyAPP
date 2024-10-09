<?php include('sesioner.php'); ?>
<html><head>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title></title>
	<!--SCRIPTS-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   	   		
	   	<link rel="stylesheet" href="./css/estiloCargaJugadores.css">
	   <style>
		.cambiosGrilla
		{
		   display:grid;
			grid-template-areas:
							'header header11 menu menu menu menu'
							'main main right right right right'
							'footer footer nombre nombre nombre nombre';
			grid-gap: 3px;
			background-color: #285d87;
			padding: 3px;
			margin-top: 3em;
		}						
		.cambiosGrilla > div {
				background-color:#5eb8f8cc;
				text-align: center;
				padding: 5px 0;
				font-size: 25px;
				color:white;
		}			
		
		.item1 { grid-area: header; background:#345;}
		.item11 { grid-area: header11; background:#345;}
		.item2 { grid-area: menu; }
		.item3 { grid-area: main;background:#345; }
		.item4 { grid-area: right; }
		.item5 { grid-area: footer; background:#345;}
		.item6 { grid-area: nombre; }
		
	   </style>
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

function enviapos(select_pos){
// obtener las claves desde el id
	var arraids = select_pos.id.split('_');
	var idclub = $.urlParam('idclub') ;
	var idjugador = arraids[1];	  
	var posicionumerica = arraids[2];
//			var categoria = $.urlParam();
	 stringcontenido='';
	//alert('es el jugador : '+idjugador+' del club '+idclub);
	//var pos_inicial = select_pos.value;

// jugador que se va : idjugador


	var parametros =
		{
	    "idpartido" : $.urlParam('idpartido'),
		"iclubescab" : $.urlParam('idclub'),
		"icatcab" : $("#icate").val(),
		"fechapartido": <?php echo("'".$_GET['fecha']."'");?>,
		"idjugadorEntra":idjugador,
		"idjugadorSale":$.urlParam('jugador'),
		"posenset":$.urlParam('pos'),
		"setnumero" : $.urlParam('set'),
		"horas"     : $("#stopwatch").text(),
		"posicion"  :posicionumerica
		};
		
	 $.ajax({ 
		url:   './abms/cambiar_jugador_partido.php',
		type:  'POST',
		data: parametros,
		dataType: 'text json',
		// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
		beforeSend: function (){
			
		},
		done: function(data){
				
		},
		success:  function (r)
		{
				$(location).attr('href','NovedadesSet.php?id='+$.urlParam('idpartido')+'&setid='+$.urlParam('set')+'&setmax='+$.urlParam('setmax')+'&fecha='+$.urlParam('fecha')+'&continuar=1&catP='+$.urlParam('catP'));
			//console.log(r);
	},// SUCCESS	
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(thrownError);
			console.log(xhr.responseText);
		}// fin ERROR:FUNCT
		}); // FIN funcion ajax JUGASPARTIDO..			

};
		
		$(document).ready(function()
		{
			var CategoriaGlobal=0;
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


		$("#volver").on("click",function(e){
			e.preventDefault();
			$(location).attr('href','NovedadesSet.php?id='+$.urlParam('idpartido')+'&setid='+$.urlParam('set')+'&setmax='+$.urlParam('setmax')+'&fecha='+$.urlParam('fecha')+'&continuar=1&catP='+$.urlParam('catP'));
		});	
			var partido = $.urlParam('idpartido'); // name
			var jugadoridparm = $.urlParam('jugador'); // idjugador que llego por parm.
			var club = $.urlParam('idclub');        // 6
			var fecha = $.urlParam('fecha');   // null		
			// se agrega parametro del set?
			var setdata = $.urlParam('set');   // null	
			var anio = $("#ianio").val();
			var stringcontenido='';	
			
		/*OBTENER PARTIDO DATOSSS*/	
				var parametros = {"id" : partido,"fechapart" : <?php echo("'".$_GET['fecha']."'");?> };
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
								$("#comp_etencia").text(v.cnombre);
								$("#fecha").text(v.Fecha);
								$("#cat_egoria").text(v.DescCate);
										  	$("#icate").val(v.idcat);
										  	CategoriaGlobal = v.idcat;
								var jugadorNombre = '';
								if(club == v.idcluba ) {
									$("#iclub").text(v.ClubA);
									if(r['pa_1'].idjugador == jugadoridparm) jugadorNombre = r['pa_1'].jugx;
									if(r['pa_2'].idjugador == jugadoridparm) jugadorNombre = r['pa_2'].jugx;
									if(r['pa_3'].idjugador == jugadoridparm) jugadorNombre = r['pa_3'].jugx;								
									if(r['pa_4'].idjugador == jugadoridparm) jugadorNombre = r['pa_4'].jugx;								
									if(r['pa_5'].idjugador == jugadoridparm) jugadorNombre = r['pa_5'].jugx;								
									if(r['pa_6'].idjugador == jugadoridparm) jugadorNombre = r['pa_6'].jugx;								
								}
								else
								{
										 $("#iclub").text(v.ClubB);
										if(r['pb_1'].idjugador == jugadoridparm) jugadorNombre = r['pb_1'].jugx;
										if(r['pb_2'].idjugador == jugadoridparm) jugadorNombre = r['pb_2'].jugx;
										if(r['pb_3'].idjugador == jugadoridparm) jugadorNombre = r['pb_3'].jugx;								
										if(r['pb_4'].idjugador == jugadoridparm) jugadorNombre = r['pb_4'].jugx;								
										if(r['pb_5'].idjugador == jugadoridparm) jugadorNombre = r['pb_5'].jugx;								
										if(r['pb_6'].idjugador == jugadoridparm) jugadorNombre = r['pb_6'].jugx;								
								}									 
								//idpartido=2&
								//fecha=2021-12-11&
								//set=1&setmax=5&jugador=142&
								//pos=B6&idclub=83&
								//catP=16
								$("#jugadornombre").text('');
								
								$("#jugadornombre").text(jugadorNombre);
							});
						},
						 error: function (xhr, ajaxOptions, thrownError) {
						// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						console.log(thrownError);
						console.log(xhr.responseText);
						}
				}); // FIN funcion ajax obtener_partido			
			
			
		/*OBTENER PARTIDO DATOSSS*/	
		//idpartido=1&iclubescab=83&fechapartido=2021-08-26&anioEquipo=2021&setdata=2
			var parametros = 
			 {
			    "idpartido" : $.urlParam('idpartido'),
	  			"iclubescab" : club,
				//"icatcab" : $("#icate").val(),
				"fechapartido": <?php echo("'".$_GET['fecha']."'");?>,
				"anioEquipo" : anio,
				"setdata" : $.urlParam('set'),
				"categoriapartido": $.urlParam('catP')
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
				if(r['estado']==1){
				$(r['Jugadores']).each(function(i, v)
				{ // indice,0 valor
						var selecter = '';
						var onclicky='';
						var estiloLibero='';
						var EsLibero ='';
						//if(v.posicion==8) {estiloLibero = '" class="item libero" ';EsLibero='<br>(Libero)'}
						//else
						  estiloLibero = '" class="item" ';
						if((v.posicion==7)) //SUPLENTESS
						{

						var puestoPosta =v.puestoxcat;	
						if(v.puestoxcat != v.puesto) puestoPosta = v.puesto;
						
						botonCentral='';	
						// ES PUNTA
						if(puestoPosta == 4)						
							botonCentral='<div class="itemiB222"><button id="central_pos_'+v.idjugador+'" name="punta" class="itemcjug4 punta  updposiciones" title="marcar central al jugador" onclick="alert(this.id);">{P}</button></div>';
						
						// ES CENTRAL
						if(puestoPosta == 6){
							
							//botonCentral='<div class="itemiB222"><button id="central_pos_'+v.idjugador+'" name="central" class="central updposiciones" title="marcar central al jugador" onclick="alert(this.id);">{C}</button></div>';
							estiloLibero = '" class="item colorCentral" ';
						};						
						
						if(puestoPosta == 3){	//ARMADOR..					
							//botonCentral='<div class="itemiB222"><button id="central_pos_'+v.idjugador+'" name="armador" class="armador updposiciones" title="marcar armador al jugador" onclick="alert(this.id);">{a}</button></div>';
						estiloLibero = '" class="item armador" ';
						};
						
						if(puestoPosta == 5)	//OPUESTO..					
							botonCentral='<div class="itemiB222"><button id="central_pos_'+v.idjugador+'" name="opuesto" class="opuesto updposiciones" title="marcar opuesto al jugador" onclick="alert(this.id);">{o}</button></div>';

						if(puestoPosta == 2)
						{	//libero..					
							//botonCentral='<div class="itemiB222"><button id="central_pos_'+v.idjugador+'" name="libero" class="libero updposiciones" title="marcar opuesto al jugador" onclick="alert(this.id);">{L}</button></div>';
						estiloLibero = '" class="item libero" ';
						};
							
							$("#CuadroJugadoresB22").append('<div id="pos_'+v.idjugador+'_'+v.posicion+'" name="pos_'+v.idjugador+'_'+v.posicion+
							estiloLibero+
							'onclick="enviapos(this);" '+
							'  >'+
							'<div class="itemiB221">'+v.nombre+'</div>'+EsLibero+
							botonCentral+
							selecter+
							'</div>');
						}

				  });// EACH ENLD
				 }; 
				 //$("#canchaA").html(stringcontenido);
    			},// SUCCESS	
			 error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
					//console.log('linea 237 '+thrownError);
					console.log('linea 238 '+xhr.responseText);
			}// fin ERROR:FUNCT
			}); // FIN funcion ajax JUGASPARTIDO..


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
 <div>
	  <div class="cambiosGrilla">
		  <div class="item1">
				 <select id="ianio" name="ianio" class="ianio">
					<option value="9999">Seleccionar año...</option>
				</select>
		  </div>
		  <div class="item11">		
				<button id="volver" name="altajug" class="altajug" title="agregar registros"><<</button>
		  </div>
		  <div class="item2" id="comp_etencia"></div>
		  <div class="item3" id="cat_egoria"></div>
		  	<input id="icate" type="hidden" value="">  

		  
		  <div class="item4" id="fecha"></div>  
		  <div class="item5" id="iclub"></div>
		   <div class="item6" id="jugadornombre"></div>
	</div>	   
 </div>	
  <section id="CuadroJugadoresB22" name="CuadroJugadoresB22" class="CuadroJugadoresB22">
  </section>
	
<!--<div id="canchaA" class="canchaBeta"></div>-->

</body>

</html>
