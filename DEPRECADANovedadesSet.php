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
			
//			console.log('parametros: resA: '+resA);
//			console.log('parametros: resB: '+resB);
//			console.log('parametros: clubA: '+clubA);
//			console.log('parametros: clubB: '+clubB);
//			console.log('parametros: valortie: '+valtiebreak);
			
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
            	// volver a PAGINA DE SETS: CSets.php
            	var partido = $("#partidoid").val();
				var fechapart = $("#fecha").text();
            	// COMENTO ESTO PARA QUE NO SE VAYA EL ERROR..
            	location.href = href='CSets.php?id='+partido+'&setmax=<?php echo($_GET['setmax']); ?>'+'&fecha='+fechapart;
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
				console.log(r);
				var clubadetc = $("#idcluba").val();
				var clubbdetc = $("#idclubb").val();
				// porque necesito tener grabado el ultimo punto para controlar..
				var valtiebreak = 25;
				if($("#setmax").val() == $("#setactual").val()) valtiebreak= 15;
				//alert($("#setmax").val());
				//alert($("#setactual").val());
				var resultado01 = $("#resa").text();
				var resultado02 = $("#resb").text();
					DetectarGanador(resultado01,resultado02,clubadetc,clubbdetc,valtiebreak);
			},
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
            }
            }); // FIN funcion ajax
		};
		
		$(document).ready(function(){
		
			var iclubescab1 = 0;
			var iclubescab2 = 0;
			var icatcab1    = 0 ;

/* CARGA CAEBECERA DEL set*/
			<?php $idpartido = $_GET['id']; ?>
			var idpartido = <?php echo $idpartido;?>;

			<?php $continuaCarga = $_GET['continuar']; ?>
			var contcargapart = <?php echo $continuaCarga;?>;
			/*
			//cargar puntoa,puntob,saque, esto trae todos los sets, resumidos
			// hacer una que traiga especificamente lo mismo pero de ese set...
				// obtener_set_id
			*/	
				var parametros = {"id" : idpartido,"fechapart" : <?php echo("'".$_GET['fecha'])."'";?> };
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
								// aca deberia dejar marcado quien tenia el saque...
								$("#saque").append('<option value="'+v.idcluba+'">'+v.ClubA+'</option>');
								$("#saque").append('<option value="'+v.idclubb+'">'+v.ClubB+'</option>');
								//26/09/2018 cargo las cosas cargadas si puse continuar carga...
								cargaCancha();
								cargarpuntosaque();
															
							});
						},
						 error: function (xhr, ajaxOptions, thrownError) {
						// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						console.log(thrownError);
						console.log(xhr.responseText);
						}
				}); // FIN funcion ajax obtener_partido

		
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
			//30 09 2018
			cargarpuntosaque();
			cargaCancha();
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
			//30 09 2018
			cargarpuntosaque();
			cargaCancha();
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
			window.location='CargarJugadores.php?idpartido='+<?php echo $idpartido; ?>+'&idclub='+clubaid+'&fecha='+<?php echo("'".$_GET['fecha']."'");?>;
		});
		
		$("#jugadoresB").click(function(){
			var clubbid = $("#idclubb").val();
			window.location='CargarJugadores.php?idpartido='+<?php echo $idpartido; ?>+'&idclub='+clubbid+'&fecha='+<?php echo("'".$_GET['fecha']."'");?>;
		});

		$("#posicionesA").click(function(){
			var clubaid = $("#idcluba").val();
			var idset   = $("#numSet").text();
			window.location='CargarPosiciones.php?idpartido='+<?php echo $idpartido; ?>+'&idclub='+clubaid+'&set='+idset+'&fecha='+<?php echo("'".$_GET['fecha']."'");?>;
		});
		
		$("#posicionesB").click(function(){
			var clubbid = $("#idclubb").val();
			var idset   = $("#numSet").text();
			window.location='CargarPosiciones.php?idpartido='+<?php echo $idpartido; ?>+'&idclub='+clubbid+'&set='+idset+'&fecha='+<?php echo("'".$_GET['fecha']."'");?>;
		});



    	$("#cerrarPosA").click(function(){
						
			var parms3 =
	    		 {
	    			"idpartido" : $("#partidoid").val(),
	    			"idset"     : $("#numSet").text(),
					"fechas"    : <?php echo("'".$_GET['fecha']."'");?>
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
				}); // FIN funcion ajax obtener set partido
						//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET	
		});// fin click cERRARpOSa							

		$("#grabarPos").click(function(){		
		var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"resa"      : $("#resa").text(),
    			"resb"      : $("#resb").text(),
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text(),
    			"saque"     : $("#saque").val()
    		};
    		
			///funciona : alert(JSON.stringify(parametros));
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
//    			console.log(r);
//				$("#incremA").prop('disabled', false);
//				$("#incremB").prop('disabled', false);
//				$("#decremA").prop('disabled', false);
//				$("#decremB").prop('disabled', false);
				
				//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET
	    		cargaCancha();
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#iclub").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
    	});//fin grabarPOS QUE NO EXISTE ACA...	
		});// document,.ready 	
	
