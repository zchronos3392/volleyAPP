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
			var idclub = arraids[1] ;
			var idjugador = arraids[2];	  
			var categoria = arraids[3];
			 stringcontenido='';
			//alert('es el jugador :'+idjugador+' del club '+idclub+' de la categoria: '+categoria);
			var pos_inicial = select_pos.value;
			
			var parametros =
				{
			    "idpartido" : $.urlParam('idpartido'),
	  			"iclubescab" : idclub,
				"icatcab" : categoria,
				"fechapartido": <?php echo("'".$_GET['fecha']."'");?>,
				"jugador":idjugador,
				"posicion":pos_inicial,
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
//					console.log('insertar jugador set, en enviapos');
				},
				done: function(data){
						
				},
				success:  function (r){
				$("canchaA").empty('');	
					var params00 = 
			 		{
			 			"idpartido" : $.urlParam('idpartido'),
	  					"iclubescab" : idclub,
						"fechapartido": <?php echo("'".$_GET['fecha']."'");?>,
						"setdata" : $.urlParam('set')
					};
			 	$.ajax({ 
					url:   './abms/obtener_jugpartido3.php',
					type:  'GET',
					data: params00,
					dataType: 'text json',
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
					beforeSend: function (){
	//					console.log('insertar jugador set, en succes de enviapos');
					},
					done: function(data){
						
						//console.log('se limpio la cancha..');			
					},
					success:  function (r){
					
					if(r['estado']==1){
					
					$(r['Jugadores']).each(function(i, v)
					{ // indice,0 valor
						switch(v.posicion)
						{
							case "1" :	
										cont1= '<div id="canchaa1"  class="gridcanchaBeta">1 '+v.nombre +'</div>';
										break;
							case "2" :
										cont2= '<div id="canchaa2"  class="gridcanchaBeta">2 '+v.nombre +'</div>';
										break;
							case "3" :
										cont3= '<div id="canchaa3"  class="gridcanchaBeta">3 '+v.nombre +'</div>';
										break;
							case "4" :
										cont4= '<div id="canchaa4"  class="gridcanchaBeta">4 '+v.nombre +'</div>';
										break;
							case "5" :
										cont5= '<div id="canchaa5"  class="gridcanchaBeta">5 '+v.nombre +'</div>';
										break;
							case "6" :
										cont6= '<div id="canchaa6"  class="gridcanchaBeta">6 '+v.nombre +'</div>';
										break;
							case "7" :
										//$("#canchaA").append();
										break;
							case "8" :
										//$("#canchaA").append();
										break;	
						 };
					  });// EACH ENLD
					 };//estado == 1
					 stringcontenido = cont1+cont2+cont3+cont4+cont5+cont6;	
					  $("#canchaA").html(stringcontenido);
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
			var partido = $.urlParam('idpartido'); // name
			var club = $.urlParam('idclub');        // 6
			var fecha = $.urlParam('fecha');   // null		
			// se agrega parametro del set?
			var setdata = $.urlParam('set');   // null	
			var stringcontenido='';	
			var parametros = 
			 {
			    "idpartido" : $.urlParam('idpartido'),
	  			"iclubescab" : club,
				//"icatcab" : $("#icate").val(),
				"fechapartido": <?php echo("'".$_GET['fecha']."'");?>,
				"setdata" : $.urlParam('set')
				};
			 $.ajax({ 
				url:   './abms/obtener_jugpartido3.php',
				type:  'GET',
				data: parametros,
				dataType: 'text json',
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
				beforeSend: function (){
					$("#cargajug").empty('');
	//				console.log('insertar jugador set, en document ready');
				},
				done: function(data){
					$("canchaA").empty('');			
				},
				success:  function (r){
				
				if(r['estado']==1){
				$(r['Jugadores']).each(function(i, v)
				{ // indice,0 valor
						var selecter='<select id="ipos_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'" name="ipos_'+v.idclub+'_'+v.idjugador+'_'+v.categoria+'" onclick="enviapos(this);" onchange="enviapos(this);">';
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
							
							if(v.posicion==8) selecter+='<option value="8" selected>Libero</option>';
							else selecter+='<option value="8">Libero</option>';
							selecter+='</select>';
						$("#CuadroJugadoresA").append('<div id="pos_'+v.idjugador+'" name="pos_'+v.idjugador+'" class="item" '+
						'  >'+
						v.nombre+
						selecter+
						'</div>');
					//alert(v.posicion);	
					switch(v.posicion)
					{
						case "1" :	
									stringcontenido += '<div id="canchaa1"  class="gridcanchaBeta">1 '+v.nombre +'</div>';
									break;
						case "2" :
									stringcontenido += '<div id="canchaa2"  class="gridcanchaBeta">2 '+v.nombre +'</div>';
									break;
						case "3" :
									stringcontenido += '<div id="canchaa3"  class="gridcanchaBeta">3 '+v.nombre +'</div>';
									break;
						case "4" :
									stringcontenido += '<div id="canchaa4"  class="gridcanchaBeta">4 '+v.nombre +'</div>';
									break;
						case "5" :
									stringcontenido += '<div id="canchaa5"  class="gridcanchaBeta">5 '+v.nombre +'</div>';
									break;
						case "6" :
									stringcontenido += '<div id="canchaa6"  class="gridcanchaBeta">6 '+v.nombre +'</div>';
									break;
						case "7" :
									//$("#canchaA").append();
									break;
						case "8" :
									//$("#canchaA").append();
									break;	
					};
						
				  });// EACH ENLD
				 }; 
				 $("#canchaA").html(stringcontenido);
    			},// SUCCESS	
			 error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			console.log(thrownError);
			console.log(xhr.responseText);
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
	
   	<header>
   			<Section class="LogoApp">
			<a href="javascript: history.go(-1)"><span id="medidas">
			<img  class="LogoApp" alt="VOLLEY.app" src="./img/textovolleyAPP_pequeno.png" />	
			</a>
		</Section>
		    
   </header>
<span id="stopwatch" style="display: none;"></span>
	</head>
<body>
  <section id="CuadroJugadoresA" name="CuadroJugadoresA" class="CuadroJugadores">
  
  </section>
	
<div id="canchaA" class="canchaBeta"></div>

</body>

</html>
