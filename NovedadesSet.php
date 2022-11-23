<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>novedades set</title>
        <meta name="title" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   <link rel="stylesheet" href="./css/tablero_style.css">


	   <style>
	   .btnCAMBIO{
			text-decoration: none;
			background: #2e89f2;
			color: #FFF;
			width: 100%;
			text-align: center;
			vertical-align: middle;
			overflow: hidden;
			border: solid 1px #FFF;
			transition: .4s;
			height: 100%;
			word-wrap: break-word;
			}
		.bloqueFotos{
			display:grid;
			padding: 0.5rem;				
				grid-template-columns: 50% 50%;
				grid-template-rows: 50%;

				/*borde redondeado*/
						border: 0px solid #000000;
						-moz-border-radius: 7px;
						-webkit-border-radius: 7px;
				/*borde redondeado*/	
		}			
		.bloqueRotar{
				display:grid;
				padding: 0.5rem;				
				grid-template-columns: 50% 50%;
				/*borde redondeado*/
						border: 0px solid #000000;
						-moz-border-radius: 7px;
						-webkit-border-radius: 7px;
				/*borde redondeado*/	
		}			
		 .repararrotacion2{
			padding: 0.5rem; 		 	
			display:grid;
			 grid-template-areas: "atras adelante";
				/*borde redondeado*/
						border: 1px solid #000000;
						-moz-border-radius: 7px;
						-webkit-border-radius: 7px;
				/*borde redondeado*/				
			
		 }   	
		.repararrotacion{
			display:grid;
			 grid-template-areas: "atras adelante";
			padding: 0.5rem; 
				/*borde redondeado*/
						border: 1px solid #000000;
						-moz-border-radius: 7px;
						-webkit-border-radius: 7px;
				/*borde redondeado*/				
			font-size:20px;	

		}	
		.itemAtrasA
		{
		  grid-area: atras;
				/*borde redondeado*/
						border: 1px solid #000000;
						-moz-border-radius: 7px;
						-webkit-border-radius: 7px;
				/*borde redondeado*/			
		background-color:#2dc6d2;	
		height:2em;	
		width: 100%;			
		}	
		.itemAdelaA{
			grid-area: adelante;
		    background-color: #db3a62;
		    border-bottom: 50px solid transparent;			     			     
				/*borde redondeado*/
						border: 1px solid #000000;
						-moz-border-radius: 7px;
						-webkit-border-radius: 7px;
				/*borde redondeado*/				
		height:2em;	
		width: 100%;					    
		}


		.itemAtrasB
		{
		  grid-area: atras;
		/*borde redondeado*/
				border: 1px solid #000000;
				-moz-border-radius: 7px;
				-webkit-border-radius: 7px;
		/*borde redondeado*/				
		background-color:#2dc6d2;			
		height:2em;					     
		width: 100%;		
		}	
		.itemAdelaB{
			grid-area: adelante;
		    background-color: #db3a62;
    		margin-top: 0em;			     
				/*borde redondeado*/
						border: 1px solid #000000;
						-moz-border-radius: 7px;
						-webkit-border-radius: 7px;
				/*borde redondeado*/				
		height:2em;		
		width: 100%;
		}

		
		
		@media (max-width: 450px){
			

			.itemAtrasA
			{
		  grid-area: atras;
				/*borde redondeado*/
						border: 1px solid #000000;
						-moz-border-radius: 7px;
						-webkit-border-radius: 7px;
				/*borde redondeado*/			
		background-color:#2dc6d2;	
		height:2em;	
		width: 100%;							     
			}	
			.itemAdelaA{
			grid-area: adelante;
		    background-color: #db3a62;
		    border-bottom: 50px solid transparent;			     			     
				/*borde redondeado*/
						border: 1px solid #000000;
						-moz-border-radius: 7px;
						-webkit-border-radius: 7px;
				/*borde redondeado*/				
		height:2em;	
		width: 100%;					    

			}

			.itemAtrasB
			{
			  grid-area: atras;
			/*borde redondeado*/
					border: 1px solid #000000;
					-moz-border-radius: 7px;
					-webkit-border-radius: 7px;
			/*borde redondeado*/				
			background-color:#2dc6d2;			
			height:2em;					     
			width: 100%;		
			}	
			.itemAdelaB{
				grid-area: adelante;
			    background-color: #db3a62;
	    		margin-top: 0em;			     
					/*borde redondeado*/
							border: 1px solid #000000;
							-moz-border-radius: 7px;
							-webkit-border-radius: 7px;
					/*borde redondeado*/				
			height:2em;		
			width: 100%;

			}			
		}			
	   </style>
	   <!--SCRIPTS PRIMERO HAY QUE VINCULAR LA LIBERIA JQUERY PARA QUE RECONOZCA EL $-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		
		<script type="text/javascript">

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// calcular los minutos transcurridos...
	function calculoTiempoRestante(inicio,fin){
	  var resultado='';
//	  console.log(inicio);
	  inicioMinutos ='';
	  inicioHoras  ='';
	  inicioMinutos = parseInt(inicio.substr(3,2));
	  inicioHoras = parseInt(inicio.substr(0,2));

//	 console.log(fin);	
	  
	  
	  finMinutos = parseInt(fin.substr(3,2));
	  finHoras = parseInt(fin.substr(0,2));

	  transcurridoMinutos = finMinutos - inicioMinutos;
	  transcurridoHoras = finHoras - inicioHoras;
	  
	  if (transcurridoMinutos < 0) {
	    transcurridoHoras--;
	    transcurridoMinutos = 60 + transcurridoMinutos;
	  }
	  
	  horas = transcurridoHoras.toString();
	  minutos = transcurridoMinutos.toString();
	  
	  
	  if (horas.length < 2) {
	    horas = "0"+horas;
	  }

 
	  if (minutos.length < 2) {
	    minutos = "0"+minutos;
	  }	  
	  		
		//console.log("PASARON : "+horas+":"+minutos+" mins");		
		resultado = horas+" hs :"+minutos+" min";
		return (resultado);
	}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function actualizaPosicion(idpartido,fechaJuego,SetNumero,MaxCountSets,
						   idjugador,posCancha,clubid,cateJugador,posicionumerica){
//no actualiza entre cambios de liberos !!
var array_suplente ='';
var idsuplente =0;
	if($(".bordeSeleccion").attr("id") == undefined)
		alert('	Primero el suplente, dsps el posta...');
	else{
		var array_suplente =	$(".bordeSeleccion").attr("id").split("_");
		var idsuplente = array_suplente[0];

			//console.log(idpartido+','+fechaJuego+','+SetNumero+','+MaxCountSets+','+idjugador+','+posCancha+','+clubid+','+cateJugador+', lo cambio por : '+idsuplente+' , pos numerica: '+posicionumerica+' hora actual: '+ $("#stopwatch").text());

//		fechaJuego = "'"+fechaJuego+"'";
		var parametros =
			{
		    "idpartido" : idpartido,
			"iclubescab" : clubid,
			"icatcab" : cateJugador,
			"fechapartido": fechaJuego,
			"idjugadorEntra":idsuplente,
			"idjugadorSale":idjugador,
			"posenset":posCancha,
			"setnumero" : SetNumero,
			"horas"     : $("#stopwatch").text(),
			"posicion"  :posicionumerica,
			"ianio":	$("#ianio").val()
			};
			 $.ajax({ 
				url:   './abms/cambiar_jugador_partido.php',
				type:  'POST',
				data: parametros,
				dataType: 'text json',
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
				beforeSend: function (){},
				done: function(data){},
				success:  function (r)
				{
				  cargaCancha();		
						//console.log(r);
			},// SUCCESS	
				error: function (xhr, ajaxOptions, thrownError) {
					console.log(thrownError);
					console.log(xhr.responseText);
				}// fin ERROR:FUNCT
				}); // FIN funcion ajax JUGASPARTIDO..			
	} //else, esta todo disponible..	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++



//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ++++++++++++ marcar seleccion de suplente o libero
function elegirSuplente(dataSelector,claseOrigen){
	//$("#"+xidmoneda).removeClass('moneda');
	//alert($("#"+dataSelector).hasClass( 'bordeSeleccion' ));
	//border: 3px solid #d51a04;		
	if($("#"+dataSelector).hasClass( 'bordeSeleccion' ))
	{
	 		 $("#"+dataSelector).removeClass('bordeSeleccion');
	 		 //$("#"+dataSelector).addClass(claseOrigen);
	 		 $("#"+dataSelector).css("border", "1px solid #ffffff");
	}
	else
	{
	 		 $("#"+dataSelector).addClass('bordeSeleccion');
	 		 $("#"+dataSelector).css("border", "3px solid #d51a04");		 
	 		 //$("#"+dataSelector).removeClass(claseOrigen);
		
	}
	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
//traigo escudo
	function obtenerEscudo(idClub,idescudoclub,claseSaque){
		//console.log(idClub);
         var parametros = {"idClub" : idClub};	
         $.ajax({ 
            url:   './abms/obtener_club_por_id.php',
            type:  'GET',
            data: parametros ,
            datatype:   'text json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				$(idescudoclub).html('');
    		},
            done: function(data){
            	
			},
            success:  function (r){
				var re = JSON.parse(r);
				//console.log(re['escudo']);
				var escudoSpan		 = '';
				var cierreEscudoSpan = '';
				
				if(re['escudo'] !='')
				{
									
					$("#"+idescudoclub).html(escudoSpan+'<img  src="'+"img/escudos/"+re['escudo']+'" class="imgjugadorTablero '+claseSaque+'" id="'+idescudoclub+'IMG"></img>'+cierreEscudoSpan); 
				}
    			else            	
    				$(idescudoclub).html('<img  src="img/jugadorGen.png" class="imgjugadorTablero" ></img>'); 
            },
             error: function (xhr, ajaxOptions, thrownError) 
             {
			 }
            });

 	}
 			
// OBTENEMOS LA DATA DE LOS SETS ANTERIORMENTE JUGADOS
			function traerSetAnteriores(clubID){
			//	$("#setsganados").empty();
				var setNumero20 =0;

				<?php $idpartido = $_GET['id']; ?>
				var idpartido = <?php echo $idpartido;?>;

				var parametros =
				{
					"idpartido" : idpartido,
					"idfecha"    : <?php echo("'".$_GET['fecha'])."'";?>,
					"setNum"	   : setNumero20,
					"llama"			:"traeSetsAnteriores"
				};
			     $.ajax({ 
			        url:   './abms/obtener_sets.php',
			        type:  'GET',
			        data: parametros,
			        dataType: 'json',
			        beforeSend: function (){
						// Bloqueamos el SELECT de los cursos
					},
			        done: function(data){

					},
			        success:  function (r)
			        {
			        	//$("#setsganadosA").empty();
						//$("#setsganadosB").empty();

			            $(r['Sets']).each(function(i, v){ // indice, valor				

						if(v.mensaje=='Fin del set')
						{
							
								if(parseInt(v.puntoa,10) >= parseInt(v.puntob,10))
								  if(clubID == 'nomA')
									$("#setsganadosA").append('<div class="parciales"><span class="parcial">L:'+v.puntoa+'</span><span class="parcial">V:'+v.puntob+'</span></div>');								if(v.puntoa <= v.puntob)
									if(clubID == 'nomB')
									$("#setsganadosB").append('<div class="parciales"><span class="parcial">L:'+v.puntoa+'</span><span class="parcial">V:'+v.puntob+'</span></div>');							
						 }
						  else
							{
//							var jugando='<section class="puntoJugando21">'+
//									'<div class="" id="setsjugandosA">'+
//										'<div class="parcialesj"><span class="parcial">L:'+v.puntoa+'</span><span class="parcial">V:'+v.puntob+'</span></div></div>'+
//									 '</section>';
//							$("#categoria").append(jugando);
							}
//	  			      		$("#periodo").text(v.setnumero);
	  			      	});
	  			    },

			         error: function (xhr, ajaxOptions, thrownError) {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						}
			        }); // FIN funcion ajax 			
			}
// OBTENEMOS LA DATA DE LOS SETS ANTERIORMENTE JUGADOS

		
		
		// nueva funcion para cambiar el color del indicador de tiempo	pedido
		function tiempoGraba(idclub,clubQuepide,fondoTiempoID,botonPresionado){
			//console.log('tiempoGraba()');
			var idbtn = "#"+botonPresionado;
			var fondoVisu = "#"+fondoTiempoID;
			//alert("CLUB QUE PIDE: "+clubQuepide);
			//alert("partido: "+$("#partidoid").val());
			var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"fechas"    : $("#fecha").text(),
    			"idclub"    : idclub,
    			"clubpide"     : clubQuepide
			 };
			
			$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   'pedirtiempo_set.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
			
            },
            success:  function (r){
            	//console.log(r);
            	// volver a PAGINA DE SETS: CSets2.php
					//analizo el contador de TIEMPOS DISPONIBLES..
					// devuelve el ok para cerrar la botonera del club correspondiente
				//	console.log('pre::cargarpuntosaque()');
					cargaCancha(); //antes cargarpuntosaque();
				//	console.log('post::cargarpuntosaque()');
				},
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
            	console.log(thrownError);
            }
            }); // FIN funcion ajax			
			
		};
		// nueva funcion para cambiar el color del indicador de tiempo	pedido		
		
		$.urlParam = function(name){
			var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
			if (results==null){
			   return null;
			}
			else{
			   return decodeURI(results[1]) || 0;
			}
		};
		
		function adelantarRotacion(idclub){
			// viene 'idcluba'
			 var idclubAntiRota = $("#"+idclub).val();
			 //alert(idclubAntiRota);
		var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"resa"      : $("#resa").text(),
    			"resb"      : $("#resb").text(),
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text(),
    			"saque"     : $("#saque").val(),
    			"anioEquipo":	$("#ianio").val(),
    			"antirotacion"  : "S",
    			"quienAntiRota" : idclubAntiRota,
    			"sentido"       : "FF"
    		};

    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertarsetdata.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
			
            },
            success:  function (r){
				//console.log(r);
				var clubadetc = $("#idcluba").val();
				var clubbdetc = $("#idclubb").val();
				// porque necesito tener grabado el ultimo punto para controlar..
				//var valtiebreak = 25;
				var valtiebreak = $("#valorFINSETCOMUN").val();
				//SI VIENE EN 0 HABRAN ERRORES !!!!
				if(valtiebreak==0) alert("FIN DEL SET EN 0 !!!");
				//if($("#setmax").val() == $("#setactual").val()) valtiebreak= 15;
				if($("#setmax").val() == $("#setactual").val()) valtiebreak= $("#valorFINENTIE").val();
									if(valtiebreak==0) alert("FIN DEL SET en tb EN 0 !!!");
				//alert($("#setmax").val());
				//alert($("#setactual").val());
				var resultado01 = $("#resa").text(); //resa01; //levanto el nuevo valor que envie a insertar	//	$("#resa").text();//levanto el valor que esta actualizado en pantalla..
				var resultado02 = $("#resb").text(); //resa02; //levanto el nuevo valor que envie a insertar	//	$("#resb").text();
					//console.log('pre::DetectarGanador()');
						DetectarGanador(resultado01,resultado02,clubadetc,clubbdetc);
						cargaCancha(); //para que se actualice solo...
						//cargarpuntosaque();
			},
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
            }
            }); // FIN funcion ajax
}
		
		function retrasarRotacion(idclub){
			// viene 'idcluba'
			 var idclubAntiRota = $("#"+idclub).val();
			 //alert(idclubAntiRota);
		var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"resa"      : $("#resa").text(),
    			"resb"      : $("#resb").text(),
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text(),
    			"saque"     : $("#saque").val(),
    			"anioEquipo":	$("#ianio").val(),
    			"antirotacion"  : "S",
    			"quienAntiRota" : idclubAntiRota,
    			"sentido"       : "BW"
    		};

    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertarsetdata.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
			
            },
            success:  function (r){
				//console.log(r);
				var clubadetc = $("#idcluba").val();
				var clubbdetc = $("#idclubb").val();
				// porque necesito tener grabado el ultimo punto para controlar..
				//var valtiebreak = 25;
				var valtiebreak = $("#valorFINSETCOMUN").val();
				//SI VIENE EN 0 HABRAN ERRORES !!!!
				if(valtiebreak==0) alert("FIN DEL SET EN 0 !!!");
				//if($("#setmax").val() == $("#setactual").val()) valtiebreak= 15;
				if($("#setmax").val() == $("#setactual").val()) valtiebreak= $("#valorFINENTIE").val();
									if(valtiebreak==0) alert("FIN DEL SET en tb EN 0 !!!");
				//alert($("#setmax").val());
				//alert($("#setactual").val());
				var resultado01 = $("#resa").text(); //resa01; //levanto el nuevo valor que envie a insertar	//	$("#resa").text();//levanto el valor que esta actualizado en pantalla..
				var resultado02 = $("#resb").text(); //resa02; //levanto el nuevo valor que envie a insertar	//	$("#resb").text();
					//console.log('pre::DetectarGanador()');
						DetectarGanador(resultado01,resultado02,clubadetc,clubbdetc);
						cargaCancha(); //para que se actualice solo...
						//cargarpuntosaque();
					//console.log('post::DetectarGanador()');
			},
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
            }
            }); // FIN funcion ajax
}
		
					// FUNCION PARA DETECTAR GANADORES AUTOMATICAMENTE REARMADA DESDE EXCEL..
		function DetectarGanador(resA,resB,clubA,clubB)
			{
			//console.log('DetectarGanador()');
			var diferencia = 0;
			var maxPuntaje = 0;
			<?php 		
					require_once './abms/Partido.php';
					$idpartido	= 0;
					$idpartido = (int)$_GET['id'];
					$fecha='';
					$fecha    = "'".$_GET['fecha']."'";
					$valoresfinales=0;  
					$valoresfinales = Partido::getfinset($idpartido,$fecha);
					//print_r($valoresfinales);
			?>
			
			var valtiebreak = 0;
			valtiebreak = <?php echo($valoresfinales["0"]["valFinSet"]);?>;

		//	console.log('parametros: valortie: '+valtiebreak);

			//SI VIENE EN 0 HABRAN ERRORES !!!!
				//if($("#setmax").val() == $("#setactual").val()) valtiebreak= 15;
				if($("#setmax").val() == $("#setactual").val()) valtiebreak= <?php echo($valoresfinales["0"]["valTBSet"]);?>;
			if(resA >= resB)
			{ // INICIO IF
			  // resA es MAYOR O IGUAL 
			  if(resA >=valtiebreak)
			   {
							
				 diferencia = resA - resB;
				 if(diferencia >=2)
				 {
					 //console.log('94 parametros: valor fin set: '+valtiebreak);	
				 	 //console.log(clubA + " - (a) wins the set");
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
				  	//console.log(' 108parametros: valor fin set: '+valtiebreak);	 					 
				 	7/console.log(clubB + " (b) wins the set");
										cerrarSet();
				 };	
			   }
			}; // fin del ELSE
			}; // FIN DE LA FUNCION		
		
		function  cerrarSet()
		{ // esta funcion cierra el set y vuelve a la pagina de CargaSets
		//console.log('cerrarSet()');
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
/* +++++++++++++++ FIN FUNCION ROTAR ++++++++++*/		
		function reanudar(resa,resb,rotar){
			//console.log('enviarJugada()');
			//quite este parametro: "debeRotar" : $("#NOROTA").text()    			
   		var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"resa"      : resa,
    			"resb"      : resb,
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text(),
    			"rotacion" : rotar,
    			"mensajeAlta" : 'Novedades30::REANUDAR'
				
			 };
    		
    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertarsetdata.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
			
            },
            success:  function (r){
						DetectarGanador(resultado01,resultado02,clubadetc,clubbdetc);
						cargaCancha(); //para que se actualice solo...
						//cargarpuntosaque();
			},
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
            }
            }); // FIN funcion ajax			
		}