function cargaCancha(){
	var params2 =
	 {
		"idpartido" : $("#partidoid").val(),
		"idset"     : $("#numSet").text(),
			"fechas"    : <?php echo("'".$_GET['fecha']."'");?>
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
				}); // FIN funcion ajax set partido
				//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET
};
					
function cargarpuntosaque(){
	var params3 =
	 {
		"idpartido" : $("#partidoid").val(),
		"idset"     : $("#numSet").text(),
		"fechas"    : <?php echo("'".$_GET['fecha']."'");?>
	};
		//alert('cargarpuntossaque');
		$.ajax({ 
				url:   './abms/obtener_set_partido.php',
				type:  'GET',
				data: params3,
				dataType: 'json',
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
				beforeSend: function (){
					
				},
				done: function(data){
						
				},
				success:  function (r){
				if(r['estado'] != "0")
				  {
					$(r['Sets']).each(function(i, v)
					{ // indice,0 valor
						$("#resa").text(v.puntoa);
						$("#resb").text(v.puntob);
						$("#saque").val(v.saque);
//						console.log('puntos a: '+v.puntoa);
//						console.log('puntos b: '+v.puntob);
//						console.log('saca: '+v.saque);
				     }); // fin estado != 0	
			       };
				},
				 error: function (xhr, ajaxOptions, thrownError) {
				// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						console.log(thrownError);
						console.log(xhr.responseText);
				}
				}); // fin funcion ajax set_partido
				//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET
};
		

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
    	<input id="CierraSet" name="CierraSet" class="cerrar20" type="button" value="X" />
	</div>
    </section>
    <section id="cronocontrolesCAB" class="cronocontrolesCAB">
    <div id="nomA" class="gridcolcab" >EQUIPO AAAAAAAAAAA<input id="idcluba" type="hidden" value=""/></div>
    <div id="nomB" class="gridcol">EQUIPO BBBBBBBBBBBB<input id="idclubb" type="hidden" value=""/></div>
    </section>
    <section id="botoneraAx" class="botoneraAx">
    	<div class="GridBotCol">
<!--    		<input id="CierraSet" name="CierraSet" class="cerrar20" type="button" value="X" />-->
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
 		<button id="jugadoresA" name="jugadoresA" title="cargar jugadores equipo A" class="btnPop2" >Jugadores Equipo Local</button>
		<button id="posicionesA" name="posicionesA" title="cargar posiciones equipo A" class="btnPop2">POS INI. E.LOCAL</button>
		<button id="jugadoresB" name="jugadoresB" title="cargar jugadores equipo B" class="btnPop2">Jugadores Equipo Visitante</button>
    	<button id="posicionesB" name="posicionesB" title="cargar posiciones equipo B" class="btnPop2">POS INI. E.VISTANTE</button>		
    	<button id="grabarPos" name="grabarPos" title="Grabar Inicio Set" class="btnPop2">Imprime Set inicio</button>		
   		<div id="jugSaque" name="jugSaque" >
   			<select id="saque" name="saque" ><option value="9999">Tiene saque..</option></select>
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