/* +++++++++++++++ FIN FUNCION ROTAR ++++++++++*/		
		function enviarJugada(resa01,resa02)
		{
			//console.log('enviarJugada()');
			//quite este parametro: "debeRotar" : $("#NOROTA").text()    			
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
				//console.log(r);
				var clubadetc = $("#idcluba").val();
				var clubbdetc = $("#idclubb").val();
				// porque necesito tener grabado el ultimo punto para controlar..
				//var valtiebreak = 25;
				var valtiebreak = $("#valorFINSETCOMUN").val();
				//SI VIENE EN 0 HABRAN ERRORES !!!!
				if(valtiebreak==0) alert("FIN DEL SET EN 0 !!!");
				//if($("#setmax").val() == $("#setactual").val()) valtiebreak= 15;
				if($("#setmax").val() == $("#setactual").val()) valtiebreak= $("#valorFINENTIE").val();
									if(valtiebreak==0) alert("FIN DEL SET en tb EN 0 !!!");
				//alert($("#setmax").val());
				//alert($("#setactual").val());
				var resultado01 = $("#resa").text(); //resa01; //levanto el nuevo valor que envie a insertar	//	$("#resa").text();//levanto el valor que esta actualizado en pantalla..
				var resultado02 = $("#resb").text(); //resa02; //levanto el nuevo valor que envie a insertar	//	$("#resb").text();
					//console.log('pre::DetectarGanador()');
						DetectarGanador(resultado01,resultado02,clubadetc,clubbdetc);
						cargaCancha(); //para que se actualice solo...
						//cargarpuntosaque();
					//console.log('post::DetectarGanador()');
			},
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
            }
            }); // FIN funcion ajax
		};
		
		$(document).ready(function(){
		var escudoAMarco=escudoBMarco="NoBorde";//		
		// COIGO PARA ANIMAR LA HAMBURGUESA
		var win = $(this); //this = window
			$("#medidas").val('W-' + win.width());

			// COIGO PARA ANIMAR LA HAMBURGUESA
			$(window).on('resize', function(){
					var win = $(this); //this = window
					$("#medidas").val('W-' + win.width());
					//$("#medidas").val('RESPONSIVE DATA:W: ' + win.width()+' - H: '+ win.height());
			});				


//para tener el año actual, para las cargas de jugadores
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
//para tener el año actual, para las cargas de jugadores


		
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
								$("#partidoCancha").text('Cancha: '+v.cancha);
								$("#competencia").text(v.cnombre);
								$("#fecha").text(v.Fecha);

								$("#categoria").text(v.DescCate);
								$("#categoria").append('<input id="idcat" type="hidden" value="'+v.idcat+'"/>');
								icatcab1 = v.idcat;
								
								traerSetAnteriores('nomA');
								//$("#nomA").text(v.ClubA + "  ("+v.ClubARes +")");
								$("#jugATitulo").text(v.ClubA);
								$("#nomA").append('<input id="idcluba" type="hidden" value="'+v.idcluba+'"/></div>');
				        	  	$("#HoraInicial").val(r['horainicio']);
								iclubescab1 = v.idcluba;
								//$("#nomB").text(v.ClubB+"  ("+v.ClubBRes +")");
				        	  	$("#HoraInicioSet").val(r['valorHoraInicioSet']);
								$("#jugBTitulo").text(v.ClubB);
								$("#nomB").append('<input id="idclubb" type="hidden" value="'+v.idclubb+'"/>');
//				    	 		var puntajeB	='<section class="punto21 sinMarginTop"><div class="" id="setsganadosB">Sets previos..Visitante</div></section>';	 	 
//								$("#nomB").append(puntajeB);
								traerSetAnteriores('nomB');
								iclubescab2 = v.idclubb ;
								$("#setmax").text(v.setsnmax);	
								$("#valorFINSETCOMUN").val(v.valFinSet);	
								$("#valorFINENTIE").val(v.valTBSet);	
								// aca deberia dejar marcado quien tenia el saque...
								$("#saque").append('<option value="'+v.idcluba+'">'+v.ClubA+'</option>');
								$("#saque").append('<option value="'+v.idclubb+'">'+v.ClubB+'</option>');
/* INCORPORAMOS LA CARGA DEL ESCUDO DE CADA CLUB */

							if(r['saque'] == v.idcluba)
							{ 
								//textoClubA = v.ClubA;
								escudoAMarco = "bordeRojo";
								escudoBMarco = "NoBorde"; 
							}
							
							if(r['saque'] == v.idclubb)
							{ 
								//textoClubB  = v.ClubB;
								escudoAMarco = "NoBorde";
								escudoBMarco = "bordeRojo"; 
							}
			// CARGO LOS ESCUDOS DE CADA EQUIPO JUNTO CON EL RESULTADO ACTUAL DEL SET
						var ESCUDOA = '<span id="escudoAMarco" class="'+escudoAMarco+'"><img  src="img/jugadorGen.png" class="imgjugadorTablero2" ></img></span>';
						
						
						var textoClubA ='<div class="grillaIdClubv20"><div class="itmidclub2a" id="escudoA">'+ESCUDOA+'</div><div class="itmidclub1a"><span id="nombrelocal">'+v.ClubA+'</span></div>'+
							 '<div id="nomA" class="" >'+
							 '<input id="idcluba" type="hidden" value="'+v.idcluba+'"/>'+
							'</div>'+
						'</div>';	

						var ESCUDOB = '<span id="escudoBMarco" class="'+escudoBMarco+'"><img  src="img/jugadorGen.png" class="imgjugadorTablero2" ></img></span>';
						
						var textoClubB  = '<div class="grillaIdClubv20"><div class="itmidclub2a" id="escudoB" >'+ESCUDOB+'</div><div class="itmidclub1a"><span id="nombrevisita">'+v.ClubB+'</span></div>'+
							 '<div id="nomB" class="" >'+
							 	'<input id="idclubb" type="hidden" value="'+v.idclubb+'"/>'+
							'</div>'+
						'</div>';

						obtenerEscudo(v.idcluba,"escudoA",escudoAMarco) ;
						obtenerEscudo(v.idclubb,"escudoB",escudoBMarco) ;

						$("#clublocal").empty();
						$("#clublocal").append(textoClubA);						
						$("#clubvisitante").empty();
						$("#clubvisitante").append(textoClubB);						
			// CARGO LOS ESCUDOS DE CADA EQUIPO JUNTO CON EL RESULTADO ACTUAL DEL SET
/* INCORPORAMOS LA CARGA DEL ESCUDO DE CADA CLUB*/								
								//26/09/2018 cargo las cosas cargadas si puse continuar carga...
										cargaCancha();
										//cargarpuntosaque();
							});// SUCCESS DE LA COLECCION PARTIDO desde obtener_partidos
							//TENGO QUE TRAER ACA EL VALOR DEL ULTIMO SET / ACTUAL
							//lO TRAIGO ACA, PARA QUE SE REFRESQUE BIEN CUANDO SALGO Y VUELVO 
							// A ENTRAR A LA PANTALLA, O CUANDO TIRO UN F5	
								$("#resa").text(r['puntoa']);
								$("#resb").text(r['puntob']);

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
		var tiempoSinSegs = tiempoTxtHora +':' + tiempoTxtMin;		
		var tiempoTxt = tiempoTxtHora +':' + tiempoTxtMin +':' + tiempoTxtSeg ;
		$("#stopwatch").text(tiempoTxt);
		var horaDesde = $("#HoraInicial").val();
		var horaInicioRealSet = $("#HoraInicioSet").val();
		var TiempoTranscurridoActual = '';
		var TiempoTranscurridoActual = calculoTiempoRestante(horaDesde,tiempoSinSegs);		
		var TTranscurridoSetActual = calculoTiempoRestante(horaInicioRealSet,tiempoSinSegs);		
		
		$("#horaactual").text(tiempoTxt);
		$("#tiempotranscurridoSet").text(TTranscurridoSetActual);				
		$("#tiempotranscurrido").text(TiempoTranscurridoActual);
		}, 1000); //funcion setinterval..
					
		 var resA = 0;
		 var resB = 0;
		$("#ocultaControles").click(function(){
				
			$("#xgrid-container22").toggle();
			$(".bloqueFotos").toggle();
		});
				
		$("#incremA").click(function(){
			var resa01 = $("#resa").text();
			resa01++;
			$("#resa").text(resa01);//LO PEGA BIEN PERO LUEGO SE BORRA CON EL VIEJO VALOR...
			$("#ROTA").text("S");	
				enviarJugada(resa01,0);
			//30 09 2018
				cargaCancha();
				//cargarpuntosaque();
	
    	});
    	
    	$("#decremA").click(function(){
			var resa01 = $("#resa").text();
			if(resa01 > 1) resa01--;
			else resa01 = 0;
			$("#resa").text(resa01);
			$("#ROTA").text("N");//ESTA MAL, NO HAY QUE ROTAR ACA..			
				// agregamos el ajuste..
				enviarJugada(resa01,0);
    	});		
    
		$("#incremB").click(function(){
			var resa02 = $("#resb").text();
			resa02++;
			$("#resb").text(resa02);
			//$("#NOROTA").text("S");			
			enviarJugada(0,resa02);
			//30 09 2018
			cargaCancha();
			//cargarpuntosaque();
    	});
    	
    	$("#decremB").click(function(){
			var resa02 = $("#resb").text();
			if(resa02 > 1) resa02--;
			else resa02 = 0;
			
			$("#resb").text(resa02);
			//$("#NOROTA").text("N"); // ESTA MAL NO HAY QUE ROTAR AL QUITAR PUNTOS..
				// agrego el ajustar resultado..
			enviarJugada(0,resa02);
    	});

		$("#ErrorSaqueA").click(function(){
			var resa02 = $("#resb").text();
			resa02++;
			$("#resb").text(resa02);
			//$("#NOROTA").text("N");
			enviarJugada(0,resa02);
			//agregar un parametro en enviarJugada( para que no rote el equipo contrario..)
			//30 09 2018
			cargaCancha();
			//cargarpuntosaque();
    	});

		$("#ErrorSaqueB").click(function(){
			var resa01 = $("#resa").text();
			resa01++;
			$("#resa").text(resa01);
			//$("#NOROTA").text("N");
			enviarJugada(resa01,0);
			//30 09 2018
			cargaCancha();
			//cargarpuntosaque();
    	});

    	
    	$("#CierraSet").click(function(){
				cerrarSet();
    	});

		$("#reanudar").click(function(){

			var resa = $("#resa").text();
			var resb = $("#resb").text();	
			var rotar = "N";	
			 reanudar(resa,resb,rotar);
			//30 09 2018
	    		//cargaCancha();
	    		//cargarpuntosaque();
		});   
		
		
		$("#grabarPos").click(function(){		
		// SETEA PARAMETROS INICIALES !!!! NO SIRVE PARA OTRA COSA
		var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"resa"      : $("#resa").text(),
    			"resb"      : $("#resb").text(),
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text(),
    			"saque"     : $("#saque").val(),
    			"mensajeAlta" : 'Novedades30::grabaPos',
    			"anioEquipo":	$("#ianio").val() 
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
				//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET
	    				cargaCancha();
	    				//cargarpuntosaque();
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#iclub").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
		   });
		});    
/*            
		$("#grabarPos_20").click(function(){		
		var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"resa"      : $("#resa").text(),
    			"resb"      : $("#resb").text(),
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text(),
    			"saque"     : $("#saque").val(),
    			"anioEquipo":	$("#ianio").val()
    		};
    		
			///funciona : alert(JSON.stringify(parametros));
    		//mandar por ajax a novedadSet
    		// capaz un insertar set 2
    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_sets_20.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#iclub").prop('disabled', true);
            },
            
            success:  function (r){
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
*/

    	
		$("#ContinuarP").click(function(){		
		var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"resa"      : $("#resa").text(),
    			"resb"      : $("#resb").text(),
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text(),
    			"saque"     : $("#saque").val(),
    			"anioEquipo":	$("#ianio").val()
    		};
    		//console.log(parametros);
			///funciona : alert(JSON.stringify(parametros));
    		//mandar por ajax a novedadSet
    		// capaz un insertar set 2
    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_sets_20.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#iclub").prop('disabled', true);
            },
            
            success:  function (r){
				//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET
	    		console.log(r);
	    		cargaCancha();
	    		//cargarpuntosaque();
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#iclub").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }            
           }); // FIN funcion ajax
    	});//fin grabarPOS QUE NO EXISTE ACA...    	

		$("#subirFotos").click(function(){
			$("#TablaInfoReferencial").show();
		
		});


		$("#LIMPIAR").on("click",function(e)
		{
			 $(".respuesta").html('');
			 $("#TablaInfoReferencial").hide();
		});
		
		$("#fLIMPIAR").on("click",function(e)
		{
			 $(".respuesta").html('');
			 $("#TablaInfoReferencial").hide();
		});

		
	    $("#fsubir").on('submit', function(e){
	        e.preventDefault();
	        $.ajax({
	            type: 'POST',
	            url:   './abms/sube_foto.php',
	            data: new FormData(this),
	            contentType: false,
	            cache: false,
	            processData:false,
		            beforeSend: function (){
		            	$("#subeFoto").val("Enviando"); // Para input de tipo button
                		$("#subeFoto").attr("disabled","disabled");
 						$('#fsubir').css("opacity",".5");
                		//$(".respuesta").html(parametros);
		            },
					complete:function(data){
	                /*
	                * Se ejecuta al termino de la petición
	                * */
	            	    $("#subeFoto").val("Sube Fotos");
    	           		$("#subeFoto").removeAttr("disabled");
        		    },		            
		            success:  function (r){
						$(".respuesta").html(r);
                		$('#fsubir').css("opacity","");
                		$("#subeFoto").attr("disabled","disabled");
						//$("#TablaInfoReferencial").hide();
						
		            },
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.responseText);
						console.log(thrownError);
		            }
		            }); // FIN funcion ajax
		});

    	
		});// document,.ready 	

function buscarLibero(vectorEquipo,idABuscar,posicionBuscada,retorno){
	var conteo=0;
	var botonCentral='';
	$(vectorEquipo).each(function(j, w)
			{ // indice =j ,0 valor = w
					//console.log('indice : ' + j + ' valor : ' +w);
					if (w.idjugador  == idABuscar)
					{
						var puestoPosta = w.puestoxcat;
						if(puestoPosta != w.puesto) puestoPosta = w.puesto;
						if(puestoPosta == posicionBuscada){
							botonCentral='<button id="cambio" class="btnCAMBIO libero" style="display: inline-block;">';
//							console.log('ENCONTRE CENTRAL.. w.idjugador '+w.idjugador+' idABuscar ' +idABuscar );					
							conteo++;		
						}
						else botonCentral = '<button id="cambio" class="btnCAMBIO" style="display: inline-block;">';
					}
			});	

   //console.log(' encontro (0=no,1>=si: ' +conteo);
return botonCentral;

}		

function buscarPosicion(vectorEquipo,idABuscar,posicionBuscada,retorno){
	var conteo=0;
	var botonCentral='';
	var colorFondo = 'style="backGround:#000;"';
	var colorFondoModo1 = ' backGround:#000;"';	
	
/* LLEGA EN POSICIONES DE CANCHA:
ColorPuestoCancha: "#1bd80e"
ColorPuestoCat	 : "#dc2327"
idjugador        : "154"
posicion		 : "6"
puesto			 : "4"
puestoxcat		 : "5"

*/	
	$(vectorEquipo).each(function(j, w)
			{ // indice =j ,0 valor = w
					//console.log('indice : ' + j + ' valor : ' +w);
					if (w.idjugador  == idABuscar)
					{
						var puestoPosta = w.puestoxcat;
								colorFondo = 'style="backGround:'+w.ColorPuestoCat+';"';
								colorFondoModo1 = ' backGround:'+w.ColorPuestoCat+';"';
						if(puestoPosta != w.puesto)
						{
							 puestoPosta = w.puesto;
								colorFondo = 'style="backGround:'+w.ColorPuestoCancha+';"';
								colorFondoModo1 = ' backGround:'+w.ColorPuestoCancha+';"';
						} 
						//if(puestoPosta == posicionBuscada){
							//botonCentral='<button id="cambio" class="btnCAMBIO" style="display: inline-block;'+colorFondo+'">';
						//	conteo++;
						//}	
//						else 
							if(retorno== 1);
							 colorFondo = '<button id="cambio" class="btnCAMBIO" style="display: inline-block;'+colorFondoModo1+'">';
					}
			});	
	return colorFondo;	

}		

	
function cargaCancha(){
//CARGAMOS LA CANCHA DE AMBOS EQUIPOS..	
//	console.log('cargaCancha()');
$("#erroresmensajes").empty();
var mensajesCentrales='';
	var params2 =
	 {
		"idpartido" : $("#partidoid").val(),
		"idset"     : $("#numSet").text(),
		"ianio"		:$("#ianio").val(),
		"fechas"    : <?php echo("'".$_GET['fecha']."'");?>,
		"quien"     :"cargaCancha"

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
					var linki = '';
					var idclubLocal     = $("#idcluba").val();
					var idclubVisitante = $("#idclubb").val();
				if(r['estado'] != "0") {
					$("#liberosA").html('');
					$("#suplentesA").html('');					
					contlibA='';//armado de LIBEROS DEL LOCAL
					var xSuplentesA=xSuplentesB='';
					$("#liberosB").html('');
					$("#suplentesB").html('');
					contlibB='';//armado de LIBEROS DEL VISITANTE
				/**** CARGAMOS LA LISTA DE LIBEROS...de ambos EQUIPOS **/	
				/**	ACA HABRIA QUE CARGAR LOS SUPLENTES...de ambos EQUIPOS **/	
					$(r['LiberosA']).each(function(j, w)
						{ // indice =j ,0 valor = w
								//console.log('indice : ' + j + ' valor : ' +w);
								//LA CLASE ITEML YA CONTIENE EL COLOR DEL LIBERO..
								//HAY QYE CAMBIARLO..
								if (! $('#liberosA').find("div[value='" + w.nombre + "']").length){
									var colorFondo = 'style="backGround:#000;"';
									var puestoPostaX = w.puestoxcat;
										colorFondo = 'style="backGround:'+w.ColorPuestoCat+';"';

								if(puestoPostaX != w.puesto)
								{
									puestoPostaX = w.puesto;
									colorFondo = 'style="backGround:'+w.ColorPuestoCancha+';"';
								} 

									contlibA +='<div '+colorFondo+ ' id="'+w.idjugador +'_L"  onclick="elegirSuplente(this.id,this.class);" >'+w.nombre +'<br>('+w.numero+')' +'</div>';
								}
						});	
					$(r['SuplentesA']).each(function(j, w)
						{ // indice =j ,0 valor = w
								//console.log('indice : ' + j + ' valor : ' +w);
						//5 = opuesto		
						esCentral='';
						//esCentral = buscarPosicion(r['SuplentesA'],w.idjugador,6,2);
						var colorFondo = 'style="backGround:#000;"';
						var puestoPostaX = w.puestoxcat;
							colorFondo = 'style="backGround:'+w.ColorPuestoCat+';"';

						if(puestoPostaX != w.puesto)
						{ 
							puestoPostaX = w.puesto;
									colorFondo = 'style="backGround:'+w.ColorPuestoCancha+';"';
						}

						if(puestoPostaX == 6)
							mensajesCentrales +='(C)'+w.nombre+' - ';
						else
							mensajesCentrales +='puesto : ('+puestoPostaX+')'+w.nombre+' - ';
								
						if (! $('#suplentesA').find("div[value='" + w.nombre + "']").length){
									xSuplentesA +='<div class="itemS" '+colorFondo+' id="'+w.idjugador +'_S"  onclick="elegirSuplente(this.id,this.class);" >'+w.nombre +'<br>('+w.numero+')' +'</div>';
								}
						});							
					$("#liberosA").html(contlibA);	
					$("#suplentesA").html(xSuplentesA);
					
					$("#erroresmensajes").html(mensajesCentrales);

					$(r['LiberosB']).each(function(j, w)
								{ // indice =j ,0 valor = w
					//			console.log(w);
									if (! $('#liberosB').find("div[value='" + w.nombre + "']").length){
								var colorFondo = 'style="backGround:#000;"';
								var puestoPostaX = w.puestoxcat;
									colorFondo = 'style="backGround:'+w.ColorPuestoCat+';"';

								if(puestoPostaX != w.puesto)
								{
									puestoPostaX = w.puesto;
									colorFondo = 'style="backGround:'+w.ColorPuestoCancha+';"';
								} 
										
										contlibB +='<div '+colorFondo+'  id="'+w.idjugador +'_L"  onclick="elegirSuplente(this.id,this.class);" >'+w.nombre +'<br>('+w.numero+')' +'</div>';
									}
								});	
					$(r['SuplentesB']).each(function(j, w)
						{ // indice =j ,0 valor = w
								//console.log('indice : ' + j + ' valor : ' +w);
								//w.puesto==

								if (! $('#suplentesB').find("div[value='" + w.nombre + "']").length){
							var colorFondo = 'style="backGround:#000;"';
							var puestoPostaX = w.puestoxcat;
								colorFondo = 'style="backGround:'+w.ColorPuestoCat+';"';

							if(puestoPostaX != w.puesto)
							{ 
								puestoPostaX = w.puesto;
										colorFondo = 'style="backGround:'+w.ColorPuestoCancha+';"';
							}

							if(puestoPostaX == 6)
								mensajesCentrales +='(C)'+w.nombre+' - ';
							else
								mensajesCentrales +='puesto : ('+puestoPostaX+')'+w.nombre+' - ';
									
									
									xSuplentesB +='<div class="itemS" '+colorFondo+' id="'+w.idjugador +'_S" onclick="elegirSuplente(this.id,this.class);"  >'+w.nombre +'<br>('+w.numero+')' +'</div>';
								}
						});							
								
					$("#liberosB").html(contlibB);	
					$("#suplentesB").html(xSuplentesB);
					
/********* CARGAMOS LA LISTA DE LIBEROS...de ambos EQUIPOS ************/	
					
					var esCentral = '';
					var esLibero  = '';
					var esArmador = '';

/********* CARGAMOS ESCUDO, NOMBRE Y QUIEN SACA...de ambos EQUIPOS ************/	
					$(r['PartidoData']).each(function(i,v)
					{
							var escudoAMarco=escudoBMarco='NoBorde';
							$("#saque").val(v.saque);

							if(v.saque == v.ClubA)
							{ 
								//textoClubA = v.ClubA;
								escudoAMarco = "bordeRojo";
								escudoBMarco = "NoBorde"; 
							}
							
							if(v.saque == v.ClubB)
							{ 
								//textoClubB  = v.ClubB;
								escudoAMarco = "NoBorde";
								escudoBMarco = "bordeRojo"; 
							}
							
						var ESCUDOA = '<span id="escudoAMarco" class="'+escudoAMarco+'"><img  src="img/jugadorGen.png" class="imgjugadorTablero2" ></img></span>';
						var textoClubA ='<div class="grillaIdClubv20"><div class="itmidclub2a" id="escudoA">'+ESCUDOA+'</div><div class="itmidclub1a">'+v.ClubA+'</div></div>';
						var ESCUDOB = '<span id="escudoBMarco" class="'+escudoBMarco+'"><img  src="img/jugadorGen.png" class="imgjugadorTablero2" ></img></span>';
						var textoClubB  = '<div class="grillaIdClubv20"><div class="itmidclub2a" id="escudoB" >'+ESCUDOB+'</div><div class="itmidclub1a">'+v.ClubB+'</div></div>';
								
						obtenerEscudo(v.ClubA,"escudoA",escudoAMarco) ;
						obtenerEscudo(v.ClubB,"escudoB",escudoBMarco) ;
						
					idclubLocal     = v.ClubA;
					idclubVisitante = v.ClubB;

					});
/********* CARGAMOS ESCUDO, NOMBRE Y QUIEN SACA...de ambos EQUIPOS ************/	

/********* CARGAMOS LA LISTA DE JUGADORES EN SU POSICION...de ambos EQUIPOS ************/	
					$(r['Sets']).each(function(i, v)
					{ // indice,0 valor
					//	console.log(v.equipoA);
						esCentral = buscarPosicion($(v.equipoA),v.pa_1idjugx,6,1);
					//ACA VA EL COLOR !!!!

						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pa_1idjugx+',\'A1\','+idclubLocal+','+$.urlParam('catP')+',1)">'+
								esCentral+
								'I - '+v.pa_1['jugx']+'</button></a>';
						$("#canchaa1").text('');
						$("#canchaa1").append(linki);

						esCentral = buscarPosicion($(v.equipoA),v.pa_2idjugx,6,1);
						esLibero = buscarLibero(r['LiberosA'],v.pa_2idjugx,2,1);//LIBERO
						if(!esCentral.includes("colorCentral"))
							esCentral =  buscarPosicion($(v.equipoA),v.pa_2idjugx,3,1);//armador
						//console.log('central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador);						
						esOpuesto = buscarPosicion($(v.equipoA),v.pa_2idjugx,5,1);										//console.log(v.pa_2idjugx + ' central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador + ' es opuesto: '+ esOpuesto);
						if(esLibero != '') esCentral = esLibero;
						if(!esCentral.includes("colorCentral"))
								if(!esCentral.includes("colorArmador"))
									if(!esCentral.includes("libero"))								 									esCentral = esOpuesto;
								 
						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pa_2idjugx+',\'A2\','+idclubLocal+','+$.urlParam('catP')+',2)">'+
								esCentral+
								'II - '+v.pa_2['jugx']+'</button></a>';
						$("#canchaa2").text('');
						$("#canchaa2").append(linki);

						esCentral = buscarPosicion($(v.equipoA),v.pa_3idjugx,6,1);
						esLibero = buscarLibero(r['LiberosA'],v.pa_3idjugx,2,1); //LIBERO

						if(!esCentral.includes("colorCentral"))							
							esCentral =  buscarPosicion($(v.equipoA),v.pa_3idjugx,3,1);//armador

						esOpuesto = buscarPosicion($(v.equipoA),v.pa_3idjugx,5,1);				
						
						if(esLibero != '') esCentral = esLibero;
						//console.log('en la variable final esCentral , quedo: '+esCentral);
						if(!esCentral.includes("colorCentral"))
								if(!esCentral.includes("colorArmador"))
									if(!esCentral.includes("libero"))
										 esCentral = esOpuesto;

						//console.log('A3 '+v.pa_3idjugx + ' central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador + ' es opuesto: '+ esOpuesto);


						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pa_3idjugx+',\'A3\','+idclubLocal+','+$.urlParam('catP')+',3)">'+
								esCentral+
								'III - '+v.pa_3['jugx']+'</button></a>';
						$("#canchaa3").text('');
						$("#canchaa3").append(linki);

						esCentral = buscarPosicion($(v.equipoA),v.pa_4idjugx,6,1);
						esLibero = buscarLibero(r['LiberosA'],v.pa_4idjugx,2,1); //LIBERO
						if(!esCentral.includes("colorCentral"))
							esCentral =  buscarPosicion($(v.equipoA),v.pa_4idjugx,3,1);//armador
						//console.log('central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador);
						esOpuesto = buscarPosicion($(v.equipoA),v.pa_4idjugx,5,1);

						//console.log(v.pa_4idjugx + ' central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador + ' es opuesto: '+ esOpuesto);
						if(esLibero != '') esCentral = esLibero;
						if(!esCentral.includes("colorCentral"))
								if(!esCentral.includes("colorArmador"))
									if(!esCentral.includes("libero"))								 										esCentral = esOpuesto;

						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pa_4idjugx+',\'A4\','+idclubLocal+','+$.urlParam('catP')+',4)">'+

								esCentral+
								'IV - '+v.pa_4['jugx']+'</button></a>';
						$("#canchaa4").text('');
						$("#canchaa4").append(linki);

						esCentral = buscarPosicion($(v.equipoA),v.pa_5idjugx,6,1);
						esLibero = buscarLibero(r['LiberosA'],v.pa_5idjugx,2,1);//LIBERO	
						if(!esCentral.includes("colorCentral"))	
							esCentral =  buscarPosicion($(v.equipoA),v.pa_5idjugx,3,1);//armador
						//console.log('central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador);
						esOpuesto = buscarPosicion($(v.equipoA),v.pa_5idjugx,5,1);
						//console.log(v.pa_5idjugx + ' central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador + ' es opuesto: '+ esOpuesto);
						if(esLibero != '') esCentral = esLibero;
						if(!esCentral.includes("colorCentral"))
								if(!esCentral.includes("colorArmador"))
									if(!esCentral.includes("libero"))								 									esCentral = esOpuesto;

						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pa_5idjugx+',\'A5\','+idclubLocal+','+$.urlParam('catP')+',5)">'+
								esCentral+
								'V - '+v.pa_5['jugx']+'</button></a>';
						$("#canchaa5").text('');
						$("#canchaa5").append(linki);

						esCentral = buscarPosicion($(v.equipoA),v.pa_6idjugx,6,1);						
						esLibero = buscarLibero(r['LiberosA'],v.pa_6idjugx,2,1);//LIBERO								
						if(!esCentral.includes("colorCentral"))							
							esCentral =  buscarPosicion($(v.equipoA),v.pa_6idjugx,3,1);//armador
							//console.log('central : '+ esCentral+' libero : '+
							//esLibero+' armador: ' +esArmador);
						esOpuesto = buscarPosicion($(v.equipoA),v.pa_6idjugx,5,1);
						//console.log(v.pa_6idjugx + ' central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador + ' es opuesto: '+ esOpuesto);
						if(esLibero != '') esCentral = esLibero;
						if(!esCentral.includes("colorCentral"))
							if(!esCentral.includes("colorArmador"))
							   if(!esCentral.includes("libero"))
									 esCentral = esOpuesto;

						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pa_6idjugx+',\'A6\','+idclubLocal+','+$.urlParam('catP')+',6)">'+
								esCentral+
								'VI - '+v.pa_6['jugx']+'</button></a>';
						$("#canchaa6").text('');
						$("#canchaa6").append(linki);

						esCentral = buscarPosicion($(v.equipoB),v.pb_1idjugx,6,1);						
						esLibero = buscarLibero(r['LiberosB'],v.pb_1idjugx,2,1);//LIBERO								
						if(!esCentral.includes("colorCentral"))							
							esCentral =  buscarPosicion($(v.equipoB),v.pb_1idjugx,3,1);//armador	
						//console.log('central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador);														
						esOpuesto = buscarPosicion($(v.equipoB),v.pb_1idjugx,5,1);		
						//console.log(v.pb_1idjugx + ' central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador + ' es opuesto: '+ esOpuesto);
						if(esLibero != '') esCentral = esLibero;
						if(!esCentral.includes("colorCentral"))
							if(!esCentral.includes("colorArmador"))
								if(!esCentral.includes("libero"))																		esCentral = esOpuesto;

						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pb_1idjugx+',\'B1\','+idclubLocal+','+$.urlParam('catP')+',1)">'+

								esCentral+
								'I - '+v.pb_1['jugx']+'</button></a>';
						$("#canchab1").text('');
						$("#canchab1").append(linki);

						esCentral = buscarPosicion($(v.equipoB),v.pb_2idjugx,6,1);												
						esLibero = buscarLibero(r['LiberosB'],v.pb_2idjugx,2,1);//LIBERO						
						if(!esCentral.includes("colorCentral"))						
							esCentral =  buscarPosicion($(v.equipoB),v.pb_2idjugx,3,1);//armador	
						//console.log('central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador);												
						esOpuesto = buscarPosicion($(v.equipoB),v.pb_2idjugx,5,1);		
						//console.log(v.pb_2idjugx + ' central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador + ' es opuesto: '+ esOpuesto);
						if(esLibero != '') esCentral = esLibero;
						if(!esCentral.includes("colorCentral"))
							if(!esCentral.includes("colorArmador"))
									if(!esCentral.includes("libero"))	
										 esCentral = esOpuesto;

						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pb_2idjugx+',\'B2\','+idclubLocal+','+$.urlParam('catP')+',2)">'+

								esCentral+
								'II - '+v.pb_2['jugx']+'</button></a>';
						$("#canchab2").text('');
						$("#canchab2").append(linki);

						esCentral = buscarPosicion($(v.equipoB),v.pb_3idjugx,6,1);												
						esLibero = buscarLibero(r['LiberosB'],v.pb_3idjugx,2,1);//LIBERO						
						if(!esCentral.includes("colorCentral"))						
							esCentral =  buscarPosicion($(v.equipoB),v.pb_3idjugx,3,1);//armador

						//console.log('central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador);						
						esOpuesto = buscarPosicion($(v.equipoB),v.pb_3idjugx,5,1);		
						//console.log(v.pb_3idjugx + ' central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador + ' es opuesto: '+ esOpuesto);
						if(esLibero != '') esCentral = esLibero;
						if(!esCentral.includes("colorCentral"))
							if(!esCentral.includes("colorArmador"))
									if(!esCentral.includes("libero"))
								 		esCentral = esOpuesto;

						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pb_3idjugx+',\'B3\','+idclubLocal+','+$.urlParam('catP')+',3)">'+

								esCentral+
								'III - '+v.pb_3['jugx']+'</button></a>';
						$("#canchab3").text('');
						$("#canchab3").append(linki);

						esCentral = buscarPosicion($(v.equipoB),v.pb_4idjugx,6,1);												
						esLibero = buscarLibero(r['LiberosB'],v.pb_4idjugx,2,1);						
						if(!esCentral.includes("colorCentral"))						
							esCentral =  buscarPosicion($(v.equipoB),v.pb_4idjugx,3,1);//armador	
						//console.log('central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador);											
						esOpuesto = buscarPosicion($(v.equipoB),v.pb_4idjugx,5,1);		
						//console.log(v.pb_4idjugx + ' central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador + ' es opuesto: '+ esOpuesto);
						if(esLibero != '') esCentral = esLibero;
						if(!esCentral.includes("colorCentral"))
							if(!esCentral.includes("colorArmador"))
								if(!esCentral.includes("libero"))
									 esCentral = esOpuesto;

						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pb_4idjugx+',\'B4\','+idclubLocal+','+$.urlParam('catP')+',4)">'+
								esCentral+
								'IV - '+v.pb_4['jugx']+'</button></a>';
						$("#canchab4").text('');
						$("#canchab4").append(linki);

						esCentral = buscarPosicion($(v.equipoB),v.pb_5idjugx,6,1);												
						esLibero = buscarLibero(r['LiberosB'],v.pb_5idjugx,2,1);										if(!esCentral.includes("colorCentral"))								
							esCentral =  buscarPosicion($(v.equipoB),v.pb_5idjugx,3,1);//armador	
						//console.log('central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador);																	
						esOpuesto = buscarPosicion($(v.equipoB),v.pb_5idjugx,5,1);		
						//console.log(v.pb_5idjugx + ' central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador + ' es opuesto: '+ esOpuesto);
						if(esLibero != '') esCentral = esLibero;
						if(!esCentral.includes("colorCentral"))
							if(!esCentral.includes("colorArmador"))
									if(!esCentral.includes("libero"))
								 		esCentral = esOpuesto;

						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pb_5idjugx+',\'B5\','+idclubLocal+','+$.urlParam('catP')+')",5>'+
								esCentral+
								'V - '+v.pb_5['jugx']+'</button></a>';
						$("#canchab5").text('');
						$("#canchab5").append(linki);
						
						esCentral = buscarPosicion($(v.equipoB),v.pb_6idjugx,6,1);												
						esLibero = buscarLibero(r['LiberosB'],v.pb_6idjugx,2,1);										if(!esCentral.includes("colorCentral"))								
							esCentral =  buscarPosicion($(v.equipoB),v.pb_6idjugx,3,1);//armador	
						//console.log('central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador);
						esOpuesto = buscarPosicion($(v.equipoB),v.pb_6idjugx,5,1);		
						//console.log(v.pb_6idjugx + ' central : '+ esCentral+' libero : '+esLibero+' armador: ' +esArmador + ' es opuesto: '+ esOpuesto);
						if(esLibero != '') esCentral = esLibero;
						if(!esCentral.includes("colorCentral"))
							if(!esCentral.includes("colorArmador"))
								if(!esCentral.includes("libero"))
									 esCentral = esOpuesto;
									 
						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pb_6idjugx+',\'B6\','+idclubLocal+','+$.urlParam('catP')+')",6>'+
								esCentral+
								'VI- '+v.pb_6['jugx']+'</button></a>';
						$("#canchab6").text('');
						$("#canchab6").append(linki);
						
						
								$("#saque").val(v.saque);
//analisis del tiempo pedido del equipo LOCAL				
								if(v.CantPausaA == 1)
								{
									$("#tiempoA1").css("background","#DC0A89");
								};

								if(v.CantPausaA == 0)
								{
									$("#tiempoA1").css("background","#DC0A89");	
									$("#tiempoA2").css("background","#DC0A89");

									$("#btnt1A").css("background","#142D5B");
									$("#btnt1A").prop('disabled', true);
									$("#btnt2A").css("background","#142D5B");
									$("#btnt2A").prop('disabled', true);
								};						
//analisis del tiempo pedido del equipo LOCAL	
//analisis del tiempo pedido del equipo VISTANTE
								if(v.CantPausaB == 1)	
								{
									$("#tiempoB1").css("background","#DC0A89");
								};
								if(v.CantPausaB == 0)
								{
									$("#tiempoB1").css("background","#DC0A89");	
									$("#tiempoB2").css("background","#DC0A89");
									$("#btnt1B").css("background","#142D5B");
									$("#btnt1B").prop('disabled', true);
									$("#btnt2B").css("background","#142D5B");
									$("#btnt2B").prop('disabled', true);							   
								};						

					});
/********* CARGAMOS LA LISTA DE JUGADORES EN SU POSICION...de ambos EQUIPOS ************/	
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
		<?php include('includes/newmenu.php'); ?>
		<?php 
			require('abms/Set.php'); 
 			  $idpartido = (int) $_GET['id'];
			  //$newset = Sett::ultSetNum($idpartido);
			  $idnewset = (int) $_GET['setid']; 
		
		?>	
<section id="medioset" class="medioset">
<div class="grid-container22" id="xgrid-container22">
	<div class="item22_0a"></div>
	<div class="item22_0b"></div>
	<div class="item22_0c"></div>
	<div class="item22_1"><div id="competencia"></div></div>
	<div class="item22_2">
		<div id="categoria" >CATEGORIA<input id="idcat" type="hidden" value=""/></div>
	    <input id="partidoid" value="<?php echo $idpartido; ?>" type="hidden"/>
	</div>
	<div class="item22_3"><div id="fecha" name="fecha" >FECHA - </div></div>		
	<div class="item22_4" id="stopwatch"></div>	
	<div class="item22_5" id="partidoCancha"></div>
	<div class="item22_6" id="numSet" ><?php echo($idnewset);?></div>	
	<div class="item22_7">
		<select id="ianio" name="ianio" class="ianio">
			<option value="9999">Seleccionar año...</option>
		</select>
	</div>
	<div class="item22_7a">
    <a href="CSets2.php?id=<?php echo $idpartido; ?>&setmax=<?php echo($_GET['setmax']); ?>&fecha=<?php echo($_GET['fecha']);?>">
    <button id="volver" title="volver a partidos" name="volver" class="btnPop29"> << </button>
    </a>
	</div>
	<div class="item22_7b">
		<a href="ModPartido.php?id=<?php echo $idpartido; ?>&fechapart=<?php echo($_GET['fecha']);?>&novedad=1&setid=<?php echo($_GET['setid']);?>&setmax=<?php echo($_GET['setmax']);?>">
	<button id="modifica" title="modifica partido" name="modifica" class="btnPop3">Mod.Part.</button></a>
	</div>
	<div class="item22_7c">
    	<button id="CierraSet" name="CierraSet" class="btnPop30">X (Set)</button>
	</div>		
	<div class="item22_8">
    	<button id="grabarPos" name="grabarPos" title="Grabar Inicio Set" class="btnPop31">Imprime Set inicio</button>		

	</div>
	<div class="item22_9">
		<button id="reanudar" name="reanudar" title="Reanudar partido" class="btnPop32"><span class="icon-play2"> (Reanudar)</span></button> 
	</div>
	<div class="item22_10">
		<button id="reload" name="grabarPos_20" title="Reload" class="btnPop3" onclick="javascript:location.reload();"><span class="icon-download"> (reload)</span></button>
	</div>
	<div class="item22_11">
		<select id="saque" name="saque" class="SELECTEXTREMO"><option value="9999">Tiene saque..</option></select>
	</div>
</div> 
 <div class="grid-containerAlfa">
 	<div class="itemA_1">
 		<input type="text" id="medidas" name="medidas" value="" disabled/>
 	</div>
 	<div class="itemA_2">
 		<button id="ocultaControles" name="CierraSet" class="btnPop3">X</button>
 	</div>
 	<div class="itemA_3">Tiempo Total Partido</div>
 	<div class="itemA_4">
 		 <span id="tiempotranscurrido" name="tiempostranscurrido"></span>
 	</div>
 	<div class="itemA_5">Tiempo del Set</div>
 	<div class="itemA_6">
 		<span id="tiempotranscurridoSet" name="tiempostranscurridoSet"></span>
 	</div>
 	<div class="itemA_7">Hora Actual</div>
	<div class="itemA_8">
		<span id="horaactual" name="horaactual"></span>
	</div>	 	
 </div>   

    <section id="botoneraAx" class="botoneraAx">
    	<div class="GridBotCol">
    	</div>
    	<div class="GridBotCol">
    		<input type="hidden" id="setactual" value="<?php echo($idnewset); ?>"/><input type="hidden" id="setmax" value="<?php echo($_GET['setmax']); ?>"/>    	
			<input type="hidden" id="valorFINSETCOMUN" value=""/>
		    <input type="hidden" id="valorFINENTIE" value=""/>	
		</div>
    	<div class="GridBotCol"></div>
   </section>

<!--
<section class="bloqueFotos">	
	<button id="subirFotos" name="subirFotos" title="Agregar fotos al tablero" class="btnPopSubeFotos">Sube Fotos</button>
	<button   id="LIMPIAR" name="LIMPIAR" title="Limpiar mensajes" class="btnPopSubeFotos">Clear</button>
</section>	
-->
<section class="bloquemensajes">	
	<div id="erroresmensajes"></div>
</section>
<div  id="TablaInfoReferencial" class="TablaInfoReferencial">
	<form  method='POST' id='fsubir' name='fsubir' enctype='multipart/form-data' >
		<div class="itemTitulo1Ref">Subir foto para tablero del partido</div>
		<div class="itemTitulo2Ref"><input type="file" name="fotoPartido" id="fotoPartido"/></div>
		<div>
			<input type="hidden" name="partidoid"  value="<?php echo($_GET['id']); ?>"/>
			<input type="hidden" name="fechapart"  value="<?php echo($_GET['fecha']); ?>"/>			
		</div>
		<div class="itemRef0">
			<select id="icarpetas" name="icarpetas" title="carpetas de fotos" class="selectCarpetas">Carpeta destino
				<?php 
					$imagenEncontrada = scandir('./img/partidos/');
					foreach($imagenEncontrada as $indice => $valor)
						if($valor != "." && $valor != ".." && $valor != "" )
					  			echo "<option value='$valor'>$valor</option>";
				?>
			</select>
		</div>		
		<div class="itemRef">
			<button type="submit"  id="subeFoto" name="subeFoto" title="Upload foto" class="btnPopSubeFotos">Subir</button>
			<button   id="fLIMPIAR" name="LIMPIAR" title="Limpiar mensajes" class="btnPopSubeFotos">Clear</button>
		</div>
	</form>
	<hr>
    <p class="respuesta">
</div>

<!----SOLO SUMAR Y RESTAR -->
<section class="bloqueRotar">	
    	<section class="repararrotacion">
    	<button id="incremA" title="Sumar PUNTO LOCAL" name="incremA" class="btnPop26">+</button>	    	
	<button id="decremA" title="Restar PUNTO LOCAL/corregir" name="decremA" class="btnPop25">-</button>
	
		<button id="itemAdelaA"  name="itemAdelaA" class="btnPop28" onclick="adelantarRotacion('idcluba');"> Forwrd </button>
		<button id="itemAtrasA"  name="itemAtrasA" class="btnPop27" onclick="retrasarRotacion('idcluba') ;"> Backwrd </button>
	
		</section>
    	<section class="repararrotacion">		
<button id="incremB" title="Suma PUNTO VISITANTE" name="incremB" class="btnPop26">+</button>   
<button id="decremB" title="Restar PUNTO VISITANTE/corregir" name="decremB" class="btnPop25">-</button>
		<button id="itemAtrasB"  name="itemAtrasB"  class="btnPop28" onclick="adelantarRotacion('idclubb');">Forwrd</button>
		<button id="itemAdelaB"  name="itemAdelaB"  class="btnPop27" onclick="retrasarRotacion('idclubb') ;">Backwrd</button>
	</section>    	    	
    </section>
<!-- SOLO SUMAR Y RESTAR -->
<!-- GIRAR ROTACION 
<section class="bloqueRotar">	
	<section class="repararrotacion">
		<button id="itemAdelaA"  name="itemAdelaA" class="btnPop3" onclick="adelantarRotacion('idcluba');"> Forwrd </button>
		<button id="itemAtrasA"  name="itemAtrasA" class="btnPop3" onclick="retrasarRotacion('idcluba') ;"> Backwrd </button>
	</section>
	<section class="repararrotacion2">
		<button id="itemAtrasB"  name="itemAtrasB"  class="btnPop3" onclick="adelantarRotacion('idclubb');">Forwrd</button>
		<button id="itemAdelaB"  name="itemAdelaB"  class="btnPop3" onclick="retrasarRotacion('idclubb') ;">Backwrd</button>
	</section>
</section>	
-->

<!--    <section id="cronocontroles" class="cronocontroles">  -->
		<div class="Espacioclub2">
						 <div class="itemEC2_1">
							 <div class="" id="clublocal">
							 <div id="nomA" class="" >
							 	<input id="idcluba" type="hidden" value=""/>
							</div>	
								<div class="grillaIdClub">
									<div class="itmidclub2"></div>
									<div class="itmidclub1"></div>
								</div>
							</div>
						</div>
						<div class="itemEC2_2">
								<div class="numero" id="resa">##</div>
						</div>
						 <div class="itemEC2_3">			
							   <div class="numero" id="resb">##</div>
						</div>
						
						 <div class="itemEC2_4">			
							 <div class="" id="clubvisitante">
							 <div id="nomB" class="" >
							 	<input id="idclubb" type="hidden" value=""/>
							</div>	
								<div class="grillaIdClub">
									<div class="itmidclub2"></div>
									<div class="itmidclub1"></div>
								</div>
							</div>
						</div>
						<div class="itemEC2_4A">
					<section id="tiemposA" class="gridcol tiempos"> 
						<div id="tiempoA1" class="tiempoIndividual t1">1T</div>
						<div id="tiempoA2" class="tiempoIndividual t2">2T</div>
						<div id="tiempoAB" class="tiempoIndividual t1"><button id="btnt1A" class="botont1" name="botont1a" onclick="var clubpide=$('#nombrelocal').text();var clubSelId=$('#idcluba').val();tiempoGraba(clubSelId,clubpide,'tiempoA1',this.id);">pide T1</button></div>
						<div id="tiempoAB" class="tiempoIndividual t2"><button id="btnt2A" class="botont2" name="botont2a" onclick="var clubpide=$('#nombrelocal').text();var clubSelId=$('#idcluba').val();tiempoGraba(clubSelId,clubpide,'tiempoA2',this.id);">pide T2</button></div>	
					</section>
						</div>
						<div class="itemEC2_4B">
						<section id="tiemposB" class="gridcol tiempos gridColMargenRight"> 
							<div id="tiempoB1" class="tiempoIndividual t1">1T</div>
							<div id="tiempoB2" class="tiempoIndividual t2">2T</div>
							<div id="tiempoAB" class="tiempoIndividual t1"><button id="btnt1B" class="botont1" name="botont1b" onclick="var clubpide=$('#nombrevisita').text();var clubSelId=$('#idclubb').val();tiempoGraba(clubSelId,clubpide,'tiempoB1',this.id);">pide T1</button></div>
							<div id="tiempoAB" class="tiempoIndividual t2"><button id="btnt2B" class="botont2" name="botont2b" onclick="var clubpide=$('#nombrevisita').text();var clubSelId=$('#idclubb').val();tiempoGraba(clubSelId,clubpide,'tiempoB2',this.id);">pide T2</button></div>	
						</section>	
							
							
						</div>
						<div class="itemEC2_5">
							<span id="nomAEstado">
								<section class="xpunto21  sinMarginTop">
								 <div class="" id="setsganadosA"></div>
								</section>	 	 			
							</span>
						</div>
						<div class="itemEC2_6">
							<span id="nomBEstado">
								<section class="xpunto21  sinMarginTop">
								 <div class="" id="setsganadosB"></div>
								</section>	 	 			
							</span>
						</div>
				</div>
<!--	  </section>	 -->
	<input id="HoraInicial" name="HoraInicial" value="" type="hidden"/>
	<input id="HoraInicioSet" name="HoraInicioSet" value="" type="hidden"/>	
	<section id="liberosA" class="ControlLiberos"></section>	
	<section id="suplentesA" class="ControlSuplentes"></section>		
    <section id="canchaA" class="canchaversion2">
    <div id="canchaa5" class="canchaversion2item5" >EN 5A - REMERA ##</div>
    <div id="canchaa4" class="canchaversion2item4  bordeRight" >JUGADOR EN 4A - REMERA ##</div>
    <div id="canchaa6" class="canchaversion2item6" >JUGADOR EN 6A - REMERA ##</div>
    <div id="canchaa3" class="canchaversion2item3  bordeRight" >JUGADOR EN 3A - REMERA ##</div>
    <div id="canchaa1" class="canchaversion2item1" >JUGADOR EN 1A - REMERA ##</div>
    <div id="canchaa2" class="canchaversion2item2  bordeRight" >JUGADOR EN 2A - REMERA ##</div>
    </section>

	<section id="liberosB" class="ControlLiberos segundoControl"></section>	
	<section id="suplentesB" class="ControlSuplentes tercerControl"></section>		
    <section id="canchaV" class="canchaversion2">
    <div id="canchab2" class="canchaversion2item2  bordeLeft" >JUGADOR EN 2B - REMERA ##</div>
    <div id="canchab1" class="canchaversion2item1" >JUGADOR EN 1B - REMERA ##</div>
    <div id="canchab3" class="canchaversion2item3  bordeLeft" >JUGADOR EN 3B - REMERA ##</div>
    <div id="canchab6" class="canchaversion2item6" >JUGADOR EN 6B - REMERA ##</div>
    <div id="canchab4" class="canchaversion2item4  bordeLeft" >JUGADOR EN 4B - REMERA ##</div>
    <div id="canchab5" class="canchaversion2item5" >JUGADOR EN 5B - REMERA ##</div>
    </section>

<!--    

</section> 

-->
</body>
</html>